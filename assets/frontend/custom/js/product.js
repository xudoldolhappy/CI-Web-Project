jQuery(function(){
    /** product detail page proc function **/
    product_detail_proc_function();
});

/**
 * product detail page proc function
 * */
function product_detail_proc_function()
{
    // photo gallery
    $('#myCarousel').carousel({
        interval: 10000
    });

    // image popup
    jQuery(".f_p_d_photo").click(function(){
        var src = jQuery(this).attr("src");
        jQuery(".f_product_preview_img").attr("src", src);
        jQuery("#f_product_img_preview_btn").trigger("click");
    });

    // image layout setting
    jQuery(".f_p_s_a").each(function(e){
        var tdv_height = jQuery(this).height();
        var img_height = jQuery(this).children("img").height();
        var mtop = ( tdv_height - img_height ) / 2;
        if ( mtop < 0 ) mtop = 0;
        // jQuery(this).children("img").css("margin-top", mtop);
    });

    // the number sert for cart
    jQuery("#f_p_d_cnt_minus").click(function(){
        var cur_num = parseInt(jQuery("#f_p_d_cart_cnt").html());
        if ( cur_num == 1 ) return;
        jQuery("#f_p_d_cart_cnt").html( cur_num - 1 );
    });
    jQuery("#f_p_d_cnt_plus").click(function(){
        var quanity = parseInt(jQuery(this).attr("quanity"));
        var cur_num = parseInt(jQuery("#f_p_d_cart_cnt").html());
        if ( quanity == cur_num ) return;
        jQuery("#f_p_d_cart_cnt").html( cur_num + 1 );
    });

    // write review
    jQuery("#f_p_d_r_add_btn").click(function(){
        var product = jQuery("#f_p_d_did").val();
        var name = jQuery("#f_p_d_r_a_name").val();
        var email = jQuery("#f_p_d_r_a_email").val();
        var rating = jQuery("#f_p_d_r_a_rating").val();
        var subject = jQuery("#f_p_d_r_a_subject").val();
        var comment = jQuery("#f_p_d_r_a_comment").val();

        if ( g_v_t(name) ) { alert("Enter your name!"); jQuery("#f_p_d_r_a_name").focus(); return; }
        if ( g_v_e(email) ) { alert("Enter correct email!"); jQuery("#f_p_d_r_a_email").focus(); return; }
        if ( g_v_ts(rating) ) { alert("Select review rating!"); jQuery("#f_p_d_r_a_rating").focus(); return; }
        if ( g_v_t(subject) ) { alert("Enter review subject!"); jQuery("#f_p_d_r_a_subject").focus(); return; }
        if ( g_v_t(comment) ) { alert("Enter review comment!"); jQuery("#f_p_d_r_a_comment").focus(); return; }

        var params = {
            "product" : product,
            "name" : name,
            "email" : email,
            "rating" : rating,
            "subject" : subject,
            "comment" : comment
        };
        var today = new Date();
        var url = BASE_URL + "front/write_product_review";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                // append new review to review list
                var html = '<div class="row g_top_boder">' +
                                '<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_r_l_tlt">' + subject + '</div>' +
                                '<div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_r_l_cnt">' +
                                    '<img src="' + BASE_URL + 'assets/frontend/lib/img/icons/r' + rating + '.png" />' +
                                    today + ' by <span>' + email + '</span>' +
                                '</div>' +
                            '</div><div class="row">' +
                                '<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">' + comment + '</div>' +
                            '</div>';

                jQuery(".f_p_d_review_list_div").append(html);

                // init write review dialog inputs
                jQuery("#f_p_d_r_a_name").val("");
                jQuery("#f_p_d_r_a_email").val("");
                jQuery("#f_p_d_r_a_rating").val(0);
                jQuery("#f_p_d_r_a_subject").val("");
                jQuery("#f_p_d_r_a_comment").val("");

                jQuery("#f_p_d_r_close_btn").trigger("click");
            } else {
            }
        });
    });

    /** add product to cart and go to cart page **/
    jQuery("#f_p_d_add_cart_btn").click(function(){
        var cartid = jQuery("#g_cartid").val();
        var product = jQuery("#f_p_d_did").val();
        var count = jQuery("#f_p_d_cart_cnt").html();
        location.href = BASE_URL + "front/add_product_tocart?product=" +
            product + "&cartid=" + cartid + "&count=" + count;
    });

    /** product gallery`s photo display **/
    jQuery(".p_a_gallery_sub_img").click(function(){
       jQuery(".f_p_d_photo").attr("src", jQuery(this).attr("src"));
    });

    /*** overview product service parts  ***/
    jQuery(".f_p_d_service_parts").hover(function(pt){
        var cur_x = pt.pageX;
        var cur_y = pt.pageY;

        jQuery("#f_p_d_s_p_o_name").html(jQuery(this).attr("p_name"));
        jQuery("#f_p_d_s_p_o_code").html(jQuery(this).attr("p_code"));
        jQuery("#f_p_d_s_p_o_quantity").html(jQuery(this).attr("p_quanity"));
        jQuery("#f_p_d_s_p_o_price").html(jQuery(this).attr("p_price"));
        jQuery("#f_p_d_s_p_o_fee").html(jQuery(this).attr("p_fee"));
        jQuery("#f_p_d_s_p_o_img").attr( "src", BASE_URL + "uploads/pcategories/" + jQuery(this).attr("p_filename"));

        var left = cur_x - 700;
        var top = cur_y;

        jQuery(".f_p_d_service_overview").css("left", left).css("top", top);
        jQuery(".f_p_d_service_overview").show(200);

    }, function(){
        jQuery(".f_p_d_service_overview").hide(0);
    });
}
