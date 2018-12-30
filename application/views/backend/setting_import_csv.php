<?php
include "template/header.php";
include "template/leftside.php";
?>
    <div id="main" role="main">

        <div class="s_i_c_top_div">
            <div class="p_c_sub_tlt">Import csv data</div>
            <div class="s_i_c_cnt_div">
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import categories info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_cateories_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_cateories_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="categories_file" style="margin-top:15px;" id="s_i_c_cateories_file" />
                        <input type="submit" name="upload" id="s_i_c_cateories_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import products info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_products_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_products_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="products_file" style="margin-top:15px;" id="s_i_c_products_file" />
                        <input type="submit" name="upload" id="s_i_c_products_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import product`s photos info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_products_photos_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_products_photos_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="products_photos_file" style="margin-top:15px;" id="s_i_c_products_photos_file" />
                        <input type="submit" name="upload" id="s_i_c_products_photos_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import product`s categoriess info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_products_categories_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_products_categories_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="products_categories_file" style="margin-top:15px;" id="s_i_c_products_categories_file" />
                        <input type="submit" name="upload" id="s_i_c_products_categories_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import product`s applications info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_products_applications_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_products_applications_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="products_applications_file" style="margin-top:15px;" id="s_i_c_products_applications_file" />
                        <input type="submit" name="upload" id="s_i_c_products_applications_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import product`s relacements info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_products_replacements_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_products_replacements_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="products_replacements_file" style="margin-top:15px;" id="s_i_c_products_replacements_file" />
                        <input type="submit" name="upload" id="s_i_c_products_replacements_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 s_i_c_ctlt"><i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;&nbsp;Import product`s advanced spec info from csv file</div>
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="javascript:void(0);" class="btn btn-primary" id="s_i_c_products_advanced_import_btn"><i class="fa  fa-upload"></i></a>
                    </div>
                    <form id="s_i_c_products_advanced_form" method="post" enctype="multipart/form-data" class="g_non_dis">
                        <input type="file" name="products_advanced_file" style="margin-top:15px;" id="s_i_c_products_advanced_file" />
                        <input type="submit" name="upload" id="s_i_c_products_advanced_upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
                    </form>
                </div> <br />
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <a href="<?php echo base_url();?>admin/make_replacement_search_product_table" class="btn btn-primary" >make replacement search product table</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="g_non_dis p_n_waiting_over_div">
        <div>Data Importing...</div>
    </div>

<?php
include "template/footer.php";
?>