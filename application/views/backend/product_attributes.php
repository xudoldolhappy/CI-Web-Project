<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <div class="p_c_top_div row">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 p_c_sub_div">
            <div class="p_c_sub_tlt">advanced part finder</div> <br>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-sm-6 col-lg-3">
                    <div class="p_a_cnt_div">
                        <div class="p_a_sub_tlt">Make</div>
                        <div class="p_a_add_div">
                            <input type="text" class="p_a_add_ipt" id="p_a_make_ipt" />
                            <div class="btn btn-sm btn-primary" id="p_a_make_btn"><span class="fa fa-plus"></span></div>
                        </div>
                        <div class="p_a_sub_cnt" id="p_a_makes">
                        <?php
                        for ( $i = 0; $i < count($makes); $i ++ )
                            echo '<div class="p_a_node p_a_n_make" did="'.$makes[$i]["id"].'">
                                    <button class="btn btn-xs btn-default p_a_make_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-xs btn-default p_a_make_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>&nbsp;&nbsp;
                                    '.$makes[$i]["title"].'
                                  </div>';
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-sm-6 col-lg-3">
                    <div class="p_a_cnt_div">
                        <div class="p_a_sub_tlt">Type</div>
                        <div class="p_a_add_div">
                            <input type="text" class="p_a_add_ipt" disabled id="p_a_type_ipt" />
                            <div class="btn btn-sm btn-primary" id="p_a_type_btn"><span class="fa fa-plus"></span></div>
                        </div>
                        <div class="p_a_sub_cnt" id="p_a_types"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2 col-sm-6 col-lg-2">
                    <div class="p_a_cnt_div">
                        <div class="p_a_sub_tlt">Model</div>
                        <div class="p_a_add_div">
                            <input type="text" class="p_a_add_ipt" disabled id="p_a_model_ipt" />
                            <div class="btn btn-sm btn-primary" id="p_a_model_btn"><span class="fa fa-plus"></span></div>
                        </div>
                        <div class="p_a_sub_cnt" id="p_a_models"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2 col-sm-6 col-lg-2">
                    <div class="p_a_cnt_div">
                        <div class="p_a_sub_tlt">Year</div>
                        <div class="p_a_add_div">
                            <input type="text" class="p_a_add_ipt" disabled id="p_a_year_ipt" />
                            <div class="btn btn-sm btn-primary" id="p_a_year_btn"><span class="fa fa-plus"></span></div>
                        </div>
                        <div class="p_a_sub_cnt" id="p_a_years"></div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-2 col-sm-6 col-lg-2">
                    <div class="p_a_cnt_div">
                        <div class="p_a_sub_tlt">Engine</div>
                        <div class="p_a_add_div">
                            <input type="text" class="p_a_add_ipt" disabled id="p_a_engine_ipt" />
                            <div class="btn btn-sm btn-primary" id="p_a_engine_btn"><span class="fa fa-plus"></span></div>
                        </div>
                        <div class="p_a_sub_cnt" id="p_a_engines"></div>
                    </div>
                </div>
                <!--
                <div class="col-xs-12 col-md-4 col-sm-6 col-lg-2">
                    <div class="p_a_cnt_div">
                        <div class="p_a_sub_tlt">Option</div>
                        <div class="p_a_add_div">
                            <input type="text" class="p_a_add_ipt" disabled id="p_a_option_ipt" />
                            <div class="btn btn-sm btn-primary" id="p_a_option_btn"><span class="fa fa-plus"></span></div>
                        </div>
                        <div class="p_a_sub_cnt" id="p_a_options"></div>
                    </div>
                </div>
                -->
            </div>
        </div>
    </div>

</div>

<?php
include "template/footer.php";
?>
