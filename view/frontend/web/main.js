// 2018-12-17
define([
	'Df_StripeClone/main'
], function(parent) {'use strict';
/** 2017-09-06 @uses Class::extend() https://github.com/magento/magento2/blob/2.2.0-rc2.3/app/code/Magento/Ui/view/base/web/js/lib/core/class.js#L106-L140 */
return parent.extend({
	/**
	 * 2018-09-29 https://ecommerce.ufc.ge/ecomm2/images/ufc-utils_v2.js
	 * @override
	 * @see Df_Payment/main::getCardTypes()
	 * @used-by https://github.com/mage2pro/core/blob/3.9.12/Payment/view/frontend/web/template/card/fields.html#L4
	 * @returns {String[]}
	 */
	getCardTypes: function() {return ['VI', 'MC', 'MI'];},
});});