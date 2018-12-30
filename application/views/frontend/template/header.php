<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 1/30/2018
 * Time: 7:01 PM
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>STARTER</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/frontend/lib/img/avata.ico" type="image/x-icon" />

    <!-- style sheet -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/layout.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/lib/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/custom/css/global.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/custom/css/home.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/custom/css/front.css">

    <!-- js -->
    <script src="<?php echo base_url();?>assets/frontend/lib/js/vendor/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <!-- multiselect -->
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"  type="text/javascript"></script>

    <!-- paypal payment plugin -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <!-- custom tree that made by me -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/custom/css/mytree.css">
    <script src="<?= base_url();?>assets/backend/custom/js/mytree.js"></script>

    <!-- google icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="<?php echo base_url();?>assets/frontend/custom/js/global_funcs.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/global_events.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/home.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/login.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/user_account.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/shop.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/product.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/cart.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/custom/js/checkout.js"></script>

    <?php echo '<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>'; ?>

</head>
<body>
<?php
$userid = "";
if ( isset($_SESSION["userid"]) ) $userid = $_SESSION["userid"];
?>
<input type="hidden" id="g_userid" value="<?= $userid;?>" />
<input type="hidden" id="g_cartid" value="<?php if (isset($_SESSION["cartid"])) echo $_SESSION["cartid"];?>" />

<div id="layout">
    <div id="header">
        <div class="row">
            <div class="col-sm-3 col-lg-3 col-xs-3 col-md-3 g_txt_center"><br>
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/frontend/lib/img/logo.png" /></a>
            </div>
            <div class="col-sm-9 col-lg-9 col-xs-9 col-md-9">
                <div class="f_cart_div"><i class="material-icons">shopping_cart</i> <div class="f_cart_txt_div">(&nbsp;<span><?php if (isset($cart_product_info["cnt"])) echo $cart_product_info["cnt"]; else echo "0";?></span>&nbsp;)&nbsp;items</div></div><br>
                <img src="<?php echo base_url();?>assets/frontend/lib/img/banner.png" />
                <?php if ( is_user_login() ) { ?>
                    <div class="f_top_logout_div"><?php if ( isset($_SESSION["email"])) echo $_SESSION["email"];?><a href="<?php echo base_url();?>front/logout">logout</a></div>
                <?php }?>
            </div>
        </div>
    </div>
    <div id="body_container">
        <div id="body_container_inner">
            <div id="menu">
                <?php
                $ms = array("", "", "", "", "", "", "", "", "", "");
                if ( isset($menu) )
                    $ms[intval($menu)] = "current";
                ?>  <!-- is user logined  -->
                <ul class="f_f_menu_ui" >
                    <li class="first" ><a class="<?= $ms[0];?>" href = "<?php echo base_url();?>" >Home</a ></li >
                    <li><a class="<?= $ms[9];?>" href = "<?php echo base_url();?>front/shop" >Shop</a ></li >
                    <li ><a class="<?= $ms[1];?>"  href = "<?php echo base_url();?>front/about">About</a ></li >
                    <li ><a class="<?= $ms[2];?>"  href = "<?php echo base_url();?>front/reviews">Reviews</a ></li >
                    <li ><a class="<?= $ms[3];?>"  href = "<?php echo base_url();?>front/returns">Returns & Warranty</a > </li >
                    <li ><a class="<?= $ms[4];?>"  href = "<?php echo base_url();?>front/contact">Contact</a ></li >
                    <li ><a class="<?= $ms[5];?>"  href = "<?php echo base_url();?>front/faq">FAQ`s</a ></li >
                    <li ><a class="<?= $ms[6];?>"  href = "<?php echo base_url();?>front/policies">Policies</a ></li >
                    <?php if ( !is_user_login() ) { ?>
                        <li ><a class="<?= $ms[7];?>"  href = "<?php echo base_url();?>front/login">Login</a ></li >
                        <li ><a class="<?= $ms[8];?>"  href = "<?php echo base_url();?>front/l_signup">Register</a ></li >
                    <?php }?>
                </ul >
                <?php if ( is_user_login() ) { ?>
                    <ul class="f_s_menu_ui" >
                        <li ><img src = "<?php echo base_url();?>assets/frontend/lib/images/user.png" id = "f_user" /></li >
                        <!--<li ><img src = "<?php echo base_url();?>assets/frontend/lib/images/setting.png" id = "f_setting" /></li >-->
                    </ul >
                <?php } ?> <!-- is not login -->
            </div>

            <!-- user account sub menus dialog -->
            <div class="f_nav_sub row g_none_dis" id="f_nav_user_profile_sub">
                <div class="col-md-12 f_use_profile_menu">
                    <div class="g_m_tlt">My Account</div>
                    <div class="g_s_tlt"><a href="<?php echo base_url();?>front/u_orders">Orders</a></div>
                    <!--                    <div class="g_s_tlt"><a href="--><?php //echo base_url();?><!--front/u_messages">Messages</a></div>-->
                    <div class="g_s_tlt"><a href="<?php echo base_url();?>front/u_addresses">Addresses</a></div>
                    <!--                    <div class="g_s_tlt"><a href="--><?php //echo base_url();?><!--front/u_wish_lists">Wish Lists</a></div>-->
                    <div class="g_s_tlt"><a href="<?php echo base_url();?>front/u_recently_iewed">Recently Viewed</a></div>
                    <div class="g_s_tlt"><a href="<?php echo base_url();?>front/u_account_settings">Account Settings</a></div>
                    <div class="g_s_tlt"><a href="<?php echo base_url();?>front/logout">Logout</a></div>
                </div>
            </div>

            <!-- user account sub menus dialog -->
            <div class="f_nav_sub row g_none_dis" id="f_nav_user_setting_sub">
                <?php
                $carts = $cart_product_info["list"];
                if ( isset( $carts ) ) {
                    for ( $i = 0; $i < count($carts); $i ++ ) {
                        echo '<div class="f_top_cart_box_item row">
                                <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5">
                                    <img class="f_cart_photo" src="'.base_url().'uploads/pcategories/'.$carts[$i]["filename"].'" />
                                </div>           
                                <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7">
                                    <a href="'.base_url().'front/product?did='.$carts[$i]["id"].'">'.$carts[$i]["code"].'</a><br>
                                    '.$carts[$i]["name"].'<br>
                                    $'.$carts[$i]["sale_price"].' × '.$carts[$i]["count"].' 
                                </div>             
                            </div>';
                    }
                    echo '<br><a href="'.base_url().'front/checkout" class="g_btn_rg">checkout</a>
                            <br><br><a href="'.base_url().'front/cart" class="g_btn_gg">view cart</a>';
                } else {
                    echo '<div class="col-md-12 f_use_setting_menu">
                            <div class="g_m_tlt">Your cart emplty!</div>
                        </div>';
                }
                ;?>
            </div>

            <!-- social site link div -->
            <div class="f_social_link">
                <a href="https://www.facebook.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_facebook.png" /></a>
                <a href="https://www.twitter.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_twitter.png" /></a>
                <a href="https://www.linkedin.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_linkedin.png" /></a>
                <a href="https://www.google.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_google.png" /></a>
                <a href="https://www.youtube.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_youtube.png" /></a>
                <a href="https://www.pinterest.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_pinterest.png" /></a>
                <a href="https://www.instagram.com/" target="_blank"><img src="<?= base_url();?>assets/frontend/lib/img/icons/s_instagram.png" /></a>
            </div>
