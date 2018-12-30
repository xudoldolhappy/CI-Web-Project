<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <!-- sandbox or production api key setting -->
    <fieldset class="s_p_fld">
        <legend>Paypal API</legend>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 g_txt_right s_p_toggle_div">
                <?php
                $src = base_url()."assets/backend/lib/img/icons/toggle_l.png";
                $state = "0";
                $sandbox_non = "";
                $production_non = "g_non_dis";
                if ( isset( $paypal_info ) && ( $paypal_info->is_live_paypal == "1" ) ) {
                    $src = base_url()."assets/backend/lib/img/icons/toggle_r.png";
                    $state = "1";
                    $sandbox_non = "g_non_dis";
                    $production_non = "";
                }
                ?>
                sandbox <img class="s_p_toggle_btn" id="s_p_pp_state" src="<?= $src;?>" state="<?= $state;?>" /> production
            </div>
        </div>
        <!-- sandbox api values -->
        <div class="row s_p_s_val_div <?= $sandbox_non;?>">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                Sandbox Client ID
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <input class="g_ipt" id="s_p_s_cid" type="text" placeholder="Sandbox Client ID" value="<?php if ( $paypal_info->p_client_id != "" ) echo $paypal_info->p_client_id; ?>" />
            </div>
        </div>
        <div class="row s_p_s_val_div <?= $sandbox_non;?>">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                Sandbox Secret Key
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <input class="g_ipt" id="s_p_s_sec" type="text" placeholder="Sandbox Secret Key" value="<?php if ( $paypal_info->p_secret_key != "" ) echo $paypal_info->p_secret_key; ?>" />
            </div>
        </div>
        <!-- live paypal api values -->
        <div class="row s_p_p_val_div <?= $production_non;?>">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                Live Paypal Production Client ID
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <input class="g_ipt" id="s_p_p_cid" type="text" placeholder="Production Client ID" value="<?php if ( $paypal_info->s_client_id != "" ) echo $paypal_info->s_client_id; ?>" />
            </div>
        </div>
        <div class="row s_p_p_val_div <?= $production_non;?>">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                Live Paypal Production Secret Key
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <input class="g_ipt" id="s_p_p_sec" type="text" placeholder="Production Secret Key" value="<?php if ( $paypal_info->s_secret_key != "" ) echo $paypal_info->s_secret_key; ?>" />
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 g_txt_right">
                <a href="javascript:void(0);" class="btn btn-primary btn-sm s_p_api_save" id="s_p_api_save">Save</a>
            </div>
        </div>

    </fieldset>

    <!-- shippig method manage -->
    <!--
    <fieldset class="s_p_fld">
        <legend>Shipping method</legend>
        <?php
        if ( isset( $shipping_methods ) ) {
            for ( $i = 0; $i < count($shipping_methods); $i ++ ) {
                echo '<div class="row" did="'.$shipping_methods[$i]["id"].'">
                        <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                            <input class="g_ipt s_p_s_method" type="text" placeholder="shipping method" value="'.$shipping_methods[$i]["title"].'" />
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <input class="g_ipt s_p_s_price" type="text" placeholder="shipping price" value="'.$shipping_methods[$i]["price"].'" />
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                            <button class="btn btn-xs btn-default s_p_pp_fix"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-xs btn-default s_p_pp_delete"><i class="fa fa-times"></i></button>
                        </div>
                    </div>';
            }
        }
        ?>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
                <input class="g_ipt" id="s_p_s_method" type="text" placeholder="shipping method" />
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <input class="g_ipt" id="s_p_s_price" type="text" placeholder="shipping price" />
            </div>
            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                <a href="javascript:void(0);" class="btn btn-success btn-xs s_p_api_save" id="s_p_add_shipping_method">Add</a>
            </div>
        </div>
    </fieldset>
    -->

</div>

<?php
include "template/footer.php";
?>
