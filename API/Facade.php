<?php
namespace Dfe\Vantiv\API;
use Df\Core\Exception as DFE;
// 2018-12-18
/** @method static Facade s()  */
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