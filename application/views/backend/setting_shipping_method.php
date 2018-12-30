<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <!-- shippig method manage -->
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

</div>

<?php
include "template/footer.php";
?>
