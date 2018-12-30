<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">
    <section id="widget-grid" class="g_main_content">
        <div class="row">
            <article class="col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-1" data-widget-editbutton="false" data-widget-custombutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2><?=(isset($user))?"Update User":"New User";?></h2>
                        <div class="a_is_super_admin">
                            <?php
                            if (isset($user)) {
                                if ( $user->is_superadmin == "1" )
                                    echo "Super Admin";
                            }
                            ?>
                        </div>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="l_alert_cnt"><?php if ( isset($alert) ) echo "<br>".$alert;?></div>
                            <form id="checkout-form" class="smart-form" novalidate="novalidate" method="post" action="<?= base_url();?>admin/add_new_user">
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="fname" placeholder="First name" value="<?php if (isset($user)) echo $user->first_name;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="lname" placeholder="Last name" value="<?php if (isset($user)) echo $user->last_name;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="mname" placeholder="Middle name" value="<?php if ( isset($user) ) echo $user->midlde_name;?>" />
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-8">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="username" placeholder="Username" value="<?php if (isset($user)) echo $user->username;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="select">
                                            <select name="gender" class="">
                                                <option value="0" selected="" disabled="">Sex</option>
                                                <option value="1" <?php if (isset($user) ) if ( $user->gender == "1" ) echo "selected";?>>Male</option>
                                                <option value="2" <?php if (isset($user) ) if ( $user->gender == "2" ) echo "selected";?>>Female</option>
                                            </select> <i></i> </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-8">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="company" placeholder="Company" value="<?php if (isset($user) ) echo $user->company;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="birthday" id="u_birthday" placeholder="Birthday" value="<?php if (isset($user) ) echo $user->birthday;?>" />
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                                <input type="password" name="password" placeholder="Password" value="<?php if (isset($user) ) echo $user->password;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-prepend fa fa-key"></i>
                                                <input type="password" name="cpassword" placeholder="Confirm Password" value="<?php if (isset($user) ) echo $user->password;?>" />
                                            </label>
                                        </section>
                                    </div>


                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                                                <input type="email" name="email" placeholder="E-mail" value="<?php if (isset($user) ) echo $user->email;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="tel" name="phone" placeholder="Phone" data-mask="(999) 999-9999" value="<?php if (isset($user) ) echo $user->phone;?>" />
                                            </label>
                                        </section>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="select">
                                                <select name="country" class="g_country">
                                                    <option value="0" selected="" disabled="">Country</option>
                                                    <?php for ( $i = 0; $i < count($countries); $i ++ ) {
                                                        if ( $user->country == $countries[$i]["iso"] ) echo '<option value="'.$countries[$i]["iso"].'" selected>'.$countries[$i]["nicename"].'</option>';
                                                       else echo '<option value="'.$countries[$i]["iso"].'">'.$countries[$i]["nicename"].'</option>';
                                                    } ?>
                                                </select> <i></i> </label>
                                        </section>

                                        <section class="col col-6">
                                            <label class="select">
                                                <select name="state" class="g_state">
                                                    <option value="0" selected="" disabled="">State</option>
                                                    <?php
                                                    $s_state = $user->state;
                                                    if ( isset($s_state) && $s_state != null && $s_state != "0" && $s_state != "" ){
                                                        for ( $i = 0; $i < count($states); $i ++ ) {
                                                            if ( $s_state == $states[$i]["code"] ) echo '<option value="'.$states[$i]["code"].'" selected>'.$states[$i]["name"].'</option>';
                                                            else echo '<option value="'.$states[$i]["code"].'">'.$states[$i]["name"].'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select> <i></i> </label>
                                        </section>

                                    </div>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                <input type="text" name="address1" placeholder="Address Line1" value="<?php if (isset($user) ) echo $user->address1;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="input"> <i class="icon-prepend fa fa-home"></i>
                                                <input type="text" name="address2" placeholder="Address Line2" value="<?php if (isset($user) ) echo $user->address2;?>" />
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="city" placeholder="City" value="<?php if (isset($user) ) echo $user->city;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="input"> <i class="icon-prepend fa fa-user"></i>
                                                <input type="text" name="zip" placeholder="Zip Code" value="<?php if (isset($user) ) echo $user->zip;?>" />
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="select">
                                                <select name="authority" class="">
                                                    <option value="0" selected="" disabled="">Authority</option>
                                                    <option value="1" <?php if ( isset($user) ) if ( $user->auth == "1" ) echo "selected";?>>Administrator</option>
                                                    <option value="2" <?php if ( isset($user) ) if ( $user->auth == "2" ) echo "selected";?>>Customer</option>
                                                </select> <i></i> </label>
                                        </section>
                                        <input type="hidden" name="did" value="<?php if( isset( $user ) ) echo $user->id;?>" />
                                    </div>
                                    <?php
                                    if( isset( $user ) ) {
                                        $qurl =  'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=otpauth://totp/Starter:'. $user->username
                                            .'?secret='. $user->auth_key.'&issuer=Starter';
                                    ?>
                                    <div class="row">
                                        <section class="col col-1 a_2fa_tlt">
                                            <input type="checkbox" value="1" name="is_2fa" id="is_2fa" <?=($user->is_2fa=="1")?"checked":"";?> /> <label for="is_2fa">Enable 2FA</label>
                                        </section>
                                        <section class="col col-2 a_2fa_qr">
                                            <img src="<?=$qurl;?>" />
                                        </section>
                                        <section class="col col-4 a_2fa_key">
                                            <span><?=$user->auth_key;?> <br><br></span>
                                            <input type="checkbox" value="1" name="is_reset_2fa" id="is_reset_2fa" /> <label for="is_reset_2fa">Reset 2FA</label>
                                        </section>
                                    </div>
                                    <?php } ?>
                                </fieldset>

                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        <?=(isset($user))?"Update User":"Add User";?>
                                    </button>
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>

<?php
include "template/footer.php";
?>

<script type="text/javascript">
    $(document).ready(function() {





    })

</script>
