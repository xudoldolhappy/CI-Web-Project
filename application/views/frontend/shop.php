<?php
include "template/header.php";
?>
<div class="container_row f_m_catainer_row">
    <!-- search box -->
    <div class="f_search_top_box_div">
        <input type="text" class="f_shop_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
        <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" class="f_shop_s_btn" />
        <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a>
        <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
    </div>
    <div class="f_m_alert_div">&nbsp;</div>
    <div class="row f_m_cnt_div">
        <?php
        if ( isset ($list) ) {
            for ( $i = 0; $i < count($list); $i ++ ) {
                $row_num = 2;
                $img_heg = "";
                if(isset($name) && $name != "" ) {
                    $row_num = 4;
                    $img_heg = "f_m_items_bysearch";
                }

                $photo = $list[$i]["photo"];
                if ( !isset($photo) || $photo == "" || $photo == null ) $photo = "product_no_photo.png";

                echo '<div class="col-xs-'.$row_num.' col-md-'.$row_num.' col-lg-'.$row_num.' col-sm-'.$row_num.'">
                    <div class="f_m_items" did="'.$list[$i]["id"].'">
                        <div class="f_m_items_photo '.$img_heg.'">
                            <img src="'.base_url().'uploads/pcategories/'.$photo.'" />
                        </div>                   
                        <div class="f_m_items_name f_m_items_name_'.$row_num.'">'.substr( $list[$i]["name"], 0, 60 ).'</div>
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

                $first_page = "c_m_pagination f_shop_m_p";
                $prev_page = "c_m_pagination f_shop_m_p";
                $next_page = "c_m_pagination f_shop_m_p";
                $last_page = "c_m_pagination f_shop_m_p";

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
                <input type="hidden" id="f_m_pagenum" value="<?= $pagenum;?>" />
            </div>
            <?php
        } else {
            echo '<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_m_no_div">
                There are not any product matched
            </div>';
        }
        ?>
    </div> <br><br><br><br>
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
