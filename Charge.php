<?php
namespace Dfe\Vantiv;
use Df\Payment\Init\Action;
use Dfe\Vantiv\Facade\Card;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Address as OA;
use Magento\Sales\Model\Order\Item as OI;
/**
 * 2018-12-19
 * @method Method m()
 * @method Settings s()
 */
final class Charge extends \Df\Payment\Charge {
	/**
	 * 2018-12-19
	 * @used-by p()
	 * @return array(string => mixed)
	 */
	private function pCharge() {
		$ba = $this->addressB(); /** @var OA $ba */
		$capture = Action::sg($this->m())->preconfiguredToCapture(); /** @var bool $capture */
		$m = $this->m(); /** @var Method $m */
		$card = $m->card(); /** @var Card $card */
		$o = $this->o(); /** @var O $o */
		$s = $this->s(); /** @var Settings $s */
		$sa = $this->addressS(); /** @var OA $sa */
		$liIndex = 1; /** @var int $liIndex */
		return [
			'authentication' => ['user' => $s->publicKey(), 'password' => $s->privateKey()]
			,df_xml_node($capture ? 'sale' : 'authorization'
				,['customerId' => $this->customerEmail(), 'reportGroup' => $s->merchantID()]
				,[
					// 2018-12-19
					// «The orderId element is a required child of several transaction types
					// and defines a merchant-assigned value representing the order in the merchant’s system.
					// Type = String; minLength = N/A; maxLength = 25».
					'orderId' => $this->id()
					// 2018-12-19
					// «The amount element is a child of several elements.
					// When used in a payment transaction this element defines the amount of the transaction.
					// Supply the value in cents without a decimal point (except as noted below).
					// For example, a value of 1995 signifies $19.95.».
					// NOTE: For the following currencies,
					// the value you submit is the amount without implied decimal:
					// Burundian Franc, Chilean Peso, Comoro Franc, Djibouti Franc, Guinea Franc,
					// Iceland Krona, Japanese Yen, South Korean Won, Vanuatu Vatu, Paraguayan Guarani,
					// Rawanda Franc, Vietnamese Dong, Uganda Shilling, CFA Franc BEAC, CFA Franc BCEAO,
					// and CFP Franc.
					,'amount' => $this->amountF()
					// 2018-12-19
					// «The orderSource element defines the order entry source for the type of transaction».
					// Type = Choice (enum); minLength = N/A; maxLength = N/A
					// 		ecommerce: The transaction is an Internet or electronic commerce transaction.
					,'orderSource' => 'ecommerce'
					// 2018-12-19
					// «The billToAddress element contains several child elements
					// that define the postal mailing address (and telephone number) used for billing purposes.
					// It also contains several elements used for the eCheck verification process.»
					,'billToAddress' => [
						'addressLine1' => $ba->getStreetLine(1)
						,'addressLine2' => $ba->getStreetLine(2)
						,'city' => $ba->getCity()
						,'companyName' => $ba->getCompany()
						,'country' => $ba->getCountryId()
						,'firstName' => $ba->getFirstname()
						,'lastName' => $ba->getLastname()
						,'phone' => $ba->getTelephone()
						,'state' => $ba->getRegion()
						,'zip' => $ba->getPostcode()
					]
					// 2018-12-19
					// «The card element defines payment card information.
					// It is a required element for most transaction types
					// unless the transaction uses an alternate payment method such as PayPal.
					// It contains one or more child elements depending upon whether the transaction
					// is a card-not-present or a card-present (face-to-face) transaction.»
					,'card' => [
						'type' => $card->brandCodeE()
						,'number' => $card->number()
						,'expDate' => $card->expMonth2() . $card->expYear2()
						,'cardValidationNum' => $card->cvc()
					]
					// 2018-12-19
					// «The cardholderAuthentication element
					// is an optional child element of the Authorization and Sale transactions.
					// The children of this element have two purposes.
					// The first is to define Verified by Visa or MasterCard SecureCode data
					// in the Authorization or Sale transactions
					// (authenticationValue, authenticationTransactionId,
					// and authenticatedByMerchant elements).
					// The customerIpAddress element can also be used to supply the customer IP Address
					// by merchants enabled for American Express Advanced AVS services.»
					,'cardholderAuthentication' => ['customerIpAddress' => $this->customerIp()]
					// 2018-12-19
					// «The customBilling element allows you to specify
					// custom billing descriptor information for the transaction.
					// This billing descriptor is used instead of the descriptor
					// defined as the default billing descriptor.
					// If you do not define this element, the default is used.»
					,'customBilling' => [
						// 2018-12-19
						// «NOTE: Please consult your Relationship Manager prior to using the <url> element.
						// The contents of this element are discarded
						// unless Worldpay specifically enables the use it in your cnpAPI submissions.»
						// 2018-12-20 It should be <= 13 characters
						'url' => substr(df_domain_current(), 0, 13)
					]
					/**
					 * 2018-12-19
					 * «The enhancedData element allows you to specify extra information
					 * concerning a transaction in order to qualify for certain purchasing interchange rates.
					 * The following tables provide information about required elements you must submit
					 * to achieve Level 2 or Level 3 Interchange rates for Visa and MasterCard.
					 * For MasterCard:
					 * 	-	The transaction must be taxable.
					 *  -	The tax charged must be between 0.1% and 30% of the transaction amount,
					 *		except as noted below.
					 * 	-	For Level 3, the transaction must use a corporate, business, or purchasing card.
					 * NOTE: You can qualify for MasterCard Level 2 rates
					 * without submitting the total tax amount (submit 0)
					 * if your MCC is one of the following:
					 * 4111, 4131, 4215, 4784, 8211, 8220, 8398, 8661, 9211, 9222, 9311, 9399, 9402.
					 * This also applies to Level 3, regardless of your MCC (i.e., submission of 0 allowed).
					 * 	-	You must include at least one line item with amount,
					 * 		description, and quantity defined.
					 * »
					 */
					,'enhancedData' => [
						// 2018-12-19
						// «The salesTax element defines the amount of sales tax
						// included in the transaction amount.
						// Although the schema defines it as an optional child of the enhancedData element,
						// it is required to receive the best interchange rate
						// for Level II and Level III corporate purchases.
						// The decimal is implied. Example: 500 = $5.00.»
						'salesTax' => $this->cFromDocF($o->getTaxAmount())
						,'discountAmount' => $this->cFromDocF($o->getDiscountAmount())
						,'shippingAmount' => $this->cFromDocF($o->getShippingAmount())
						,'destinationPostalCode' => $sa->getPostcode()
						,'destinationCountryCode' => $sa->getCountryId()
						// 2018-12-19
						// «The date the order was placed.
						// If you do not know the order date, do not include this element.
						// Type = Date; Format = YYYY-MM-DD»
						,'orderDate' => df_date()->toString('y-MM-dd')
						// 2018-12-19
						// «The detailTax element is an optional child
						// of both the enhancedData and lineItemData elements,
						// which you use to specify detailed tax information (for example, city or local tax).
						// The total sum of the detailTax values should match either the salesTax value,
						// if detailTax is a child of enhancedData,
						// or the taxAmount element if detailTax is a child of lineItemData.»
						,'detailTax' => [
							// 2018-12-19
							// «The taxIncludedInTotal element is an optional child of the detailTax element
							// and defines whether or not the tax is included in the total purchase amount.
							// Type = Boolean; Valid Values = true or false»
							'taxIncludedInTotal' => df_bts(dff_eq($o->getSubtotal(), $o->getSubtotalInclTax()))
							,'taxAmount' => $this->cFromDocF($o->getTaxAmount())
						]
						// 2018-12-19
						// «The lineItemData element contains several child elements
						// used to define information concerning individual items in the order.
						// Although the schema defines it as an optional child of the enhancedData element,
						// it is required for Level III interchange rates.»
						,'lineItemData' => array_values($this->oiLeafs(function(OI $i) use(&$liIndex) {return [
							// 2018-12-19
							// «The itemSequenceNumber element is an optional child of the lineItemData element
							// (required for Visa transactions).
							// When providing line item data,
							// you must number each item sequentially starting with 1.
							// Type = Integer; minInclusive value = 1, maxInclusive value = 99»
							'itemSequenceNumber' => $liIndex++
							// 2018-12-19
							// «The itemDescription element is a required child of the lineItemData element,
							// which provides a brief text description of the item purchased.
							// Type = String; minLength = N/A; maxLength = 26»
							// 2018-12-20
							// We need to chop the string to 24 symbols,
							// because Vantiv treats the … Unicode symbol as 3 symbols.
							// 2019-01-28
							// It seems that Vantiv sometimes fails with the … Unicode symbol at all:
							// https://www.upwork.com/messages/rooms/room_a47917c5cb842618a58747d62e02deee/story_18b0527e26fb4095099b2771f9b9802f
							// So I stoped using this symbol at all.
							// Now I afraid to use mb_substr() for the same reason too, so I use substr().
							,'itemDescription' => substr($i->getName(), 0, 26)
							// 2018-12-19
							// «The productCode element is an optional child of the lineItemData element,
							// which specifies the product code of the purchased item.
							// This value is a merchant defined description code of the product/service.
							// This could be an inventory number, UPC, catalog number,
							// or some other value that the merchant uses to define the specific product.
							// Although an optional element,
							// it is required by Visa and MasterCard when specifying line item data.
							// Type = String; minLength = 1; maxLength = 12»
							,'productCode' => $i->getSku()
							// 2018-12-19
							// «The quantity element is an optional child of the lineItemData element,
							// which specifies the number of items purchased.
							// Although an optional element,
							// it is required by Visa and MasterCard when specifying line item data.
							// The value must be greater than zero,
							// but no more than 12 digits not including the decimal point.
							// Type = Decimal; minInclusive = 0; totalDigits = 12»
							,'quantity' => $i->getQtyOrdered()
							// 2018-12-19
							// «The taxAmount element is a required child of the detailTax element
							// and an optional child of the lineItemData element
							// and defines the detail tax amount on the purchased good or service.
							// The decimal is implied. Example: 500 = $5.00.
							// Type = Integer; totalDigits = 8
							// NOTE: If you include taxAmount as a child of lineItemData along with detailTax,
							// the lineItemData taxAmount should be the sum of the taxAmount children
							// from detailTax children.»
							,'taxAmount' => $this->cFromDocF($i->getTaxAmount())
							// 2018-12-19
							// «The lineItemTotal element is an optional child of the lineItemData element,
							// which specifies the total cost of the line items purchased, not including tax.
							// For example, if the order was for 500 pencils at $1.00 each,
							// the lineItemTotal would be $500.
							// Although an optional element,
							// it is required by Visa and MasterCard when specifying line item data.
							// The decimal is implied. Example: 500 = $5.00.
							// Type = Integer; totalDigits = 8»
							,'lineItemTotal' => $this->cFromDocF(df_oqi_total($i))
							// 2018-12-19
							// «The lineItemTotalWithTax element is an optional child of the lineItemData element,
							// which specifies the total cost of the line items purchased including tax.
							// If the tax is not known, do not include this element.
							// The decimal is implied. Example: 500 = $5.00.
							// Type = Integer; totalDigits = 8»
							,'lineItemTotalWithTax' => $this->cFromDocF(df_oqi_total($i, true))
							// 2018-12-19
							// «The itemDiscountAmount element is an optional child of the lineItemData element,
							// which specifies the item discount amount.
							// Although an optional element,
							// it is required by Visa for Level III Interchange rates.
							// The value must be greater than or equal to 0.
							// The decimal is implied. Example: 500 = $5.00.
							// Type = Integer; totalDigits = 8»
							,'itemDiscountAmount' => $this->cFromDocF($i->getDiscountAmount())
							// 2018-12-19
							// «The unitCost element is an optional child of the lineItemData element,
							// which specifies the price of one unit of the item purchased.
							// Although the schema defines it as an optional child of the enhancedData element,
							// it is required by Visa for Level III interchange rates.
							// The value must be greater than or equal to 0.
							// Type = Decimal; minInclusive value = 0, totalDigits = 12»
							,'unitCost' => $this->cFromDocF(df_oqi_price($i))
						];}))
					]
				]
			)
		];
	}

	/**
	 * 2018-12-19
	 * @used-by \Dfe\Vantiv\Method::chargeNewParams()
	 * @param Method|null $m [optional]
	 * @return array(string => mixed)
	 */
	static function p(Method $m = null) {return (new self($m ?: dfpm(__CLASS__)))->pCharge();}
}