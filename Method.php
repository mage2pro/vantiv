<?php
namespace Dfe\Vantiv;
use Magento\Sales\Model\Order\Payment\Transaction as T;
// 2018-12-17
/** @method Settings s() */
final class Method extends \Df\StripeClone\Method {
	/**
	 * 2018-12-17
	 * @override
	 * @see \Df\Payment\Method::amountLimits()
	 * @used-by \Df\Payment\Method::isAvailable()
	 * @return null
	 */
	protected function amountLimits() {return null;}

	/**
	 * 2018-12-17
	 * @override
	 * @see \Df\Payment\Method::iiaKeys()
	 * @used-by \Df\Payment\Method::assignData()
	 * @return string[]
	 */
	protected function iiaKeys() {return [self::$C_CVC, self::$C_EXP_MONTH, self::$C_EXP_YEAR, self::$C_NUMBER];}

	/**
	 * 2018-12-17
	 * @override
	 * @see \Df\StripeClone\Method::transUrlBase()
	 * @used-by \Df\StripeClone\Method::transUrl()
	 * @param T $t
	 * @return string
	 */
	protected function transUrlBase(T $t) {return '';}

	/**
	 * 2018-12-17
	 * @used-by iiaKeys()
	 */
	private static $C_CVC = 'c_cvc';

	/**
	 * 2018-12-17
	 * @used-by iiaKeys()
	 */
	private static $C_EXP_MONTH = 'c_exp_month';

	/**
	 * 2018-12-17
	 * @used-by iiaKeys()
	 */
	private static $C_EXP_YEAR = 'c_exp_year';

	/**
	 * 2018-12-17
	 * @used-by iiaKeys()
	 */
	private static $C_NUMBER = 'c_number';
}