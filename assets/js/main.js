(function ($) {
    "use strict";
    $(document).ready(function($) {

        let amountField = $("#pwb3d-amount");
        amountField.keydown((e) => {
            pwb3dCheckMinimumVal();
        });


        function pwb3dCheckMinimumVal() {
            if ($("#pwb3d-minimum-hidden").length) {

                let min_amount = Number($("#pwb3d-minimum-hidden").val());
                let amt = Number($("#pwb3d-amount").val());
                console.log(min_amount, amt);
                if (min_amount> 0 && amt < min_amount) {
                    console.log('Amount cannot be less than the minimum amount');
                    $("#pwb3d-min-val-warn").text(
                        "Amount cannot be less than the minimum amount"
                    );
                    return false;
                } else {
                    $("#pwb3d-min-val-warn").text("");
                    $("#pwb3d-amount").removeClass("rerror");
                }
            }
        }

        $(".pwb3d-number").keydown(function(e) {
            if (
                e.keyCode == 46 ||
                e.keyCode == 8 ||
                e.keyCode == 9 ||
                e.keyCode == 27 ||
                e.keyCode == 13 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)
            ) {
                return;
            } else {
                if (
                    e.shiftKey ||
                    ((e.keyCode < 48 || e.keyCode > 57) &&
                        (e.keyCode < 96 || e.keyCode > 105))
                ) {
                    e.preventDefault();
                }
            }
        });



        function pwb3dValidateEmail(email) {
            let re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        $("#pwb3d-form").on('submit', function (e) {
            e.preventDefault();
            let requiredFieldIsInvalid = false;
            $(this)
                .find("input, select, textarea")
                .each(
                    function () {
                        $(this).removeClass("rerror"); //.css({ "border-color":"#d1d1d1" });
                    }
                );
            let email = $(this)
                .find("#pwb3d-email")
                .val();
            const color = $(this)
                .find("#pwb3d-color")
                .val();
            var amount = $(this)
                .find("#pwb3d-amount")
                .val();
            if (Number(amount) < 1) {
                $(this)
                    .find("#pwb3d-amount")
                    .addClass("rerror"); //  css({ "border-color":"red" });
                $("html,body").animate(
                    { scrollTop: $(".rerror").offset().top - 110 },
                    500
                );
                return false;
            }
            if (!pwb3dValidateEmail(email)) {
                $(this)
                    .find("#pwb3d-email")
                    .addClass("rerror"); //.css({ "border-color":"red" });
                $("html,body").animate(
                    { scrollTop: $(".rerror").offset().top - 110 },
                    500
                );
                return false;
            }
            if(pwb3dCheckMinimumVal() == false){
                $(this)
                    .find("#pwb3d-amount")
                    .addClass("rerror"); //.css({ "border-color":"red" });
                $("html,body").animate(
                    { scrollTop: $(".rerror").offset().top - 110 },
                    500
                );
                return false;
            }
            $(this)
                .find("input, select, text, textarea")
                .filter("[required]")
                .filter(
                    function () {
                        return this.value === "";
                    }
                )
                .each(
                    function () {
                        $(this).addClass("rerror");
                        requiredFieldIsInvalid = true;
                    }
                );

            if ($("#pwb3d-agreement").length && !$("#pwb3d-agreement").is(":checked")) {
                $("#pwb3d-agreementicon").addClass("rerror");
                requiredFieldIsInvalid = true;
            }

            if (requiredFieldIsInvalid) {
                $("html,body").animate(
                    { scrollTop: $(".rerror").offset().top - 110 },
                    500
                );
                return false;
            }

            let selfS = $(this);
            let $formS = $(this);

            $.blockUI({ message: "Please wait..." });

            let formData = new FormData(this);
            $.ajax(
                {
                    url: $formS.attr("action"),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "JSON",
                    success: function (data) {
                        data.custom_fields.push({
                            "display_name":"Plugin",
                            "variable_name":"plugin",
                            "value":"paywithbank3d"
                        });
                        $.unblockUI();
                        if (data.result === "success") {
                            const names = data.name.split(" ");
                            //const firstName = names[0] || "";
                            //const lastName = names[1] || "";
                            const handler = Bank3D.createPayment({
                                "reference": data.code,
                                "currencyCode": data.currency,
                                "merchantKey": pwb3d_settings.key,
                                "amount": data.total,
                                "email": data.email,
                                "color": data.color,
                                "mode": pwb3d_settings.mode,
                                "callback": function(reference) {
                                    // Transaction was completed and it was successfull.
                                    $.blockUI({ message: "Please wait..." });
                                    $.post(
                                        $formS.attr("action"),
                                        {
                                            action: "pwb3d_verify_payment",
                                            code: reference.reference
                                        },
                                        function (feedback) {
                                            console.log(feedback);
                                            data = JSON.parse(feedback);
                                            if (data.result === "success2") {
                                                window.location.href = data.link;
                                            }
                                            if (data.result == "success") {
                                                $("#pwb3d-form")[0].reset();
                                                $("html,body").animate(
                                                    { scrollTop: $("#pwb3d-form").offset().top - 110 },
                                                    500
                                                );
                                                selfS.before('<div class="alert-success">' + data.message + '</div>');

                                                $(this)
                                                    .find("input, select, textarea")
                                                    .each(
                                                        function () {
                                                            $(this).css(
                                                                {
                                                                    "border-color": "#d1d1d1",
                                                                    "background-color": "#fff"
                                                                }
                                                            );
                                                        }
                                                    );
                                                //console.log(feedback);
                                                $.unblockUI();
                                            } else{
                                                selfS.before('<div class="alert-danger">' + data.message + '</div>');
                                                $.unblockUI();
                                            }


                                        }
                                    );
                                    // This is the stage where it's necessary to verify the payment using "reference" argument
                                   //console.log(reference)
                                },
                                "onReady" :function () {
                                    $.unblockUI();
                                }
                            });
                            handler.open();
                        }
                    }
                });
        })


    })
})(jQuery);