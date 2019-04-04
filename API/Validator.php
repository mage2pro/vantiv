<?php
namespace Dfe\Vantiv\API;
// 2018-12-19
/** @used-by \Dfe\Vantiv\API\Client::responseValidatorC() */
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by valid()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function long() {return $this->r('message');}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 * @return bool
	 */
	function valid() {return '000' === $this->r('response');}
}