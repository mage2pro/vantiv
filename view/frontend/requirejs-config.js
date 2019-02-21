// 2019-02-22
var config = {config: {mixins: {
	// 2019-02-22
	// «Make the Vantiv payment module compatible with a custom checkout module»
	// https://github.com/mage2pro/vantiv/issues/3
	'Magento_Checkout/js/view/payment/list': {'Dfe_Vantiv/payment-list': true}
}}};