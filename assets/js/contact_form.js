/*

Script  : Contact Form
Version : 1.0
Author  : Surjith S M
URI     : http://themeforest.net/user/surjithctly

Copyright © All rights Reserved
Surjith S M / @surjithctly

*/

$(function() {

    "use strict";

    /* ================================================
       jQuery Validate - Reset Defaults
       ================================================ */

    $.validator.setDefaults({
        highlight: function(element) {
            $(element).closest('.c-form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.c-form-group').removeClass('has-error');
        },
        errorElement: 'small',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }
            if (element.parent('label').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

    /* 
    VALIDATE
    -------- */

    $("#phpcontactform").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            subject: "required",
            message: "required",
        },
        messages: {
            name: "Seu nome é obrigatório",
            email: {
                required: "O e-mail é obrigatório",
                email: "E-mail inválido"
            },
            subject: "O campo assunto é obrigatório",
            message: "O campo de mensagem é obrigatório",
        },
        submitHandler: function(form) {

            $("#js-contact-btn").attr("disabled", true);

            /* 
            CHECK PAGE FOR REDIRECT (Thank you page)
            ---------------------------------------- */

            var redirect = $('#phpcontactform').data('redirect');
            var noredirect = false;
            if (redirect == 'none' || redirect == "" || redirect == null) {
                noredirect = true;
            }

            $("#js-contact-result").html('<div class="alert alert-warning">Please wait...</div>');

            /* 
            FETCH SUCCESS / ERROR MSG FROM HTML DATA-ATTR
            --------------------------------------------- */

            var success_msg = $('#js-contact-result').data('success-msg');
            var error_msg = $('#js-contact-result').data('error-msg');

            var dataString = $(form).serialize();

            /* 
             AJAX POST
             --------- */

            $.ajax({
                type: "POST",
                data: dataString,
                url: "php/ControllerSite.php?action=contato",
                cache: false,
                success: function(d) {
                    $(".form-group").removeClass("has-success");
                    if (d == '1') {
                        if (noredirect) {
                            $('#js-contact-result').fadeIn('slow').html('<div class="alert alert-success">' + success_msg + '</div>').delay(3000).fadeOut('slow');
                            $('#phpcontactform').trigger("reset");
                        } else {
                            window.location.href = redirect;
                        }
                    } else {
                        $('#js-contact-result').fadeIn('slow').html('<div class="alert alert-danger">' + error_msg + '</div>').delay(3000).fadeOut('slow');
                    }
                    $("#js-contact-btn").attr("disabled", false);
                }
            });
            return false;

        }
    });

})
