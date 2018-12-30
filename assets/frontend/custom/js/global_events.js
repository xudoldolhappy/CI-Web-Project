jQuery(function(){
    /**
     * global proc function
     * */
    front_global_proc_func();
});


/**
 * global proc function
 * */
function front_global_proc_func()
{
    // display provinces when clikc every countries
    jQuery("#ep_countires").change(function(){
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
                    jQuery("#ep_provinces").html(html);
                    ep_select_province_proc();
                } else {
                    // alert("db error!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("generated database error!");
            }
        });

    });

    // socail link position
    var left = jQuery( window).width() - 100;
    jQuery(".f_social_link").css("left", left);
    jQuery ( window ).resize(function(){
        var left = jQuery( window).width() - 100;
        jQuery(".f_social_link").css("left", left);
    });

}