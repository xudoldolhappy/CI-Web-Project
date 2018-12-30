<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <div class="p_c_top_div row">
        <div class="col-xs-12 col-md-4 col-sm-4 col-lg-4">
            <div class="p_c_sub_tlt">Product Spec Items</div> <br>
            <div class="p_c_sub_div">
                <div class="p_a_add_div">
                    <input type="text" class="p_a_add_ipt" id="p_s_b_spec_ipt" />
                    <div class="btn btn-sm btn-primary" id="p_s_b_spec_btn"><span class="fa fa-plus"></span></div>
                </div>
                <div class="p_a_sub_cnt">
                    <?php
                    for ( $i = 0; $i < count($spces); $i ++ )
                        echo '<div class="p_a_node p_a_n_make" did="'.$spces[$i]["id"].'">
                                    <button class="btn btn-xs btn-default p_s_b_spec_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default p_s_b_spec_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;
                                    '.$spces[$i]["title"].'
                                  </div>';
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 col-sm-4 col-lg-4">
            <div class="p_c_sub_tlt">Replacement Brand Items</div> <br>
            <div class="p_c_sub_div">
                <div class="p_a_add_div">
                    <input type="text" class="p_a_add_ipt" id="p_s_b_brand_ipt" />
                    <div class="btn btn-sm btn-primary" id="p_s_b_brand_btn"><span class="fa fa-plus"></span></div>
                </div>
                <div class="p_a_sub_cnt">
                    <?php
                    for ( $i = 0; $i < count($brands); $i ++ )
                        echo '<div class="p_a_node p_a_n_make" did="'.$brands[$i]["id"].'">
                                    <button class="btn btn-xs btn-default p_s_b_brand_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default p_s_b_brand_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;
                                    '.$brands[$i]["title"].'
                                  </div>';
                    ?>
                </div>
            </div>
        </div>
        <!-- Service Part Items Manage -->
        <div class="col-xs-12 col-md-4 col-sm-4 col-lg-4">
            <div class="p_c_sub_tlt">Service Part Items</div> <br>
            <div class="p_c_sub_div">
                <div class="p_a_add_div">
                    <input type="text" class="p_a_add_ipt" id="p_s_b_service_part_ipt" />
                    <div class="btn btn-sm btn-primary" id="p_s_b_service_part_btn"><span class="fa fa-plus"></span></div>
                </div>
                <div class="p_a_sub_cnt">
                    <?php
                    for ( $i = 0; $i < count($services); $i ++ )
                        echo '<div class="p_a_node p_a_n_make" did="'.$services[$i]["id"].'">
                                    <button class="btn btn-xs btn-default p_s_b_service_part_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default p_s_b_service_part_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;
                                    '.$services[$i]["title"].'
                                  </div>';
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include "template/footer.php";
?>
