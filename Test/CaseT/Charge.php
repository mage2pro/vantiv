<?php
namespace Dfe\Vantiv\Test\CaseT;
use Df\Payment\BankCardNetworkDetector as D;
use Dfe\Vantiv\API\Facade as F;
# 2018-12-17
final class Charge extends \Dfe\Vantiv\Test\CaseT {
	/** 2018-12-17 */
	function t00():array {echo __METHOD__;}

	/** 2018-12-18 */
	function t01():array {echo $this->curl($this->req('live'), 'https://payments.vantivcnp.com/vap/communicator/online');}

	/** 2018-12-18 @test */
	function t02():array {echo $this->curl($this->doc(), 'https://payments.vantivprelive.com/vap/communicator/online');}

	/** 2018-12-18 */
	function t03():array {$s = $this->s(); echo df_json_encode([
		'merchantID' => $s->merchantID(), 'privateKey' => $s->privateKey(), 'publicKey' => $s->publicKey()
	]);}

	/** 2018-12-18 */
	function t04():array {echo $this->doc();}

	/** 2018-12-18 */
	function t05():array {echo df_json_encode(F::s()->post($this->docBody())->a());}

	/** 2018-12-19 */
	function t06():array {echo df_json_encode(F::s()->post($this->docBody('failure'))->a());}

	/** 2018-12-18 @test */
	function t07():array {echo df_json_encode(F::s()->post($this->docBody('success', true))->a());}

	/**
	 * 2018-12-18
	 * @used-by self::t01()
	 * @used-by self::t02()
	 */
	private function curl(string $req, string $url):string {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: text/xml','Expect: ']);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		return curl_exec($ch);
	}

	/** 2018-12-18 */
	private function doc():string {return df_xml_g('litleOnlineRequest', $this->docBody(), [
		'merchantId' => $this->s()->merchantID()
		,'merchantSdk' => 'Magento;8.15.6'
		,'version' => '8.23'
		,'xmlns' => 'http://www.litle.com/schema'
	]);}

	/**
	 * 2018-12-18
	 * @used-by self::doc()
	 * @return array(string => mixed)
	 */
	private function docBody(string $type = 'success', bool $capture = false) {
		$card = $this->j("test/card/$type");
		$s = $this->s();
		$oid = 12345;//df_uid(10);
		$liIndex = 1;
		return [
			'authentication' => ['user' => $s->publicKey(), 'password' => $s->privateKey()]
			,df_xml_node($capture ? 'sale' : 'authorization'
				,['customerId' => 'admin@mage2.pro', 'reportGroup' => $s->merchantID()]
				,[
					'orderId' => $oid
					,'amount' => 2
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
						'type' => self::type(D::p($card['num']))
						,'number' => $card['num']
						,'expDate' => $card['exp']
						,'cardValidationNum' => $card['cvc']
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
						,'lineItemData' => array_map(function() use(&$liIndex) {return [
							'itemSequenceNumber' => $liIndex++
							,'itemDescription' => 'Test'
							,'productCode' => 364
							,'quantity' => 1
							,'lineItemTotal' => 1
							,'unitCost' => 1
						];}, [1, 2])
					]
				]
			)
		];
	}

	/**
	 * 2018-12-18
	 * @used-by self::req()
	 * @param string $path
	 * @return array(string => string)
	 */
	private function j($path) {return df_json_file_read(BP . "/_my/test/Vantiv/$path.json");}

	/**
	 * 2018-12-18
	 * @used-by self::t01()
	 * @used-by self::t02()
	 * @param string $type
	 * @return string
	 */
	private function req($type) {
		$card = $this->j("$type/card");
		$cred = $this->j("$type/credentials");
		return strtr(df_contents(df_module_dir($this) . '/T/data/request.xml'), [
			'%c_cvc%' => $card['cvc']
			,'%c_exp%' => $card['exp']
			,'%c_num%' => $card['num']
			,'%c_type%' => self::type(D::p($card['num']))
			,'%merchantID%' => $cred['merchantID']
			/**
			 * 2018-12-18
			 * «The orderId element is a required child of several transaction types
			 * and defines a merchant-assigned value representing the order in the merchant’s system.
			 * Type = String; minLength = N/A; maxLength = 25»
			 */
			,'%order%' => df_uid(8)
			,'%privateKey%' => $cred['privateKey']
			,'%publicKey%' => $cred['publicKey']
		]);
	}

	/**
	 * 2018-12-18
	 * @used-by self::req()
	 * @param string $t
	 * @return string
	 */
	private function type($t) {return dftr($t, [
		D::AE => 'AX', D::DN => 'DC', D::DS => 'DI', D::JC => 'JC', D::MC => 'MC', D::VI => 'VI'
	]);}
}