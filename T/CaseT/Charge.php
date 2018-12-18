<?php
namespace Dfe\Vantiv\T\CaseT;
use Df\Payment\BankCardNetworkDetector as D;
// 2018-12-17
final class Charge extends \Dfe\Vantiv\T\CaseT {
	/** 2018-12-17 */
	function t00() {echo __METHOD__;}

	/** 2018-12-18 */
	function t01() {echo $this->curl(
		$this->req('live'), 'https://payments.vantivcnp.com/vap/communicator/online'
	);}

	/** @test 2018-12-18 */
	function t02() {echo $this->curl(
		$this->req('test'), 'https://payments.vantivprelive.com/vap/communicator/online'
	);}

	/**
	 * 2018-12-18
	 * @used-by t01()
	 * @used-by t02()
	 * @param string $req
	 * @param string $url
	 * @return string
	 */
	private function curl($req, $url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: text/xml','Expect: '));
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSLVERSION, 6);
		return curl_exec($ch);
	}

	/**
	 * 2018-12-18
	 * @used-by req()
	 * @param string $path
	 * @return array(string => string)
	 */
	private function j($path) {return df_json_decode(file_get_contents(
		BP . "/_my/test/Vantiv/$path.json"
	));}

	/**
	 * 2018-12-18
	 * @used-by t01()
	 * @used-by t02()
	 * @param string $type
	 * @return string
	 */
	private function req($type) {
		$card = $this->j("$type/card");
		$cred = $this->j("$type/credentials");
		return strtr(file_get_contents(df_module_dir($this) . '/T/data/request.xml'), [
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
		])
	;}

	/**
	 * 2018-12-18
	 * @used-by req()
	 * @param string $t
	 * @return string
	 */
	private function type($t) {return dftr($t, [
		D::AE => 'AX', D::DN => 'DC', D::DS => 'DI', D::JC => 'JC', D::MC => 'MC', D::VI => 'VI'
	]);}
}