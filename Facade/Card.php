<?php
namespace Dfe\Vantiv\Facade;
// 2018-12-18
final class Card extends \Df\StripeClone\Facade\Card {
	/**
	 * 2018-12-18
	 * @used-by \Df\StripeClone\Facade\Card::create()
	 * @param array(string => mixed) $p
	 */
	function __construct($p) {}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::brand()
	 * @return null
	 */
	function brand() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::country()
	 * @return null
	 */
	function country() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\Facade\Card::isActive()
	 * @return int|null
	 */
	function expMonth() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\Facade\Card::isActive()
	 * @return int|null
	 */
	function expYear() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return string
	 */
	function id() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::last4()
	 * @return string
	 */
	function last4() {return null;}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\Card::owner()
	 * @return null
	 */
	function owner() {return null;}
}