<?php
/**
 * Created by PhpStorm.
 * User: ruh19
 * Date: 3/3/2018
 * Time: 6:05 PM
 */
?>

<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <span class="txt-color-white">SmartAdmin 1.8.2 <span class="hidden-xs"> - Web Application Framework</span> © 2014-2015</span>
        </div>

        <div class="col-xs-6 col-sm-6 text-right hidden-xs">
            <div class="txt-color-white inline-block">
                <i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
                <div class="btn-group dropup">
                    <button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
                        <i class="fa fa-link"></i> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right text-left">
                        <li>
                            <div class="padding-5">
                                <p class="txt-color-darken font-sm no-margin">Download Progress</p>
                                <div class="progress progress-micro no-margin">
                                    <div class="progress-bar progress-bar-success" style="width: 50%;"></div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="padding-5">
                                <p class="txt-color-darken font-sm no-margin">Server Load</p>
                                <div class="progress progress-micro no-margin">
                                    <div class="progress-bar progress-bar-success" style="width: 20%;"></div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="padding-5">
                                <p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
                                <div class="progress progress-micro no-margin">
                                    <div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="padding-5">
                                <button class="btn btn-block btn-default">refresh</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script data-pace-options='{ "restartOnRequestAfter": true }' src="<?= base_url();?>assets/backend/lib/js/plugin/pace/pace.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="<?= base_url();?>assets/backend/lib/js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="<?= base_url();?>assets/backend/lib/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>

<script src="<?= base_url();?>assets/backend/lib/js/app.config.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/notification/SmartNotification.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/smartwidgets/jarvis.widget.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/sparkline/jquery.sparkline.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/masked-input/jquery.maskedinput.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/select2/select2.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/msie-fix/jquery.mb.browser.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/fastclick/fastclick.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/demo.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/app.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/speech/voicecommand.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/smart-chat-ui/smart.chat.ui.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/smart-chat-ui/smart.chat.manager.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.cust.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.resize.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/moment/moment.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/fullcalendar/jquery.fullcalendar.min.js"></script>

<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.fillbetween.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.orderBar.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.pie.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.time.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/flot/jquery.flot.tooltip.min.js"></script>

<!-- table plugins -->
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

<!-- file upload via ajax -->
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="<?= base_url();?>assets/backend/lib/js/plugin/jquery-form/jquery-form.min.js"></script>

<!-- email send plugin -->
<script src="https://smtpjs.com/v2/smtp.js"></script>

<!-- multiselect -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<!-- auto complete plugin -->
<script type="text/javascript" src="<?= base_url();?>assets/backend/lib/js/plugin/custom/typeahead.js"></script>

<!-- single search select -->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>-->

<!-- custom javascript -->
<script src="<?= base_url();?>assets/backend/custom/js/global_func.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/global_event.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/mytree.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/dashboard.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/user_manage.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/products.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/product_add.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/orders.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/setting.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/reviews.js"></script>
<script src="<?= base_url();?>assets/backend/custom/js/message.js"></script>

</body>
</html>
