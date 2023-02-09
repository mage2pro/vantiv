<?php
namespace Dfe\Vantiv\Facade;
# 2018-12-18
/** @method \Dfe\Vantiv\Settings ss() */
final class Customer extends \Df\StripeClone\Facade\Customer {
	/**
	 * 2018-12-18
	 * 2022-11-13
	 * It is never used because the Vantiv module does not use @see \Df\StripeClone\Payer::newCard()
	 * It is similar to @see \Dfe\TBCBank\Facade\Customer::cardAdd()
	 * 2022-11-17
	 * `object` as an argument type is not supported by PHP < 7.2:
	 * https://github.com/mage2pro/core/issues/174#user-content-object
     * 2022-12-19 We can not declare the $c argument type because it is undeclared in the overriden method.
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::cardAdd()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param object $c
	 */
	function cardAdd($c, string $token):string {df_should_not_be_here(); return '';}

	/**
	 * 2018-12-18
	 * 2022-11-13
	 * It is never used because the Vantiv module does not use @see \Df\StripeClone\Payer::newCard()
	 * It is similar to @see \Dfe\TBCBank\Facade\Customer::create()
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::create()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param array(string => mixed) $p
	 * @return null
	 */
	function create(array $p) {df_should_not_be_here(); return null;}

	/**
	 * 2018-12-18
	 * 2022-11-13
	 * It is never used because the Vantiv module does not use @see \Df\StripeClone\Payer::newCard()
	 * It is similar to @see \Dfe\TBCBank\Facade\Customer::id()
	 * 2022-11-17
	 * `object` as an argument type is not supported by PHP < 7.2:
	 * https://github.com/mage2pro/core/issues/174#user-content-object
	 * @override
	 * @see \Df\StripeClone\Facade\Customer::id()
	 * @used-by \Df\StripeClone\Payer::newCard()
	 * @param object $c
	 */
	function id($c):string {df_should_not_be_here(); return '';}

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