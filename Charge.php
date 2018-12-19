<?php
namespace Dfe\Vantiv;
use Df\Payment\Init\Action;
use Dfe\Vantiv\Facade\Card;
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
		$m = $this->m(); /** @var Method $m */
		$capture = Action::sg($this->m())->preconfiguredToCapture(); /** @var bool $capture */
		$card = $m->card(); /** @var Card $card */
		$s = $this->s();
		$oid = df_uid(10);
		return [
			'authentication' => ['user' => $s->publicKey(), 'password' => $s->privateKey()]
			,df_xml_node($capture ? 'sale' : 'authorization'
				,['customerId' => 'admin@mage2.pro', 'reportGroup' => $s->merchantID()]
				,[
					'orderId' => $oid
					,'amount' => 1
					,'orderSource' => 'ecommerce'
					,'billToAddress' => [
						'addressLine1' => '49 West 32nd Street'
						,'city' => 'New York City'
						,'companyName' => 'Mage2.PRO'
						,'country' => 'US'
						,'firstName' => 'Dmitry'
						,'lastName' => 'Fedyuk'
						,'phone' => '+1 (212) 736-3800'
						,'state' => 'New York'
						,'zip' => '10001'
					]
					,'card' => [
						'type' => $card->brandCodeE()
						,'number' => $card->number()
						,'expDate' => $card->expMonth2() . $card->expYear2()
						,'cardValidationNum' => $card->cvc()
					]
					,'cardholderAuthentication' => ['customerIpAddress' => '127.0.0.1']
					,'customBilling' => ['url' => 'localhost']
					,'enhancedData' => [
						'salesTax' => 0
						,'discountAmount' => 0
						,'shippingAmount' => 0
						,'destinationPostalCode' => '10001'
						,'destinationCountryCode' => 'US'
						,'orderDate' => '2018-12-17'
						,'detailTax' => ['taxAmount' => 0]
						,'lineItemData' => [
							'itemSequenceNumber' => 1
							,'itemDescription' => 'Test'
							,'productCode' => 364
							,'quantity' => 1
							,'lineItemTotal' => 1
							,'unitCost' => 1
						]

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