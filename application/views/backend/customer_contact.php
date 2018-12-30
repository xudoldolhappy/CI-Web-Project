<?php
include "template/header.php";
include "template/leftside.php";
?>

<div id="main" role="main">

    <div class="b_o_top_div">
        <div class="p_c_sub_tlt">Customer Contact List</div>
        <table id="b_r_message_list_table" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
            <tr>
                <th>NO</th>
                <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>Date</th>
                <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Customer Name</th>
                <th><i class="fa fa-fw fa-mail text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
                <th><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Phone</th>
                <th>Company Name</th>
                <th>Order Number</th>
                <th>RMA Number</th>
                <th style="width: 32%;">Comment</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ( isset($contacts) && count($contacts) > 0 ) {
                for ($i = 0; $i < count($contacts); $i++) {
                    $is_reply = $contacts[$i]["reply_user"];
                    $state = '<button class="btn btn-xs btn-default b_c_c_reply_btn" data-original-title="Edit Row" 
                                email="' . $contacts[$i]["email"] . '"
                                did="'.$contacts[$i]["id"].'">
                                <i class="fa fa-comments-o"></i></button>';
                    if ( isset( $is_reply) && $is_reply != "" && $is_reply != null && $is_reply != "0" )
                        $state = '<img src="'.base_url().'assets/frontend/lib/img/icons/check.png" class="b_c_c_confirm_img" />';
                    echo '<tr class="g_cusor_pointer" title="'.$contacts[$i]["commment"].'">
                        <td>' . ($i + 1) . '</td>
                        <td>' . $contacts[$i]["date"] . '</td>
                        <td>' . $contacts[$i]["first_name"] . '</td>
                        <td>' . $contacts[$i]["email"] . '</td>
                        <td>' . $contacts[$i]["phone"] . '</td>
                        <td>' . $contacts[$i]["company"] . '</td>
                        <td>' . $contacts[$i]["order"] . '</td>
                        <td>' . $contacts[$i]["rma"] . '</td>
                        <td>' .substr($contacts[$i]["commment"], 0, 80). '...</td>
                        <td>' . $state . '</td>
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

<!-- ui-dialog -->
<div id="b_c_c_reply_dlg" title="Customer Contact Message Reply">
    <div class="row">
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 b_c_c_r_s_tlt">Customer Email:</div>
        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" id="b_c_c_r_email"></div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 b_c_c_r_s_tlt">Reply Message:</div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <textarea class="g_ipt" rows="8" id="b_c_c_reply_content"></textarea>
        </div>
    </div>
</div>


<?php
include "template/footer.php";
?>
