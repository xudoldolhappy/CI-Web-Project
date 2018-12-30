<?php
include "template/header.php";
?>
<div class="container_row f_m_catainer_row">
    <div class="f_cart_tlt">Your Cart &nbsp;(&nbsp;<span><?php if (isset($cart_product_info["cnt"])) echo $cart_product_info["cnt"];?></span>&nbsp;items&nbsp;)
        <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_g g_float_right">advanced part finder</a>
        <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_g g_float_right">shop by categories</a></div>
    <div class="f_cart_list_div">
        <div class="row">
            <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_a_l_heard">Items</div>
            <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_p_d_a_l_heard">Price</div>
            <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_p_d_a_l_heard">Core Fee</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_heard">Quantity</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_heard">Total</div>
        </div>
    <?php
    $list = $cart_product_info["list"];
    $sum = 0.0;
    if ( isset( $list ) )
        for ( $i = 0; $i < count($list); $i ++ )
        {
            $sub_sum = ( intval($list[$i]["count"]) * ( floatval($list[$i]["sale_price"]) + floatval($list[$i]["core_fee"]) ));
            $sum += $sub_sum;
            echo '<div class="row f_cart_items_row">
                    <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1">
                          <img class="f_cart_photo" src="'.base_url().'uploads/pcategories/'.$list[$i]["filename"].'" />              
                    </div>
                    <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_items_code">
                        <a href="'.base_url().'front/product?did='.$list[$i]["id"].'">'.$list[$i]["code"].'</a>
                    </div><div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_cart_items">
                        <a href="'.base_url().'front/product?did='.$list[$i]["id"].'">'.$list[$i]["name"].'</a>
                    </div><div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_cart_items">
                        $<span class="f_cart_product_price">'.number_format(floatval($list[$i]["sale_price"]), 2).'</span>
                    </div><div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_cart_items">
                        <b>$&nbsp;&nbsp;'.number_format(floatval($list[$i]["core_fee"]), 2).'</b>
                    </div><div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_items" did="'.$list[$i]["cart_id"].'">
                        <i class="material-icons f_cart_count_down">keyboard_arrow_down</i>
                        <div class="f_cart_total_count">'.$list[$i]["count"].'</div>
                        <i class="material-icons f_cart_count_up"  quanity="'.$list[$i]["quanity"].'">keyboard_arrow_up</i>
                    </div><div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_items">
                        $<span class="f_cart_total_price">'.number_format(floatval($sub_sum), 2).'</span>
                        <i class="material-icons f_cart_remove">close</i></div>
                </div>';
        }
    ?>
        <div class="row"><br>
            <div class="col-xs-8 col-md-8 col-lg-8 col-sm-8">&nbsp;</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_total_tlt g_txt_right g_top_boder">Grand total:</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_total_tlt g_top_boder">$<?php echo number_format(floatval( $sum), 2);?></div>
        </div>
        <div class="row"><br>
            <div class="col-xs-8 col-md-8 col-lg-8 col-sm-8">&nbsp;</div>
            <div class="col-xs-4 col-md-4 col-lg-4 col-sm-4 g_txt_right"><a href="<?= base_url();?>front/checkout" class="g_btn_rg">checkout</a></div>
        </div>
    </div>
    <br><br><br><br>
</div>
<?php
include "template/footer.php";
?>
