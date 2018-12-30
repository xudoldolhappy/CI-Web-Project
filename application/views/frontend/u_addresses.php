<?php
include "template/header.php";
?>
<div class="container_row">
    <div class="ep_tabs">
        <a href="<?php echo base_url();?>front/u_orders">Orders</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_messages">Messages</a>-->
        <a class="ep_tabs_a_active" href="<?php echo base_url();?>front/u_addresses">Addresses</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_wish_lists">Wish Lists</a>-->
        <a href="<?php echo base_url();?>front/u_recently_iewed">Recently Viewed</a>
        <a href="<?php echo base_url();?>front/u_account_settings">Account Settings</a>
    </div>
    <div class="ep_cnts">
        <?php
        $u = $user_profile_info;
        ?>
        <div class="row">
            <div class="col-xs-4 col-md-4">First Name</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            <div class="col-xs-4 col-md-4">Last Name</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
        </div><div class="row">
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_first_name" class="g_ipt" value="<?= $u->first_name;?>" /></div>
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_last_name" class="g_ipt" value="<?= $u->last_name;?>" /></div>
        </div><div class="row">
            <div class="col-xs-4 col-md-4">Company</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            <div class="col-xs-4 col-md-4">Phone Number</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
        </div><div class="row">
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_company" class="g_ipt" value="<?= $u->company;?>" /></div>
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_phone" class="g_ipt" value="<?= $u->phone;?>" /></div>
        </div><div class="row">
            <div class="col-xs-4 col-md-4">Country</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            <div class="col-xs-4 col-md-4">State</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
        </div><div class="row">
            <div class="col-xs-6 col-md-6"><select class="g_ipt signup_country" id="ep_countires" name="country">
                    <option value="0">Please select</option>
                    <?php
                    for ( $i = 0; $i < count($countries); $i ++ ) {
                        if ( $u->country == $countries[$i]["iso"] ) echo '<option value="'.$countries[$i]["iso"].'" selected>'.$countries[$i]["nicename"].'</option>';
                        else echo '<option value="'.$countries[$i]["iso"].'">'.$countries[$i]["nicename"].'</option>';
                    } ?>
                </select></div>
            <div class="col-xs-6 col-md-6"><select class="g_ipt signup_state" id="ep_provinces" name="province">
                    <option value="0">Please select</option>
                    <?php
                    $s_state = $u->state;
                    if ( isset($s_state) && $s_state != null && $s_state != "0" && $s_state != "" ){
                        for ( $i = 0; $i < count($states); $i ++ ) {
                            if ( $s_state == $states[$i]["code"] ) echo '<option value="'.$states[$i]["code"].'" selected>'.$states[$i]["name"].'</option>';
                            else echo '<option value="'.$states[$i]["code"].'">'.$states[$i]["name"].'</option>';
                        }
                    }
                    ?>
                </select></div>
        </div><div class="row">
            <div class="col-xs-4 col-md-4">Address Line1</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            <div class="col-xs-4 col-md-4">Address Line2</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
        </div><div class="row">
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_address1" class="g_ipt" value="<?= $u->address1;?>" /></div>
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_address2" class="g_ipt" value="<?= $u->address2;?>" /></div>
        </div><div class="row">
            <div class="col-xs-4 col-md-4">City</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            <div class="col-xs-4 col-md-4">Zip Code</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
        </div><div class="row">
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_city" class="g_ipt" value="<?= $u->city;?>" /></div>
            <div class="col-xs-6 col-md-6"><input type="text" id="signup_zip" class="g_ipt" value="<?= $u->zip;?>" /></div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 g_txt_center"><input type="button" class="g_btn_y" id="u_address_update" value="UPDATE ADDRESS" /></div>
        </div>
    </div>
</div>

<?php
include "template/footer.php";
?>