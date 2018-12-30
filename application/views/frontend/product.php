<?php
include "template/header.php";
?>
<div class="container_row f_m_catainer_row">
    <!-- search box -->
    <div class="f_search_top_box_div">
        <input type="text" class="f_shop_s_ipt" placeholder="Search" value="<?php if(isset($name)) echo $name;?>" />
        <img src="<?php echo base_url();?>assets/frontend/lib/img/icons/search.png" class="f_shop_s_btn" />
        <a href="<?php echo base_url();?>front/shop_bycategories" class="g_btn_b">shop by categories</a>
        <a href="<?php echo base_url();?>front/shop_byadvanced" class="g_btn_b">advanced part finder</a>
    </div>
    <div class="row f_p_d_top">
        <?php
        $product = $info["product"];
        if ( isset ($product) ) {

            $image = $info["image"];
            $applications = $info["product_applications"];
            $replacements = $info["replacement_brands"];
            $advances= $info["product_advances"];
            $categories = $info["products_categories"];
            $reviews  = $info["product_reviews"];
            $alters  = $info["alternative"];
            $service_parts = $info["service_parts"];
            $cstr = "";
            foreach ( $categories as $val ) {
                if ( $cstr != "" ) $cstr .= ",&nbsp;&nbsp;&nbsp;";
                $cstr .= '<a href="'.base_url().'front/shop_bycategories?category='.$val["category"].'">'.$val["title"].'</a>';
            }
            ?>

            <input type="hidden" id="f_p_d_did" value="<?= $product->id;?>" />

            <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5">
                <?php
                $main_photo = "product_not.png";
                if ( isset($image) && count($image) > 0 ) $main_photo = $image[0]["filename"];
                ?>
                <img class="f_p_d_photo" src="<?= base_url();?>uploads/pcategories/<?= $main_photo;?>" />
                <?php /*if ( $product->favorite == "1" )
                echo '<img class="f_p_d_favorite_img" src="'.base_url().'assets/frontend/lib/img/icons/favorite.png" />';*/ ?>

                <div class="">
                    <div class="row">
                        <div class="span12">
                            <div class="well p_d_well">
                                <div id="myCarousel" class="carousel slide">

                                    <div class="carousel-inner">

                                        <?php
                                        for ( $i = 0; $i < count($image); $i ++ ) {
                                            if ( $i == 0 ) {
                                                echo '<div class="item active">
                                                    <div class="row-fluid">';
                                            }
                                            if ( $i != 0 && fmod( $i, 3 ) == 0 ) {
                                                echo '</div>
                                                </div>
                                                <div class="item">
                                                    <div class="row-fluid">';
                                            }
                                            echo '<div class="span3"><a href="#x" class="thumbnail f_p_s_a"><img class="p_a_gallery_sub_img" src="'.base_url().'uploads/pcategories/'.$image[$i]["filename"].'" alt="Image" style="max-width:100%;" /></a></div>';
                                            if ( $i == count($image) - 1 ) {
                                                echo '</div>
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                                    <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                                </div><!--/myCarousel-->

                            </div><!--/well-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7">
                <div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_p_d_name"><?= $product->name;?></div>
                </div><div class="row">
                    <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_i_stlt">Product ID : </div>
                    <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_i_scnt"><?= $product->code;?></div>
                </div><div class="row">
                    <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_i_stlt">Quanity : </div>
                    <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_i_scnt"><?= $product->quanity;?></div>
                </div><div class="row">
                    <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_i_stlt">Category : </div>
                    <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_i_scnt"><?= $cstr;?></div>
                </div><div class="row">
                    <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_i_stlt">Price : </div>
                    <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_i_scnt">$<?php echo number_format(floatval($product->sale_price), 2);?></div>
                </div><div class="row">
                    <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_i_stlt">Core Fee : </div>
                    <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_i_scnt">$<?php echo number_format(floatval($product->core_fee), 2);?></div>
                </div><div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_p_d_i_stlt g_top_boder">Short Description </div>
                </div><div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12"><?= $product->short_description;?></div>
                </div><div class="row"><br><br>
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <span class="f_p_d_cart_cont" id="f_p_d_cnt_minus">-</span>
                        <span id="f_p_d_cart_cnt">1</span>
                        <span class="f_p_d_cart_cont" id="f_p_d_cnt_plus"  quanity="<?= $product->quanity;?>">+</span>
                        <span id="f_p_d_add_cart_btn">Add cart</span>
                    </div>
                </div><div class="row"><br>
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_p_d_i_stlt g_top_boder">Questions About Your Order?</div>
                </div><div class="row">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">Contact us for advice or more details. Our experts are standing by to help!</div>
                </div><div class="row"><br><br>
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <div class="f_p_d_link_us"><div><i class="material-icons">shopping_cart</i></div><a href="#" target="_blank">Ships TODAY if ordered by 2pm EST.</a></div>
                        <div class="f_p_d_link_us"><div><i class="material-icons">verified_user</i></div><a href="<?php echo base_url();?>/front/policies" target="_blank">1 Year Warranty on all Products</a></div>
                        <div class="f_p_d_link_us"><div><i class="material-icons">email</i></div><a href="<?php echo base_url();?>/front/contact" target="_blank">Send an Email</a></div>
                        <!--                    <div class="f_p_d_link_us"><div><i class="material-icons">call</i></div><a href="#" target="_blank">(800) 753-2242</a></div>-->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 f_p_d_d_info_div">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#f_p_d_description_tab">Description</a></li>
                    <li><a data-toggle="tab" href="#f_p_d_recommended_tab">Alternate</a></li>
                    <li><a data-toggle="tab" href="#f_p_d_applications_tab">Application List</a></li>
                    <li><a data-toggle="tab" href="#f_p_d_replacements_tab">Replacement List</a></li>
                    <li><a data-toggle="tab" href="#f_p_d_specs_tab">Product Specs</a></li>
                    <li><a data-toggle="tab" href="#f_p_d_service_parts_tab">Service Parts</a></li>
                    <li><a data-toggle="tab" href="#f_p_d_reviews_tab">Reviews ( <?= count($reviews);?> ) </a></li>
                </ul>

                <div class="tab-content">
                    <div id="f_p_d_description_tab" class="tab-pane fade in active">
                        <?= $product->description;?>
                    </div>

                    <!-- Recommended Product -->
                    <div id="f_p_d_recommended_tab" class="tab-pane fade">
                        <div class="row">
                            <?php
                            if ( isset ($alters) ) {
                                for ( $i = 0; $i < count($alters); $i ++ ) {
                                    echo '<div class="col-xs-4 col-md-4 col-lg-4 col-sm-4">
                                    <div class="f_m_items" did="'.$alters[$i]["pid"].'">
                                        <div class="f_m_items_photo f_m_items_bysearch">
                                            <img src="'.base_url().'uploads/pcategories/'.$alters[$i]["photo"].'" />
                                        </div>                   
                                        <div class="f_m_items_name">'.$alters[$i]["name"].'</div>
                                        <div class="f_m_items_price">$'.number_format(floatval($alters[$i]["sale_price"]), 2).'</div>
                                        <div class="f_m_items_cart"><button class="g_btn_gr" quanity="'.$alters[$i]["quanity"].'">Add to cart</button></div>
                                    </div>
                                </div>';
                                } }
                            ?>
                        </div>
                    </div>

                    <!-- Application List Info -->
                    <div id="f_p_d_applications_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_heard">Make</div>
                            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_heard">Type</div>
                            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_heard">Model</div>
                            <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_heard">Year</div>
                            <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_a_l_heard">Engine</div>
                            <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_p_d_a_l_heard">&nbsp;</div>
                        </div>
                        <?php
                        if ( isset( $applications ) )
                            for ( $i = 0; $i < count($applications); $i ++ ) {
                                echo '<div class="row f_p_d_b_b">
                                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_cnt">&nbsp;'.$applications[$i]["make_title"].'</div>
                                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_cnt">&nbsp;'.$applications[$i]["type_title"].'</div>
                                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_cnt">&nbsp;'.$applications[$i]["model_title"].'</div>
                                <div class="col-xs-2 col-md-2 col-lg-2 col-sm-2 f_p_d_a_l_cnt">&nbsp;'.$applications[$i]["year_title"].'</div>
                                <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_a_l_cnt">&nbsp;'.$applications[$i]["engine_title"].'</div>
                                <div class="col-xs-1 col-md-1 col-lg-1 col-sm-1 f_p_d_a_l_cnt_link">
                                    <a href="'.base_url().'front/shop_byadvanced?make='.$applications[$i]["make"].'&
                                    type='.$applications[$i]["type"].'&
                                    model='.$applications[$i]["model"].'&
                                    year='.$applications[$i]["year"].'&
                                    engine='.$applications[$i]["engine"].'" target="_blank">
                                    <i class="material-icons">screen_share</i></a></div>
                            </div>';
                            }
                        ?>
                    </div>

                    <!-- Repalcement List Info -->
                    <div id="f_p_d_replacements_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_a_l_heard">Brand</div>
                            <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_a_l_heard">Part Number</div>
                        </div>
                        <?php
                        if ( isset( $replacements ) )
                            for ( $i = 0; $i < count($replacements); $i ++ ) {
                                echo '<div class="row f_p_d_b_b">
                                <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_a_l_cnt">&nbsp;'.$replacements[$i]["brand_title"].'</div>
                                <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_a_l_cnt">&nbsp;'.$replacements[$i]["value"].'</div>
                            </div>';
                            }
                        ?>
                    </div>

                    <!-- Product Spec List Info -->
                    <div id="f_p_d_specs_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_a_l_heard">Characteristic</div>
                            <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_a_l_heard">Value</div>
                        </div>
                        <?php
                        if ( isset( $advances ) )
                            for ( $i = 0; $i < count($advances); $i ++ ) {
                                echo '<div class="row f_p_d_b_b">
                                <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_a_l_cnt">&nbsp;'.$advances[$i]["spec_title"].'</div>
                                <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_a_l_cnt">&nbsp;'.$advances[$i]["value"].'</div>
                            </div>';
                            }
                        ?>
                    </div>

                    <!-- Service Parts -->
                    <div id="f_p_d_service_parts_tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_a_l_heard">Description</div>
                            <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_a_l_heard">Part Number</div>
                        </div>
                        <?php
                        if ( isset( $service_parts ) )
                            for ( $i = 0; $i < count($service_parts); $i ++ ) {
                                echo '<div class="row f_p_d_b_b">
                                <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5 f_p_d_a_l_cnt">&nbsp;'.$service_parts[$i]["service_title"].'</div>
                                <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7 f_p_d_a_l_cnt f_p_d_service_parts"
                                    p_name = "'.$service_parts[$i]["p_name"].'"
                                    p_code = "'.$service_parts[$i]["value"].'"
                                    p_price = "'.number_format(floatval($service_parts[$i]["p_price"]), 2).'" 
                                    p_quanity = "'.$service_parts[$i]["p_quanity"].'"
                                    p_fee = "'.number_format(floatval($service_parts[$i]["p_fee"]), 2).'"   
                                    p_filename = "'.$service_parts[$i]["p_filename"].'" >
                                    <a href="'.base_url().'front/product?did='.$service_parts[$i]["p_id"].'">'.$service_parts[$i]["value"].'&nbsp;(&nbsp;'.$service_parts[$i]["p_name"].'&nbsp;)</a></div>
                            </div>';
                            }
                        ?>
                    </div>

                    <!-- Reviews -->
                    <div id="f_p_d_reviews_tab" class="tab-pane fade">
                        <button class="g_btn_gr" id="f_p_d_new_review_btn" data-toggle="modal" data-target="#f_p_d_new_review_dlg">Write Review</button>
                        <div class="f_p_d_review_list_div">
                            <?php
                            if ( isset($reviews) )
                                for ( $i = 0; $i < count($reviews); $i ++ ) {
                                    echo '<div class="row g_top_boder">
                                   <div class="col-xs-3 col-md-3 col-lg-3 col-sm-3 f_p_d_r_l_tlt">'.$reviews[$i]["subject"].'</div>
                                   <div class="col-xs-9 col-md-9 col-lg-9 col-sm-9 f_p_d_r_l_cnt">
                                         <img src="'.base_url().'assets/frontend/lib/img/icons/r'.$reviews[$i]["rating"].'.png" />
                                         '.$reviews[$i]["date"].' by <span>'.$reviews[$i]["email"].'</span>                             
                                    </div>
                              </div>
                              <div class="row">
                                   <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_p_d_r_l_cnt">'.$reviews[$i]["comment"].'</div>
                              </div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { redirect("front/shop"); }?>
    </div>
    <br><br><br><br>

    <!-- new review modal dialog -->
    <div class="modal fade" id="f_p_d_new_review_dlg" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Write Review</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">Name</div>
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">Email</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6"><input type="text" class="g_ipt" id="f_p_d_r_a_name" /></div>
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6"><input type="text" class="g_ipt" id="f_p_d_r_a_email" /></div>
                    </div><br>
                    <div class="row">
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">Review Subject</div>
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">Rating</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6"><input type="text" class="g_ipt" id="f_p_d_r_a_subject" /></div>
                        <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
                            <select class="g_ipt" id="f_p_d_r_a_rating">
                                <option disabled selected value="0">Select Rating</option>
                                <option value="1">1 star (worst)</option>
                                <option value="2">2 star</option>
                                <option value="3">3 star (average)</option>
                                <option value="4">4 star</option>
                                <option value="5">5 star (best)</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="row"><div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">Comment</div></div>
                    <div class="row"><div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                            <textarea class="g_ipt" id="f_p_d_r_a_comment" rows="5"></textarea>
                        </div></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="f_p_d_r_add_btn">Submit review</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="f_p_d_r_close_btn">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- overview of product service parts -->
<div class="f_p_d_service_overview g_none_dis">
    <div class="row">
        <div class="col-xs-5 col-md-5 col-lg-5 col-sm-5">
            <img src="<?= base_url();?>uploads/pcategories/" id="f_p_d_s_p_o_img" />
        </div>
        <div class="col-xs-7 col-md-7 col-lg-7 col-sm-7">
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6"></div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6"></div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 f_p_d_i_scnt" id="f_p_d_s_p_o_name"></div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12 g_top_boder">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_stlt">PRODUCT ID :</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_scnt" id="f_p_d_s_p_o_code"></div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_stlt">QUANITY :</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_scnt" id="f_p_d_s_p_o_quantity"></div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_stlt">PRICE :</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_scnt" id="f_p_d_s_p_o_price"></div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_stlt">CORE FEE :</div>
                <div class="col-xs-6 col-md-6 col-lg-6 col-sm-6 f_p_d_i_scnt" id="f_p_d_s_p_o_fee"></div>
            </div>
        </div>
    </div>
</div>


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg g_none_dis" data-toggle="modal" id="f_product_img_preview_btn" data-target="#f_product_img_preview_modal">Open Modal</button>
<!-- Modal -->
<div id="f_product_img_preview_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <i class="material-icons f_img_preview_close" data-dismiss="modal">cancel</i>
                <img src="" class="f_product_preview_img" />
            </div>
        </div>

    </div>
</div>

<?php
include "template/footer.php";
?>
