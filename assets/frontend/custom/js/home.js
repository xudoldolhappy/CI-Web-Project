jQuery(function(){
    /**
     * main menu ui process function
     * */
    home_main_menu_process_func();

    /**
     * main proc function
     * */
    home_main_proc_func();
});


/**
 * main menu ui process function
 * */
function home_main_menu_process_func()
{
    /**
     * activity part
     * */
    jQuery("#f_activity").click(function(){
        var offset = jQuery(this).offset();
        var left = offset.left + 15;
        var top = offset.top + jQuery(this).height() + 7;
        jQuery("#f_nav_activity_sub").css("left", left).css("top", top).show(500);
    });

    jQuery(window).click(function(e){
        if ( jQuery(e.target).is("#f_activity") || jQuery(e.target).is(".f_nav_sub") ||
            (jQuery(e.target).is(".f_acivity_menu") || jQuery(e.target).is(".g_m_tlt"))  ||
            jQuery(e.target).is(".f_acivity_recent") || jQuery(e.target).is(".f_nav_recents")) {
            return;
        }
        jQuery("#f_nav_activity_sub").hide(300);
    });

    /**
     * user account manage part
     * */
    jQuery("#f_user").click(function(){
        var offset = jQuery(this).offset();
        var left = offset.left - jQuery("#f_nav_user_profile_sub").width() + 40;
        var top = offset.top + jQuery(this).height() + 7;
        jQuery("#f_nav_user_profile_sub").css("left", left).css("top", top).show(500);
    });

    jQuery(window).click(function(e){
        if ( jQuery(e.target).is("#f_user") || jQuery(e.target).is(".f_nav_sub") ||
            (jQuery(e.target).is(".f_use_profile_menu") || jQuery(e.target).is(".g_m_tlt"))  ||
            jQuery(e.target).is(".f_acivity_recent") || jQuery(e.target).is(".f_nav_user_profile_cnt")) {
            return;
        }
        jQuery("#f_nav_user_profile_sub").hide(300);
    });

    /**
     * use setting manage part
     * */
    jQuery(".f_cart_div").click(function(){
        var offset = jQuery(this).offset();
        var left = offset.left - ( jQuery("#f_nav_user_setting_sub").width() - jQuery(this).width() ) + 65;
        var top = offset.top + jQuery(this).height() + 15;
        jQuery("#f_nav_user_setting_sub").css("left", left).css("top", top).show(500);
    });

    jQuery(window).click(function(e){
        if ( jQuery(e.target).is(".f_cart_div") || jQuery(e.target).is(".f_nav_sub") ||
            (jQuery(e.target).is(".f_use_profile_menu") || jQuery(e.target).is(".g_m_tlt"))  ||
            jQuery(e.target).is(".f_cart_div i") || jQuery(e.target).is(".f_cart_div div") ||
            jQuery(e.target).is(".f_cart_txt_div span")) {
            return;
        }
        jQuery("#f_nav_user_setting_sub").hide(300);
    });

    /**
     * edit profile items clikc
     * */
    jQuery(".f_use_profile_menu").children(".g_s_tlt").click(function(){
       location.href = jQuery(this).children("a").attr("href");
    });
}

/**
 * main proc function
 * */
function home_main_proc_func()
{
    // display link icons when mouse over on the items
    jQuery(".h_items_div").hover(function(){
        jQuery(this).children(".h_items_stlt_div").addClass("g_none_dis");
        jQuery(this).children(".h_items_icon_div").removeClass("g_none_dis");
    }, function(){
        jQuery(this).children(".h_items_stlt_div").removeClass("g_none_dis");
        jQuery(this).children(".h_items_icon_div").addClass("g_none_dis");
    });

    // faq page event
    jQuery(".h_s_tlt_d").click(function(){
        var cnttag = jQuery(this).next("div");
        var hidetag = jQuery(this).parent(".row").next(".row");
        if ( hidetag.hasClass("g_none_dis") ) { // expand
            hidetag.removeClass("g_none_dis");
            jQuery(this).children("img").attr("src", BASE_URL + "assets/frontend/lib/img/icons/d1.png");
        } else { // collapse
            hidetag.addClass("g_none_dis");
            jQuery(this).children("img").attr("src", BASE_URL + "assets/frontend/lib/img/icons/d2.png");
        }
    });

    // contact info submit
    jQuery("#f_c_contact_btn").click(function(){
        var first_name = jQuery("#f_c_first_name").val();
        var phone = jQuery("#f_c_phone").val();
        var email = jQuery("#f_c_email").val();
        var order = jQuery("#f_c_order_number").val();
        var company = jQuery("#f_c_company").val();
        var rma = jQuery("#f_c_rma").val();
        var commment = jQuery("#f_c_comment").val();

        if ( g_v_t(first_name) ) { alert("Input first name!"); jQuery("#f_c_first_name").focus(); return; }
        if ( g_v_e(email) ) { alert("Invalid email!"); jQuery("#f_c_email").focus(); return; }
        if ( g_v_t(commment) ) { alert("Enter commment!"); jQuery("#f_c_comment").focus(); return; }

        var params = {
            "first_name" : first_name,
            "phone" : phone,
            "email" : email,
            "order" : order,
            "company" : company,
            "rma" : rma,
            "commment" : commment
        };
        var url = BASE_URL + "front/submit_contact_us_info";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Submitted successfully!");
                location.reload();
            } else {
                alert("Failed contact submit!");
            }
        });
    });
}