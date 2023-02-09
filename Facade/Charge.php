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
	 * @param int|float $a
	 * The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 * @return null
	 */
	function capturePreauthorized(string $id, $a) {return null;}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::card()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param object|array(string => mixed) $c
	 */
	function card($c):Card {return $this->m()->card();}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::create()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param array(string => mixed) $p
	 */
	function create(array $p):Operation {return F::s()->post($p);}

	/**
	 * 2018-12-19 A string like «82924704471941425»
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::id()
	 * @used-by \Df\StripeClone\Method::chargeNew()
	 * @param Operation $c
	 */
	function id($c):string {return $c['litleTxnId'];}

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
	 * 2022-12-19 The $a value is already converted to the PSP currency and formatted according to the PSP requirements.
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::refund()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @return null
	 */
	function refund(string $id, int $a) {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Charge::void()
	 * @used-by \Df\StripeClone\Method::_refund()
	 * @return null
	 */
	function void(string $id) {return null;}
}