<?php
namespace Dfe\Vantiv\API;
/**
 * 2018-12-18
 * 2018-12-19
 * "A successful response to a charge request": https://mage2.pro/t/5782
 * "A failure response to a charge request": https://mage2.pro/t/5783
 * @method static Facade s()
 */
final class Facade extends \Df\API\Facade {
	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $suffix
	 * @return string
	 */
	protected function path($id, $suffix) {return '';}
}