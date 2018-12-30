<?php
include "template/header.php";
include "template/leftside.php";
?>

<div id="main" role="main">

    <div class="b_o_top_div">
        <div class="p_c_sub_tlt">Order List</div>
        <table id="b_o_order_list_table" class="table table-striped table-bordered table-hover" width="100%">
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
       if ( isset($orders) && count($orders) > 0 ) {
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
           }
       } else {
           echo 'There are not any order yet...';
       }
       ?>
        </tbody>
    </table>
    </div>

</div>

<?php
include "template/footer.php";
?>
