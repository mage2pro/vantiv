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
	function __construct(array $p) {$this->_p = $p;}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::brand()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 */
	function brand():string {return D::label($this->brandCode());}

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
	 * @used-by \Df\StripeClone\CardFormatter::country()
	 * @return null
	 */
	function country() {return null;}

	/**
	 * 2018-12-19
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 */
	function cvc():string {return dfa($this->_p, M::C_CVC);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expMonth()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\Facade\Card::isActive()
	 */
	function expMonth():int {return intval($this->expMonth2());}

	/**
	 * 2018-12-19
	 * @used-by self::expMonth()
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 */
	function expMonth2():string {return dfa($this->_p, M::C_EXP_MONTH);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::expYear()
	 * @used-by \Df\StripeClone\CardFormatter::exp()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\Facade\Card::isActive()
	 */
	function expYear():int {return 2000 + intval($this->expYear2());}

	/**
	 * 2018-12-19
	 * @used-by self::expYear()
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 */
	function expYear2():string {return dfa($this->_p, M::C_EXP_YEAR);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::id()
	 * @used-by \Df\StripeClone\ConfigProvider::cards()
	 * @used-by \Df\StripeClone\Facade\Customer::cardIdForJustCreated()
	 * @return null
	 */
	function id() {return null;}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::last4()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @used-by \Df\StripeClone\CardFormatter::label()
	 */
	function last4():string {return substr($this->number(), -4);}

	/**
	 * 2018-12-19
	 * @used-by self::brandCode()
	 * @used-by self::last4()
	 * @used-by \Dfe\Vantiv\Charge::pCharge()
	 */
	function number():string {return dfa($this->_p, M::C_NUMBER);}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Facade\Card::owner()
	 * @used-by \Df\StripeClone\CardFormatter::ii()
	 * @return null
	 */
	function owner() {return null;}

	/**
	 * 2018-12-19
	 * @used-by self::brand()
	 * @used-by self::brandCodeE()
	 * @return string|null
	 */
	private function brandCode() {return D::p($this->number());}

	/**
	 * 2018-12-19
	 * @used-by self::__construct()
	 * @var array(string => string)
	 */
	private $_p;
}