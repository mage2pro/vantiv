<?php
namespace Dfe\Vantiv\API;
// 2018-12-18
/** @used-by \Dfe\Vantiv\API\Client::responseValidatorC() */
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by valid()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function long() {return '';}

	/**
	 * 2018-12-18
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Response\Validator::validate()
	 * @return bool
	 */
	function valid() {return !$this->long();}
}