<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <?php $p = $info["product"];?>
    <div class="p_c_top_div row">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 p_c_sub_div">
            <div class="p_c_sub_tlt">add new product
                <a href="#" class="btn btn-primary <?php if(!isset($p)) echo "g_non_dis";?> p_n_remove_btn p_n_btn">Remove</a>
                <a href="#" class="btn btn-primary p_n_publish_btn p_n_btn">Publish</a>
                <a href="<?= base_url();?>admin/product_new" class="btn btn-primary p_n_btn">New Product</a></div> <br>
            <input type="hidden" value="<?php if ( isset($did) ) echo $did;?>" id="p_n_did" />
            <input type="hidden" value="0" id="product_add_is_application_update" />
            <div class="row">
                <div class="col-xs-push-0 col-md-3 col-sm-3 col-lg-3 p_n_sub_div">
                    <div class="p_a_sub_tlt">Produc categories</div>
                    <div class="p_n_c_div">
                    <?php
                    $c = $info["products_categories"];
                    for ( $i = 0; $i < count($list); $i ++ ) {
                        $pmo = "mytree_open"; if ( $i != 0 ) $pmo = "";
                        $check = "";
                        if ( isset($c) ) {
                            for ( $k = 0; $k < count($c); $k ++ ) {
                                if ( $c[$k]["category"] == $list[$i]["id"] ) {
                                    $check = "checked";
                                }
                            }
                        }
                        echo '<div class="my_tree_node my_tree_'.$list[$i]["level"].' my_tree_id_'.$list[$i]["parent_id"].'">
                                    <div class="my_tree_icon '.$pmo.'" level="'.$list[$i]["level"].'"></div>
                                    <div class="my_tree_cnt my_tree_check" did="'.$list[$i]["id"].'">
                                        <input type="checkbox" class="my_tree_checkbox" '.$check.'/>
                                        '.$list[$i]["title"].'</div>
                              </div>';
                    }
                    ?>
                    </div>
                </div>
                <div class="col-xs-12 col-md-9 col-sm-9 col-lg-9">
                    <div class="p_n_sub_div">
                        <div class="p_a_sub_tlt">Produc Info</div>
                        <input type="text" class="g_ipt p_n_ipt" id="p_n_code" placeholder="Product ID" value="<?php if(isset($p)) echo $p->code;?>" />
                        <input type="text" class="g_ipt p_n_ipt" id="p_n_quanity" placeholder="Quanity" value="<?php if(isset($p)) echo $p->quanity;?>" />
                        <input type="checkbox" id="p_n_favorite_check" <?php if(isset($p) && $p->favorite == "1" ) echo "checked"; ?> /> <label for="p_n_favorite_check">Favorite Prduct</label>
                        <input type="text" class="g_ipt p_n_ipt" id="p_n_name" placeholder="Product Name" value="<?php if(isset($p)) echo $p->name;?>" />
                        <input type="text" class="g_ipt p_n_ipt" id="p_n_reference" placeholder="Product Reference" value="<?php if(isset($p)) echo $p->reference;?>" />

                        <div class="form-group">
                            <input type="text" name="txtCountry" id="p_n_alternative_products" class="typeahead g_ipt p_n_ipt" placeholder="Enter altenative or recommended product and Select one"
                                   value="<?php if (isset($info["alternative"])) echo $info["alternative"];?>" />
                            <!--
                            <select id="p_n_realted_products" multiple class="form-control" >
                            <?php
                            $alter = $info["alternative"];
                            for ( $i = 0; $i < count( $products); $i ++ )
                            {
                                if ( $p->id == $products[$i]["id"] ) continue;
                                $alter_sel = "";
                                for ( $k = 0; $k < count($alter); $k ++ ) {
                                    if ( $products[$i]["id"] == $alter[$k]["alternative"] ) $alter_sel = "selected";
                                }
                                echo '<option value="'.$products[$i]["id"].'" '.$alter_sel.'>'.$products[$i]["name"].'&nbsp;:&nbsp;'.$products[$i]["code"].'</option>';
                            }
                            ?>
                            </select>
                            -->
                        </div>

                        <div class="p_n_stlt">Product Short Description</div>
                        <textarea class="g_ipt p_n_ipt" id="p_n_short_description" rows="3"><?php if(isset($p)) echo $p->short_description;?></textarea>
                        <div class="p_n_stlt">Product Description</div>
                        <textarea class="g_ipt p_n_ipt" id="p_n_description" rows="10"><?php if(isset($p)) echo $p->description;?></textarea>
                        <div id="tabs">
                            <ul>
                                <li><a href="#p_n_t_images">Product Images</a></li>
                                <li><a href="#p_n_t_general">General</a></li>
                                <li><a href="#p_n_t_shipping">Shipping</a></li>
                                <li><a href="#p_n_t_attribute" id="product_add_application">Application</a></li>
                                <li><a href="#p_n_t_replacement_list">Repacement List</a></li>
                                <li><a href="#p_n_t_advanced">Product Spec</a></li>
                                <li><a href="#p_n_t_service_parts">Service Parts</a></li>
                            </ul>
                            <div id="p_n_t_images">
                                <?php
                                $i = $info["image"];
                                $iu = base_url()."assets/backend/lib/img/product_new.jpg";
                                $iv = "product_new.jpg";
                                if ( isset($i) && count($i) > 0 ) {
                                    if ( $i[0] != "" ) {
                                        $iu = base_url()."uploads/pcategories/".$i[0]["filename"];
                                        $iv = $i[0]["filename"];
                                    }
                                }
                                ?>
                                <div class="row">
                                    <!-- fetured main image -->
                                    <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">
                                        <br><img src="<?= $iu;?>" class="p_n_photo" id="p_n_img" />
                                    </div>
                                    <!-- product gallery images -->
                                    <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">
                                        <div class="p_a_gallery_tlt">Product gallery</div>
                                        <div class="">
                                            <?php
                                            if ( isset($k) ) {
                                                for ( $k = 1; $k < count($i); $k ++ ) {
                                                    echo '<div class="p_a_g_p_div" photo="'.$i[$k]["filename"].'">
                                                            <img src="'.base_url().'uploads/pcategories/'.$i[$k]["filename"].'" />
                                                            <button class="btn btn-xs btn-default p_a_gallery_img_remove" data-original-title="Cancel">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>';
                                                }
                                            }
                                            ?>
                                            <div class="p_a_g_p_div" photo="">
                                                <img src="<?= base_url();?>assets/backend/lib/img/add_Image.png" id="p_a_add_gallery_image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_open_multipart('admin/user_photo_upload');?>
                                <input type="file" name="image" size="20" id="ep_photo_upload_ipt" class="g_non_dis" />
                                <input type="submit" value="upload" id="ep_photos_submit" is_gallery="" class="g_non_dis" />
                                </form>
                                <input type="hidden" id="p_n_p_image" value="<?= $iv;?>" />
                            </div>
                            <div id="p_n_t_general">
                                <br><div class="row">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Regular Price ( $usd ) :</div>
                                    <div class="col-xs-9 col-md-9 col-sm-9 col-lg-9"><input type="text" class="g_ipt" id="p_n_regular_price" value="<?php if(isset($p)) echo $p->regular_price;?>" /></div>
                                </div>
                                <br><div class="row">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Sale Price ( $usd ) :</div>
                                    <div class="col-xs-9 col-md-9 col-sm-9 col-lg-9"><input type="text" class="g_ipt" id="p_n_sale_price" value="<?php if(isset($p)) echo $p->sale_price;?>" /></div>
                                </div>
                                <br><div class="row">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Core Fee ( $usd ) :</div>
                                    <div class="col-xs-9 col-md-9 col-sm-9 col-lg-9"><input type="text" class="g_ipt" id="p_n_core_fee" value="<?php if(isset($p)) echo $p->core_fee;?>" /></div>
                                </div>
                                <br><div class="row">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Sale price start dates :</div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                        <input type="text" class="g_ipt" id="startdate" placeholder="Expected start date" class="hasDatepicker" value="<?php if(isset($p)) echo $p->start_date;?>" />
                                    </div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Sale price expire dates :</div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                        <input type="text" class="g_ipt" id="finishdate" placeholder="Expected start date" class="hasDatepicker" value="<?php if(isset($p)) echo $p->end_date;?>" />
                                    </div>
                                </div><br><br><br><br>
                            </div>
                            <div id="p_n_t_shipping">
                                <br><div class="row">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Weight ( kg ) :</div>
                                    <div class="col-xs-9 col-md-9 col-sm-9 col-lg-9"><input type="text" class="g_ipt" id="p_n_weight" value="<?php if(isset($p)) echo $p->weight;?>" /></div>
                                </div>
                                <br><div class="row">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Dimensions ( cm )  :</div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3"><input type="text" class="g_ipt" id="p_n_length" placeholder="Length" value="<?php if(isset($p)) echo $p->length;?>" /></div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3"><input type="text" class="g_ipt" id="p_n_width" placeholder="Width" value="<?php if(isset($p)) echo $p->width;?>" /></div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3"><input type="text" class="g_ipt" id="p_n_height" placeholder="Height" value="<?php if(isset($p)) echo $p->height;?>" /></div>
                                </div><br><br><br><br>
                            </div>
                            <div id="p_n_t_attribute">
                                <!-- import replacement list from csv file -->
                                <div class="row">
                                    <div class="col-xs-12 col-md-7 col-sm-7 col-lg-7">
                                        <div class="p_a_app_alert g_non_dis">
                                            <i class="fa fa-gear fa-4x fa-spin"></i>Loading application list...
                                        </div></div>
                                    <div class="col-xs-12 col-md-5 col-sm-5 col-lg-5 g_txt_right">
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" id="p_n_get_application__csv_btn">
                                            <span class="btn-label"><i class="glyphicon glyphicon-camera"></i></span>Import Application List CSV</a>
                                    </div>
                                    <br>
                                    <form id="upload_application_csv" method="post" enctype="multipart/form-data" class="g_non_dis">
                                        <input type="file" name="application_file" style="margin-top:15px;" id="p_n_get_application_csv_file" />
                                        <input type="submit" name="upload" id="p_n_get_application_csv_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                                    </form>
                                </div>
                                <div class="row p_a_app_header">
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">Make</div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-2">Type</div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-2">Model</div>
                                    <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">Year</div>
                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-2 p_a_no_r_bor">Engine</div>
                                    <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1 p_a_no_r_bor"></div>
                                </div>
                                <!-- display replacement list saved db already -->
                                <div class="p_n_app_list_cnt_div">
                                    <div class="row p_a_app_cnt">
                                        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                            <select class="g_ipt p_n_att_make">
                                                <option value="0" disabled selected>--make--</option>
                                                <?php
                                                for ( $i = 0; $i < count($makes); $i ++ ) {
                                                    $sel = ""; if ( $p->a_make == $makes[$i]["id"] ) $sel = "selected";
                                                    echo '<option value="'.$makes[$i]["id"].'" '.$sel.'>'.$makes[$i]["title"].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
                                            <select class="g_ipt p_n_att_type">
                                                <option value="0" disabled selected>--type--</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
                                            <select class="g_ipt p_n_att_model">
                                                <option value="0" disabled selected>--model--</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
                                            <select class="g_ipt p_n_att_year">
                                                <option value="0" disabled selected>--year--</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
                                            <select class="g_ipt p_n_att_engine">
                                                <option value="0" disabled selected>--engine--</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1 pa_app_edit_btn_div">
                                            <div class="btn btn-sm btn-primary pa_app_btn" id="pa_add_new_app_item"><span class="fa fa-plus"></span></div>
<!--                                            <button class="btn btn-default txt-color-blueLight p_a_app_add_btn"><i class="glyphicon fa-plus-square"></i></button>-->
                                        </div>
                                    </div>
                                </div>
                                <br><br><br><br>
                            </div>

                            <!-- Replacement Brand -->
                            <div id="p_n_t_replacement_list">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 g_txt_right">
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" id="p_n_get_csv_btn">
                                            <span class="btn-label"><i class="glyphicon glyphicon-camera"></i></span>Import Replacement Brand CSV</a>
                                    </div>
                                    <br>
                                    <form id="upload_csv" method="post" enctype="multipart/form-data" class="g_non_dis">
                                        <input type="file" name="employee_file" style="margin-top:15px;" id="p_n_get_csv_file" />
                                        <input type="submit" name="upload" id="p_n_get_csv_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                                    </form>
                                </div>
                                <div class="p_n_r_l_custom">
                                    <?php
                                    $rb = $info["replacement_brands"];
                                    if ( isset($rb) ) {
                                        for ( $i = 0; $i < count($rb); $i ++ ) {
                                            echo '<div class="row p_n_r_l_top_row">
                                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                                        <select class="g_ipt p_n_c_brand">
                                                            <option value="0" disabled>--Product Spec--</option>';
                                                    for ( $k = 0; $k < count( $brands); $k ++ ) {
                                                        $selected = ""; if ( $brands[$k]["id"] == $rb[$i]["brand"] ) $selected = "selected";
                                                        echo '<option value="'.$brands[$k]["id"].'" '.$selected.'>'.$brands[$k]["title"].'</option>';
                                                    }
                                                    echo '</select>
                                                            </div>
                                                            <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">
                                                                <input type="text" class="g_ipt p_n_c_value" value="'.$rb[$i]["value"].'" /></div>
                                                            <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
                                                                <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
                                                            </div>
                                                        </div>';
                                        }
                                    }
                                    ;?>
                                    <div class="row p_n_r_l_top_row">
                                        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                            <select class="g_ipt p_n_c_brand">
                                                <option value="0" disabled selected>--Replacement Brand--</option>
                                                <?php
                                                for ( $i = 0; $i < count($brands); $i ++ ) {
                                                    echo '<option value="'.$brands[$i]["id"].'">'.$brands[$i]["title"].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt p_n_c_value" /></div>
                                        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
                                            <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="p_n_r_l_new_custom">Add new custom filed</div>
                                <br><br><br><br>
                            </div>

                            <!-- product spec -->
                            <div id="p_n_t_advanced">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 g_txt_right">
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" id="p_s_get_csv_btn">
                                            <span class="btn-label"><i class="glyphicon glyphicon-camera"></i></span>Import Product Spec CSV</a>
                                    </div>
                                    <br>
                                    <form id="upload_product_spec_csv" method="post" enctype="multipart/form-data" class="g_non_dis">
                                        <input type="file" name="productspec_file" style="margin-top:15px;" id="p_s_get_csv_file" />
                                        <input type="submit" name="upload" id="p_s_get_csv_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                                    </form>
                                </div>
                                <div class="p_n_t_custom">
                                    <?php
                                    $a = $info["product_advances"];
                                    if ( isset($a) ) {
                                        for ( $i = 0; $i < count($a); $i ++ ) {
                                            echo '<div class="row p_n_c_top_row">
                                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                                        <select class="g_ipt p_n_c_spec">
                                                            <option value="0" disabled>--Product Spec--</option>';
                                                        for ( $k = 0; $k < count( $specs); $k ++ ) {
                                                            $selected = ""; if ( $specs[$k]["id"] == $a[$i]["spec"] ) $selected = "selected";
                                                            echo '<option value="'.$specs[$k]["id"].'" '.$selected.'>'.$specs[$k]["title"].'</option>';
                                                        }
                                                 echo '</select>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">
                                                        <input type="text" class="g_ipt p_n_c_value" value="'.$a[$i]["value"].'" /></div>
                                                    <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
                                                        <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
                                                    </div>
                                                </div>';
                                        }
                                    }
                                    ;?>
                                    <div class="row p_n_c_top_row">
                                        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                            <select class="g_ipt p_n_c_spec">
                                                <option value="0" disabled selected>--Product Spec--</option>
                                            <?php
                                            for ( $i = 0; $i < count($specs); $i ++ ) {
                                                echo '<option value="'.$specs[$i]["id"].'">'.$specs[$i]["title"].'</option>';
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt p_n_c_value" /></div>
                                        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
                                            <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="p_n_t_new_custom">Add new custom filed</div>
                                <br><br><br><br>
                            </div>

                            <!-- service parts -->
                            <div id="p_n_t_service_parts">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 g_txt_right">
                                        <a href="javascript:void(0);" class="btn btn-labeled btn-primary" id="p_service_parts_get_csv_btn">
                                            <span class="btn-label"><i class="glyphicon glyphicon-camera"></i></span>Import Service Parts CSV</a>
                                    </div>
                                    <br>
                                    <form id="upload_service_parts_csv" method="post" enctype="multipart/form-data" class="g_non_dis">
                                        <input type="file" name="service_parts" style="margin-top:15px;" id="p_service_parts_get_csv_file" />
                                        <input type="submit" name="upload" id="p_service_parts_get_csv_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                                    </form>
                                </div>
                                <div class="p_service_parts_t_custom">
                                    <?php
                                    $a = $info["service_parts"];
                                    if ( isset($a) ) {
                                        for ( $i = 0; $i < count($a); $i ++ ) {
                                            echo '<div class="row p_service_parts_top_row">
                                                    <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                                        <select class="g_ipt p_n_c_service_parts">
                                                            <option value="0" disabled>--Service Part--</option>';
                                                            for ( $k = 0; $k < count( $services); $k ++ ) {
                                                                $selected = ""; if ( $services[$k]["id"] == $a[$i]["service"] ) $selected = "selected";
                                                                echo '<option value="'.$services[$k]["id"].'" '.$selected.'>'.$services[$k]["title"].'</option>';
                                                            }
                                            echo        '</select>
                                                    </div>
                                                    <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">
                                                        <select class="p_n_c_value p_n_service_part_produc_slt" data-show-subtext="true" data-live-search="true"><!-- selectpicker --> 
                                                            <option value="0" disabled>Select any product</option>';
                                                            for ( $k = 0; $k < count($products); $k ++ ) {
                                                                if ( $p->id == $products[$k]["id"] ) continue;
                                                                $sel = "";
                                                                if ( $products[$k]["code"] == $a[$i]["value"] ) $sel = "selected";
                                                                echo '<option value="'.$products[$k]["code"].'" '.$sel.'>'.$products[$k]["name"].'&nbsp;(&nbsp;'.$products[$k]["code"].'&nbsp;) </option>';
                                                            }
                                            echo        '</select>
                                                    </div>
                                                    <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
                                                        <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
                                                    </div>
                                                </div>';
                                        }
                                    }
                                    ;?>
                                    <div class="row p_service_parts_top_row">
                                        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
                                            <select class="g_ipt p_n_c_service_parts">
                                                <option value="0" disabled selected>--Service Part--</option>
                                                <?php
                                                for ( $i = 0; $i < count($services); $i ++ ) {
                                                    echo '<option value="'.$services[$i]["id"].'">'.$services[$i]["title"].'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">
                                            <select class="p_n_c_value p_n_service_part_produc_slt" data-show-subtext="true" data-live-search="true"><!-- selectpicker -->
                                                <option value="0" disabled selected>Select any product</option>
                                                <?php
                                                for ( $i = 0; $i < count($products); $i ++ ) {
                                                    if ( $p->id == $products[$i]["id"] ) continue;
                                                    echo '<option value="'.$products[$i]["code"].'">'.$products[$i]["name"].'&nbsp;(&nbsp;'.$products[$i]["code"].'&nbsp;) </option>';
                                                }
                                                ?>    
                                            </select>
                                        </div>
                                        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
                                            <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="p_service_parts_t_new_custom">Add new custom filed</div>
                                <br><br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

</div>

<!-- application new item -->
<div class="g_non_dis" id="p_n_app_temp">
    <div class="row p_a_app_cnt">
        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
            <select class="g_ipt p_n_att_make">
                <option value="0" disabled selected>--make--</option>
                <?php
                for ( $i = 0; $i < count($makes); $i ++ ) {
                    $sel = ""; if ( $p->a_make == $makes[$i]["id"] ) $sel = "selected";
                    echo '<option value="'.$makes[$i]["id"].'" '.$sel.'>'.$makes[$i]["title"].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
            <select class="g_ipt p_n_att_type">
                <option value="0" disabled selected>--type--</option>
            </select>
        </div>
        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
            <select class="g_ipt p_n_att_model">
                <option value="0" disabled selected>--model--</option>
            </select>
        </div>
        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
            <select class="g_ipt p_n_att_year">
                <option value="0" disabled selected>--year--</option>
            </select>
        </div>
        <div class="col-xs-2 col-md-2 col-sm-2 col-lg-2">
            <select class="g_ipt p_n_att_engine">
                <option value="0" disabled selected>--engine--</option>
            </select>
        </div>
        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
            <button class="btn btn-default txt-color-blueLight p_a_app_add_btn"><i class="glyphicon glyphicon-trash"></i></button>
        </div>
    </div>
</div>

<!-- product spec new item -->
<div class="g_non_dis" id="p_n_product_spec_temp">
    <div class="row p_n_c_top_row">
        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
            <select class="g_ipt p_n_c_spec">
                <option value="0" disabled selected>--Product Spec--</option>
                <?php
                for ( $i = 0; $i < count($specs); $i ++ ) {
                    echo '<option value="'.$specs[$i]["id"].'">'.$specs[$i]["title"].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt p_n_c_value" /></div>
        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
            <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
        </div>
    </div>
</div>

<!-- service part new item -->
<div class="g_non_dis" id="p_n_service_parts_temp">
    <div class="row p_service_parts_top_row">
        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
            <select class="g_ipt p_n_c_service_parts">
                <option value="0" disabled selected>--Service Part--</option>
                <?php
                for ( $i = 0; $i < count($services); $i ++ ) {
                    echo '<option value="'.$services[$i]["id"].'">'.$services[$i]["title"].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8">
            <select class="p_n_c_value p_n_service_part_produc_slt" data-show-subtext="true" data-live-search="true"><!-- selectpicker -->
                <option value="0" disabled selected>Select any product</option>
                <?php
                for ( $i = 0; $i < count($products); $i ++ ) {
                    if ( $p->id == $products[$i]["id"] ) continue;
                    echo '<option value="'.$products[$i]["code"].'">'.$products[$i]["name"].'&nbsp;(&nbsp;'.$products[$i]["code"].'&nbsp;) </option>';
                }
                ?>
            </select>
        </div>
        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
            <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
        </div>
    </div>
</div>

<!-- replacement brand new item -->
<div class="g_non_dis" id="p_n_replacement_brand_temp">
    <div class="row p_n_r_l_top_row">
        <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3">
            <select class="g_ipt p_n_c_brand">
                <option value="0" disabled selected>--Replacement Brand--</option>
                <?php
                for ( $i = 0; $i < count($brands); $i ++ ) {
                    echo '<option value="'.$brands[$i]["id"].'">'.$brands[$i]["title"].'</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt p_n_c_value" /></div>
        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1">
            <button class="btn btn-default txt-color-blueLight"><i class="glyphicon glyphicon-trash"></i></button>
        </div>
    </div>
</div>

<div class="g_non_dis p_n_waiting_over_div">
    <div>Application Data Importing...</div>
</div>

<?php
include "template/footer.php";
?>
