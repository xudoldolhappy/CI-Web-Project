<?php
include "template/header.php";
?>
<div class="container_row">
    <div class="ep_tabs">
        <a href="<?php echo base_url();?>front/u_orders">Orders</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_messages">Messages</a>-->
        <a href="<?php echo base_url();?>front/u_addresses">Addresses</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_wish_lists">Wish Lists</a>-->
        <a class="ep_tabs_a_active" href="<?php echo base_url();?>front/u_recently_iewed">Recently Viewed</a>
        <a href="<?php echo base_url();?>front/u_account_settings">Account Settings</a>
    </div>
    <div class="ep_cnts row">
        <?php
        if ( isset ($list) ) {
            for ( $i = 0; $i < count($list); $i ++ ) {
                $favorite_img = "";
                if ( $list[$i]["favorite"] == "1" )
                    $favorite_img = '<img class="f_m_favorite_img" src="'.base_url().'assets/frontend/lib/img/icons/favorite.png" />';
                echo '<div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
                    <div class="f_m_items" did="'.$list[$i]["id"].'">
                        <div class="f_m_items_photo">
                            <img src="'.base_url().'uploads/pcategories/'.$list[$i]["photo"].'" />
                            '.$favorite_img.'</div>
                        <div class="f_m_items_name">'.$list[$i]["name"].'</div>
                        <div class="f_m_items_price">$'.$list[$i]["sale_price"].'</div>
                        <div class="f_m_items_cart"><button class="g_btn_gr">Add to cart</button></div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="f_u_alert">There are not any viewed product by you</div>';
        }
        ?>
    </div>
</div>

<?php
include "template/footer.php";
?>