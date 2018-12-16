<?php
namespace Dfe\Vantiv;
// 2018-12-17
/** @method static Settings s() */
final class Settings extends \Df\Payment\Settings\BankCard {
	/**
	 * 2018-12-17
	 * @return string
	 */
	function password() {return $this->p();}

	/**
	 * 2018-12-17
	 * @override
	 * @see \Df\Payment\Settings::publicKey()
	 * @used-by \Df\StripeClone\ConfigProvider::config()
	 * @return string
	 */
	function publicKey() {return null;}

	/**
	 * 2018-12-17
	 * @return string
	 */
	function username() {return $this->v();}

	/**
	 * 2018-12-17
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'df_payment/vantiv';}
}