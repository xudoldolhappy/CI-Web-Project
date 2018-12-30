<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <section id="widget-grid" class="">
        <div class="p_c_sub_tlt">Product list</div>
        <!-- row -->
        <div class="row">
            <article class="col-sm-12 col-lg-12 col-xs-12 col-md-12 g_txt_right b_p_a_forward">
                <span class="b_p_a_forward_tlt_cnt">Total products count&nbsp;:&nbsp;<b><?= $cnt;?></b> </span>
                <?php
                $first = 1;
                $last = intval($cnt / $limit);
                if ( $last * $limit < $cnt ) $last ++;

                $prev = intval($pagenum) - 1;
                if ( $prev == 0 ) $prev = 1;
                $next = intval($pagenum) + 1;
                if ( $next > $last ) $next --;

                $first_page = "b_p_a_forward_able_page";
                $prev_page = "b_p_a_forward_able_page";
                $next_page = "b_p_a_forward_able_page";
                $last_page = "b_p_a_forward_able_page";

                if ( $pagenum == $first ) {
                    $first_page = "";
                    $prev_page = "";
                }
                if ( $pagenum == $last ) {
                    $next_page = "";
                    $last_page = "";
                }
                ?>
                <input type="text" value="<?php if($search_key) echo $search_key;?>" id="b_p_a_forward_search_key_ipt" />
                <i class="fa fa-search" id="b_p_a_forward_search_key_btn"></i>
                <i class="fa fa-fast-backward <?= $first_page;?>" pagenum="<?= $first;?>" ></i>
                <i class="fa fa-step-backward <?= $prev_page;?>" pagenum="<?= $prev;?>"></i>
                <i class="fa fa-step-forward <?= $next_page;?>" pagenum="<?= $next;?>"></i>
                <i class="fa fa-fast-forward <?= $last_page;?>" pagenum="<?= $last;?>"></i>
                <input type="hidden" id="b_p_a_forward__pagenum" value="<?= $pagenum;?>" />
            </article>
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <table id="user_list_tbh" class="table table-striped table-bordered table-hover" width="100%">
                    <thead>
                    <tr>
                        <th>no</th>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Create Date</th>
                        <th>Regular Price</th>
                        <th style="width: 150px;">Sale Price</th>
                        <th style="width: 120px;">Quanity</th>
                        <th>Short Description</th>
                        <th style="width: 70px;"><i class="fa fa-fw fa-pencil-square-o text-muted hidden-md hidden-sm hidden-xs"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    for ( $i = 0; $i < count($list); $i ++ ) {
                        $quanity = $list[$i]["quanity"];
                        $alert = "";
                        if ( $quanity == "0" ) $alert = "g_alert_tr";
                        echo '<tr class="'.$alert.'">
                                <td>'.( ( $pagenum - 1 ) * $limit + $i + 1 ).'</td>
                                <td>'.$list[$i]["code"].'</td>
                                <td>'.$list[$i]["name"].'</td>
                                <td>'.$list[$i]["create_date"].'</td>
                                <td>$'.$list[$i]["regular_price"].'</td>
                                <td>$
                                    <input type="text" value="'.$list[$i]["sale_price"].'" class="b_p_a_sale_price" />
                                    <i class="fa fa-play b_p_a_sale_price_btn" did="'.$list[$i]["id"].'"></i>
                                </td><td>
                                    <input type="text" value="'.$quanity.'" class="b_p_a_quanity" />
                                    <i class="fa fa-play b_p_a_quanity_btn" did="'.$list[$i]["id"].'"></i>
                                </td>
                                <td>'.$list[$i]["short_description"].'</td>
                                <td did="'.$list[$i]["id"].'">
                                    <a href="'.base_url().'admin/product_new?did='.$list[$i]["id"].'">
                                        <button class="btn btn-xs btn-default products_all_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button></a>
                                    <a href="'.base_url().'admin/delete_one_product?did='.$list[$i]["id"].'">
                                        <button class="btn btn-xs btn-default products_all_delete" data-original-title="Cancel"><i class="fa fa-times"></i></button></a>
                                </td>
                            </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </article>
        </div>
    </section>

</div>

<?php
include "template/footer.php";
?>
