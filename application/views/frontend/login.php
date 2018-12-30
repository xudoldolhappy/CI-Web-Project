<?php
include "template/header.php";
?>
    <div class="l_login_back">
        <div class="l_signup">
            <div class="l_signup_tlt">member`s login</div>
            <div class="l_signup_enter">
                Email <br>
                <input type="text" id="l_login_email" />
            </div>
            <div class="l_signup_enter">
                Password <br>
                <input type="password" id="l_login_password" />
            </div>
            <div class="l_login_btn">login</div>
            <div class="l_bot_bor"></div>
            <div class="l_login_facebook_btn" id="facebook_login_btn">Join with Facebook</div>
            <div class="l_signup_terms">
                Not a member? <a href="<?php echo base_url();?>front/l_signup"><b>Join Free Now!</b></a>
            </div>
        </div>
        <div class="l_r_t_div">
            <div class="l_r_t_tlt"> Welcome to starter1.com </div>
            <div class="l_r_s_tlt"> we feature the highest quality starters, alternators, generators, and electrical
                parts for your vehicle, boat, watercraft, motorcycle, ATV, farm tractor, or any application. </div>
        </div>
    </div>
    <div class="l_social_login_div">
        <div class="l_b_tlt">Help spread the word about starter1.com!</div>
        <div class="l_s_div">
            <span id="l_l_facebook">share on facebook</span>
            <span id="l_l_twitter">twitter</span>
            <span id="l_l_google">google + </span>
            <span id="l_l_pinterest">pinterest</span>
        </div>
    </div>
<?php
include "template/footer.php";
?>
