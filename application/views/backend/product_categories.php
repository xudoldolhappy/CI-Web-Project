<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">
    <div class="p_c_top_div row">
        <!-- product categories tree structure display -->
        <div class="col-xs-5 col-md-5 col-sm-5 col-lg-3 p_c_sub_div">
            <div class="p_c_sub_tlt">Produc categories</div> <br>

        <?php
        if ( isset( $list ) ) {
            if (count($list) > 0) {
                for ($i = 0; $i < count($list); $i++) {
                    $pmo = "mytree_open";
                    if ($i != 0) $pmo = "";
                    $edit = '<button class="btn btn-xs btn-default p_c_node_del" data-original-title="Cancel"><i class="fa fa-times"></i></button>
                         <button class="btn btn-xs btn-default p_c_node_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>';
                    if ($i == 0) $edit = '';
                    echo '<div class="my_tree_node my_tree_' . $list[$i]["level"] . ' my_tree_id_' . $list[$i]["parent_id"] . '">
                            <div class="my_tree_icon ' . $pmo . '" level="' . $list[$i]["level"] . '"></div>
                            <div class="my_tree_cnt" did="' . $list[$i]["id"] . '">' . $list[$i]["title"] . $edit . '</div>
                      </div>';
                }
            }
        }
        ?>
        </div>
        <div class="col-xs-1 col-md-1 col-sm-1 col-lg-1"></div>
        <!-- add new product category -->
        <div class="col-xs-6 col-md-6 col-sm-6 col-lg-8 p_c_sub_div">
            <div class="p_c_sub_tlt">Add new product category</div> <br>
            <div class="row">
                <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">Category Title</div>
                <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt" id="p_c_a_title" /></div>
            </div><br>
            <div class="row">
                <div class="col-xs-4 col-md-4 col-sm-4 col-lg-4">Category Slug</div>
                <div class="col-xs-8 col-md-8 col-sm-8 col-lg-8"><input type="text" class="g_ipt" id="p_c_a_slug" /></div>
            </div><br>
            <div class="row">
                <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">Category Photo and Description</div>
            </div>
            <div class="row">
                <div class="col-xs-3 col-md-3 col-sm-3 col-lg-3"><img src="<?= base_url();?>assets/backend/lib/img/category.jpg" alt="category photo" id="p_c_img" /></div>
                <div class="col-xs-9 col-md-9 col-sm-9 col-lg-9"><textarea class="g_ipt" rows="10" id="p_c_a_description" ></textarea></div>
            </div><br>
            <div class="row">
                <input type="hidden" value="" id="p_c_a_photo" />
                <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12 g_txt_center"><input type="submit" class="btn btn-sm btn-primary" value="Add Category" id="p_c_a_btn" /></div>
            </div>
        </div>
        <?php echo form_open_multipart('admin/user_photo_upload');?>
        <input type="file" name="image" size="20" id="ep_photo_upload_ipt" class="g_non_dis" />
        <input type="submit" value="upload" id="ep_photos_submit" class="g_non_dis" />
        </form>
    </div>
</div>

<?php
include "template/footer.php";
?>
