<?php
include "template/header.php";
?>
<div class="banner">
</div>
<div class="container_row">
    <div class="f_m_search_div row">
        <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_m_tlt">advanced part finder </div>
        <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 g_txt_right">
            <input type="text" class="f_m_search_ipt" id="f_p_a_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
            <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" id="f_p_a_s_btn" class="f_m_search_btn" />
            <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a>
        </div>
    </div>
    <div class="f_m_alert_div">&nbsp;</div>
    <div class="row f_m_cnt_div">
        <div class="col-xs-4 col-md-4 col-lg-4 col-sm-4 f_s_c_tree_div">
            <select class="g_ipt f_s_a_slt" id="f_s_a_slt_make">
                <option value="0" disabled selected>--make--</option>
                <?php
                if ( isset($makes) )
                for ( $i = 0; $i < count($makes); $i ++ ) {
                    $sel = ""; if ( $make == $makes[$i]["id"] ) $sel = "selected";
                    echo '<option value="'.$makes[$i]["id"].'" '.$sel.'>'.$makes[$i]["title"].'</option>';
                }
                ?>
            </select>
            <select class="g_ipt f_s_a_slt" id="f_s_a_slt_type">
                <option value="0" disabled selected>--type--</option>
                <?php
                if ( isset($types) )
                    for ( $i = 0; $i < count($types); $i ++ ) {
                        $sel = ""; if ( $type == $types[$i]["id"] ) $sel = "selected";
                        echo '<option value="'.$types[$i]["id"].'" '.$sel.'>'.$types[$i]["title"].'</option>';
                    }
                ?>
            </select>
            <select class="g_ipt f_s_a_slt" id="f_s_a_slt_model">
                <option value="0" disabled selected>--model--</option>
                <?php
                if ( isset($models) )
                for ( $i = 0; $i < count($models); $i ++ ) {
                    $sel = ""; if ( $model == $models[$i]["id"] ) $sel = "selected";
                    echo '<option value="'.$models[$i]["id"].'" '.$sel.'>'.$models[$i]["title"].'</option>';
                }
                ?>
            </select>
            <select class="g_ipt f_s_a_slt" id="f_s_a_slt_year">
                <option value="0" disabled selected>--year--</option>
                <?php
                if ( isset($years) )
                for ( $i = 0; $i < count($years); $i ++ ) {
                    $sel = ""; if ( $year == $years[$i]["id"] ) $sel = "selected";
                    echo '<option value="'.$years[$i]["id"].'" '.$sel.'>'.$years[$i]["title"].'</option>';
                }
                ?>
            </select>
            <select class="g_ipt f_s_a_slt" id="f_s_a_slt_engine">
                <option value="0" disabled selected>--engine--</option>
                <?php
                if ( isset($engines) )
                for ( $i = 0; $i < count($engines); $i ++ ) {
                    $sel = ""; if ( $engine == $engines[$i]["id"] ) $sel = "selected";
                    echo '<option value="'.$engines[$i]["id"].'" '.$sel.'>'.$engines[$i]["title"].'</option>';
                }
                ?>
            </select>
            <br><br>
            <button class="g_btn_y" id="f_s_a_advanced_parameter_btn">Filter</button>
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

                    $first_page = "c_m_pagination f_s_a";
                    $prev_page = "c_m_pagination f_s_a";
                    $next_page = "c_m_pagination f_s_a";
                    $last_page = "c_m_pagination f_s_a";

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
                    <input type="hidden" id="f_s_a_pagenum" value="<?= $pagenum;?>" />
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
