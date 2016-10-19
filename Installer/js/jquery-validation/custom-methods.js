jQuery.validator.addMethod('adminUsernameAdminPasswordNotEqual', function(value, element, param) {
	return this.optional(element) || value != $(param).val();
}, 'This value must not be different than the Administrator username');