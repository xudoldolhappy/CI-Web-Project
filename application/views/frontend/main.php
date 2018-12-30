<?php
include "template/header.php";
?>
<div class="container_row f_m_catainer_row">
    <!-- slider -->
    <div class="container f_m_slider_container">
        <div id="myCarousel" class="carousel slide f_main_slider" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
                <li data-target="#myCarousel" data-slide-to="5"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/back/banner5.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/back/banner6.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/back/banner4.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/back/banner3.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/back/banner1.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/back/banner2.jpg" alt="Los Angeles" style="width:100%;">
                </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
<!--                <span class="glyphicon glyphicon-chevron-left"></span>-->
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
<!--                <span class="glyphicon glyphicon-chevron-right"></span>-->
                <span class="sr-only">Next</span>
            </a>

            <div class="f_m_slider_cnt_div">
                <div class="f_m_slider_top_tlt">
                    High quality electrical <br> parts at low prices
                </div>
                <div class="f_m_search_ipt_div">
                    <input type="text" class="f_m_search_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" class="f_m_search_btn" />
                </div>
                <div class="f_m_search_div f_m_slider_cnt_href_div">
                    <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a> &nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
                </div>
            </div>
        </div>
    </div><br><br>
    <div class="f_m_alert_div">&nbsp;</div>
    <div class="row f_m_cnt_div">
    <?php
    if ( isset ($list) ) {
        for ( $i = 0; $i < count($list); $i ++ ) {
            $photo = $list[$i]["photo"];
            if ( !isset($photo) || $photo == "" || $photo == null ) $photo = "product_no_photo.png";
            echo '<div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
                    <div class="f_m_items" did="'.$list[$i]["id"].'">
                        <div class="f_m_items_photo">
                            <img src="'.base_url().'uploads/pcategories/'.$photo.'" />
                            <!--<img class="f_m_favorite_img" src="'.base_url().'assets/frontend/lib/img/icons/favorite.png" />-->
                            <!--<div class="f_product_quanity_mark">'.$list[$i]["quanity"].'</div>-->
                        </div>                   
                        <div class="f_m_items_name">'.$list[$i]["name"].'</div>
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

            $first_page = "c_m_pagination f_m_p";
            $prev_page = "c_m_pagination f_m_p";
            $next_page = "c_m_pagination f_m_p";
            $last_page = "c_m_pagination f_m_p";

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
<?php
include "template/footer.php";
?>
