jQuery(function(){
   /**
    * event proc
    * */
   mytree_event_proc();
});

/**
 * event proc
 * */
function mytree_event_proc()
{
    jQuery(".my_tree_cnt").click(function(){
        if ( jQuery(this).is(".my_tree_check") ) return; // case in checkbox
        jQuery(".my_tree_cnt").removeClass("my_tree_cnt_clicked");
        jQuery(this).addClass("my_tree_cnt_clicked");
    });

    jQuery(".my_tree_icon").click(function(){
        var did = jQuery(this).next(".my_tree_cnt").attr("did");
        if ( !jQuery(".my_tree_id_" + did).is(".my_tree_node") ) return; // if this node has not own child node, then return
        var level = jQuery(this).attr("level");
        var pdid = jQuery(this).parent().next().children(":last-child").attr("did");
        var temp = false;
        if ( jQuery(this).is(".mytree_open") ) {
            jQuery(this).removeClass("mytree_open");

            /*
            jQuery(".my_tree_id_" + did).hide();

            var pp = jQuery(".my_tree_id_" + did).children(":last-child").attr("did");
            jQuery(".my_tree_id_" + pp).hide();
            jQuery(".my_tree_id_" + pp).removeClass("mytree_open");

            var pp = jQuery(".my_tree_id_" + pp).children(":last-child").attr("did");
            jQuery(".my_tree_id_" + pp).hide();
            jQuery(".my_tree_id_" + pp).removeClass("mytree_open");

            var pp = jQuery(".my_tree_id_" + pp).children(":last-child").attr("did");
            jQuery(".my_tree_id_" + pp).hide();
            jQuery(".my_tree_id_" + pp).removeClass("mytree_open");

            var pp = jQuery(".my_tree_id_" + pp).children(":last-child").attr("did");
            jQuery(".my_tree_id_" + pp).hide();
            jQuery(".my_tree_id_" + pp).removeClass("mytree_open");
            */

            var is_start = false;
            jQuery(".my_tree_node").each(function(){
                if ( is_start ) {
                    var slevel = jQuery(this).children(":first-child").attr("level");
                    if ( level == slevel ) {
                        is_start = false;
                        return;
                    }

                    jQuery(this).hide();
                    jQuery(this).children(":first-child").removeClass("mytree_open");

                }

                if ( did == jQuery(this).children(":last-child").attr("did") ) {
                    is_start = true;
                }
            });
        } else {
            jQuery(".my_tree_id_" + did).show();
            jQuery(this).addClass("mytree_open")
        }
    });
}