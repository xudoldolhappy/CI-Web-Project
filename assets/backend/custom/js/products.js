jQuery(function(){
    /** produc list proc func */
    product_list_proc_func();
    /** produc categories proc func */
    product_categories_proc_func();
    /** produc attributes proc func */
    product_attributes_proc_func();
    /** product specs and repalcement brand proc func */
    product_specs_replacement_brands_proc_func();
});


/**
 * produc list proc func
 * */
function product_list_proc_func()
{
    // change product`s quanity
    jQuery(".b_p_a_quanity_btn").click(function(){
        var did = jQuery(this).attr("did");
        var quanity = jQuery(this).prev(".b_p_a_quanity").val();
        var tag = jQuery(this).parent("td").parent("tr");

        if ( g_v_t(quanity) ) { alert("Input Product Quanity!"); jQuery(this).prev(".b_p_a_quanity").focus(); return; }
        if ( g_v_n(quanity) ) { alert("Product Quanity must number"); jQuery(this).prev(".b_p_a_quanity").val("0").focus(); return; }
        if ( parseInt(quanity) < 0 ) { alert("Invalid Product Quanity!"); jQuery(this).prev(".b_p_a_quanity").val("0").focus(); return; }

        var params = {
            "id" : did,
            "quanity" : quanity
        };
        var url = BASE_URL + "admin/chnage_one_product_quanity";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Changed product`s quanity successfully!");
                if ( tag.hasClass("g_alert_tr") ) tag.removeClass("g_alert_tr");
            } else {
                alert("Failed to change quality!");
            }
        });
    });

    // change product`s slae price
    jQuery(".b_p_a_sale_price_btn").click(function(){
        var did = jQuery(this).attr("did");
        var sale_price = jQuery(this).prev(".b_p_a_sale_price").val();

        if ( g_v_t(sale_price) ) { alert("Input Product Quanity!"); jQuery(this).prev(".b_p_a_sale_price").focus(); return; }
        if ( g_v_n(sale_price) ) { alert("Product Quanity must number"); jQuery(this).prev(".b_p_a_sale_price").val("0").focus(); return; }

        var params = {
            "id" : did,
            "sale_price" : sale_price
        };
        var url = BASE_URL + "admin/chnage_one_product_sale_price";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Changed product`s sale price successfully!");
            } else {
                alert("Failed to change slae price!");
            }
        });
    });

    /******************  search and page move ***********************/
    // search name event
    jQuery("#b_p_a_forward_search_key_ipt").keypress(function(e){
        if ( e.which == 13 ) {
            jQuery("#b_p_a_forward_search_key_btn").trigger("click");
        }
    });
    jQuery("#b_p_a_forward_search_key_btn").click(function(){
        jQuery("#b_p_a_forward__pagenum").val("1");
        display_products_bysearch();
    });

    // page number
    jQuery(".b_p_a_forward_able_page").click(function(){
        jQuery("#b_p_a_forward__pagenum").val(jQuery(this).attr("pagenum"));
        display_products_bysearch();
    });

    /**
     * display products by categories, name, page
     * */
    function display_products_bysearch()
    {
        var search_key = jQuery("#b_p_a_forward_search_key_ipt").val();
        var pagenum = jQuery("#b_p_a_forward__pagenum").val();

        location.href = BASE_URL + "admin/products_all?" +
            "pagenum=" + pagenum +
            "&search_key=" + search_key;
    }
}

/**
 * produc categories proc func
 * */
function product_categories_proc_func()
{
    // opend uplaod broswer
    jQuery("#p_c_img").click(function(){
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
                jQuery("#p_c_a_photo").val(response.responseJSON.success);
                jQuery("#p_c_img").attr("src",BASE_URL + "uploads/pcategories/"+response.responseJSON.success);
            }else{
                alert('Image Upload Error.');
            }
        }
    };

    // delete one tree node
    jQuery(".p_c_node_del").click(function(){
       if ( !confirm("Would you like to delete this ncategory?") ) return;
       var did = jQuery(this).parent(".my_tree_cnt").attr("did");
        var params = {
            "id" : did
        };
        var url = BASE_URL + "admin/delete_one_product_category";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Deleted category successfully!");
                location.reload();
            } else {
                alert("Failed category deleting!");
            }
        });
    });

    // add new product category
    jQuery("#p_c_a_btn").click(function(){
        var title = jQuery("#p_c_a_title").val();
        var parent_id = jQuery(".my_tree_cnt_clicked").attr("did");
        var level = parseInt( jQuery(".my_tree_cnt_clicked").prev(".my_tree_icon").attr("level") ) + 1;
        var slug = jQuery("#p_c_a_slug").val();
        var description = jQuery("#p_c_a_description").val();
        var photo = jQuery("#p_c_a_photo").val();

        if ( g_v_t(title) ) { alert("Input category title!"); jQuery("#p_c_a_title").focus(); return; }
        if ( g_v_t(parent_id) ) { alert("Select parent category!"); return; }

        var params = {
            "title" : title,
            "parent_id" : parent_id,
            "level" : level,
            "slug" : slug,
            "description" : description,
            "photo" : photo
        };
        var url = BASE_URL + "admin/add_new_product_category";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                alert("Added category successfully!");
                location.reload();
            } else {
                alert("Failed category adding!");
            }
        });
    });
}

/**
 * produc attributes proc func
 * */
function product_attributes_proc_func()
{
    produc_attribute_js_all_proc_func();

    // add new make attribute
    jQuery("#p_a_make_btn").click(function(){
        var title = jQuery("#p_a_make_ipt").val();
        if ( g_v_t(title) ) { alert("Input make title!"); jQuery("#p_a_make_ipt").focus(); return; }
        var params = { "title" : title };
        var url = BASE_URL + "admin/add_new_product_attribute_make";
        $.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_make" did="' + list[i]["id"] + '">' +
                            '<button class="btn btn-xs btn-default p_a_make_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                            '<button class="btn btn-xs btn-default p_a_make_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                            list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_makes").html(html);
                jQuery("#p_a_make_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                alert("Failed category adding!");
            }
        });

    });

    // add new type attribute
    jQuery("#p_a_type_btn").click(function() {
        var make = jQuery(".p_a_n_make_clicked").attr("did");
        var title = jQuery("#p_a_type_ipt").val();
        if (g_v_t(make)) { alert("Please select make!"); return; }
        if (g_v_t(title)) { alert("Input make title!"); jQuery("#p_a_type_ipt").focus(); }
        var params = {"title": title, "make": make};
        var url = BASE_URL + "admin/add_new_product_attribute_type";
        jQuery.post(url, params, function (res) {
            if (res.status == "1") {
                var list = res.list;
                var html = '';
                for (i = 0; i < list.length; i++) {
                    html += '<div class="p_a_node  p_a_n_type" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_type_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_type_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_types").html(html);
                jQuery("#p_a_type_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                alert("Failed category adding!");
            }
        });
    });

    // add new model attribute
    jQuery("#p_a_model_btn").click(function(){
        var type = jQuery(".p_a_n_type_clicked").attr("did");
        var title = jQuery("#p_a_model_ipt").val();
        if ( g_v_t(type) ) { alert("Please select make!"); return; }
        if ( g_v_t(title) ) { alert("Input model title!"); jQuery("#p_a_model_ipt").focus(); return; }
        var params = { "title" : title, "type": type };
        var url = BASE_URL + "admin/add_new_product_attribute_model";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_model" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_model_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_model_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_models").html(html);
                jQuery("#p_a_model_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                alert("Failed category adding!");
            }
        });
    });

    // add new year attribute
    jQuery("#p_a_year_btn").click(function(){
        var model = jQuery(".p_a_n_model_clicked").attr("did");
        var title = jQuery("#p_a_year_ipt").val();
        if ( g_v_t(model) ) { alert("Please select model!"); return; }
        if ( g_v_t(title) ) { alert("Input year title!"); jQuery("#p_a_year_ipt").focus(); return; }
        var params = { "title" : title, "model": model };
        var url = BASE_URL + "admin/add_new_product_attribute_year";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_year" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_year_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_year_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_years").html(html);
                jQuery("#p_a_year_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                alert("Failed category adding!");
            }
        });
    });

    // add new engine attribute
    jQuery("#p_a_engine_btn").click(function(){
        var year = jQuery(".p_a_n_year_clicked").attr("did");
        var title = jQuery("#p_a_engine_ipt").val();
        if ( g_v_t(year) ) { alert("Please select year!"); return; }
        if ( g_v_t(title) ) { alert("Input engine title!"); jQuery("#p_a_engine_ipt").focus(); return; }
        var params = { "title" : title, "year": year };
        var url = BASE_URL + "admin/add_new_product_attribute_engine";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_engine" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_engine_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_engine_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_engines").html(html);
                jQuery("#p_a_engine_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                alert("Failed category adding!");
            }
        });
    });

    /*
    // add new option attribute
    jQuery("#p_a_option_btn").click(function(){
        var engine = jQuery(".p_a_n_engine_clicked").attr("did");
        var title = jQuery("#p_a_option_ipt").val();
        if ( g_v_t(engine) ) { alert("Please select engine!"); return; }
        if ( g_v_t(title) ) { alert("Input option title!"); jQuery("#p_a_option_ipt").focus(); return; }
        var params = { "title" : title, "engine": engine };
        var url = BASE_URL + "admin/add_new_product_attribute_option";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_option" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_option_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_option_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_options").html(html);
                jQuery("#p_a_option_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                alert("Failed category adding!");
            }
        });
    });
    */
}

/**
 * all proc in product attribute via generating javascript
 * */
function produc_attribute_js_all_proc_func()
{
    /**
     * make
     * */
    jQuery(".p_a_n_make").unbind("click").click(function(){
        jQuery(".p_a_n_make").removeClass("p_a_n_make_clicked");
        jQuery(this).addClass("p_a_n_make_clicked");
        jQuery("#p_a_type_ipt").removeAttr("disabled");

        // display related types
        var make = jQuery(this).attr("did");
        var params = { "make" : make };
        var url = BASE_URL + "admin/get_product_attribute_types";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_type" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_type_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_type_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_types").html(html);
                jQuery("#p_a_type_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                jQuery("#p_a_types").html("");
            }
        });

        jQuery("#p_a_models").html("");
        jQuery("#p_a_years").html("");
        jQuery("#p_a_engines").html("");

    });
    jQuery(".p_a_make_del").unbind("click").click(function(){
        if ( !confirm("Would you like to delete this attribute?") ) return;
        var tag = jQuery(this).parent("div");
        var did = jQuery(this).parent("div").attr("did");
        var params = { "id" : did, "kind": 1 };
        var url = BASE_URL + "admin/delete_product_attribute_via_id";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    /**
     * type
     * */
    jQuery(".p_a_n_type").unbind("click").click(function(){
        jQuery(".p_a_n_type").removeClass("p_a_n_type_clicked");
        jQuery(this).addClass("p_a_n_type_clicked");
        jQuery("#p_a_model_ipt").removeAttr("disabled");

        // display related types
        var type = jQuery(this).attr("did");
        var params = { "type" : type };
        var url = BASE_URL + "admin/get_product_attribute_models";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_model" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_model_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_model_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_models").html(html);
                jQuery("#p_a_model_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                jQuery("#p_a_models").html("");
            }
        });

        jQuery("#p_a_years").html("");
        jQuery("#p_a_engines").html("");
        jQuery("#p_a_options").html("");

    });
    jQuery(".p_a_type_del").unbind("click").unbind("click").click(function(){
        if ( !confirm("Would you like to delete this attribute?") ) return;
        var tag = jQuery(this).parent("div");
        var did = jQuery(this).parent("div").attr("did");
        var params = { "id" : did, "kind":2 };
        var url = BASE_URL + "admin/delete_product_attribute_via_id";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    /**
     * model
     * */
    jQuery(".p_a_n_model").unbind("click").click(function(){
        jQuery(".p_a_n_model").removeClass("p_a_n_model_clicked");
        jQuery(this).addClass("p_a_n_model_clicked");
        jQuery("#p_a_year_ipt").removeAttr("disabled");

        // display related years
        var model = jQuery(this).attr("did");
        var params = { "model" : model };
        var url = BASE_URL + "admin/get_product_attribute_years";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_year" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_year_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_year_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_years").html(html);
                jQuery("#p_a_year_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                jQuery("#p_a_years").html("");
            }
        });

        jQuery("#p_a_engines").html("");
        jQuery("#p_a_options").html("");

    });
    jQuery(".p_a_model_del").unbind("click").click(function(){
        if ( !confirm("Would you like to delete this attribute?") ) return;
        var tag = jQuery(this).parent("div");
        var did = jQuery(this).parent("div").attr("did");
        var params = { "id" : did, "kind":3 };
        var url = BASE_URL + "admin/delete_product_attribute_via_id";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    /**
     * year
     * */
    jQuery(".p_a_n_year").unbind("click").click(function(){
        jQuery(".p_a_n_year").removeClass("p_a_n_year_clicked");
        jQuery(this).addClass("p_a_n_year_clicked");
        jQuery("#p_a_engine_ipt").removeAttr("disabled");

        // display related years
        var year = jQuery(this).attr("did");
        var params = { "year" : year };
        var url = BASE_URL + "admin/get_product_attribute_engines";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_engine" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_engine_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_engine_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_engines").html(html);
                jQuery("#p_a_engine_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                jQuery("#p_a_engines").html("");
            }
        });

        jQuery("#p_a_options").html("");

    });
    jQuery(".p_a_year_del").unbind("click").click(function(){
        if ( !confirm("Would you like to delete this attribute?") ) return;
        var tag = jQuery(this).parent("div");
        var did = jQuery(this).parent("div").attr("did");
        var params = { "id" : did, "kind":4 };
        var url = BASE_URL + "admin/delete_product_attribute_via_id";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    /**
     * engine
     * */
    jQuery(".p_a_n_engine").unbind("click").click(function(){
        jQuery(".p_a_n_engine").removeClass("p_a_n_engine_clicked");
        jQuery(this).addClass("p_a_n_engine_clicked");
        jQuery("#p_a_option_ipt").removeAttr("disabled");

        // display related years
        var engine = jQuery(this).attr("did");
        var params = { "engine" : engine };
        var url = BASE_URL + "admin/get_product_attribute_options";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                var list = res.list;
                var html = '';
                for ( i = 0; i < list.length; i ++ ) {
                    html += '<div class="p_a_node  p_a_n_option" did="' + list[i]["id"] + '">' +
                        '<button class="btn btn-xs btn-default p_a_option_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>' +
                        '<button class="btn btn-xs btn-default p_a_option_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;' +
                        list[i]["title"] +
                        '</div>';
                }
                jQuery("#p_a_options").html(html);
                jQuery("#p_a_option_ipt").val("");
                produc_attribute_js_all_proc_func();
            } else {
                jQuery("#p_a_options").html("");
            }
        });

    });
    jQuery(".p_a_engine_del").unbind("click").click(function(){
        if ( !confirm("Would you like to delete this attribute?") ) return;
        var tag = jQuery(this).parent("div");
        var did = jQuery(this).parent("div").attr("did");
        var params = { "id" : did, "kind":5 };
        var url = BASE_URL + "admin/delete_product_attribute_via_id";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    /**
     * option
     * */
    /*
    jQuery(".p_a_n_option").click(function(){
        jQuery(".p_a_n_option").removeClass("p_a_n_option_clicked");
        jQuery(this).addClass("p_a_n_option_clicked");
    });
    jQuery(".p_a_option_del").click(function(){
        if ( !confirm("Would you like to delete this attribute?") ) return;
        var tag = jQuery(this).parent("div");
        var did = jQuery(this).parent("div").attr("did");
        var params = { "id" : did, "kind":6 };
        var url = BASE_URL + "admin/delete_product_attribute_via_id";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });
    */
}

/** product specs and repalcement brand proc func */
function product_specs_replacement_brands_proc_func()
{
    // add new product spec items
    jQuery("#p_s_b_spec_btn").unbind("click").click(function(){
        var title = jQuery("#p_s_b_spec_ipt").val();
        if ( g_v_t (title) ) {
            jQuery("#p_s_b_spec_ipt").focus();
            return;
        }
        var params = { "title" : title };
        var url = BASE_URL + "admin/add_new_product_spec";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });
    // delete current product spec item
    jQuery(".p_s_b_spec_del").unbind("click").click(function(){
        if ( !confirm( " Would you like to delete this item?") ) return;
        var did  = jQuery(this).parent(".p_a_node").attr("did");
        var params = { "did" : did };
        var url = BASE_URL + "admin/delete_current_product_spec";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    // add new replacement brand items
    jQuery("#p_s_b_brand_btn").unbind("click").click(function(){
        var title = jQuery("#p_s_b_brand_ipt").val();
        if ( g_v_t (title) ) {
            jQuery("#p_s_b_brand_ipt").focus();
            return;
        }
        var params = { "title" : title };
        var url = BASE_URL + "admin/add_new_replacement_brand";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });
    // delete current replacement brand items
    jQuery(".p_s_b_brand_del").unbind("click").click(function(){
        if ( !confirm( " Would you like to delete this item?") ) return;
        var did  = jQuery(this).parent(".p_a_node").attr("did");
        var params = { "did" : did };
        var url = BASE_URL + "admin/delete_current_replacement_brand";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });

    // add new replacement brand items
    jQuery("#p_s_b_service_part_btn").unbind("click").click(function(){
        var title = jQuery("#p_s_b_service_part_ipt").val();
        if ( g_v_t (title) ) {
            jQuery("#p_s_b_service_part_ipt").focus();
            return;
        }
        var params = { "title" : title };
        var url = BASE_URL + "admin/add_new_replacement_service_part";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });
    // delete current replacement brand items
    jQuery(".p_s_b_service_part_del").unbind("click").click(function(){
        if ( !confirm( " Would you like to delete this item?") ) return;
        var did  = jQuery(this).parent(".p_a_node").attr("did");
        var params = { "did" : did };
        var url = BASE_URL + "admin/delete_current_service_part";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
            } else {
            }
        });
    });
}