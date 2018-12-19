<?php
namespace Dfe\Vantiv\API;
use Df\Xml\G;
use Dfe\Vantiv\Settings as S;
// 2018-12-18
final class Client extends \Df\API\Client {
	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::_construct()
	 * @used-by \Df\API\Client::__construct()
	 */
	protected function _construct() {
		parent::_construct();
		$s = dfps($this); /** @var S $s */
		$this->reqXml('litleOnlineRequest', [G::P__ATTRIBUTES => [
			'merchantId' => $s->merchantID()
			,'merchantSdk' => 'Magento;8.15.6'
			,'version' => '8.23'
			,'xmlns' => 'http://www.litle.com/schema'
		]]);
		$this->addFilterResBV(function($x) {
			$a = df_xml_parse_a($x); /** @var array(string => mixed) $a */
			return dfa($a, 'authorizationResponse', dfa($a, 'saleResponse'));
		});
	}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::headers()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::p()
	 * @return array(string => string)
	 */
	protected function headers() {return ['Content-Type' => 'text/xml'];}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::responseValidatorC()
	 * @used-by \Df\API\Client::p()
	 * @return string
	 */
	protected function responseValidatorC() {return \Dfe\Vantiv\API\Validator::class;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::url()
	 * @return string
	 */
	protected function urlBase() {return dfp_url_api(
		$this, 'https://payments.vantiv{stage}.com/vap/communicator/online', ['prelive', 'cnp']
	);}

	/**
	 * 2018-12-18
	 * https://framework.zend.com/manual/1.12/en/zend.http.client.adapters.html#zend.http.client.adapters.socket
	 * @see CURL_SSLVERSION_TLSv1_2
	 * @override
	 * @see \Df\API\Client::zfConfig()
	 * @used-by \Df\API\Client::__construct()
	 * @return array(string => mixed)
	 */
	protected function zfConfig() {return ['ssltransport' => 'tlsv1.2'];}
}