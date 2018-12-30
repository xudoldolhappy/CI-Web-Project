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
        <div class="f_t_tlt">FAQ</div>
        <div class="f_t_cnt">
            <!--
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />What types of payment do you accept?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    We accept all major credit cards, debit cards, and PayPal. We do not accept personal checks or money orders.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />How soon do I need to pay after checkout?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    Payment must be received by our office within 7 days of your initial checkout.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />How much is shipping?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    Your shipping cost is determined at checkout. Shipping to the continental U.S. is free via UPS Ground.
                    We also offer Next Day Air and 2nd Day Air services for an additional cost. We combine shipping on multiple items to save you money.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />What shipping carriers do you use?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    We use UPS and US Postal Service Priority Mail for our shipping inside the USA. All international shipments are made using UPS.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />When will you ship?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    We make every effort to ship your item the same business day you complete your purchase if it is completed by 2:00 pm
                    Eastern time M-F, all others will go out the next business day.
                    We will send an email with the tracking number to your registered email address when your package has shipped.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />What is your return policy?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    We accept returns within 14 days of your purchase. Please click here for more details.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />What is your warranty policy?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    Every item we sell is covered by our one year warranty. If you have a problem, we can repair,
                    send you a replacement unit or refund your money. Please click here for more details.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />How do I contact you with a question?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    You can email us at sales@dbelectrical.com or call us toll free at 800-753-2242.
                    Our regular business hours are 8:00-5:00 Eastern time Monday - Friday. We are here to help.
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 h_s_tlt_d g_txt_black">
                    <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/d2.png" />Have technical questions?</div>
            </div>
            <div class="row g_none_dis">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12">
                    Please view the frequently asked questions section below, or send us an email at sales@dbelectrical.com

                    SDR0031 Mini Hi-Torque Chevy Wire Hookup

                    Click here to view Wiring Diagram

                    AMN0002 Mando Alternator Wires

                    The Red wire is 12 Volt all the time, the Purple wire is 12 Volt switched.

                    Brown wire on Winch Motors

                    The Brown wire is for overcrank. Overcrank is not on all winches. If yours doesn't have it, you can disregard or remove the Brown wire.
                </div>
            </div>
           -->
        </div>
    </div>
<?php
include "template/footer.php";
?>