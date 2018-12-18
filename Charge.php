<?php
namespace Dfe\Vantiv;
/**
 * 2018-12-19
 * @method Method m()
 * @method Settings s()
 */
final class Charge extends \Df\Payment\Charge {
	/**
	 * 2018-12-19
	 * @used-by p()
	 * @return array(string => mixed)
	 */
	private function pCharge() {return [];}

	/**
	 * 2018-12-19
	 * @used-by \Dfe\Vantiv\Method::chargeNewParams()
	 * @param Method|null $m [optional]
	 * @return array(string => mixed)
	 */
	static function p(Method $m = null) {return (new self($m ?: dfpm(__CLASS__)))->pCharge();}
}