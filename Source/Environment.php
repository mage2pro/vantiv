<?php
namespace Dfe\Vantiv\Source;
// 2018-12-17
final class Environment extends \Df\Config\Source {
	/**
	 * 2018-12-17
	 * @override
	 * @see \Df\Config\Source::map()
	 * @used-by \Df\Config\Source::toOptionArray()
	 * @return array(string => string)
	 */
	protected function map() {return [self::$PRE_LIVE => 'Pre-Live', self::$PRODUCTION => 'Production'];}

	/**
	 * 2018-12-17
	 * @var string
	 */
	private static $PRE_LIVE = 'pre_live';
	/**
	 * 2018-12-17
	 * @var string
	 */
	private static $PRODUCTION = 'production';
}