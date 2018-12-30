<?php
include "template/header.php";
?>
<div class="container_row">
    <div class="ep_tabs">
        <a class="ep_tabs_a_active" href="<?php echo base_url();?>front/u_orders">Orders</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_messages">Messages</a>-->
        <a href="<?php echo base_url();?>front/u_addresses">Addresses</a>
<!--        <a href="--><?php //echo base_url();?><!--front/u_wish_lists">Wish Lists</a>-->
        <a href="<?php echo base_url();?>front/u_recently_iewed">Recently Viewed</a>
        <a href="<?php echo base_url();?>front/u_account_settings">Account Settings</a>
    </div>
    <div class="ep_cnts">

        <?php if ( isset($orders) && count($orders) > 0 ) { ?>
            <table class="table table-striped table-bordered table-hover" width="100%">
                <thead>
                <tr>
                    <th>NO</th>
                    <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Order Date</th>
                    <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                    <th><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Phone</th>
                    <th>Company</th>
                    <th>Shipping Method</th>
                    <th>Grand Total Price</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for ($i = 0; $i < count($orders); $i++) {
                    $paid = "";
                    if ($orders[$i]["is_paid"] == "1") $paid = "paid";
                    echo '<tr>
                            <td>' . ($i + 1) . '</td>
                            <td>' . $orders[$i]["order_date"] . '</td>
                            <td>' . $orders[$i]["first_name"] . '&nbsp;' . $orders[$i]["last_name"] . '</td>
                            <td>' . $orders[$i]["phone"] . '</td>
                            <td>' . $orders[$i]["company"] . '</td>
                            <td>' . $orders[$i]["s_title"] . '</td>
                            <td>' . (floatval($orders[$i]["subtotal"]) + floatval($orders[$i]["s_price"])) . '</td>
                            <td class="g_green_txt">' . $paid . '</td>
                        </tr>';
                } ?>
                </tbody>
            </table>
            <?php
            } else {
                echo '<div class="f_u_alert">
                You have not placed any orders with us. When you do, their status will appear on this page.
                </div>';
            }
            ?>
    </div>
</div>

<?php
include "template/footer.php";
?>