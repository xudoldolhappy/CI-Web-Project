jQuery(function(){
    /** orders proc func */
    messages_proc_func();
});

/**
 * messages proc func
 * */
function messages_proc_func()
{
    var responsiveHelper_dt_basic = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    $('#b_r_message_list_table').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#b_r_message_list_table'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_dt_basic.respond();
        }
    });

    // Dialog click
    $('.b_c_c_reply_btn').click(function() {
        jQuery("#b_c_c_r_email").html(jQuery(this).attr("email"));
        jQuery("#b_c_c_reply_content").attr("did", jQuery(this).attr("did"));
        $('#b_c_c_reply_dlg').dialog('open');
        return false;

    });

    $('#b_c_c_reply_dlg').dialog({
        autoOpen : false,
        width : 600,
        resizable : false,
        modal : true,
        buttons : [{
            html : "<i class='fa fa-comments-o'></i>&nbsp; Send",
            "class" : "btn btn-primary",
            click : function() {

                /*********************** reply email send to customer *****************************/
                var to = jQuery("#b_c_c_r_email").html();
                var content = jQuery("#b_c_c_reply_content").val();
                var did = jQuery("#b_c_c_reply_content").attr("did");
                Email.send("hmc198918@outlook.com",
                    to,
                    "Thank for your answer",
                    content,
                    "smtp.elasticemail.com",
                    "ruh1991912@outlook.com",
                    "ecd0495f-fbb9-4ff3-9469-88121b1e0acb");

                var params = {
                    "id" : did,
                    "content" : content
                };
                var url = BASE_URL + "admin/reply_customer_contact_message";
                $.post(url, params, function(res) {
                    if(res.status == "1" ) {
                        alert("Sent successufully!");
                        location.reload();
                    } else {
                        alert("Database Error!");
                    }
                });
            }
        }, {
            html : "<i class='fa fa-times'></i>&nbsp; Cancel",
            "class" : "btn btn-default",
            click : function() {
                $(this).dialog("close");
            }
        }]
    });
}