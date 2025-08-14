define(['jquery', 'jquery/validate'], function ($) {
    'use strict';
 
    return function () {
        $.validator.addMethod(
            'validate-phone-number',
            function (value) {
                return /^[6-9]\d{9}$/.test(value); // Validates 10-digit Indian mobile numbers
            },
            $.mage.__('Please enter a valid 10-digit Indian mobile number.')
        );
    };
});