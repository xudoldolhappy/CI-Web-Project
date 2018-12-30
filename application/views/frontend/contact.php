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
    <div class="f_t_tlt">Contact Us</div>
    <div class="f_t_cnt">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="f_cnt_info_dv">
                    <p>354 Mascoma St.</p>
                    <p>Lebanon NH  03766</p>
                    <p>Local   603-448-5314</p>
                    <p>Toll Free 877-644-3721</p>
                    <p>E-Mail: sales@********</p>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="row">
                    <div class="col-xs-6 col-md-6">First Name</div>
                    <div class="col-xs-6 col-md-6">Phone Number</div>
                </div><div class="row">
                    <div class="col-xs-6 col-md-6"><input type="text" value="<?php if ( isset($user_profile_info) ) echo $user_profile_info->first_name;?>" id="f_c_first_name" class="g_ipt" /></div>
                    <div class="col-xs-6 col-md-6"><input type="text" value="<?php if ( isset($user_profile_info) ) echo $user_profile_info->phone;?>" id="f_c_phone" class="g_ipt" /></div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6">Email Address</div>
                    <div class="col-xs-6 col-md-6">Order Number</div>
                </div><div class="row">
                    <div class="col-xs-6 col-md-6"><input type="text" value="<?php if ( isset($user_profile_info) ) echo $user_profile_info->email;?>" id="f_c_email" class="g_ipt" /></div>
                    <div class="col-xs-6 col-md-6"><input type="text" id="f_c_order_number" class="g_ipt" /></div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6">Company Name</div>
                    <div class="col-xs-6 col-md-6">RMA Number</div>
                </div><div class="row">
                    <div class="col-xs-6 col-md-6"><input type="text" id="f_c_company" class="g_ipt" /></div>
                    <div class="col-xs-6 col-md-6"><input type="text" id="f_c_rma" class="g_ipt" /></div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">Comments/Questions</div>
                </div><div class="row">
                    <div class="col-xs-12 col-md-12"><textarea class="g_ipt" id="f_c_comment" rows="6"></textarea></div>
                </div><br>
                <div class="row">
                    <div class="col-xs-12 col-md-12 g_txt_center"><input type="button" id="f_c_contact_btn" class="g_btn_g" value="Submit Form" /></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "template/footer.php";
?>
