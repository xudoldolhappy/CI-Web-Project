jQuery(function(){
   /*** cart page all proc function ***/
   cart_page_all_proc_func();
});


/**
 * cart page all proc function
 * */
function cart_page_all_proc_func()
{
    // count down
    jQuery(".f_cart_count_down").click(function(){
        var count = parseInt(jQuery(this).parent("div").children(".f_cart_total_count").html());
        if ( count == 1 ) return;
        var did = jQuery(this).parent("div").attr("did");
        // var price = parseFloat(jQuery(this).parent("div").prev("div").children(".f_cart_product_price").html());
        // var tag = jQuery(this).parent("div");
        count -= 1;

        var params = { "did" : did, "count": count };
        var url = BASE_URL + "front/update_cart_product_count";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
                // tag.next("div").children(".f_cart_total_price").html( (price * parseFloat(count)).toFixed(2) );
                // tag.children(".f_cart_total_count").html(count);
            } else {

            }
        });
    });

    // count up
    jQuery(".f_cart_count_up").click(function(){
        var quanity = parseInt(jQuery(this).attr("quanity"));
        var count = parseInt(jQuery(this).parent("div").children(".f_cart_total_count").html());
        if ( quanity == count ) return;

        var did = jQuery(this).parent("div").attr("did");
        // var price = parseFloat(jQuery(this).parent("div").prev("div").children(".f_cart_product_price").html());
        // var tag = jQuery(this).parent("div");
        count += 1;

        var params = { "did" : did, "count": count };
        var url = BASE_URL + "front/update_cart_product_count";
        jQuery.post(url, params, function(res) {
            if(res.status == "1" ) {
                location.reload();
                // tag.next("div").children(".f_cart_total_price").html( (price * parseFloat(count)).toFixed(2) );
                // tag.children(".f_cart_total_count").html(count);
            } else {

            }
        });
    });

    // remove product
    jQuery(".f_cart_remove").click(function(){
        if ( !confirm("Would you like to remove this product from cart?") ) return;
        var did = jQuery(this).parent("div").prev("div").attr("did");
        location.href = BASE_URL + "front/remove_product_incart_byid?did=" + did;
    });

}