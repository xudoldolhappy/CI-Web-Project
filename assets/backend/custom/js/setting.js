jQuery(function(){
   /*** general setting all event process function ***/
   general_setting_event_proc_func();

   /*** payment setting all event process fucntion ***/
   payment_setting_event_proc_func();

   /*** import csv data like as categories, products and related info ***/
   setting_import_csv_daata();
});

/***
 * general setting all event process function
 * ***/
function general_setting_event_proc_func()
{
   // paypal info toggle button event
   jQuery(".s_p_toggle_btn").click(function(){
      var state = jQuery(this).attr("state");
      if ( state == "0" ) {
          jQuery(this).attr("src", BASE_URL + "assets/backend/lib/img/icons/toggle_r.png" )
          jQuery(this).attr("state", "1");
          jQuery(".s_p_s_val_div").addClass("g_non_dis");
          jQuery(".s_p_p_val_div").removeClass("g_non_dis");
      } else {
          jQuery(this).attr("src", BASE_URL + "assets/backend/lib/img/icons/toggle_l.png" )
          jQuery(this).attr("state", "0");
          jQuery(".s_p_s_val_div").removeClass("g_non_dis");
          jQuery(".s_p_p_val_div").addClass("g_non_dis");
      }
   });

   // update admin paypal info
   jQuery("#s_p_api_save").click(function(){
       var is_live_paypal = jQuery("#s_p_pp_state").attr("state");   // 0=>sandbox, 1=>live paypal
       var p_client_id = jQuery("#s_p_s_cid").val();
       var p_secret_key = jQuery("#s_p_s_sec").val();
       var s_client_id = jQuery("#s_p_p_cid").val();
       var s_secret_key = jQuery("#s_p_p_sec").val();

       var params = {
           "is_live_paypal" : is_live_paypal,
           "p_client_id" : p_client_id,
           "p_secret_key" : p_secret_key,
           "s_client_id" : s_client_id,
           "s_secret_key" : s_secret_key
       };
       var url = BASE_URL + "admin/update_admin_paypal_info";
       $.post(url, params, function(res) {
           if(res.status == "1" ) {
               alert("Updated successfully!");
           } else {
               alert("Failed updating!");
           }
       });
   });

   // add new shipping method
    jQuery("#s_p_add_shipping_method").click(function(){
        var title = jQuery("#s_p_s_method").val();
        var price = jQuery("#s_p_s_price").val();

        if ( g_v_t(title) ) {
           alert("Please enter shipping method");
            jQuery("#s_p_s_method").focus();
            return;
        }

        if ( g_v_t(price) ) {
            alert("Please enter shipping price");
            jQuery("#s_p_s_price").focus();
            return;
        }

        var params = {
            "title" : title,
            "price" : price
        };
        var url = BASE_URL + "admin/add_new_shipping_method";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Added successfully!");
                location.reload();
            } else {
                alert("Failed updating!");
            }
        });
    });

    // update curernt shipping methid info
    jQuery(".s_p_pp_fix").click(function(){
        var tag = jQuery(this).parent("div").parent("div");
        var id = tag.attr("did");
        var title = tag.children(":first-child").children(".s_p_s_method").val();
        var price = tag.children(":first-child").next("div").children(".s_p_s_price").val();

        if ( g_v_t(title) ) {
            alert("Please enter shipping method");
            tag.children(":first-child").children(".s_p_s_method").focus();
            return;
        }

        if ( g_v_t(price) ) {
            alert("Please enter shipping price");
            tag.children(":first-child").next("div").children(".s_p_s_price").focus();
            return;
        }

        var params = {
            "id" : id,
            "title" : title,
            "price" : price
        };
        var url = BASE_URL + "admin/update_current_shipping_method";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Updated successfully!");
            } else {
                alert("Failed updating!");
            }
        });
    });

    // delete curernt shipping methid info
    jQuery(".s_p_pp_delete").click(function(){
       if ( ! confirm("Would you like to delete current shipping method?") ) return;
        var tag = jQuery(this).parent("div").parent("div");
        var id = tag.attr("did");

        var params = {
            "id" : id
        };
        var url = BASE_URL + "admin/remove_current_shipping_method";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Deleted successfully!");
                tag.remove();
            } else {
                alert("Failed updating!");
            }
        });
    });
}
/***
 * payment setting all event process fucntion
 * ***/
function payment_setting_event_proc_func()
{

}

/***
 * import csv data like as categories, products and related info
 */
function  setting_import_csv_daata()
{
    /*************************** import categories from csv file *****************************/
    jQuery("#s_i_c_cateories_import_btn").click(function(){
        jQuery("#s_i_c_cateories_file").trigger("click");
    });

    jQuery("#s_i_c_cateories_file").change(function(){
        if ( jQuery("#s_i_c_cateories_file").val() == "" ) return;
        jQuery("#s_i_c_cateories_upload").trigger("click");
    });

    jQuery('#s_i_c_cateories_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_categpries_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported categories successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });

    /*************************** import products from csv file *****************************/
    jQuery("#s_i_c_products_import_btn").click(function(){
        jQuery("#s_i_c_products_file").trigger("click");
    });

    jQuery("#s_i_c_products_file").change(function(){
        if ( jQuery("#s_i_c_products_file").val() == "" ) return;
        jQuery("#s_i_c_products_upload").trigger("click");
    });

    jQuery('#s_i_c_products_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_products_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported products successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });

    /*************************** import products photos from csv file *****************************/
    jQuery("#s_i_c_products_photos_import_btn").click(function(){
        jQuery("#s_i_c_products_photos_file").trigger("click");
    });

    jQuery("#s_i_c_products_photos_file").change(function(){
        if ( jQuery("#s_i_c_products_photos_file").val() == "" ) return;
        jQuery("#s_i_c_products_photos_upload").trigger("click");
    });

    jQuery('#s_i_c_products_photos_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_products_photos_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported product`s photos successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });

    /*************************** import products categories from csv file *****************************/
    jQuery("#s_i_c_products_categories_import_btn").click(function(){
        jQuery("#s_i_c_products_categories_file").trigger("click");
    });

    jQuery("#s_i_c_products_categories_file").change(function(){
        if ( jQuery("#s_i_c_products_categories_file").val() == "" ) return;
        jQuery("#s_i_c_products_categories_upload").trigger("click");
    });

    jQuery('#s_i_c_products_categories_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_products_categories_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported product`s photos successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });

    /*************************** import products applications from csv file *****************************/
    jQuery("#s_i_c_products_applications_import_btn").click(function(){
        jQuery("#s_i_c_products_applications_file").trigger("click");
    });

    jQuery("#s_i_c_products_applications_file").change(function(){
        if ( jQuery("#s_i_c_products_applications_file").val() == "" ) return;
        jQuery("#s_i_c_products_applications_upload").trigger("click");
    });

    jQuery('#s_i_c_products_applications_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_products_applications_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported product`s applications successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });

    /*************************** import product replacements from csv file *****************************/
    jQuery("#s_i_c_products_replacements_import_btn").click(function(){
        jQuery("#s_i_c_products_replacements_file").trigger("click");
    });

    jQuery("#s_i_c_products_replacements_file").change(function(){
        if ( jQuery("#s_i_c_products_replacements_file").val() == "" ) return;
        jQuery("#s_i_c_products_replacements_upload").trigger("click");
    });

    jQuery('#s_i_c_products_replacements_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_products_replacements_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported product`s replacements successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });

    /*************************** import product advanced spec from csv file *****************************/
    jQuery("#s_i_c_products_advanced_import_btn").click(function(){
        jQuery("#s_i_c_products_advanced_file").trigger("click");
    });

    jQuery("#s_i_c_products_advanced_file").change(function(){
        if ( jQuery("#s_i_c_products_advanced_file").val() == "" ) return;
        jQuery("#s_i_c_products_advanced_upload").trigger("click");
    });

    jQuery('#s_i_c_products_advanced_form').on("submit", function(e) {

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_products_advanced_data_csv_in_setting";
        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,          // The content type used when sending data to the server.
            cache: false,                // To unable request pages to be cached
            processData: false,          // To send DOMDocument or non processed data file it is set to false
            success: function (data) {
                jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                if (data.status == 1) {
                    alert("Imported product`s advance spec successfully!");
                } else {
                    alert("Please Select File");
                }
            }
        });
    });
}