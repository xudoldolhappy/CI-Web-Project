jQuery(function(){
    /** global event */
    backend_global_event();
});

/**
 *  global event
 * */
function backend_global_event()
{
    // display provinces when clikc every countries
    jQuery(".g_country").change(function(){
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
                    var html = '<option value="0" selected="" disabled="">State</option>';
                    var list = data.list;
                    for ( i = 0; i < list.length; i ++ ) {
                        html += '<option value="' + list[i]["code"] + '">' + list[i]["name"] + '</option>';
                    }
                    jQuery(".g_state").html(html);
                } else {
                    alert("db error!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("generated database error!");
            }
        });

    });
}