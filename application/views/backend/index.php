<?php
include "template/header.php";
include "template/leftside.php";
?>
    <div id="main" role="main">
        <!-- slae chat -->
        <div class="row i_sub_top_div">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
                        <h2>Sales Chart</h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <div id="saleschart" class="chart"></div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <!-- Recent Products -->
        <div class="row i_sub_top_div">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                    <header>
                        <h2>Recent Products</h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div class="widget-body no-padding i_recent_div">
                            <table id="user_list_tb" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th>no</th>
                                    <th>Product ID</th>
                                    <th>Name</th>
                                    <th>Create Date</th>
                                    <th>Regular Price</th>
                                    <th>Sale Price</th>
                                    <th style="width: 50%;">Short Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ( $i = 0; $i < count($rproducts); $i ++ ) {
                                    echo '<tr>
                                             <td>'.( $i + 1 ).'</td>
                                            <td>'.$rproducts[$i]["code"].'</td>
                                            <td>'.$rproducts[$i]["name"].'</td>
                                            <td>'.$rproducts[$i]["create_date"].'</td>
                                            <td>$'.$rproducts[$i]["regular_price"].'</td>
                                            <td>$'.$rproducts[$i]["sale_price"].'</td>
                                            <td>'.$rproducts[$i]["short_description"].'</td>
                                        </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </article>
        </div>
        <!-- Recent Users -->
        <div class="row i_sub_top_div">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                    <header>
                        <h2>Recent Users</h2>
                    </header>
                    <div>
                        <div class="jarviswidget-editbox">
                        </div>
                        <div class="widget-body no-padding i_recent_div">
                            <table id="user_list_tb" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Last Name</th>
                                    <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> First Name</th>
                                    <th><i class="fa fa-fw fa-comment-o text-muted hidden-md hidden-sm hidden-xs"></i> Email</th>
                                    <th>County</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Address</th>
                                    <th><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip</th>
                                    <th>Company</th>
                                    <th>Authority</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                for ( $i = 0; $i < count($rusers); $i ++ ) {
                                    $auth = "Customer";
                                    if ( $rusers[$i]["auth"] == "1" ) $auth = "Administrator";
                                    echo '<tr>
                                            <td>'.( $i + 1 ).'</td>
                                            <td>'.$rusers[$i]["first_name"].'</td>
                                            <td>'.$rusers[$i]["last_name"].'</td>
                                            <td>'.$rusers[$i]["email"].'</td>
                                            <td>'.$rusers[$i]["country_name"].'</td>
                                            <td>'.$rusers[$i]["state_name"].'</td>
                                            <td>'.$rusers[$i]["city"].'</td>
                                            <td>'.$rusers[$i]["address1"].'</td>
                                            <td>'.$rusers[$i]["zip"].'</td>
                                            <td>'.$rusers[$i]["company"].'</td>
                                            <td>'.$auth.'</td>
                                        </tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

<?php
include "template/footer.php";
?>
