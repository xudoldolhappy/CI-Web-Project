<?php
include "template/header.php";
?>
<div class="container_row">
    <div class="ep_tabs">
        <a href="<?php echo base_url();?>front/u_orders">Orders</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_messages">Messages</a>-->
        <a href="<?php echo base_url();?>front/u_addresses">Addresses</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_wish_lists">Wish Lists</a>-->
        <a href="<?php echo base_url();?>front/u_recently_iewed">Recently Viewed</a>
        <a class="ep_tabs_a_active" href="<?php echo base_url();?>front/u_account_settings">Account Settings</a>
    </div>
    <div class="ep_cnts">
        <div class="g_alert_txt u_accoutn_email_alert g_txt_center">&nbsp;</div>
        <div class="as_e_cnt">
            Email Address: &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="g_ipt_o" name="email" value="<?= $user_profile_info->email;?>" id="as_update_email_input" /><br><br>
            <input type="button" id="as_update_email_btn" value="save" class="g_btn_g" />
        </div>
        <br>
        <div class="g_alert_txt u_accoutn_pass_alert g_txt_center">&nbsp;</div>
        <div class="row">
            <div class="col-xs-5 col-md-5 g_txt_right">Current Password:</div>
            <div class="col-xs-7 col-md-7"><input type="password" id="as_p_u_current" class="g_ipt_h" /></div>
        </div><div class="row">
            <div class="col-xs-5 col-md-5 g_txt_right">New Password:</div>
            <div class="col-xs-7 col-md-7"><input type="password" id="as_p_u_password" class="g_ipt_h" disabled /></div>
        </div><div class="row">
            <div class="col-xs-5 col-md-5 g_txt_right">Comfirm Password:</div>
            <div class="col-xs-7 col-md-7"><input type="password" id="as_p_u_confirm" class="g_ipt_h" disabled /></div>
        </div><div class="row">
            <div class="col-xs-12 col-md-12 g_txt_center"><input type="button" id="as_update_password_btn" class="g_btn_g" value="save" /></div>
        </div>
    </div>
</div>

<?php
include "template/footer.php";
?>