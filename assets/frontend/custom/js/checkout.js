jQuery(function(){
   /*** general effect in this page ***/
   checkout_general_event_proc_func();

   /*** billing address proc fucntion ***/
   checkout_billing_proc_fucn();

    /*** shipping address proc fucntion ***/
    checkout_shipping_proc_fucn();

    /*** shipping method proc fucntion ***/
    checkout_shipping_method_proc_fucn();

    /*** payment proceed proc fucntion ***/
    checkout_payment_proceed_proc_fucn();

    /*** payment detail proc fucntion ***/
    checkout_payment_detail_proc_fucn();
});

/***
 * general effect in this page
 * ***/
function checkout_general_event_proc_func()
{
    // tabs toggle event function
    f_checkbox_toggle_tabs();
    jQuery("#f_ch_new_billing_countires").change(function(){
        var country = jQuery(this).val();
        if ( country == "0" || country == "" ) return;

        var dataQuery = "country=" + country;
        jQuery.ajax({
            url: BASE_URL + "front/get_provinces",
            type: "post",
            data: dataQuery,
            dataType: "json",
            async: true,
            success: function(data) {
                if(data.status == "1" ) {
                    var html = '<option value="0">Please Select</option>';
                    var list = data.list;
                    for ( i = 0; i < list.length; i ++ ) {
                        html += '<option value="' + list[i]["code"] + '">' + list[i]["name"] + '</option>';
                    }
                    jQuery("#f_ch_new_billing_provinces").html(html);
                } else {
                    // alert("db error!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("generated database error!");
            }
        });
    });

    jQuery("#f_ch_new_shipping_countires").change(function(){
        var country = jQuery(this).val();
        if ( country == "0" || country == "" ) return;

        var dataQuery = "country=" + country;
        jQuery.ajax({
            url: BASE_URL + "front/get_provinces",
            type: "post",
            data: dataQuery,
            dataType: "json",
            async: true,
            success: function(data) {
                if(data.status == "1" ) {
                    var html = '<option value="0">Please Select</option>';
                    var list = data.list;
                    for ( i = 0; i < list.length; i ++ ) {
                        html += '<option value="' + list[i]["code"] + '">' + list[i]["name"] + '</option>';
                    }
                    jQuery("#f_ch_new_shipping_provinces").html(html);
                } else {
                    // alert("db error!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("generated database error!");
            }
        });
    });
}

/***
 * billing address proc fucntion
 * ***/
function checkout_billing_proc_fucn()
{
    // toggle billing style via radio button
    jQuery("input[name='f_ch_billing_address_kind']").click(function(){
       if ( jQuery(this).val() == 0 ) { // if use old user`s address
           jQuery(".f_ch_billing_sub_old").show(100);
           jQuery(".f_ch_billing_sub_new").hide(100);
       } else {                         // if use new address for billing address
           jQuery(".f_ch_billing_sub_old").hide(100);
           jQuery(".f_ch_billing_sub_new").show(100);
       }
    });

    // insert billing address with user`s address
    jQuery("#f_ch_billing_asold_btn").click(function(){
        var did = jQuery("#f_ch_billing_did").val();
        var sdid = jQuery("#f_ch_shipping_did").val();
        var as_shipping = 0;
        if ( jQuery("#f_ch_billing_same_ship").is(":checked") ) as_shipping = 1;

        var tag = jQuery(this).parent(".f_ch_sub_cnt_div").parent(".f_ch_cnt_div").next(".f_checkout_tab_div");

        var params = {
            "did" : did,
            "sdid" : sdid,
            "as_shipping" : as_shipping
        };
        var url = BASE_URL + "front/set_billing_address_via_useraddress";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Set billing address successfully!");
                // var arr = res.id.split("##");
                // jQuery("#f_ch_billing_did").val(arr[0]);
                // jQuery("#f_ch_shipping_did").val(arr[1]);
                //
                // tag.addClass("f_ch_active_div").trigger("click");
                // f_checkbox_toggle_tabs();

                location.href = BASE_URL + "front/checkout?tab=1";
            } else {
                alert("Failed setting!");
            }
        });
    });

    // set billing address newly without using user`s profile address info
    jQuery("#f_ch_billing_asnew_btn").click(function(){
        var did = jQuery("#f_ch_billing_did").val();
        var sdid = jQuery("#f_ch_shipping_did").val();
        var as_shipping = 0;
        if ( jQuery("#f_ch_billing_same_ship_new").is(":checked") ) as_shipping = 1;
        var as_profile = 0;
        if ( jQuery("#f_ch_billing_as_user_address").is(":checked") ) as_profile = 1;

        var first_name = jQuery("#f_ch_new_billing_first_name").val();
        var last_name = jQuery("#f_ch_new_billing_last_name").val();
        var company = jQuery("#f_ch_new_billing_company").val();
        var phone = jQuery("#f_ch_new_billing_phone").val();
        var country = jQuery("#f_ch_new_billing_countires").val();
        var state = jQuery("#f_ch_new_billing_provinces").val();
        var address1 = jQuery("#f_ch_new_billing_address1").val();
        var address2 = jQuery("#f_ch_new_billing_address2").val();
        var city = jQuery("#f_ch_new_billing_city").val();
        var zip = jQuery("#f_ch_new_billing_zip").val();

        if ( g_v_t(first_name) ) { alert("Input first name!"); jQuery("#f_ch_new_billing_first_name").focus(); return; }
        if ( g_v_t(last_name) ) { alert("Input last name!"); jQuery("#f_ch_new_billing_last_name").focus(); return; }
        if ( g_v_t(company) ) { alert("Input company name"); jQuery("#f_ch_new_billing_company").focus(); return; }
        if ( g_v_ts(country) ) { alert("Select country"); return; }

        var tag = jQuery(this).parent(".f_ch_sub_cnt_div").parent(".f_ch_cnt_div").next(".f_checkout_tab_div");

        var params = {
            "did" : did,
            "sdid" : sdid,
            "as_shipping" : as_shipping,
            "as_profile" : as_profile,
            "first_name" : first_name,
            "last_name" : last_name,
            "company" : company,
            "phone" : phone,
            "country" : country,
            "state" : state,
            "address1" : address1,
            "address2" : address2,
            "city" : city,
            "zip" : zip
        };
        var url = BASE_URL + "front/set_billing_address_newly";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Set billing address successfully!");
                // var arr = res.id.split("##");
                // jQuery("#f_ch_billing_did").val(arr[0]);
                // jQuery("#f_ch_shipping_did").val(arr[1]);
                //
                // tag.addClass("f_ch_active_div").trigger("click");
                // f_checkbox_toggle_tabs();

                location.href = BASE_URL + "front/checkout?tab=1";

            } else {
                alert("Failed setting!");
            }
        });
    });
}

/***
 * shipping address proc fucntion
 * ***/
function checkout_shipping_proc_fucn()
{
    // toggle shipping style via radio button
    jQuery("input[name='f_ch_shipping_address_kind']").click(function(){
        if ( jQuery(this).val() == 0 ) { // if use old user`s address
            jQuery(".f_ch_shipping_sub_old").show(100);
            jQuery(".f_ch_shipping_sub_new").hide(100);
        } else {                         // if use new address for billing address
            jQuery(".f_ch_shipping_sub_old").hide(100);
            jQuery(".f_ch_shipping_sub_new").show(100);
        }
    });

    // set shipping address with user`s address
    jQuery("#f_ch_shipping_asold_btn").click(function(){
        var sdid = jQuery("#f_ch_shipping_did").val();

        var tag = jQuery(this).parent(".f_ch_sub_cnt_div").parent(".f_ch_cnt_div").next(".f_checkout_tab_div");

        var params = {
            "sdid" : sdid
        };
        var url = BASE_URL + "front/set_shipping_address_via_useraddress";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Set shipping address successfully!");
                // jQuery("#f_ch_shipping_did").val(res.id);
                //
                // tag.addClass("f_ch_active_div").trigger("click");
                // f_checkbox_toggle_tabs();

                location.href = BASE_URL + "front/checkout?tab=2";

            } else {
                alert("Failed setting!");
            }
        });
    });

    // set shipping address newly without using user`s profile address info
    jQuery("#f_ch_shipping_asnew_btn").click(function(){
        var sdid = jQuery("#f_ch_shipping_did").val();
        var as_profile = 0;
        if ( jQuery("#f_ch_shipping_as_user_address").is(":checked") ) as_profile = 1;

        var first_name = jQuery("#f_ch_new_shipping_first_name").val();
        var last_name = jQuery("#f_ch_new_shipping_last_name").val();
        var company = jQuery("#f_ch_new_shipping_company").val();
        var phone = jQuery("#f_ch_new_shipping_phone").val();
        var country = jQuery("#f_ch_new_shipping_countires").val();
        var state = jQuery("#f_ch_new_shipping_provinces").val();
        var address1 = jQuery("#f_ch_new_shipping_address1").val();
        var address2 = jQuery("#f_ch_new_shipping_address2").val();
        var city = jQuery("#f_ch_new_shipping_city").val();
        var zip = jQuery("#f_ch_new_shipping_zip").val();

        if ( g_v_t(first_name) ) { alert("Input first name!"); jQuery("#f_ch_new_shipping_first_name").focus(); return; }
        if ( g_v_t(last_name) ) { alert("Input last name!"); jQuery("#f_ch_new_shipping_last_name").focus(); return; }
        if ( g_v_t(company) ) { alert("Input company name"); jQuery("#f_ch_new_shipping_company").focus(); return; }
        if ( g_v_ts(country) ) { alert("Select country"); return; }

        var tag = jQuery(this).parent(".f_ch_sub_cnt_div").parent(".f_ch_cnt_div").next(".f_checkout_tab_div");

        var params = {
            "sdid" : sdid,
            "as_profile" : as_profile,
            "first_name" : first_name,
            "last_name" : last_name,
            "company" : company,
            "phone" : phone,
            "country" : country,
            "state" : state,
            "address1" : address1,
            "address2" : address2,
            "city" : city,
            "zip" : zip
        };
        var url = BASE_URL + "front/set_shipping_address_newly";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Set billing address successfully!");
                // jQuery("#f_ch_shipping_did").val(res.id);
                //
                // tag.addClass("f_ch_active_div").trigger("click");
                // f_checkbox_toggle_tabs();

                location.href = BASE_URL + "front/checkout?tab=2";

            } else {
                alert("Failed setting!");
            }
        });
    });
}

/***
 * shipping method proc fucntion
 * ***/
function checkout_shipping_method_proc_fucn()
{
   // set shipping method
   jQuery("#f_ch_shipping_method_btn").click(function(){
       var did = jQuery("#f_ch_order_did").val();   // order table`s primary key
       var billing_address = jQuery("#f_ch_billing_did").val();
       var shipping_address = jQuery("#f_ch_shipping_did").val();
       var shipping_method =  jQuery("input[name='f_ch_shipping_method_items']:checked").val();
       if ( shipping_method == null || shipping_method == "" || shipping_method == undefined ) {
           alert("Please select a shipping method");
           return;
       }

       var params = {
           "did" : did,
           "billing_address" : billing_address,
           "shipping_address" : shipping_address,
           "shipping_method" : shipping_method
       };

       var tag = jQuery(this).parent(".f_ch_sub_cnt_div").parent(".f_ch_cnt_div").next(".f_checkout_tab_div");

       var url = BASE_URL + "front/set_order_incheckout";
       $.post(url, params, function(res) {
           if(res.status == "1" ) {
               alert("Set order successfully!");

               location.href = BASE_URL + "front/checkout?tab=3";

           } else {
               alert("Failed setting!");
           }
       });
   });
}

/***
 * payment proceed proc fucntion
 * ***/
function checkout_payment_proceed_proc_fucn()
{
    jQuery("#f_ch_proceed_payment_btn").click(function(){
        var did = jQuery("#f_ch_order_did").val();   // order table`s primary key
        var payment_kind = jQuery("input[name='f_ch_payment_kind']:checked").val();
        var subtotal = jQuery(this).attr("subtotal");
        if ( payment_kind == "" || payment_kind == null || payment_kind == undefined || payment_kind == "0" ) {
            alert("Please select payment kind");
            return;
        }

        if ( subtotal == "0" || subtotal == undefined || subtotal == "" ) {
            alert("There are not any product");
            location.href = BASE_URL + "front/cart";
            return;
        }

        var params = {
            "did" : did,
            "payment_kind" : payment_kind,
            "subtotal" : subtotal
        };

        var tag = jQuery(this).parent("div").parent(".row").parent(".f_cart_list_div").parent(".f_ch_cnt_div").next(".f_checkout_tab_div");

        var url = BASE_URL + "front/set_order_confirm_incheckout";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Order confirmed successfully!");
                // tag.addClass("f_ch_active_div").trigger("click");
                // f_checkbox_toggle_tabs();

                location.href = BASE_URL + "front/checkout?tab=4";

            } else {
                alert("Failed setting!");
            }
        });
    });
}

/***
 * payment detail proc fucntion
 * ***/
function checkout_payment_detail_proc_fucn()
{
    var is_live_paypal = jQuery("#f_ch_paypal_is_live").val();
    var p_client_id = jQuery("#f_ch_paypal_sandbox_clientid").val();
    var p_secret_key = jQuery("#f_ch_paypal_sandbox_secretkey").val();
    var s_client_id = jQuery("#f_ch_paypal_live_clientid").val();
    var s_secret_key = jQuery("#f_ch_paypal_live_secretkey").val();

    var grand_funds = jQuery("#f_ch_grand_total_fund").val();
    var paypal_kind = "sandbox" ;
    var ch_sandbox = p_client_id;
    var ch_production = p_secret_key;
    if ( is_live_paypal == "1" ) {
        paypal_kind = "production";
        ch_sandbox = s_client_id;
        ch_production = s_secret_key;
    }

    if ( jQuery("#f_ch_checkout_page").val() == "1" ) {
        paypal.Button.render({

            env: paypal_kind, // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    ch_sandbox,
                production: ch_production
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: jQuery("#f_ch_grand_total_fund").val(), currency: 'USD' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                    // payment complete process
                    payment_complete_proc_func();
                });
            }

        }, '#paypal-button-container');
    }

}

function f_checkbox_toggle_tabs()
{
    jQuery(".f_ch_active_div").unbind("click").click(function(){
        if ( jQuery(this).next(".f_ch_cnt_div").is(".g_none_dis") ) {
            jQuery(this).next(".f_ch_cnt_div").removeClass("g_none_dis");
        } else {
            jQuery(this).next(".f_ch_cnt_div").addClass("g_none_dis")
        }
    });
}

/**
 * payment complete process
 * */
function payment_complete_proc_func()
{
    var did = jQuery("#f_ch_order_did").val();                  // order table`s primary key
    var billing_address = jQuery("#f_ch_billing_did").val();
    var shipping_address = jQuery("#f_ch_shipping_did").val();
    var params = {
        "did" : did,
        "billing_address" : billing_address,
        "shipping_address" : shipping_address
    };

    var url = BASE_URL + "front/payment_complete_proc";
    $.post(url, params, function(res) {
        if(res.status == "1" ) {
            location.href = BASE_URL + "front/u_orders";
        } else {
            alert("Database Error!");
        }
    });
}