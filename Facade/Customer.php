<?php
namespace Dfe\Vantiv\Facade;
# 2018-12-18
/** @method \Dfe\Vantiv\Settings ss() */
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @param object $c
	 * @param string $token
	 * @return null
	 */
	function cardAdd($c, $token) {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @param array(string => mixed) $p
	 * @return null
	 */
	function create(array $p) {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @param object $c
	 * @return null
	 */
	function id($c) {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::_get()
	 * @used-by \Df\StripeClone\Facade\Customer::get()
	 * @param array(string => mixed) $id
	 * @return array(string => mixed)
	 */
	protected function _get($id) {return $id;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardsData()
	 * @used-by \Df\StripeClone\Facade\Customer::cards()
	 * @param array(string => mixed) $c
	 * @return \Dfe\Vantiv\Facade\Card[]
	 * @see \Dfe\Stripe\Facade\Charge::cardData()
	 */
	protected function cardsData($c) {return [];}
}