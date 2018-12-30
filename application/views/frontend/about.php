<?php
include "template/header.php";
?>
    <!--
    <div class="banner">
        <img src="<?php echo base_url();?>assets/frontend/lib/images/banner.png" alt="" />
    </div>
    -->
    <div class="container_row">
        <!-- search box -->
        <div class="f_search_top_box_div f_t_search">
            <input type="text" class="f_shop_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
            <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" class="f_shop_s_btn" />
            <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a>
            <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
        </div>
        <div class="f_t_tlt">About Us</div>
        <div class="f_t_cnt f_abt_cnt_dv">
            This site is dedicated to the quality products manufactured by Leece Neville -Prestolite Electric, Delco Remy, Denso, Lester Electrical Chargers,  Full river, Motobatt & Trojan Batteries. We are an authorized warehouse distributor of Leece Neville, Delco Remy, Denso and an authorized dealer for Trojan Battery and quite proud of it
            We also offer aftermarket starters & Alternators
            <br><br>
            We are a full service starter-alternator-generator sales & service facility. Also we offer related electrical parts. We have been in business since 1980. We are a leading supplier to local clients and have built a trusting and lasting relationship with 100's of customers. We are now offering you our products and services on-line and hope to build a relationship with each and every new customer. And for all our loyal customers take a look and see more of what we have to offer.
            If you are looking for new or wish to have your unit rebuilt, We can help.  Let my 35 years in the rotating electrics business help you with quality products and service.
            <p><b>Thank you, Dave Fellows -Owner</b></p>

        </div>
    </div>
<?php
include "template/footer.php";
?>