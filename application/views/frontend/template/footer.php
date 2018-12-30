<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 1/30/2018
 * Time: 7:01 PM
 */
?>
                <div id="footer">
                        <div class="footer_link g_none_dis">
                            <ul style="color:#FFf;">
                                &nbsp;
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    <div class="main_footer">
        <div class="row">
            <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 m_f_tlt">About DB Electrical</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 m_f_tlt">Company</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 m_f_tlt">Product</div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 m_f_tlt">Account</div>
            <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 m_f_tlt">Trusted & Secure</div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
                We feature the highest quality starters,
                alternators, generators, and electrical parts for your vehicle, boat, watercraft, motorcycle,
                ATV, farm tractor & more. We are dedicated to offering the lowest prices and the absolute best service.
            </div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
                <a href = "<?php echo base_url();?>front/about">About</a ><br>
                <a href = "<?php echo base_url();?>front/reviews">Reviews</a ><br>
                <a href = "<?php echo base_url();?>front/returns">Returns & Warranty</a ><br>
                <a href = "<?php echo base_url();?>front/contact">Contact</a ><br>
                <a href = "<?php echo base_url();?>front/faq">FAQ`s</a ><br>
                <a href = "<?php echo base_url();?>front/policies">Policies</a ><br>
            </div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
                <a href = "<?php echo base_url();?>front/shop_bycategories">Shop by categories</a ><br>
                <a href = "<?php echo base_url();?>front/shop_byadvanced">Advanced part finder</a ><br>
                <a href = "<?php echo base_url();?>front/cart">Cart</a ><br>
                <a href = "<?php echo base_url();?>front/checkout">Checkout</a ><br>
            </div>
            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2">
                <a href = "<?php echo base_url();?>front/u_account_settings">Account</a ><br>
                <a href = "<?php echo base_url();?>front/u_addresses">Address</a ><br>
                <a href = "<?php echo base_url();?>front/u_orders">Order Status</a ><br>
                <a href = "<?php echo base_url();?>front/u_recently_iewed">Recently Viewd</a ><br>
                <?php if ( !is_user_login() ) { ?>
                <a href = "<?php echo base_url();?>front/login">Login</a ><br>
                <a href = "<?php echo base_url();?>front/l_signup">Register</a ><br>
                <?php } else { ?>
                <a href = "<?php echo base_url();?>front/logout">Logout</a ><br>
                <?php }?>
            </div>
            <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
                <img class="m_f_p_logo" src="<?= base_url();?>assets/frontend/lib/img/icons/paypal-logo.png" />
            </div>
        </div>
        <div class="m_f_b_tlt">
            <!--
            If you have any questions, we are here to help! Call (1)122-912 or  Send an Email <br>
            © 2018 DB Electrical All Rights Reserved.
            -->
        </div>
    </div>
</div>

<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '3545437c-115a-4e91-855c-c770b205380c', f: true }); done = true; } }; })();</script>

    </body>
</html>
