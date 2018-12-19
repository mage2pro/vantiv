<?php
namespace Dfe\Vantiv\Block;
use Dfe\Vantiv\Facade\Card;
use Dfe\Vantiv\Method as M;
/**
 * 2018-12-19
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 * @method M m()
 */
class Info extends \Df\StripeClone\Block\Info {
	/**
	 * 2018-12-19
	 * @override
	 * @see \Df\StripeClone\Block\Info::card()
	 * @used-by \Df\StripeClone\Block\Info::cf()
	 * @return Card
	 */
	protected function card() {return $this->m()->card();}
}