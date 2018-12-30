<?php
include "template/header.php";
?>
<div class="banner">
</div>
<div class="container_row">
    <!-- search box -->
    <div class="f_search_top_box_div f_t_search">
        <input type="text" class="f_shop_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
        <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" class="f_shop_s_btn" />
        <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a>
        <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
    </div>
    <div class="f_t_tlt">Customer Reviews</div>
    <div class="f_t_cnt">
        <!--
        At DBElectrical.com, we are committed to offering the lowest prices and the absolute best service,
        period. Our friendly, knowledgeable staff is ready to assist you with any questions you might have,
        and we will ship your order promptly and efficiently. To ensure customer satisfaction, we ask all of
        our customers to rate their experience. Here's what they say:
        -->
    </div>
    <div class="f_p_d_review_list_div f_r_cnt_div">
        <?php
        if ( isset($reviews) )
            for ( $i = 0; $i < count($reviews); $i ++ ) {
                echo '<div class="row g_top_boder">
                           <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_r_l_tlt">'.$reviews[$i]["subject"].'</div>
                           <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_r_l_cnt">
                                 <img src="'.base_url().'assets/frontend/lib/img/icons/r'.$reviews[$i]["rating"].'.png" />
                                 '.$reviews[$i]["date"].' by <span>'.$reviews[$i]["email"].'</span>                             
                            </div>
                      </div>
                      <div class="row">
                           <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_p_d_r_l_cnt">'.$reviews[$i]["comment"].'</div>
                      </div>';
            }
        ?>
    </div>
</div>
<?php
include "template/footer.php";
?>
