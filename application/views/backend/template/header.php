<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 3/3/2018
 * Time: 6:05 PM
 */
?>
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
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/custom/css/mytree.css">
    <link rel="stylesheet" type="text/css" media="screen" href="<?= base_url();?>assets/backend/custom/css/backend.css">

    <!-- multiselect -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

    <!-- single sezrch select -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />

    <?php echo '<script type="text/javascript">var BASE_URL = "'.base_url().'";</script>'; ?>

</head>

<body class="">

<!-- HEADER -->
<header id="header">
    <div id="logo-group">
        <a href="<?= base_url();?>front/"><span id="logo"> <img src="<?= base_url();?>assets/backend/lib/img/logo.png" alt="SmartAdmin"> </span></a>
    </div>

    <!-- Recet Order Info -->
    <div class="project-context hidden-xs">
        <span class="project-selector dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user b_recent_user_i"></i><b class="badge b_recent_user_cnt_b"> &nbsp;5&nbsp; </b></span>
        <ul class="dropdown-menu">
            <li><a href="javascript:void(0);">Order1</a></li>
            <li><a href="javascript:void(0);">Order2</a></li>
            <li><a href="javascript:void(0);">Order3</a></li>
            <li><a href="javascript:void(0);">Order4</a></li>
            <li><a href="javascript:void(0);">Order5</a></li>
            <li class="divider"></li>
            <li>
                <a href="javascript:void(0);"><i class="fa fa-power-off"></i> Close</a>
            </li>
        </ul>
    </div>

    <div class="pull-right">
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- Top menu profile link : this shows only when top menu is active -->
        <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
            <li class="">
                <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                    <img src="<?= base_url();?>assets/backend/lib/img/avatars/sunny.png" alt="John Doe" class="online" />
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= base_url();?>admin/login" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span> <a href="<?= base_url();?>admin/login" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
        </div>

        <!-- input: search field -->
        <form action="search.html" class="header-search pull-right">
            <input id="search-fld"  type="text" name="param" placeholder="Find reports and more" data-autocomplete='[
					"ActionScript",
					"AppleScript",
					"Scheme"]'>
            <button type="submit">
                <i class="fa fa-search"></i>
            </button>
            <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
        </form>

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
    </div>

</header>
<!-- END HEADER -->

