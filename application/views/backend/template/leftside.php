<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 3/3/2018
 * Time: 6:06 PM
 */
?>
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">
    <!-- User info -->
    <div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as it -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
<!--						<img src="--><?//= base_url();?><!--assets/backend/lib/img/avatars/sunny.png" alt="me" class="online" />-->
						<span>
							<?= $_SESSION["email"];?>
						</span>
<!--						<i class="fa fa-angle-down"></i>-->
					</a>
				</span>
    </div>
    <!-- end user info -->
    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
            <li><a href="<?php echo base_url();?>admin"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-lg fa-fw fa-shopping-cart"></i> <span class="menu-item-parent">Product Manage</span></a>
                <ul>
                    <li><a href="<?php echo base_url();?>admin/product_new">New Product</a></li>
                    <li><a href="<?php echo base_url();?>admin/products_all">All Products</a></li>
                    <li><a href="<?php echo base_url();?>admin/product_categories">Categories</a></li>
                    <li><a href="<?php echo base_url();?>admin/product_attributes">Application Items</a></li>
                    <li><a href="<?php echo base_url();?>admin/product_spec_bran_items">Others</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">User Manage</span></a>
                <ul>
                    <li class=""><a href="<?php echo base_url();?>admin/user_add" title="Add User"><span class="menu-item-parent">Add User</span></a></li>
                    <li class=""><a href="<?php echo base_url();?>admin/users_all" title="All Users"><span class="menu-item-parent">All Users</span></a></li>
                    <li class=""><a href="<?php echo base_url();?>admin/user_log" title="User Log"><span class="menu-item-parent">User Log</span></a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url();?>admin/orders"><i class="fa fa-lg fa-fw fa-cube"></i> <span class="menu-item-parent">Orders</span></a></li>
            <li><a href="<?php echo base_url();?>admin/reviews"><i class="fa fa-lg fa-fw fa-desktop"></i> <span class="menu-item-parent">Reviews</span></a></li>
            <li><a href="<?php echo base_url();?>admin/customer_contact"><i class="fa fa-lg fa-fw fa-wechat "></i> <span class="menu-item-parent">Messages</span></a></li>
            <li class="">
                <a href="#" title="Dashboard"><i class="fa fa-lg fa-fw fa-windows"></i> <span class="menu-item-parent">Settings</span></a>
                <ul>
<!--                    <li class=""><a href="--><?php //echo base_url();?><!--admin/setting_general" title="General"><span class="menu-item-parent">General</span></a></li>-->
                    <li class=""><a href="<?php echo base_url();?>admin/setting_payment" title="Payment"><span class="menu-item-parent">Payment</span></a></li>
                    <li class=""><a href="<?php echo base_url();?>admin/setting_shipping_method" title="Payment"><span class="menu-item-parent">Shipping Method</span></a></li>
                    <li class=""><a href="<?php echo base_url();?>admin/setting_import_csv" title="Payment"><span class="menu-item-parent">Import Data</span></a></li>
<!--                    <li class=""><a href="--><?php //echo base_url();?><!--admin/setting_myprofile" title="My Profile"><span class="menu-item-parent">My Profile</span></a></li>-->
                </ul>
            </li>
<!--            <li><a href="--><?php //echo base_url();?><!--admin/chat_manage"><i class="fa fa-lg fa-fw fa-comment-o"></i> <span class="menu-item-parent">Chat</span></a></li>-->
            <li><a href="<?php echo base_url();?>admin/logout"><i class="fa fa-lg fa-fw fa-inbox"></i> <span class="menu-item-parent">Logout</span></a></li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->
