<?php
include "template/header.php";
include "template/leftside.php";
?>

<div id="main" role="main">

    <div class="b_o_top_div">
        <div class="p_c_sub_tlt">Product Review List</div>
        <table id="b_r_review_list_table" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
            <tr>
                <th>NO</th>
                <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i>Date</th>
                <th>Mark</th>
                <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Customer Name</th>
                <th><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
                <th>Product Name</th>
                <th>Subject</th>
                <th style="width: 40%;">Comment</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ( isset($reviews) && count($reviews) > 0 ) {
                for ($i = 0; $i < count($reviews); $i++) {
                    echo '<tr class="g_cusor_pointer" title="'.$reviews[$i]["comment"].'">
                        <td>' . ($i + 1) . '</td>
                        <td>' . $reviews[$i]["date"] . '</td>
                        <td><img class="b_r_rating_img" src="'.base_url().'assets/frontend/lib/img/icons/r'. $reviews[$i]["rating"].'.png" /></td>
                        <td>' . $reviews[$i]["name"] . '</td>
                        <td>' . $reviews[$i]["email"] . '</td>
                        <td>' . $reviews[$i]["p_name"] . '</td>
                        <td>' . $reviews[$i]["subject"] . '</td>
                        <td>' .substr($reviews[$i]["comment"], 0, 80). '...</td>
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
