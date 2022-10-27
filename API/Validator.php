<?php
namespace Dfe\Vantiv\API;
# 2018-12-19
/** @used-by \Dfe\Vantiv\API\Client::responseValidatorC() */
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by self::valid()
	 * @used-by \Df\API\Client::_p()
	 */
	function long():string {return df_nts($this->r('message'));}

	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 */
	function valid():bool {return '000' === $this->r('response');}
}