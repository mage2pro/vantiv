<?php
namespace Dfe\Vantiv;
use Df\Payment\Settings\Proxy;
# 2018-12-17
/** @method static Settings s() */
final class Settings extends \Df\StripeClone\Settings {
	/**
	 * 2019-01-18
	 * @used-by \Dfe\Vantiv\API\Client::proxy()
	 */
	function proxy():Proxy {return dfc($this, function() {return new Proxy($this->m());});}
}