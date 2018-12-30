<?php
include "template/header.php";
?>
<div class="container_row">
    <div class="ep_tabs">
        <a href="<?php echo base_url();?>front/u_orders">Orders</a>
        <a href="<?php echo base_url();?>front/u_messages">Messages</a>
        <a href="<?php echo base_url();?>front/u_addresses">Addresses</a>
        <a class="ep_tabs_a_active" href="<?php echo base_url();?>front/u_wish_lists">Wish Lists</a>
        <a href="<?php echo base_url();?>front/u_recently_iewed">Recently Viewed</a>
        <a href="<?php echo base_url();?>front/u_account_settings">Account Settings</a>
    </div>
    <div class="ep_cnts">
        Orders
    </div>
</div>

<?php
include "template/footer.php";
?>