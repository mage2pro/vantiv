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
	}

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
}