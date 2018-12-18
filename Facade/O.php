<?php
namespace Dfe\Vantiv\Facade;
use Df\API\Operation;
// 2018-12-18
final class O extends \Df\StripeClone\Facade\O {
	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\StripeClone\Facade\O::toArray()
	 * @used-by \Df\StripeClone\Method::transInfo()
	 * @param Operation $o
	 * @return array(string => mixed)
	 */
	function toArray($o) {return $o->a();}
}