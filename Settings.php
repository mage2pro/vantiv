<?php
namespace Dfe\Vantiv;
// 2018-12-17
/** @method static Settings s() */
final class Settings extends \Df\StripeClone\Settings {
	/**
	 * 2018-12-17
	 * @return string
	 */
	function environment() {return $this->v();}
}