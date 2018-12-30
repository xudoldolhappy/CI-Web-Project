<?php
include "template/header.php";
include "template/leftside.php";
?>
<div id="main" role="main">

    <section id="widget-grid" class="">
        <div class="p_c_sub_tlt">User list</div>
        <!-- row -->
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                    <header>
<!--                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>-->
                        <h2>You can filter any user</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="user_list_tb" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th data-hide="phone">ID</th>
                                    <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Last Name</th>
                                    <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> First Name</th>
                                    <th>Gender</th>
                                    <th data-class="expand"><i class="fa fa-fw fa-comment-o text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
                                    <th>County</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip</th>
                                    <th>Company</th>
                                    <th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Phone</th>
                                    <th>Authority</th>
                                    <th><i class="fa fa-fw fa-pencil-square-o text-muted hidden-md hidden-sm hidden-xs"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ( $i = 0; $i < count($list); $i ++ ) {
                                    $gender = "male";
                                    if ( $list[$i]["gender"] == "2" ) $gender = "female";
                                    $auth = "Customer";
                                    if ( $list[$i]["auth"] == "1" ) $auth = "Administrator";
                                    $del_btn = '<button class="btn btn-xs btn-default users_all_delete" data-original-title="Cancel"><i class="fa fa-times"></i></button>';
                                    if ( $list[$i]["is_superadmin"] ) $del_btn = '';
                                    echo '<tr>
                                            <td>'.( $i + 1 ).'</td>
                                            <td>'.$list[$i]["first_name"].'</td>
                                            <td>'.$list[$i]["last_name"].'</td>
                                            <td>'.$gender.'</td>
                                            <td>'.$list[$i]["email"].'</td>
                                            <td>'.$list[$i]["country_name"].'</td>
                                            <td>'.$list[$i]["state_name"].'</td>
                                            <td>'.$list[$i]["city"].'</td>
                                            <td>'.$list[$i]["address1"].'</td>
                                            <td>'.$list[$i]["zip"].'</td>
                                            <td>'.$list[$i]["company"].'</td>
                                            <td>'.$list[$i]["phone"].'</td>
                                            <td>'.$auth.'</td>
                                            <td did="'.$list[$i]["id"].'">
                                                <button class="btn btn-xs btn-default users_all_edit" data-original-title="Edit Row"><i class="fa fa-pencil"></i></button>
                                                '.$del_btn.'
                                            </td>
                                        </tr>';
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
            </article>
        </div>
    </section>

</div>

<?php
include "template/footer.php";
?>
