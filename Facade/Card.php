<?php
namespace Dfe\Vantiv\Facade;
use Df\Payment\BankCardNetworkDetector as D;
use Dfe\Vantiv\Method as M;
# 2018-12-19
final class Card extends \Df\StripeClone\Facade\Card {
	/**
	 * 2018-12-19
	 * @used-by \Df\StripeClone\Facade\Card::create()
	 * @param array(string => mixed) $p
	 */
	function __construct($p) {$this->_p = $p;}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::brand()
	 * @return null
	 */
	function brand() {return D::label($this->brandCode());}

	/**
	 * 2018-12-19
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 * @return string|null
	 */
	function brandCodeE() {return dftr($this->brandCode(), [
		D::AE => 'AX', D::DN => 'DC', D::DS => 'DI', D::JC => 'JC', D::MC => 'MC', D::VI => 'VI'
	]);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::country()
	 * @return null
	 */
	function country() {return null;}

	/**
	 * 2018-12-19
	 * @return string
	 */
	function cvc() {return dfa($this->_p, M::C_CVC);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\Facade\Card::isActive()
	 * @return int|null
	 */
	function expMonth() {return intval($this->expMonth2());}

	/**
	 * 2018-12-19
	 * @used-by expMonth()
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 * @return string
	 */
	function expMonth2() {return dfa($this->_p, M::C_EXP_MONTH);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\Facade\Card::isActive()
	 * @return int|null
	 */
	function expYear() {return 2000 + intval($this->expYear2());}

	/**
	 * 2018-12-19
	 * @used-by expYear()
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 * @return string
	 */
	function expYear2() {return dfa($this->_p, M::C_EXP_YEAR);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return string
	 */
	function id() {return null;}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::last4()
	 * @return string
	 */
	function last4() {return substr($this->number(), -4);}

	/**
	 * 2018-12-19
	 * @used-by brandCode()
	 * @used-by last4()
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 * @return string
	 */
	function number() {return dfa($this->_p, M::C_NUMBER);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::owner()
	 * @return null
	 */
	function owner() {return null;}

	/**
	 * 2018-12-19
	 * @used-by brand()
	 * @used-by brandCodeE()
	 * @return string|null
	 */
	private function brandCode() {return D::p($this->number());}

	/**
	 * 2018-12-19
	 * @used-by __construct()
	 * @var array(string => string)
	 */
	private $_p;
}