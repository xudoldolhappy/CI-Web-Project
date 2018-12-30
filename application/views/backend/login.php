<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

    <title> STATER </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/font-awesome.min.css">
    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/smartadmin-skins.min.css">
    <!-- SmartAdmin RTL Support  -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/smartadmin-rtl.min.css">
    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/lib/css/demo.min.css">
    <!-- FAVICONS -->
    <link rel="shortcut icon" href="<?= base_url();?>assets/backend/lib/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= base_url();?>assets/backend/lib/img/favicon/favicon.ico" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="<?= base_url();?>assets/backend/lib/img/splash/sptouch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url();?>assets/backend/lib/img/splash/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= base_url();?>assets/backend/lib/img/splash/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= base_url();?>assets/backend/lib/img/splash/touch-icon-ipad-retina.png">
    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="<?= base_url();?>assets/backend/lib/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="<?= base_url();?>assets/backend/lib/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="<?= base_url();?>assets/backend/lib/img/splash/iphone.png" media="screen and (max-device-width: 320px)">

    <!-- custom style sheet -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/custom/css/global.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/custom/css/backend.css">

    <?php echo '<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>'; ?>

</head>

<body class="">

<div id="main" role="main" class="l_top_div">
    <div class="l_top_tlt">admin login</div>
    <div class="l_alert_cnt"><?php if ( isset($alert) ) echo $alert;?></div>
    <form id="checkout-form" class="smart-form" novalidate="novalidate" method="post" action="<?= base_url();?>admin/login_confirm">
        <fieldset>
            <div class="row">
                <section class="col col-10 l_sec">
                    <label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
                        <input type="text" name="email" placeholder="E-mail">
                    </label>
                </section>
            </div>

            <div class="row">
                <section class="col col-10 l_sec">
                    <label class="input"> <i class="icon-prepend fa fa-key"></i>
                        <input type="password" name="password" placeholder="Password">
                    </label>
                </section>
            </div>
        </fieldset>
        <footer>
            <button type="submit" class="btn btn-primary l_login_btn">
                login
            </button>
        </footer>
    </form>
</div>
<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url();?>assets/backend/lib/js/plugin/pace/pace.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="<?= base_url();?>assets/backend/lib/js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="<?= base_url();?>assets/backend/lib/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>
<script src="<?= base_url();?>assets/backend/lib/js/app.config.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/notification/SmartNotification.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/smartwidgets/jarvis.widget.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/select2/select2.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/fastclick/fastclick.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/demo.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/app.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/speech/voicecommand.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/smart-chat-ui/smart.chat.manager.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/moment/moment.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>

<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.fillbetween.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.orderBar.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.pie.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

<!-- table plugins -->
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<script type="text/javascript">
    jQuery(function() {
        var errorClass = 'invalid';
        var errorElement = 'em';
        var $checkoutForm = $('#checkout-form').validate({
            errorClass		: errorClass,
            errorElement	: errorElement,
            highlight: function(element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function(element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },
            // Rules for form validation
            rules : {
                email : {
                    required : true,
                    email : true
                },
                password : {
                    required : true
                }
            },
            // Messages for form validation
            messages : {
                email : {
                    required : 'Please enter your email address',
                    email : 'Please enter a VALID email address'
                },
                password : {
                    required : 'Please enter your password'
                }
            },
            errorPlacement : function(error, element) {
                error.insertAfter(element.parent());
            }
        });
    })
</script>

</body>

</html>