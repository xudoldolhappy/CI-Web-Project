jQuery(function(){
    /**
     * product add all proc func
     * */
    product_add_proc_func();
});

/** global varibale for gallery photo addding **/
var g_is_gallery_first = true;

/**
 * product add all proc func
 * */
function product_add_proc_func()
{
    /********************* main ui setting *************************/
    // tabs plugin function
    jQuery('#tabs').tabs();

    // date display plugin in general setting
    jQuery('#startdate').datepicker({
        dateFormat : 'yy-mm-dd',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
        }
    });

    jQuery('#finishdate').datepicker({
        dateFormat : 'yy-mm-dd',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
        }
    });

    // multiselect
    $('#p_n_realted_products').multiselect({
        nonSelectedText: 'Select altenative or recommended products',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'99.5%'
    });

    // autocmplete
    $('#p_n_alternative_products').typeahead({
        source: function (query, result) {
            $.ajax({
                url: BASE_URL + "admin/get_product_list_for_autocomplete",
                data: 'query=' + query,
                dataType: "json",
                type: "POST",
                success: function (data) {
                    if ( data.status == 1 ) {
                        var list = data.list;
                        result($.map(list, function (item) {
                            return item;
                        }));
                    }
                }
            });
        }
    });

    /********** select attribute in attribute tabs *************/
    p_n_application_js_proc();
    jQuery("#pa_add_new_app_item").click(function(){
        var tag = jQuery(this).parent("div").parent(".p_a_app_cnt");
        var make_id = tag.children("div").children(".p_n_att_make").val();
        if ( make_id == "" || make_id == undefined || make_id == null ) return;
        var make_name = tag.children("div").children(".p_n_att_make").children("option:selected").html();
        var type_id = tag.children("div").children(".p_n_att_type").val();
        var type_name = tag.children("div").children(".p_n_att_type").children("option:selected").text();
        var model_id = tag.children("div").children(".p_n_att_model").val();
        var model_name = tag.children("div").children(".p_n_att_model").children("option:selected").text();
        var year_id = tag.children("div").children(".p_n_att_year").val();
        var year_name = tag.children("div").children(".p_n_att_year").children("option:selected").text();
        var engine_id = tag.children("div").children(".p_n_att_engine").val();
        var engine_name = tag.children("div").children(".p_n_att_engine").children("option:selected").text();

        if ( type_id == null ) type_id = "";
        if ( model_id == null ) model_id = "";
        if ( year_id == null ) year_id = "";
        if ( engine_id == null ) engine_id = "";

        var html = '<div class="row p_a_app_cnt pa_app_edit_row">' +
                        '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3 pa_app_edit_make" make_id="' + make_id + '">' +
                            make_name  +
                        '</div>' +
                        '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_type" type_id="' + type_id + '">' +
                            type_name  +
                        '</div>' +
                        '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_model" model_id="' + model_id + '">' +
                            model_name  +
                        '</div>' +
                        '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_year" year_id="' + year_id + '">' +
                            year_name  +
                        '</div>' +
                        '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_engine" engine_id="' + engine_id + '">' +
                            engine_name  +
                        '</div>' +
                        '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1 pa_app_edit_btn_div">' +
                            '<div class="btn btn-sm btn-success pa_app_btn pa_app_row_edit"><span class="fa fa-pencil"></span></div>' +
                            '<div class="btn btn-sm btn-danger pa_app_btn pa_app_row_remove"><span class="fa fa-trash-o"></span></div>' +
                        '</div>' +
                    '</div>';
        tag.before(html);
        p_n_application_js_proc();
    });
    // add new application rows
    // jQuery(".p_n_t_new_application").click(function(){
    //    var prev_make = jQuery(this).prev(".p_a_app_cnt").children(":first-child").children(".p_n_att_make").val();
    //    if ( g_v_ts (prev_make) && jQuery(this).prev().is(".p_a_app_cnt") ) {
    //        alert("Please set previoous application.");
    //        return;
    //    }
    //
    //    var html = jQuery("#p_n_app_temp").html();
    //    jQuery(this).before(html);
    //    p_n_application_js_proc();
    // });

    /***************** custom attribute setting in avanced ******/
    product_custom_setting_js_proc();
    jQuery(".p_n_t_new_custom").click(function(){
        var old_val = jQuery(".p_n_t_custom").children(":last-child").children(":first-child").children("select").val();
        if (  old_val == "0" || old_val == null ) return;
       jQuery(".p_n_t_custom").append(jQuery("#p_n_product_spec_temp").html());
        product_custom_setting_js_proc()
    });
    /***************** custom attribute setting in service parts ******/
    product_custom_setting_js_proc();
    jQuery(".p_service_parts_t_new_custom").click(function(){
        var old_val = jQuery(".p_service_parts_t_custom").children(":last-child").children(":first-child").children("select").val();
        if (  old_val == "0" || old_val == null ) return;
        jQuery(".p_service_parts_t_custom").append(jQuery("#p_n_service_parts_temp").html());
        product_custom_setting_js_proc()
    });

    /*************************** import replacement brand from csv file *****************************/
    jQuery("#p_n_get_csv_btn").click(function(){
        jQuery("#p_n_get_csv_file").trigger("click");
    });

    jQuery("#p_n_get_csv_file").change(function(){
        if ( jQuery("#p_n_get_csv_file").val() == "" ) return;
        jQuery("#p_n_get_csv_upload").trigger("click");
    });

    jQuery('#upload_csv').on("submit", function(e){
        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_replacement_data_csv";
        $.ajax({
            url:url,
            method:"POST",
            data:new FormData(this),
            contentType:false,          // The content type used when sending data to the server.
            cache:false,                // To unable request pages to be cached
            processData:false,          // To send DOMDocument or non processed data file it is set to false
            success: function(data){
                if( data.status == 1 )
                {
                    var html = "";
                    var info = data.json;
                    var brands = info["brand"];     // current brand list
                    var list = info["list"];        // brand all list
                    var ids = info["ids"];          // current brand is list
                    var values = info["value"];     // current brand value list
                    for ( i = 0; i < brands.length; i ++ ) {
                        html += '<div class="row p_n_r_l_top_row">' +
                                    '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">' +
                                        '<select class="g_ipt p_n_c_brand">' +
                                            '<option value="0" disabled>--Product Spec--</option>';
                                for ( j = 0; j < list.length; j ++ ) {
                                    var selected = ""; if ( list[j]["id"] == ids[i] ) selected = "selected";
                                    html += '<option value="' + list[j]["id"] + '" ' + selected + '>' + list[j]["title"] + '</option>';
                                }
                            html +=     '</select>' +
                                    '</div>' +
                                    '<div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt p_n_c_value" value="' + values[i] + '" /></div>' +
                                    '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">' +
                                        '<button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>' +
                                    '</div>' +
                                '</div>';
                    }
                    jQuery(".p_n_r_l_custom").prepend(html);
                    jQuery("#p_n_get_csv_file").val("");
                    product_custom_setting_js_proc();
                }
                else
                {
                    jQuery("#p_n_get_csv_file").val("");
                    alert("Please Select File");
                }
            }
        })
    });

    /*************************** import product spec from csv file *****************************/
    jQuery("#p_s_get_csv_btn").click(function(){
        jQuery("#p_s_get_csv_file").trigger("click");
    });

    jQuery("#p_s_get_csv_file").change(function(){
        if ( jQuery("#p_s_get_csv_file").val() == "" ) return;
        jQuery("#p_s_get_csv_upload").trigger("click");
    });

    jQuery('#upload_product_spec_csv').on("submit", function(e){
        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_product_spec_csv";
        $.ajax({
            url:url,
            method:"POST",
            data:new FormData(this),
            contentType:false,          // The content type used when sending data to the server.
            cache:false,                // To unable request pages to be cached
            processData:false,          // To send DOMDocument or non processed data file it is set to false
            success: function(data){
                if( data.status == 1 )
                {
                    var html = "";
                    var info = data.json;
                    var specs = info["spec"];     // current brand list
                    var list = info["list"];        // brand all list
                    var ids = info["ids"];          // current brand is list
                    var values = info["value"];     // current brand value list
                    for ( i = 0; i < specs.length; i ++ ) {
                        html += '<div class="row p_n_c_top_row">' +
                                    '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">' +
                                        '<select class="g_ipt p_n_c_spec">' +
                                            '<option value="0" disabled>--Product Spec--</option>';
                                        for ( j = 0; j < list.length; j ++ ) {
                                            var selected = ""; if ( list[j]["id"] == ids[i] ) selected = "selected";
                                            html += '<option value="' + list[j]["id"] + '" ' + selected + '>' + list[j]["title"] + '</option>';
                                        }
                        html +=         '</select>' +
                                    '</div>' +
                                    '<div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">' +
                                        '<input type="text" class="g_ipt p_n_c_value" value="' + values[i] + '" /></div>' +
                                    '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">' +
                                        '<button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>' +
                                    '</div>' +
                                '</div>';
                    }
                    jQuery(".p_n_t_custom").prepend(html);
                    jQuery("#p_s_get_csv_file").val("");
                    product_custom_setting_js_proc();
                }
                else
                {
                    jQuery("#p_n_get_csv_file").val("");
                    alert("Please Select File");
                }
            }
        })
    });

    /*************************** import service parts from csv file *****************************/
    jQuery("#p_service_parts_get_csv_btn").click(function(){
        jQuery("#p_service_parts_get_csv_file").trigger("click");
    });

    jQuery("#p_service_parts_get_csv_file").change(function(){
        if ( jQuery(this).val() == "" ) return;
        jQuery("#p_service_parts_get_csv_upload").trigger("click");
    });

    jQuery('#upload_service_parts_csv').on("submit", function(e){
        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_service_parts_csv";
        $.ajax({
            url:url,
            method:"POST",
            data:new FormData(this),
            contentType:false,          // The content type used when sending data to the server.
            cache:false,                // To unable request pages to be cached
            processData:false,          // To send DOMDocument or non processed data file it is set to false
            success: function(data){
                if( data.status == 1 )
                {
                    var html = "";
                    var info = data.json;
                    var services = info["service"];     // current services list
                    var products = info["products"];     // current products list
                    var list = info["list"];        // brand all list
                    var ids = info["ids"];          // current brand is list
                    var values = info["value"];     // current brand value list
                    for ( i = 0; i < services.length; i ++ ) {
                        html += '<div class="row p_service_parts_top_row">' +
                            '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">' +
                                '<select class="g_ipt p_n_c_service_parts">' +
                                    '<option value="0" disabled>--Service Part--</option>';
                        for ( j = 0; j < list.length; j ++ ) {
                            var selected = ""; if ( list[j]["id"] == ids[i] ) selected = "selected";
                            html += '<option value="' + list[j]["id"] + '" ' + selected + '>' + list[j]["title"] + '</option>';
                        }
                        html +=  '</select>' +
                            '</div>' +
                            '<div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">' +
                                '<select class="p_n_c_value p_n_service_part_produc_slt">' +
                                    '<option value="0">Select any product</option>';
                        for ( j = 0; j < products.length; j ++ ) {
                            var selected = ""; if ( products[j]["code"] == values[i] ) selected = "selected";
                            html += '<option value="' + products[j]["code"] + '" ' + selected + '>' + products[j]["name"] + '&nbsp;(&nbsp;' + products[j]["code"] + '&nbsp;)</option>';
                        }
                        html +=  '</select>' +
                            '</div>' +
                            '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">' +
                            '<button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>' +
                            '</div>' +
                            '</div>';
                    }
                    jQuery(".p_service_parts_t_custom").prepend(html);
                    jQuery("#p_service_parts_get_csv_file").val("");
                    product_custom_setting_js_proc();
                }
                else
                {
                    jQuery("#p_n_get_csv_file").val("");
                    alert("Please Select File");
                }
            }
        })
    });

    /*************************** import application list from csv file *****************************/
    jQuery("#p_n_get_application__csv_btn").click(function(){
        jQuery("#p_n_get_application_csv_file").trigger("click");
    });

    jQuery("#p_n_get_application_csv_file").change(function(){
        if ( jQuery("#p_n_get_application_csv_file").val() == "" ) return;
        jQuery("#p_n_get_application_csv_upload").trigger("click");
    });

    jQuery('#upload_application_csv').on("submit", function(e){

        jQuery(".p_n_waiting_over_div").removeClass("g_non_dis");

        e.preventDefault(); //form will not submitted
        var url = BASE_URL + "admin/import_application_data_csv";
        $.ajax({
            url:url,
            method:"POST",
            data:new FormData(this),
            contentType:false,          // The content type used when sending data to the server.
            cache:false,                // To unable request pages to be cached
            processData:false,          // To send DOMDocument or non processed data file it is set to false
            success: function(data){
                if( data.status == 1 )
                {
                    var html = "";
                    var list = data.json;
                    for ( i = 0; i < list.length; i ++ ) {
                        html += '<div class="row p_a_app_cnt pa_app_edit_row">' +
                                    '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3 pa_app_edit_make" make_id="' + list[i]["make_id"] + '">' +
                                        list[i]["make_title"]  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_type" type_id="' + list[i]["type_id"] + '">' +
                                        list[i]["type_title"]  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_model" model_id="' + list[i]["model_id"] + '">' +
                                        list[i]["model_title"]  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_year" year_id="' + list[i]["year_id"] + '">' +
                                        list[i]["year_title"]  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_engine" engine_id="' + list[i]["engine_id"] + '">' +
                                        list[i]["engine_title"]  +
                                    '</div>' +
                                    '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1 pa_app_edit_btn_div">' +
                                        '<div class="btn btn-sm btn-success pa_app_btn pa_app_row_edit"><span class="fa fa-pencil"></span></div>' +
                                        '<div class="btn btn-sm btn-danger pa_app_btn pa_app_row_remove"><span class="fa fa-trash-o"></span></div>' +
                                    '</div>' +
                                '</div>';
                    }

                    jQuery(".p_n_app_list_cnt_div").prepend(html);
                    jQuery("#p_n_get_application_csv_file").val("");
                    jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                    p_n_application_js_proc();
                }
                else
                {
                    jQuery(".p_n_waiting_over_div").addClass("g_non_dis");
                    jQuery("#p_n_get_application_csv_file").val("");
                    alert("Please Select File");
                }
            }
        })
    });

    jQuery("#product_add_application").click(function(){
        var did = jQuery("#p_n_did").val();
        if ( did == undefined || did == null || did == "" ) return;
        jQuery(".p_a_app_alert").removeClass("g_non_dis");
        var params = {
            "id" : did
        };
        var url = BASE_URL + "admin/get_application_info_via_productid";
        jQuery.post(url, params, function(data) {
            if( data.status == 1 )
            {
                jQuery("#product_add_is_application_update").val("1");
                jQuery(".p_a_app_alert").addClass("g_non_dis");

                var html = "";
                var list = data.json;
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="row p_a_app_cnt pa_app_edit_row">' +
                                    '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3 pa_app_edit_make" make_id="' + list[i]["make"] + '">' +
                                        list[i]["make_title"]  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_type" type_id="' + list[i]["type"] + '">' +
                                        g_ret_val_val(list[i]["type_title"])  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_model" model_id="' + list[i]["model"] + '">' +
                                        g_ret_val_val(list[i]["model_title"])  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_year" year_id="' + list[i]["year"] + '">' +
                                        g_ret_val_val(list[i]["year_title"])  +
                                    '</div>' +
                                    '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2 pa_app_edit_engine" engine_id="' + list[i]["engine"] + '">' +
                                        g_ret_val_val(list[i]["engine_title"])  +
                                    '</div>' +
                                    '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1 pa_app_edit_btn_div">' +
                                        '<div class="btn btn-sm btn-success pa_app_btn pa_app_row_edit"><span class="fa fa-pencil"></span></div>' +
                                        '<div class="btn btn-sm btn-danger pa_app_btn pa_app_row_remove"><span class="fa fa-trash-o"></span></div>' +
                                    '</div>' +
                                '</div>';
                }

                jQuery(".p_n_app_list_cnt_div").prepend(html);
                p_n_application_js_proc();
            }
        });
    });

    /***************** add new replacement brand items row******/
    jQuery(".p_n_r_l_new_custom").click(function(){
        var old_val = jQuery(".p_n_r_l_custom").children(":last-child").children(":first-child").children("select").val();
        if (  old_val == "0" || old_val == null ) return;
        jQuery(".p_n_r_l_custom").append(jQuery("#p_n_replacement_brand_temp").html());
        product_custom_setting_js_proc();
    });

    /*********************** product image proc ***********************/
    gallery_photo_dynamic_proc_func();

    // opend uplaod broswer
    jQuery("#p_n_img").click(function(){
        jQuery("#ep_photo_upload_ipt").trigger("click");
    });

    jQuery("#ep_photo_upload_ipt").change(function(){
        jQuery("#ep_photos_submit").trigger("click");
    });

    jQuery("#ep_photos_submit").click(function(e){
        jQuery(this).parents("form").ajaxForm(options);
    });

    var options = {
        complete: function(response)
        {
            if(jQuery.isEmptyObject(response.responseJSON.error)){
                if ( jQuery("#ep_photos_submit").attr("is_gallery") == "1" ){   // gellery photo
                    if ( g_is_gallery_first ) {
                        var html = '<div class="p_a_g_p_div" photo="' + response.responseJSON.success + '">' +
                                        '<img src="' + BASE_URL + 'uploads/pcategories/' + response.responseJSON.success + '" />' +
                                        '<button class="btn btn-xs btn-default p_a_gallery_img_remove" data-original-title="Cancel">' +
                                            '<i class="fa fa-times"></i>' +
                                        '</button>' +
                                    '</div>';
                        jQuery("#p_a_add_gallery_image").parent("div").before(html);
                        gallery_photo_dynamic_proc_func();
                        g_is_gallery_first = false;
                    }
                } else {                                                        // featured photo
                    jQuery("#p_n_p_image").val(response.responseJSON.success);
                    jQuery("#p_n_img").attr("src",BASE_URL + "uploads/pcategories/"+response.responseJSON.success);
                }
            }else{
                alert('Image Upload Error.');
            }
        }
    };

    // add new product gallery image
    jQuery("#p_a_add_gallery_image").click(function(){
        if ( jQuery("#p_n_p_image").val() == "" || jQuery("#p_n_p_image").val() == "product_new.jpg" ) {
            alert("Please select product featured photo firstly");
            return;
        }
        g_is_gallery_first = true;
        jQuery("#ep_photos_submit").attr("is_gallery", "1");
        jQuery("#ep_photo_upload_ipt").trigger("click");
    });

    // galery photo proc func that added dynamically via javascript
    function gallery_photo_dynamic_proc_func()
    {
        // remove selected gallery photo
        jQuery(".p_a_gallery_img_remove").click(function(){
           jQuery(this).parent("div").remove();
        });
    }


    /************************ product publish *****************************/
    jQuery(".p_n_publish_btn").click(function(){
        var did = jQuery("#p_n_did").val();
        var code = jQuery("#p_n_code").val();
        var quanity = jQuery("#p_n_quanity").val();
        var name = jQuery("#p_n_name").val();
        if ( g_v_t(code) ) { alert("Input Product ID!"); jQuery("#p_n_code").focus(); return; }

        if ( g_v_t(quanity) ) { alert("Input Product Quanity!"); jQuery(this).prev(".b_p_a_quanity").focus(); return; }
        if ( g_v_n(quanity) ) { alert("Product Quanity must number"); jQuery(this).prev(".b_p_a_quanity").val("0").focus(); return; }
        if ( parseInt(quanity) < 0 ) { alert("Invalid Product Quanity!"); jQuery(this).prev(".b_p_a_quanity").val("0").focus(); return; }

        if ( g_v_t(name) ) { alert("Input Product name!"); jQuery("#p_n_name").focus(); return; }

        var reference = jQuery("#p_n_reference").val();
        var favorite = 0; if ( jQuery("#p_n_favorite_check").is(":checked") ) favorite = 1;
        var short_description = jQuery("#p_n_short_description").val();
        var description = jQuery("#p_n_description").val();
        var regular_price = jQuery("#p_n_regular_price").val();
        var sale_price = jQuery("#p_n_sale_price").val();
        var core_fee = jQuery("#p_n_core_fee").val();
        var start_date = jQuery("#startdate").val();
        var end_date = jQuery("#finishdate").val();
        var weight = jQuery("#p_n_weight").val();
        var length = jQuery("#p_n_length").val();
        var width = jQuery("#p_n_width").val();
        var height = jQuery("#p_n_height").val();

        var is_application_update = jQuery("#product_add_is_application_update").val();

        var photo = jQuery("#p_n_p_image").val();
        jQuery(".p_a_g_p_div").each(function(e){
            var ph = jQuery(this).attr("photo");
            if ( ph != "" ) {
                photo += "," + ph;
            }
        });

        var categories = "";
        jQuery(".my_tree_checkbox:checked").each(function(e){
            if ( e != 0 ) categories += ",";
            categories += jQuery(this).parent(".my_tree_cnt").attr("did");
        });

        var advanced = "";
        jQuery(".p_n_c_top_row").each(function(e){
            var name = jQuery(this).children(":first-child").children(".p_n_c_spec").val();
            var val = jQuery(this).children(":first-child").next().children(".p_n_c_value").val();
            if ( val != "" ) {
                if ( e != 0 ) advanced += "##";
                advanced += name + "&&" + val;
            };
        });

        // service parts info
        var service_parts = "";
        jQuery(".p_service_parts_top_row").each(function(e){
            var name = jQuery(this).children(":first-child").children(".p_n_c_service_parts").val();
            var val = jQuery(this).children(":first-child").next().children(".p_n_service_part_produc_slt").val();
            if ( val != "" && val != "0"  && val != null ) {
                if ( e != 0 ) service_parts += "##";
                service_parts += name + "&&" + val;
            };
        });

        var brand = "";
        jQuery(".p_n_r_l_top_row").each(function(e){
            var name = jQuery(this).children(":first-child").children(".p_n_c_brand").val();
            var val = jQuery(this).children(":first-child").next().children(".p_n_c_value").val();
            if ( val != "" ) {
                if ( e != 0 ) brand += "##";
                brand += name + "&&" + val;
            };
        });

        var product_alternative = jQuery("#p_n_alternative_products").val();
        // jQuery("#p_n_realted_products option:selected").each(function(){
        //     if ( product_alternative != "" ) product_alternative += "##";
        //     product_alternative += jQuery(this).val();
        // });

        var application = "";
        jQuery(".pa_app_edit_row").each(function(e){
            var make = jQuery(this).find(".pa_app_edit_make").attr("make_id"); if ( make == "undefined" ) make = "";
            var type = jQuery(this).find(".pa_app_edit_type").attr("type_id"); if ( type == "undefined" ) type = "";
            var model = jQuery(this).find(".pa_app_edit_model").attr("model_id"); if ( model == "undefined" ) model = "";
            var year = jQuery(this).find(".pa_app_edit_year").attr("year_id"); if ( year == "undefined" ) year = "";
            var engine = jQuery(this).find(".pa_app_edit_engine").attr("engine_id"); if ( engine == "undefined" ) engine = "";
            if ( !g_v_ts(make) ) {
                if ( e != 0 ) application += "##";
                application += make + "&&" + type + "&&" + model + "&&" + year + "&&" + engine;
            }
        });

        var params = {
            "did" : did,
            "code" : code,
            "quanity" : quanity,
            "name" : name,
            "reference" : reference,
            "favorite" : favorite,
            "short_description" : short_description,
            "description" : description,
            "regular_price" : regular_price,
            "sale_price" : sale_price,
            "core_fee" : core_fee,
            "start_date" : start_date,
            "end_date" : end_date,
            "weight" : weight,
            "length" : length,
            "width" : width,
            "height" : height,
            "application" : application,
            "photo" : photo,
            "categories" : categories,
            "advanced" : advanced,
            "service_parts" : service_parts,
            "brand" : brand,
            "product_alternative" : product_alternative,
            "is_application_update": is_application_update
        };
        var url = BASE_URL + "admin/publish_products";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Published successufully!");
                jQuery("#p_n_did").val(res.did);
                jQuery(".p_n_remove_btn").removeClass("g_non_dis");
            } else {
            }
        });
    });

    // remove
    jQuery(".p_n_remove_btn").click(function(){
        if ( !confirm("Would you like to delete this product?") ) return;
        var did = jQuery("#p_n_did").val();
        var params = { "did" : did };
        var url = BASE_URL + "admin/delete_one_product_inaddingpage";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Deleted successfully!");
                location.reload();
            } else {
                alert("Failed delete!");
            }
        });
    });
}

/**
 * product add
 * attribute tabs
 * when add new html via js as dynamic
 * */
function product_custom_setting_js_proc()
{
    // remove prodcut spec items
    jQuery(".p_n_c_top_row").children("div").children("button").unbind("click").click(function(){
        if ( !confirm("Would you like to remove this field?") ) return;
        jQuery(this).parent("div").parent(".p_n_c_top_row").remove();
    });

    // remove replacement items
    jQuery(".p_n_r_l_top_row").children("div").children("button").unbind("click").click(function(){
        if ( !confirm("Would you like to remove this field?") ) return;
        jQuery(this).parent("div").parent(".p_n_r_l_top_row").remove();
    });

    // remove service parts items
    jQuery(".p_service_parts_top_row").children("div").children("button").unbind("click").click(function(){
        if ( !confirm("Would you like to remove this field?") ) return;
        jQuery(this).parent("div").parent(".p_service_parts_top_row").remove();
        jQuery(".dropdown-menu").children("li").bind("click");
    });
}

/**
 * product add
 * application setting
 * when add new application html via js as dynamic
 * */
function p_n_application_js_proc()
{
    // remove current application rows
    jQuery(".p_a_app_add_btn").unbind("click").click(function(){
        if ( !confirm("Would you like to remove current application?") ) return;
        jQuery(this).parent("div").parent(".p_a_app_cnt").remove();
    });

    jQuery(".p_n_att_make").unbind("change").change(function(){

        var tag = jQuery(this).parent("div").parent(".p_a_app_cnt");
        tag.find(".p_n_att_type").html('<option value="0" disabled selected>--type--</option>');
        tag.find(".p_n_att_model").html('<option value="0" disabled selected>--model--</option>');
        tag.find(".p_n_att_year").html('<option value="0" disabled selected>--year--</option>');
        tag.find(".p_n_att_engine").html('<option value="0" disabled selected>--engine--</option>');

        var make = jQuery(this).val();
        var params = { "make" : make };
        var url = BASE_URL + "admin/get_product_attribute_types";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<option value="' + list[i]["id"] + '">' + list[i]["title"] + '</option>';
                }
                tag.find(".p_n_att_type").append(html);
                p_n_application_js_proc();
            } else {

            }
        });
    });

    jQuery(".p_n_att_type").unbind("change").change(function(){

        var tag = jQuery(this).parent("div").parent(".p_a_app_cnt");
        tag.find(".p_n_att_model").html('<option value="0" disabled selected>--model--</option>');
        tag.find(".p_n_att_year").html('<option value="0" disabled selected>--year--</option>');
        tag.find(".p_n_att_engine").html('<option value="0" disabled selected>--engine--</option>');

        var type = jQuery(this).val();
        var params = { "type" : type };
        var url = BASE_URL + "admin/get_product_attribute_models";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<option value="' + list[i]["id"] + '">' + list[i]["title"] + '</option>';
                }
                tag.find(".p_n_att_model").append(html);
                p_n_application_js_proc();
            } else {

            }
        });
    });

    jQuery(".p_n_att_model").unbind("change").change(function(){

        var tag = jQuery(this).parent("div").parent(".p_a_app_cnt");
        tag.find(".p_n_att_year").html('<option value="0" disabled selected>--year--</option>');
        tag.find(".p_n_att_engine").html('<option value="0" disabled selected>--engine--</option>');

        var model = jQuery(this).val();
        var params = { "model" : model };
        var url = BASE_URL + "admin/get_product_attribute_years";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<option value="' + list[i]["id"] + '">' + list[i]["title"] + '</option>';
                }
                jQuery(".p_n_att_year").append(html);
                p_n_application_js_proc();
            } else {

            }
        });
    });

    jQuery(".p_n_att_year").unbind("change").change(function(){

        var tag = jQuery(this).parent("div").parent(".p_a_app_cnt");
        tag.find(".p_n_att_engine").html('<option value="0" disabled selected>--engine--</option>');

        var year = jQuery(this).val();
        var params = { "year" : year };
        var url = BASE_URL + "admin/get_product_attribute_engines";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<option value="' + list[i]["id"] + '">' + list[i]["title"] + '</option>';
                }
                jQuery(".p_n_att_engine").append(html);
                p_n_application_js_proc();
            } else {

            }
        });
    });

    // remove added application item row
    jQuery(".pa_app_row_remove").unbind("click").click(function(){
       if ( !confirm("Do you really want to remove this application?") ) return;
       jQuery(this).parent("div").parent(".pa_app_edit_row").remove();
    });
    // remove added application item row via edit
    jQuery(".pa_app_row_edit_remove").unbind("click").click(function(){
        if ( !confirm("Do you really want to remove this application?") ) return;
        jQuery(this).parent("div").parent(".pa_app_temp_edit_row").prev(".pa_app_edit_row").remove();
        jQuery(this).parent("div").parent(".pa_app_temp_edit_row").remove();
    });

    jQuery(".pa_app_row_edit").unbind("click").click(function(){
        var tag = jQuery(this).parent("div").parent(".pa_app_edit_row");
        var make_id = tag.find(".pa_app_edit_make").attr("make_id");
        var type_id = tag.find(".pa_app_edit_type").attr("type_id");
        var model_id = tag.find(".pa_app_edit_model").attr("model_id");
        var year_id = tag.find(".pa_app_edit_year").attr("year_id");
        var engine_id = tag.find(".pa_app_edit_engine").attr("engine_id");


        var params = {
                "make" : make_id,
                "type" : type_id,
                "model" : model_id,
                "year" : year_id
            };
        var url = BASE_URL + "admin/get_product_application_list_for_edit";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var html = "";
                var list = res.json;
                var makes = list["make_list"];
                var types = list["type_list"];
                var models = list["model_list"];
                var years = list["year_list"];
                var engines = list["engine_list"];
                html += '<div class="row p_a_app_cnt pa_app_temp_edit_row">' +
                            '<div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">' +
                                '<select class="g_ipt p_n_att_make">' +
                                    '<option value="0" disabled selected>--make--</option>';
                    if ( makes != null ) for ( ii = 0; ii < makes.length; ii ++ )
                    {
                        var sel = "";
                        if ( make_id == makes[ii]["id"]) sel = "selected";
                        html += '<option value="' + makes[ii]["id"] + '" ' + sel + '>' + makes[ii]["title"] + '</option>';
                    }
                    html +=     '</select>' +
                            '</div>' +
                            '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">' +
                                '<select class="g_ipt p_n_att_type">' +
                                    '<option value="0" disabled selected>--type--</option>';
                    if ( types != null ) for ( ii = 0; ii < types.length; ii ++ )
                    {
                        var sel = ""; if ( type_id == types[ii]["id"] ) sel = "selected";
                        html += '<option value="' + types[ii]["id"] + '" ' + sel + '>' + types[ii]["title"] + '</option>';
                    }

                    html +=     '</select>' +
                            '</div>' +
                            '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">' +
                                '<select class="g_ipt p_n_att_model">' +
                                    '<option value="0" disabled selected>--model--</option>';
                    if ( models != null ) for ( ii = 0; ii < models.length; ii ++ )
                    {
                        var sel = ""; if ( model_id == models[ii]["id"] ) sel = "selected";
                        html += '<option value="' + models[ii]["id"] + '" ' + sel + '>' + models[ii]["title"] + '</option>';
                    }
                    html +=     '</select>' +
                            '</div>' +
                            '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">' +
                                '<select class="g_ipt p_n_att_year">' +
                                    '<option value="0" disabled selected>--year--</option>';
                    if ( years != null ) for ( ii = 0; ii < years.length; ii ++ )
                    {
                        var sel = ""; if ( year_id == years[ii]["id"] ) sel = "selected";
                        html += '<option value="' + years[ii]["id"] + '" ' + sel + '>' + years[ii]["title"] + '</option>';
                    }
                    html +=     '</select>' +
                            '</div>' +
                            '<div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">' +
                                '<select class="g_ipt p_n_att_engine">' +
                                    '<option value="0" disabled selected>--engine--</option>';
                    if ( engines != null ) for ( ii = 0; ii < engines.length; ii ++ )
                    {
                        var sel = ""; if ( engine_id == engines[ii]["id"] ) sel = "selected";
                        html += '<option value="' + engines[ii]["id"] + '" ' + sel + '>' + engines[ii]["title"] + '</option>';
                    }
                    html +=     '</select>' +
                            '</div>' +
                            '<div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">' +
                                '<div class="btn btn-sm btn-success pa_app_btn pa_app_row_edit_save"><span class="fa fa-save"></span></div>' +
                                '<div class="btn btn-sm btn-danger pa_app_btn pa_app_row_edit_remove"><span class="fa fa-trash-o"></span></div>' +
                            '</div>' +
                        '</div>';
                    jQuery(".pa_app_temp_edit_row").remove();
                    jQuery(".pa_app_edit_row").show();
                    tag.after(html);
                    tag.hide();
                p_n_application_js_proc();
            } else {

            }
        });
    });

    // save edited values
    jQuery(".pa_app_row_edit_save").unbind("click").click(function(){
        var tag = jQuery(this).parent("div").parent(".pa_app_temp_edit_row");
        var tag1 = tag.prev(".pa_app_edit_row");

        var make_id = tag.find(".p_n_att_make").val();
        if ( make_id == "" || make_id == undefined || make_id == null ) return;
        var make_name = tag.find(".p_n_att_make").children("option:selected").text();
        var type_id = tag.find(".p_n_att_type").val();
        var type_name = tag.find(".p_n_att_type").children("option:selected").text();
        var model_id = tag.find(".p_n_att_model").val();
        var model_name = tag.find(".p_n_att_model").children("option:selected").text();
        var year_id = tag.find(".p_n_att_year").val();
        var year_name = tag.find(".p_n_att_year").children("option:selected").text();
        var engine_id = tag.find(".p_n_att_engine").val();
        var engine_name = tag.find(".p_n_att_engine").children("option:selected").text();

        tag1.find(".pa_app_edit_make").attr("make_id", make_id).html(make_name);
        tag1.find(".pa_app_edit_type").attr("type_id", type_id).html(type_name);
        tag1.find(".pa_app_edit_model").attr("model_id", model_id).html(model_name);
        tag1.find(".pa_app_edit_year").attr("year_id", year_id).html(year_name);
        tag1.find(".pa_app_edit_engine").attr("engine_id", engine_id).html(engine_name);

        tag1.show();
        tag.remove();
    });
}