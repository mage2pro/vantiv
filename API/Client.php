<?php
namespace Dfe\Vantiv\API;
use Df\Payment\Settings\Proxy;
use Dfe\Vantiv\Settings as S;
# 2018-12-18
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
		$this->reqXml('litleOnlineRequest', [
			'merchantId' => $s->merchantID()
			,'merchantSdk' => 'Magento;8.15.6'
			,'version' => '8.23'
			,'xmlns' => 'http://www.litle.com/schema'
		]);
		$this->addFilterResBV(function($x) {
			$a = df_xml_parse_a($x); /** @var array(string => mixed) $a */
			return dfa_seq($a, ['authorizationResponse', 'saleResponse', '@']);
		});
	}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::headers()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::_p()
	 * @return array(string => string)
	 */
	protected function headers():array {return ['Content-Type' => 'text/xml'];}

	/**
	 * 2019-01-18
	 * @override
	 * @see \Df\API\Client::proxy()
	 * @used-by \Df\API\Client::setup()
	 * @return Proxy|null
	 */
	protected function proxy() {
		$s = dfps($this); /** @var S $s */
		$r = $s->proxy(); /** @var Proxy $r */
		return !$r->enable() ? null : $r;
	}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::responseValidatorC()
	 * @used-by \Df\API\Client::_p()
	 */
	protected function responseValidatorC():string {return \Dfe\Vantiv\API\Validator::class;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::url()
	 */
	protected function urlBase():string {return dfp_url_api(
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
	protected function zfConfig():array {return ['ssltransport' => 'tlsv1.2'];}
}