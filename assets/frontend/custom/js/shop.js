jQuery(function(){
    /**** main shop page proc function ****/
    main_shop_proc_func();
    /**** all shop  proc function ****/
    all_shop_proc_func();
    /**** shop bycategories page proc function ****/
    shop_bycategories_proc_func();
    /**** shop byadvaced page proc function ****/
    shop_byadvaced_proc_func();
});

/**
 * main shop proc func
 * */
function main_shop_proc_func()
{
    // search name event
    jQuery(".f_m_search_ipt").keypress(function(e){
       if ( e.which == 13 ) {
           jQuery(".f_m_search_btn").trigger("click");
       }
    });
    jQuery(".f_m_search_btn").click(function(){
        jQuery("#f_m_pagenum").val("1");
        display_products();
    });

    // page number
    jQuery(".f_m_p").click(function(){
        jQuery("#f_m_pagenum").val(jQuery(this).attr("pagenum"));
        display_products();
    });

    /**
     * display products by name, page
     * */
    function display_products()
    {
        var name = jQuery(".f_m_search_ipt").val();
        var pagenum = jQuery("#f_m_pagenum").val();
        location.href = BASE_URL + "front/main?pagenum=" + pagenum + "&name=" + name;
    }

    /************* go to product page ************/
    jQuery(".f_m_items_photo, .f_m_items_name").click(function(){
       var did = jQuery(this).parent(".f_m_items").attr("did");
       location.href = BASE_URL + "front/product?did=" + did;
    });

    /** add product to cart and go to cart page **/
    jQuery(".f_m_items_cart").children("button").click(function(){
        if ( jQuery(this).attr("quanity") == "0" ) return;
        var cartid = jQuery("#g_cartid").val();
        var product = jQuery(this).parent(".f_m_items_cart").parent(".f_m_items").attr("did");
        location.href = BASE_URL + "front/add_product_tocart?product=" +
            product + "&cartid=" + cartid + "&count=1";
    });

    // image popup
    jQuery(".f_m_items_photo").click(function(){
       var src = jQuery(this).children("img").attr("src");
       jQuery(".f_product_preview_img").attr("src", src);
       // jQuery("#f_product_img_preview_btn").trigger("click");
    });

    // image layout setting
    jQuery(".f_m_items_photo").each(function(e){
        var tdv_height = jQuery(this).height();
        var img_height = jQuery(this).children("img").height();
        var mtop = ( tdv_height - img_height ) / 2;
        if ( mtop < 0 ) mtop = 0;
        // jQuery(this).children("img").css("margin-top", mtop);
    });
}

/****
 * all shop  proc function
 * ****/
function all_shop_proc_func()
{
    // search name event
    jQuery(".f_shop_s_ipt").keypress(function(e){
        if ( e.which == 13 ) {
            jQuery(".f_shop_s_btn").trigger("click");
        }
    });
    jQuery(".f_shop_s_btn").click(function(){
        jQuery("#f_m_pagenum").val("1");
        shop_display_products();
    });

    // page number
    jQuery(".f_shop_m_p").click(function(){
        jQuery("#f_m_pagenum").val(jQuery(this).attr("pagenum"));
        shop_display_products();
    });

    /**
     * display products by name, page
     * */
    function shop_display_products()
    {
        var name = jQuery(".f_shop_s_ipt").val();
        var pagenum = jQuery("#f_m_pagenum").val();
        if ( pagenum == undefined ) pagenum = 1;
        location.href = BASE_URL + "front/shop?pagenum=" + pagenum + "&name=" + name;
    }

}

/**
 * shop bycategories page proc function
 * */
function shop_bycategories_proc_func()
{
    // search name event
    jQuery("#f_p_c_s_ipt").keypress(function(e){
        if ( e.which == 13 ) {
            jQuery("#f_p_c_s_btn").trigger("click");
        }
    });
    jQuery("#f_p_c_s_btn").click(function(){
        jQuery("#f_s_c_pagenum").val("1");
        display_products_bycategories();
    });

    // page number
    jQuery(".f_s_c").click(function(){
        jQuery("#f_s_c_pagenum").val(jQuery(this).attr("pagenum"));
        display_products_bycategories();
    });

    // categories
    jQuery(".f_s_c_tree_cnt").click(function(){
        jQuery("#f_s_c_pagenum").val("1");                      // init pagenumber
        jQuery("#f_s_category").val(jQuery(this).attr("did"));
        display_products_bycategories();
    });

    /**
     * display products by categories, name, page
     * */
    function display_products_bycategories()
    {
        var name = jQuery("#f_p_c_s_ipt").val();
        var pagenum = jQuery("#f_s_c_pagenum").val();
        var category = jQuery("#f_s_category").val();
        var trees_dis = "";
        var trees_open = "";
        jQuery(".my_tree_node").each(function(e){
            if ( e != 0 ) {
                trees_dis += ",";
                trees_open += ",";
            }
            if ( jQuery(this).is(":visible") ) trees_dis += "1";
            else trees_dis += "0";

            if ( jQuery(this).children(".my_tree_icon").is(".mytree_open") ) trees_open += "1";
            else trees_open += "0";
        });

        location.href = BASE_URL + "front/shop_bycategories?pagenum=" + pagenum +
            "&category=" + category +
            //"&trees_dis=" + trees_dis +
            //"&trees_open=" + trees_open +
            "&name=" + name;
    }
}

/**
 * shop byadvanced page proc function
 * */
function shop_byadvaced_proc_func()
{
    // search name event
    jQuery("#f_p_a_s_ipt").keypress(function(e){
        if ( e.which == 13 ) {
            jQuery("#f_p_a_s_btn").trigger("click");
        }
    });
    jQuery("#f_p_a_s_btn").click(function(){
        jQuery("#f_s_a_pagenum").val("1");
        display_products_byadvaceds();
    });

    // page number
    jQuery(".f_s_a").click(function(){
        jQuery("#f_s_a_pagenum").val(jQuery(this).attr("pagenum"));
        display_products_byadvaceds();
    });

    // filter by advanced parameters
    jQuery("#f_s_a_advanced_parameter_btn").click(function () {
        jQuery("#f_s_a_pagenum").val("1");
        display_products_byadvaceds();
    });


    /**
     * display products by categories, name, page
     * */
    function display_products_byadvaceds()
    {
        var name = jQuery("#f_p_a_s_ipt").val();
        var pagenum = jQuery("#f_s_a_pagenum").val();
        var make = jQuery("#f_s_a_slt_make").val();
        var type = jQuery("#f_s_a_slt_type").val();
        var model = jQuery("#f_s_a_slt_model").val();
        var year = jQuery("#f_s_a_slt_year").val();
        var engine = jQuery("#f_s_a_slt_engine").val();

        location.href = BASE_URL + "front/shop_byadvanced?pagenum=" + pagenum +
            "&name=" + name +
            "&make=" + make +
            "&type=" + type +
            "&model=" + model +
            "&year=" + year +
            "&engine=" + engine;
    }

    jQuery("#f_s_a_slt_make").unbind("change").change(function(){

        jQuery("#f_s_a_slt_type").html('<option value="0" disabled selected>--type--</option>');
        jQuery("#f_s_a_slt_model").html('<option value="0" disabled selected>--model--</option>');
        jQuery("#f_s_a_slt_year").html('<option value="0" disabled selected>--year--</option>');
        jQuery("#f_s_a_slt_engine").html('<option value="0" disabled selected>--engine--</option>');

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
                jQuery("#f_s_a_slt_type").append(html);
            } else {

            }
        });
    });

    jQuery("#f_s_a_slt_type").unbind("change").change(function(){

        jQuery("#f_s_a_slt_model").html('<option value="0" disabled selected>--model--</option>');
        jQuery("#f_s_a_slt_year").html('<option value="0" disabled selected>--year--</option>');
        jQuery("#f_s_a_slt_engine").html('<option value="0" disabled selected>--engine--</option>');

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
                jQuery("#f_s_a_slt_model").append(html);
            } else {

            }
        });
    });

    jQuery("#f_s_a_slt_model").unbind("change").change(function(){

        jQuery("#f_s_a_slt_year").html('<option value="0" disabled selected>--year--</option>');
        jQuery("#f_s_a_slt_engine").html('<option value="0" disabled selected>--engine--</option>');

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
                jQuery("#f_s_a_slt_year").append(html);
            } else {

            }
        });
    });

    jQuery("#f_s_a_slt_year").unbind("change").change(function(){

        jQuery("#f_s_a_slt_engine").html('<option value="0" disabled selected>--engine--</option>');

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
                jQuery("#f_s_a_slt_engine").append(html);
            } else {

            }
        });
    });
}