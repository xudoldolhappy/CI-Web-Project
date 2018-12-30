<?php
include "template/header.php";
?>
<div class="l_signup_top_div">
    <form method="post" action="#">
        <div class="bl_signup">
            <div class="l_signup_tlt">NEW ACCOUNT</div>
            <div class="row">
                <div class="col-xs-4 col-md-4">First Name</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
                <div class="col-xs-4 col-md-4">Last Name</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            </div><div class="row">
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_first_name" class="g_ipt" /></div>
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_last_name" class="g_ipt" /></div>
            </div><div class="row">
                <div class="col-xs-4 col-md-4">Password</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
                <div class="col-xs-4 col-md-4">Confirm Password</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            </div><div class="row">
                <div class="col-xs-6 col-md-6"><input type="password" id="signup_password" class="g_ipt" /></div>
                <div class="col-xs-6 col-md-6"><input type="password" id="signup_confirm_password" class="g_ipt" /></div>
            </div><div class="row">
                <div class="col-xs-4 col-md-4">Email Address</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
                <div class="col-xs-4 col-md-4">Phone Number</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            </div><div class="row">
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_email" class="g_ipt" /></div>
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_phone" class="g_ipt" /></div>
            </div><div class="row">
                <div class="col-xs-4 col-md-4">Country</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
                <div class="col-xs-4 col-md-4">State</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            </div><div class="row">
                <div class="col-xs-6 col-md-6"><select class="g_ipt signup_country" id="ep_countires" name="country">
                        <option value="0">Please select</option>
                        <?php for ( $i = 0; $i < count($countries); $i ++ ) {
                            if ( $match->country == $countries[$i]["iso"] ) echo '<option value="'.$countries[$i]["iso"].'" selected>'.$countries[$i]["nicename"].'</option>';
                            else echo '<option value="'.$countries[$i]["iso"].'">'.$countries[$i]["nicename"].'</option>';
                        } ?>
                    </select></div>
                <div class="col-xs-6 col-md-6"><select class="g_ipt signup_state" id="ep_provinces" name="province">
                        <option value="0">Please select</option>
                    </select></div>
            </div><div class="row">
                <div class="col-xs-4 col-md-4">Address Line1</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
                <div class="col-xs-4 col-md-4">Address Line2</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            </div><div class="row">
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_address1" class="g_ipt" /></div>
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_address2" class="g_ipt" /></div>
            </div><div class="row">
                <div class="col-xs-4 col-md-4">City</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
                <div class="col-xs-4 col-md-4">Zip Code</div><div class="col-xs-2 col-md-2 g_txt_right">required</div>
            </div><div class="row">
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_city" class="g_ipt" /></div>
                <div class="col-xs-6 col-md-6"><input type="text" id="signup_zip" class="g_ipt" /></div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-6"><div class="l_s_signup_btn" id="l_s_signup_btn">view singles now</div></div>
                <div class="col-xs-6 col-md-6"><div class="l_login_facebook_btn" id="facebook_login_btn">Join with Facebook</div></div>
            </div>
            <div class="l_signup_terms">
                I am a member? <a href="<?php echo base_url();?>front/login"><b>Login</b></a>
            </div>
        </div>
    </form>
</div>
<?php
include "template/footer.php";
?>
