jQuery(function(){
    /** Oders */
    user_account_oders_proc_func();
    /** Messages */
    user_account_messages_proc_func();
    /** Addresses */
    user_account_address_proc_func();
    /** Wish Lists */
    user_account_wish_lists_proc_func();
    /** Recently Viewed */
    user_account_recently_viewd_proc_func();
    /** Account Settings */
    user_account_account_settings_proc_func();
});

/** Oders */
function user_account_oders_proc_func()
{

}
/** Messages */
function user_account_messages_proc_func()
{

}
/** Addresses */
function user_account_address_proc_func()
{
    jQuery("#u_address_update").click(function(){
        var first_name = jQuery("#signup_first_name").val();
        var last_name = jQuery("#signup_last_name").val();
        var company = jQuery("#signup_company").val();
        var phone = jQuery("#signup_phone").val();
        var country = jQuery(".signup_country").val();
        var state = jQuery(".signup_state").val();
        var address1 = jQuery("#signup_address1").val();
        var address2 = jQuery("#signup_address2").val();
        var city = jQuery("#signup_city").val();
        var zip = jQuery("#signup_zip").val();

        if ( g_v_t(first_name) ) { alert("Input first name!"); jQuery("#l_s_firstname").focus(); return; }
        if ( g_v_t(last_name) ) { alert("Input last name!"); jQuery("#signup_last_name").focus(); return; }
        if ( g_v_ts(country) ) { alert("Select country"); return; }

        var params = {
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
        var url = BASE_URL + "front/user_profile_update";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Upated successfully!");
            } else {
                alert("Failed user register!");
            }
        });
    });
}
/** Wish Lists */
function user_account_wish_lists_proc_func()
{

}
/** Recently Viewed */
function user_account_recently_viewd_proc_func()
{

}
/** Account Settings */
function user_account_account_settings_proc_func()
{
    // email
    jQuery("#as_update_email_input").blur(function(){
        var val = jQuery(this).val();
        if ( g_v_e(val) )
        {
            jQuery(this).addClass("g_bad_val_input");
            jQuery(".u_accoutn_email_alert").html("Invalid email");
        }
    }).keypress(function(e){
        if ( e.which == 13 )
            jQuery(this).trigger("blur");
    }).focus(function(){
        jQuery(this).removeClass("g_bad_val_input");
        jQuery(".u_accoutn_email_alert").html("&nbsp;");
    });

    jQuery("#as_update_email_btn").click(function(){
        if ( jQuery(".g_alert_txt").html() != "&nbsp;" ) return;
        var email = jQuery("#as_update_email_input").val();
        var params = { "email": email };
        var url = BASE_URL + "front/update_user_email";
        $.post(url, params, function(res) {
            if (res.status != 1 ) {
                location.reload();
            } else {
                alert("DB error!");
            }
        });
    });

    // password
    jQuery("#as_p_u_current").blur(function(){
        var tag = jQuery(this);
        var val = jQuery(this).val();
        if ( val == "" ) {
            jQuery(this).addClass("g_bad_val_input");
            jQuery(".u_accoutn_pass_alert").html("Please input current password");
            return;
        } else {
            var params = { "password": val };
            var url = BASE_URL + "front/confirm_user_password";
            $.post(url, params, function(res) {
                if (res.status != 1 ) {
                    tag.addClass("g_bad_val_input");
                    jQuery(".u_accoutn_pass_alert").html("Please retype correct password");
                } else {
                    jQuery("#as_p_u_password").removeAttr("disabled").trigger("focus");
                }
            });
        }
    }).keypress(function(e){
        if ( e.which == 13 )
            jQuery(this).trigger("blur");
    }).focus(function(){
        jQuery(this).removeClass("g_bad_val_input");
        jQuery(".u_accoutn_pass_alert").html("&nbsp;");
    });

    jQuery("#as_p_u_password").blur(function(){

        if ( jQuery(this).val().length < 3 ) {
            jQuery(this).addClass("g_bad_val_input");
            jQuery(".u_accoutn_pass_alert").html("Please enter at least 3 characters!");
            return;
        } else {
            jQuery("#as_p_u_confirm").removeAttr("disabled").trigger("focus");
        }
    }).keypress(function(e){
        if ( e.which == 13 )
            jQuery(this).trigger("blur");
    }).focus(function(){
        jQuery("input").removeClass("g_bad_val_input");
        jQuery(".u_accoutn_pass_alert").html("&nbsp;");
    });

    jQuery("#as_p_u_confirm").blur(function(){

        if ( jQuery(this).val() != jQuery("#as_p_u_password").val() ) {
            jQuery(this).addClass("g_bad_val_input");
            jQuery(".u_accoutn_pass_alert").html("New password do not match!");
            return;
        } else {
            jQuery("#as_update_password_btn").attr("active", "1");
        }
    }).keypress(function(e){
        if ( e.which == 13 )
            jQuery(this).trigger("blur");
    }).focus(function(){
        jQuery("input").removeClass("g_bad_val_input");
        jQuery(".u_accoutn_pass_alert").html("&nbsp;");
    });

    jQuery("#as_update_password_btn").click(function(){
        if ( jQuery(this).attr("active") != "1" ) {
            jQuery(".u_accoutn_pass_alert").html("New password do not match!");
            return;
        }

        var password = jQuery("#as_p_u_password").val();
        var params = { "password": password };
        var url = BASE_URL + "front/update_user_password";
        $.post(url, params, function(res) {
            if (res.status != 1 ) {
                alert("Updated successfully!");
            } else {
                alert("DB error!");
            }
        });
    });
}












