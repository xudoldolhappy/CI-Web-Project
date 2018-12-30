jQuery(function(){
   /** user add proc func */
   user_add_proc_func();
   /** user list proc func */
   user_list_proc_func();
   /** user log proc func */
   user_log_proc_func();
});

/**
 * user add proc func
 * */
function user_add_proc_func()
{
    var errorClass = 'invalid';
    var errorElement = 'em';

    var $checkoutForm = $('#checkout-form').validate({
        errorClass		: errorClass,
        errorElement	: errorElement,
        highlight: function(element) {
            $(element).parent().removeClass('state-success').addClass("state-error");
            $(element).removeClass('valid');
        },
        unhighlight: function(element) {
            $(element).parent().removeClass("state-error").addClass('state-success');
            $(element).addClass('valid');
        },

        // Rules for form validation
        rules : {
            fname : {
                required : true
            },
            lname : {
                required : true
            },
            username : {
                required : true
            },
            password : {
                required : true
            },
            cpassword : {
                required : true
            },
            email : {
                required : true,
                email : true
            },
            phone : {
                required : true
            },
            country : {
                required : true
            },
            address1 : {
                required : true,
            },
            city : {
                required : true
            },
            zip : {
                required : true,
            },
            authority : {
                required : true,
            }
        },

        // Messages for form validation
        messages : {
            fname : {
                required : 'Please enter your first name'
            },
            lname : {
                required : 'Please enter your last name'
            },
            username : {
                required : 'Please enter your Username'
            },
            password : {
                required : 'Please enter your password'
            },
            cpassword : {
                required : 'Please enter your confirm password'
            },
            email : {
                required : 'Please enter your email address',
                email : 'Please enter a VALID email address'
            },
            phone : {
                required : 'Please enter your phone number'
            },
            country : {
                required : 'Please select your country'
            },
            address1 : {
                required : 'Please enter your address',
            },
            city : {
                required : 'Please enter your city'
            },
            zip : {
                required : 'Please enter your zipcode'
            },
            authority : {
                required : 'Please select your authority',
            }
        },

        // Do not change code below
        errorPlacement : function(error, element) {
            error.insertAfter(element.parent());
        }
    });


    // birthday
    jQuery('#u_birthday').datepicker({
        dateFormat : 'yy-mm-dd',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
        }
    });

    // confirm password
    jQuery("input[name='cpassword']").focus(function(){
        if ( jQuery("input[name='password']").val() == "" ) {
            jQuery("input[name='password']").focus();
            return;
        }
    }).blur(function(){

        if ( jQuery("input[name='password']").val() == "" ) {
            jQuery("input[name='password']").focus();
            return;
        }


        if ( jQuery("input[name='password']").val() != jQuery("input[name='cpassword']").val() ) {
            alert("Do not match password");
            jQuery(this).val("");
            return;
        }
    }).keypress(function(event){
        if ( event.which == 13 ) jQuery.trigger("blur");
    });

}
/**
 * user list proc func
 * */
function user_list_proc_func()
{
    var responsiveHelper_dt_basic = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    jQuery('#user_list_tb').dataTable({
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
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#user_list_tb'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_dt_basic.respond();
        }
    });

    // delete selected user
    jQuery(".users_all_delete").click(function(){
        if ( !confirm( " Would you like to delete this suser? ") ) return;
       var did  = jQuery(this).parent("td").attr("did");
       location.href = BASE_URL + "admin/delete_one_user?id=" + did;
    });

    // edit selected user
    jQuery(".users_all_edit").click(function(){
        var did  = jQuery(this).parent("td").attr("did");
        location.href = BASE_URL + "admin/user_add?id=" + did;
    });

}
/**
 * user log proc func
 * */
function user_log_proc_func()
{
    var responsiveHelper_datatable_col_reorder = undefined;
    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };
    $('#user_login_log_tb').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
        "t"+
        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "autoWidth" : true,
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_datatable_col_reorder) {
                responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#user_login_log_tb'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_datatable_col_reorder.respond();
        }
    });
}