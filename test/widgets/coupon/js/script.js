$(document).ready(function(){
    var pp     = $("#pp"),
        buttonCloseCoupon =  $("#close-coupon"),
        buttonOpenCoupon = $("#buttonOpenCoupon"),
        form = $("#coupon-form"),
        submit = $("#submit");

    form.validate({

        rules: {
            "CouponForm[name]": {
                required: true
            },
            "CouponForm[email]": {
                required: true,
                email: true
            },
        },
        messages: {
            "CouponForm[name]": {
                required: "Поле Имя обязательное для заполнения"
            },
            "CouponForm[email]": {
                required: "Поле E-mail обязательное для заполнения",
                email: "Введите пожалуйста корректный e-mail"
            }
        },
        focusCleanup: true,
        focusInvalid: false,
        invalidHandler: function(event, validator) {
            $(".js-form-message").text("Исправьте пожалуйста все ошибки.");
        },
        onkeyup: function(element) {
            $(".js-form-message").text("");
        },
        errorPlacement: function(error, element) {
            return true;
        },
        errorClass: "form-input_error",
        validClass: "form-input_success"
    });

    function pp_hide(pp){
        pp.css({display: "none"});
        pp.css({opacity: "0"});
        $.cookie('couponWindow', 0);
    }

    function pp_show(pp, bg){
        setTimeout(function() {
            pp.animate({opacity: "1"}, 500);
            pp.css({"display": "block"});
        }, 2000);
        buttonCloseCoupon.click(function(){pp_hide(pp)});
    }

    function pp_open(pp) {
        pp.animate({opacity: "1"}, 500);
        pp.css({"display": "block"});
        buttonCloseCoupon.click(function(){pp_hide(pp)});
        //bg.fadeIn(1000).click(function(){pp_hide(pp, bg)});
    }

    function buttonHide(button) {
        if ($.cookie('couponWindow') == 2) {
            button.css({display: "none"});
        }
    }

    buttonOpenCoupon.click(function(){pp_open(pp)});

    if ( $.cookie('couponWindow') == undefined ){
        //  $.cookie('visit', true);
        $.cookie('couponWindow', 1);
        pp_show(pp);
    }

    if ( $.cookie('couponWindow') == 1) {
        pp_show(pp);
    }

    submit.click(function () {
        if (form.valid()) {
            $.cookie('couponWindow', 2);
        }
    });

    buttonHide(buttonOpenCoupon);
});