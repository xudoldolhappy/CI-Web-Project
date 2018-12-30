<?php
include "template/header.php";
?>
<div class="banner">
</div>
<div class="container_row">
    <div class="f_m_search_div row">
        <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_m_tlt">shop by categories</div>
        <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 g_txt_right">
            <input type="text" class="f_m_search_ipt" id="f_p_c_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
            <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" id="f_p_c_s_btn" class="f_m_search_btn" />
            <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
        </div>
    </div>
    <div class="f_m_alert_div">&nbsp;</div>
    <div class="row f_m_cnt_div">
        <div class="col-xs-4 col-md-4 col-lg-4 col-sm-4 f_s_c_tree_div">
            <?php
            if ( isset( $categories ) ) {
                $diss = array();
                $opens = array();
                if ( isset($trees_dis) ) $diss = explode(",", $trees_dis);
                if ( isset($trees_open) ) $opens = explode(",", $trees_open);
                for ( $i = 0; $i < count($categories); $i ++ ) {
                    $dis = "";
                    $open = "";
                    if ( isset($trees_dis) ) {
                        $dis = "display: block";
                        if ($diss[$i] == "0") $dis = "display: none";
                    }
                    if ( isset($trees_open) )
                    {
                        $open = "mytree_open";  if ( $opens[$i] == "0" ) $open = "";
                    }
                    if ( $i == 0 ) $open = "mytree_open";
                    $clicked = ""; if ( isset($category)) if ( $categories[$i]["id"] == $category ) $clicked = "my_tree_cnt_clicked";

                    if ( $i == 0 ) $edit = '';
                    echo '<div class="my_tree_node my_tree_'.$categories[$i]["level"].' my_tree_id_'.$categories[$i]["parent_id"].'" style="'.$dis.'">
                            <div class="my_tree_icon '.$open.'" level="'.$categories[$i]["level"].'"></div>
                            <div class="my_tree_cnt f_s_c_tree_cnt '.$clicked.'" did="'.$categories[$i]["id"].'">'.$categories[$i]["title"].'</div>
                      </div>';
                }
            }
            ?>
        </div>
        <div class="col-xs-8 col-md-8 col-lg-8 col-sm-8">
            <?php
            if ( isset ($list) ) {
            for ( $i = 0; $i < count($list); $i ++ ) {
                $favorite_img = "";
                $photo = $list[$i]["photo"];
                if ( !isset($photo) || $photo == "" || $photo == null ) $photo = "product_no_photo.png";
                /*if ( $list[$i]["favorite"] == "1" )
                    $favorite_img = '<img class="f_m_favorite_img" src="'.base_url().'assets/frontend/lib/img/icons/favorite.png" />';*/
                echo '<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
                    <div class="f_m_items" did="'.$list[$i]["id"].'">
                        <div class="f_m_items_photo">
                            <img src="'.base_url().'uploads/pcategories/'.$photo.'" />
                            '.$favorite_img.'</div>
                            <!--<div class="f_product_quanity_mark">'.$list[$i]["quanity"].'</div>-->
                        <div class="f_m_items_name">'.substr($list[$i]["name"], 0, 60).'</div>
                        <div class="f_m_items_price">$'.number_format(floatval($list[$i]["sale_price"]), 2).'</div>
                        <div class="f_m_items_cart"><button class="g_btn_gr" quanity="'.$list[$i]["quanity"].'">Add to cart</button></div>
                    </div>
                </div>';
            } ?>
            <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 g_txt_right">
                <span class="f_m_total_cnt">Total product count&nbsp;:&nbsp;<?= $cnt;?> </span>
                <?php
                $first = 1;
                $last = intval($cnt / $limit);
                if ( $last * $limit < $cnt ) $last ++;

                $prev = intval($pagenum) - 1;
                if ( $prev == 0 ) $prev = 1;
                $next = intval($pagenum) + 1;
                if ( $next > $last ) $next --;

                $first_page = "c_m_pagination f_s_c";
                $prev_page = "c_m_pagination f_s_c";
                $next_page = "c_m_pagination f_s_c";
                $last_page = "c_m_pagination f_s_c";

                if ( $pagenum == $first ) {
                    $first_page = "";
                    $prev_page = "";
                }
                if ( $pagenum == $last ) {
                    $next_page = "";
                    $last_page = "";
                }
                ?>
                <i class="material-icons <?= $first_page;?>" pagenum="<?= $first;?>">fast_rewind</i>
                <i class="material-icons <?= $prev_page;?>" pagenum="<?= $prev;?>">skip_previous</i>
                <i class="material-icons <?= $next_page;?>" pagenum="<?= $next;?>">skip_next</i>
                <i class="material-icons <?= $last_page;?>" pagenum="<?= $last;?>">fast_forward</i>
                <input type="hidden" id="f_s_c_pagenum" value="<?= $pagenum;?>" />
                <input type="hidden" id="f_s_category" value="<?= $category;?>" />
            </div>
            <?php
            } else {
                echo '<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_m_no_div">
                There are not any product matched
            </div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg g_none_dis" data-toggle="modal" id="f_product_img_preview_btn" data-target="#f_product_img_preview_modal">Open Modal</button>
<!-- Modal -->
<div id="f_product_img_preview_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <i class="material-icons f_img_preview_close" data-dismiss="modal">cancel</i>
                <img src="" class="f_product_preview_img" />
            </div>
        </div>

    </div>
</div>

<?php
include "template/footer.php";
?>
