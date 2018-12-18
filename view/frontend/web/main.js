// 2018-12-17
define([
	'Df_StripeClone/main'
], function(parent) {'use strict';
/** 2017-09-06 @uses Class::extend() https://github.com/magento/magento2/blob/2.2.0-rc2.3/app/code/Magento/Ui/view/base/web/js/lib/core/class.js#L106-L140 */
return parent.extend({
	/**
	 * 2018-12-18
	 * These data are submitted to the M2 server part
	 * as the `additional_data` property value on the «Place Order» button click:
	 * @used-by Df_Payment/mixin::getData():
	 *		getData: function() {return {additional_data: this.dfData(), method: this.item.method};},
	 * https://github.com/mage2pro/core/blob/2.8.4/Payment/view/frontend/web/mixin.js#L224
	 * @override
	 * @see Dfe_StripeClone/main::dfData()
	 * @returns {Object}
	 */
	dfData: function() {return {
		c_cvc: this.creditCardVerificationNumber()
		,c_exp_month: this.creditCardExpMonth2()
		,c_exp_year: this.creditCardExpYear2()
		,c_number: this.creditCardNumber()
	};},
	/**
	 * 2018-12-17
	 * @override
	 * @see Df_Payment/main::getCardTypes()
	 * @used-by https://github.com/mage2pro/core/blob/3.9.12/Payment/view/frontend/web/template/card/fields.html#L4
	 * @returns {String[]}
	 */
	getCardTypes: function() {return ['VI', 'MC', 'AE', 'DI'];},
    /**
	 * 2018-12-18
	 * @override
	 * @see Df_StripeClone/main::tokenCheckStatus()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L8-L15
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L75
	 * @param {Boolean} status
	 * @returns {Boolean}
	 */
	tokenCheckStatus: function(status) {return status;},
	/**
	 * 2018-12-18
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L21-L29
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L73
	 * @param {Object} params
	 * @param {Function} callback
	 */
	tokenCreate: function(params, callback) {callback(true, {});},
});});