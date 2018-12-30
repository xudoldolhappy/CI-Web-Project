<?php
include "template/header.php";
?>
<div class="container_row f_checkout_top_div">
    <br><!-- billing address -->
    <?php
    $u = $user_info;
    $b = $billing_address;
    $s = $shipping_address;
    $m = $shipping_methods;
    $o = $order;
    ?>
    <input type="hidden" id="f_ch_checkout_page" value="1" />
    <input type="hidden" id="f_ch_billing_did" value="<?php if(isset($b)) echo $b->id;?>" />
    <input type="hidden" id="f_ch_shipping_did" value="<?php if(isset($s)) echo $s->id;?>" />
    <input type="hidden" id="f_ch_order_did" value="<?php if(isset($o)) echo $o->id;?>" />

    <!-- billing address setting tab -->
    <div class="f_checkout_tab_div f_ch_active_div">
        <div class="f_ch_img_div"><img src="<?= base_url();?>assets/frontend/lib/img/icons/bill1.png"></div>
        <div class="f_ch_t_tlt">Billing Details</div>
    </div>
    <div class="f_ch_cnt_div <?php if ( $tab != "0" ) echo "g_none_dis";?>">
        <!-- use user`s address as billing address -->
        <input type="radio" name="f_ch_billing_address_kind" id="f_ch_b_a_k1" value="0" checked /> <label for="f_ch_b_a_k1">I want to use an existing billing address</label>
        <div class="f_ch_billing_sub_old f_ch_sub_cnt_div">
            <div class="f_ch_sub_sub_div">
                <?php
                if ( isset($u) )
                    echo $u->first_name."&nbsp;".$u->last_name.",&nbsp;".$u->company.",&nbsp;".
                        $u->address1.",&nbsp;".$u->city.",&nbsp;".$u->state_name.",&nbsp;".
                        $u->country_name.",&nbsp;".$u->zip;
                ;?>
                <br>
                <input type="checkbox" id="f_ch_billing_same_ship" <?php if(isset($b) && $b->as_shipping="1") echo "checked";?> /> <label for="f_ch_billing_same_ship">I also want to ship to this address</label>
            </div>
            <a href="javascript:void(0);" class="g_btn_rg" id="f_ch_billing_asold_btn">bill to this address</a>
        </div><br>


        <!-- use user`s address as new address -->
        <input type="radio" name="f_ch_billing_address_kind"  id="f_ch_b_a_k2" value="1" /> <label for="f_ch_b_a_k2">I want to use an existing billing address</label>
        <div class="f_ch_billing_sub_new f_ch_sub_cnt_div  <?php if ( $tab != "1" ) echo "g_none_dis";?>">
            <div class="f_ch_sub_sub_div">
                <fieldset>
                    <div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* First Name</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_first_name" class="g_ipt" value="<?php if (isset($b)) echo $b->first_name; else echo $u->first_name;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* Last Name</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_last_name" class="g_ipt" value="<?php if (isset($b)) echo $b->last_name; else echo $u->last_name;?>" /></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* Company</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_company" class="g_ipt" value="<?php if (isset($b)) echo $b->company; else echo $u->company;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* Phone Number</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_phone" class="g_ipt" value="<?php if (isset($b)) echo $b->phone; else echo $u->phone;?>" /></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* Country</div>
                        <div class="col-xs-4 col-md-4"><select class="g_ipt" id="f_ch_new_billing_countires" name="country">
                                <option value="0">Please select</option>
                                <?php for ( $i = 0; $i < count($countries); $i ++ ) {
                                    $c_c = $u->country;
                                    if ( isset($b)) $c_c = $b->country;
                                    if ( $c_c == $countries[$i]["iso"] ) echo '<option value="'.$countries[$i]["iso"].'" selected>'.$countries[$i]["nicename"].'</option>';
                                    else echo '<option value="'.$countries[$i]["iso"].'">'.$countries[$i]["nicename"].'</option>';
                                } ?>
                            </select></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* State</div>
                        <div class="col-xs-4 col-md-4"><select class="g_ipt" id="f_ch_new_billing_provinces" name="province">
                                <option value="0">Please select</option>
                                <?php
                                for ( $i = 0; $i < count($b_states); $i ++ ) {
                                    $c_s = $u->state;
                                    if ( isset($b)) $c_s = $b->state;
                                    if ( $c_s == $b_states[$i]["code"] ) echo '<option value="'.$b_states[$i]["code"].'" selected>'.$b_states[$i]["name"].'</option>';
                                    else echo '<option value="'.$b_states[$i]["code"].'">'.$b_states[$i]["name"].'</option>';
                                }
                                ?>
                            </select></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* Address Line1</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_address1" class="g_ipt" value="<?php if (isset($b)) echo $b->address1; else echo $u->address1;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right"> Address Line2</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_address2" class="g_ipt" value="<?php if (isset($b)) echo $b->address2; else echo $u->address2;?>" /></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* City</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_city" class="g_ipt" value="<?php if (isset($b)) echo $b->city; else echo $u->city;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* Zip Code</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_billing_zip" class="g_ipt" value="<?php if (isset($b)) echo $b->zip; else echo $u->zip;?>" /></div>
                    </div>
                </fieldset>

                <input type="checkbox" id="f_ch_billing_as_user_address"/> <label for="f_ch_billing_as_user_address">Save this address in my address book</label><br>
                <input type="checkbox" id="f_ch_billing_same_ship_new" <?php if(isset($b) && $b->as_shipping="1") echo "checked";?> /> <label for="f_ch_billing_same_ship_new">I also want to ship to this address</label><br>
            </div>
            <a href="javascript:void(0);" class="g_btn_rg" id="f_ch_billing_asnew_btn">bill to this address</a>
        </div>
    </div>

    <!-- shipping address -->
    <div class="f_checkout_tab_div <?php if (isset($b)) echo "f_ch_active_div";?>">
        <div class="f_ch_img_div"><img src="<?= base_url();?>assets/frontend/lib/img/icons/address1.png"></div>
        <div class="f_ch_t_tlt">Shipping Details</div>
    </div>
    <div class="f_ch_cnt_div  <?php if ( $tab != "1" ) echo "g_none_dis";?>">
        <!-- use user`s address as billing address -->
        <input type="radio" name="f_ch_shipping_address_kind" id="f_ch_b_a_k3" value="0" checked /> <label for="f_ch_b_a_k3">I want to use an existing shipping address</label>
        <div class="f_ch_shipping_sub_old f_ch_sub_cnt_div">
            <div class="f_ch_sub_sub_div">
                <?php
                if ( isset($u) )
                    echo $u->first_name."&nbsp;".$u->last_name.",&nbsp;".$u->company.",&nbsp;".
                        $u->address1.",&nbsp;".$u->city.",&nbsp;".$u->state_name.",&nbsp;".
                        $u->country_name.",&nbsp;".$u->zip;
                ;?>
                <br>
            </div>
            <a href="javascript:void(0);" class="g_btn_rg" id="f_ch_shipping_asold_btn">ship to this address</a>
        </div><br>


        <!-- use user`s address as new address -->
        <input type="radio" name="f_ch_shipping_address_kind"  id="f_ch_b_a_k4" value="1" /> <label for="f_ch_b_a_k4">I want to use a new shipping address</label>
        <div class="f_ch_shipping_sub_new f_ch_sub_cnt_div  <?php if ( $tab != "3" ) echo "g_none_dis";?>">
            <div class="f_ch_sub_sub_div">
                <fieldset>
                    <div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* First Name</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_first_name" class="g_ipt" value="<?php if (isset($s)) echo $s->first_name; else echo $u->first_name;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* Last Name</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_last_name" class="g_ipt" value="<?php if (isset($s)) echo $s->last_name; else echo $u->last_name;?>" /></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* Company</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_company" class="g_ipt" value="<?php if (isset($s)) echo $s->company; else echo $u->company;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* Phone Number</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_phone" class="g_ipt" value="<?php if (isset($s)) echo $s->phone; else echo $u->phone;?>" /></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* Country</div>
                        <div class="col-xs-4 col-md-4"><select class="g_ipt" id="f_ch_new_shipping_countires" name="country">
                                <option value="0">Please select</option>
                                <?php for ( $i = 0; $i < count($countries); $i ++ ) {
                                    $c_c = $u->country;
                                    if ( isset($s)) $c_c = $s->country;
                                    if ( $c_c == $countries[$i]["iso"] ) echo '<option value="'.$countries[$i]["iso"].'" selected>'.$countries[$i]["nicename"].'</option>';
                                    else echo '<option value="'.$countries[$i]["iso"].'">'.$countries[$i]["nicename"].'</option>';
                                } ?>
                            </select></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* State</div>
                        <div class="col-xs-4 col-md-4"><select class="g_ipt" id="f_ch_new_shipping_provinces" name="province">
                                <option value="0">Please select</option>
                                <?php
                                for ( $i = 0; $i < count($s_states); $i ++ ) {
                                    $c_s = $u->state;
                                    if ( isset($s)) $c_s = $s->state;
                                    if ( $c_s == $s_states[$i]["code"] ) echo '<option value="'.$s_states[$i]["code"].'" selected>'.$s_states[$i]["name"].'</option>';
                                    else echo '<option value="'.$s_states[$i]["code"].'">'.$s_states[$i]["name"].'</option>';
                                }
                                ?>
                            </select></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* Address Line1</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_address1" class="g_ipt" value="<?php if (isset($s)) echo $s->address1; else echo $u->address1;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right"> Address Line2</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_address2" class="g_ipt" value="<?php if (isset($s)) echo $s->address2; else echo $u->address2;?>" /></div>
                    </div><div class="row">
                        <div class="col-xs-2 col-md-2 g_txt_right">* City</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_city" class="g_ipt" value="<?php if (isset($s)) echo $s->city; else echo $u->city;?>" /></div>
                        <div class="col-xs-2 col-md-2 g_txt_right">* Zip Code</div>
                        <div class="col-xs-4 col-md-4"><input type="text" id="f_ch_new_shipping_zip" class="g_ipt" value="<?php if (isset($s)) echo $s->zip; else echo $u->zip;?>" /></div>
                    </div>
                </fieldset>

                <input type="checkbox" id="f_ch_shipping_as_user_address"/> <label for="f_ch_shipping_as_user_address">Save this address in my address book</label><br>
            </div>
            <a href="javascript:void(0);" class="g_btn_rg" id="f_ch_shipping_asnew_btn">ship to this address</a>
        </div>
    </div>

    <!-- shipping method -->
    <div class="f_checkout_tab_div <?php if (isset($s)) echo "f_ch_active_div";?>">
        <div class="f_ch_img_div"><img src="<?= base_url();?>assets/frontend/lib/img/icons/shipping1.png"></div>
        <div class="f_ch_t_tlt">Shipping Method</div>
    </div>
    <div class="f_ch_cnt_div  <?php if ( $tab != "2" ) echo "g_none_dis";?>">
        <div class="f_ch_sub_cnt_div">
            Please choose the shipping method for your order
            <div class="f_ch_s_m_s_sub_div">
                <?php
                for ( $i = 0; $i < count($m); $i ++ ) {
                    $checked = "";
                    if ( isset($o) ) if ( $m[$i]["id"] == $o->shipping_method ) $checked = "checked";
                    echo '<div class="row"><div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                <input type="radio" name="f_ch_shipping_method_items" value="'.$m[$i]["id"].'" id="f_ch_s_m_'.$i.'" '.$checked.' />
                                <label for="f_ch_s_m_'.$i.'">'.$m[$i]["title"].'</label>
                            </div><div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                <span>$'.$m[$i]["price"].'</span></div></div>';
                }
                ?>
            </div><br>
            <a href="javascript:void(0);" class="g_btn_rg" id="f_ch_shipping_method_btn">continue</a>
        </div>
    </div>


    <!-- order address -->
    <div class="f_checkout_tab_div <?php if (isset($o)) echo "f_ch_active_div";?>">
        <div class="f_ch_img_div"><img src="<?= base_url();?>assets/frontend/lib/img/icons/order1.png"></div>
        <div class="f_ch_t_tlt">Order Confirmation</div>
    </div>
    <div class="f_ch_cnt_div  <?php if ( $tab != "3" ) echo "g_none_dis";?>">
        <div class="f_cart_list_div">
            Please review the contents of your order below and then choose how you'd like to pay for your order.<br><br>
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
                    $sub_sum = number_format(( intval($list[$i]["count"]) * ( floatval($list[$i]["sale_price"]) + floatval($list[$i]["core_fee"])) ), 2);
                    $sum += $sub_sum;
                    echo '<div class="row f_cart_items_row">
                    <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1">
                          <img class="f_cart_photo" src="'.base_url().'uploads/pcategories/'.$list[$i]["filename"].'" />              
                    </div>
                    <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_items_code">
                        <a href="<a href="'.base_url().'front/product?did='.$list[$i]["id"].'">'.$list[$i]["code"].'</a></div>
                    <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_cart_items">
                        <a href="'.base_url().'front/product?did='.$list[$i]["id"].'">'.$list[$i]["name"].'</a></div>
                    <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_cart_items">
                        $<span class="f_cart_product_price">'.number_format(floatval($list[$i]["sale_price"]), 2).'</span>
                    </div><div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_cart_items">
                        <b>$&nbsp;&nbsp;'.number_format(floatval($list[$i]["core_fee"]), 2).'</b>
                    </div><div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_items" did="'.$list[$i]["cart_id"].'">
                        <div class="g_txt_center">'.$list[$i]["count"].'</div>
                    </div>
                    <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_items">
                        $<span class="f_cart_total_price">'.$sub_sum.'</span>
                    </div>
                </div>';
                }
            ?>
            <div class="row"><br>
                <div class="col-xs-4 col-md-4 col-lg-4 col-sm-4">&nbsp;</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_cart_total_tlt g_txt_right g_top_boder">Subtotal:</div>
                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_total_tlt g_top_boder">$<?php echo number_format( $sum, 2);?></div>
            </div>
            <div class="row"><br>
                <div class="col-xs-4 col-md-4 col-lg-4 col-sm-4">&nbsp;</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_cart_total_tlt g_txt_right g_top_boder">Shipping (UPS (Worldwide Expedited)):</div>
                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_total_tlt g_top_boder">$<?php if ( isset($o))  echo number_format(floatval($o->shipping_price), 2);?></div>
            </div>
            <div class="row"><br>
                <div class="col-xs-4 col-md-4 col-lg-4 col-sm-4">&nbsp;</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_cart_total_tlt g_txt_right g_top_boder">Grand total:</div>
                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_cart_total_tlt g_top_boder">$<?php if ( isset($o))  echo number_format(( $sum + $o->shipping_price ), 2);?></div>
            </div>
            <div class="row"><br>
                <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                    <div class="f_ch_p_k_comm_div">How Would You Like to Pay?</div>
                    <div class="f_ch_p_k_cnt_div">
                        <input type="radio" name="f_ch_payment_kind" id="f_ch_p_k_1" value="1" checked /> <label for="f_ch_p_k_1">paypal</label>
                    </div>
                </div>
            </div>
            <div class="row"><br>
                <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 g_txt_right">
                    <a href="javascript:void(0);" class="g_btn_rg" id="f_ch_proceed_payment_btn" subtotal="<?php echo $sum;?>">proceed to payment</a></div>
            </div>
        </div>
    </div>

    <!-- payment detail -->
    <div class="f_checkout_tab_div <?php if (isset($o) && floatval($o->subtotal) > 0 ) echo "f_ch_active_div";?>">
        <div class="f_ch_img_div"><img src="<?= base_url();?>assets/frontend/lib/img/icons/payment.png" /></div>
        <div class="f_ch_t_tlt">Pyment Detail</div>
    </div>
    <div class="f_ch_cnt_div  <?php if ( $tab != "4" ) echo "g_none_dis";?>">
        <div class="f_ch_sub_cnt_div">
            Log in to PayPal to complete your order.
            <div class="f_ch_s_m_s_sub_div">
                <!-- funds amount -->
                <input type="hidden" id="f_ch_grand_total_fund" value="<?php if ( isset($o)) echo ( $sum + $o->shipping_price ) ;?>" />

                <!-- paypal info -->
                <input type="hidden" id="f_ch_paypal_is_live" value="<?= $paypal_info->is_live_paypal;?>" />
                <input type="hidden" id="f_ch_paypal_sandbox_clientid" value="<?= $paypal_info->p_client_id;?>" />
                <input type="hidden" id="f_ch_paypal_sandbox_secretkey" value="<?= $paypal_info->p_secret_key;?>" />
                <input type="hidden" id="f_ch_paypal_live_clientid" value="<?= $paypal_info->s_client_id;?>" />
                <input type="hidden" id="f_ch_paypal_live_secretkey" value="<?= $paypal_info->s_secret_key;?>" />

                <?php
                $paypal_dis = "g_none_dis";
                if ( isset($o)) {
                    if ( $o->payment_kind == "1" ) {        // paypal
                        $paypal_dis = "";
                    }
                }
                ?>
                <div id="paypal-button-container" class="<?= $paypal_dis;?>"></div>
            </div><br>
        </div>
    </div>
    <br>
</div>
<?php
include "template/footer.php";
?>
