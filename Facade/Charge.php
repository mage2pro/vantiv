<?php
namespace Dfe\Vantiv\Facade;
use Df\API\Operation;
use Df\Xml\X;
use Dfe\Vantiv\API\Facade as F;
# 2018-12-18
/** @method \Dfe\Vantiv\Method m() */
final class Charge extends \Df\StripeClone\Facade\Charge {
	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::capturePreauthorized()
	 * @used-by \Df\StripeClone\Method::charge()
	 * @param string $id
	 * @param int|float $a
	 * The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 * @return Operation
	 */
	function capturePreauthorized($id, $a) {return null;}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::card()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param object|array(string => mixed) $c
	 * @return Card
	 */
	function card($c) {return $this->m()->card();}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 * @return Operation
	 */
	function create(array $p) {return F::s()->post($p);}

	/**
	 * 2018-12-19 A string like «82924704471941425»
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::id()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param Operation $c
	 * @return string
	 */
	function id($c) {return $c['litleTxnId'];}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::pathToCard()
	 * @used-by \Df\StripeClone\Block\Info::cardDataFromChargeResponse()
	 * @used-by \Df\StripeClone\Facade\Charge::cardData()
	 * @return null
	 */
	function pathToCard() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::refund()
	 * @used-by void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @param float $a
	 * В формате и валюте платёжной системы.
	 * Значение готово для применения в запросе API.
	 * @return null
	 */
	function refund($id, $a) {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @param string $id
	 * @return null
	 */
	function void($id) {return null;}
}