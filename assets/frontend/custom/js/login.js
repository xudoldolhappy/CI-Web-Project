jQuery(function(){

    /**
     * login function
     * */
    l_user_login();
});

/**
 * login function
 * */
function l_user_login()
{
    // login button ( goto login page )
    jQuery(".f_login_div").click(function(){
       location.href = BASE_URL + "front/login";
    });

    // trigger login button when press enter key
    jQuery("#l_login_email, #l_login_password").keypress(function(e){
       if ( e.which == 13 ) {
           jQuery(".l_login_btn").trigger("click");
       }
    });

    // login proc
    jQuery(".l_login_btn").click(function(){
        var email = jQuery("#l_login_email").val();
        var password = jQuery("#l_login_password").val();

        if ( g_v_e(email) ) { alert("Invalid email!"); jQuery("#l_login_email").focus(); return; }
        if ( g_v_t(password) ) { alert("Input password!"); jQuery("#l_login_password").focus(); return; }

        var jsonStr = "{" +
            "\"email\":\"" + email + "\", " +
            "\"password\":\"" + password + "\"" +
            "}";

        var dataQuery = "jsonStr=" + jsonStr;
        jQuery.ajax({
            url: BASE_URL + "front/login_confirm",
            type: "post",
            data: dataQuery,
            dataType: "json",
            async: true,
            success: function(data) {
                if(data.status == "1" ) {
                    location.href = BASE_URL + "front/main";
                } else {
                    alert("Failed user login!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("generated database error!");
            }
        });
    });

    // sign up proc
    jQuery("#l_s_signup_btn").click(function(){
        var first_name = jQuery("#signup_first_name").val();
        var last_name = jQuery("#signup_last_name").val();
        var email = jQuery("#signup_email").val();
        var phone = jQuery("#signup_phone").val();
        var password = jQuery("#signup_password").val();
        var cpassword = jQuery("#signup_confirm_password").val();
        var country = jQuery(".signup_country").val();
        var state = jQuery(".signup_state").val();
        var address1 = jQuery("#signup_address1").val();
        var address2 = jQuery("#signup_address2").val();
        var city = jQuery("#signup_city").val();
        var zip = jQuery("#signup_zip").val();

        if ( g_v_t(first_name) ) { alert("Input first name!"); jQuery("#l_s_firstname").focus(); return; }
        if ( g_v_t(last_name) ) { alert("Input last name!"); jQuery("#signup_last_name").focus(); return; }
        if ( g_v_e(email) ) { alert("Invalid email!"); jQuery("#signup_email").focus(); return; }
        if ( g_v_t(password) ) { alert("Input password!"); jQuery("#signup_password").focus(); return; }
        if ( password != cpassword ) { alert("Do not match email!"); jQuery("#signup_password").focus(); return; }
        if ( g_v_ts(country) ) { alert("Select country"); return; }

        var jsonStr = "{" +
            "\"first_name\":\"" + first_name + "\", " +
            "\"last_name\":\"" + last_name + "\", " +
            "\"email\":\"" + email + "\", " +
            "\"phone\":\"" + phone + "\", " +
            "\"password\":\"" + password + "\", " +
            "\"country\":\"" + country + "\", " +
            "\"state\":\"" + state + "\", " +
            "\"address1\":\"" + address1 + "\", " +
            "\"address2\":\"" + address2 + "\", " +
            "\"city\":\"" + city + "\", " +
            "\"zip\":\"" + zip + "\"" +
            "}";

        var dataQuery = "jsonStr=" + jsonStr;
        jQuery.ajax({
            url: BASE_URL + "front/lsignup",
            type: "post",
            data: dataQuery,
            dataType: "json",
            async: true,
            success: function(data) {
                if(data.status == "1" ) {
                    location.href = BASE_URL + "front/main";
                } else if (data.status == "2") {
                    alert("The eamil exist alredy Please enter other email");
                    jQuery("#l_signup_email").focus();
                } else {
                    alert("Failed user register!");
                }
            },
            error: function(xhr, ajaxOptions, thrownError){
                alert("generated database error!");
            }
        });
    });

    jQuery("#facebook_login_btn").click(function(){
        facebook_login_func();
    });
}

/************************************************** facebook login ***************************************************/
(function(thisdocument, scriptelement, id) {
    var js, fjs = thisdocument.getElementsByTagName(scriptelement)[0];
    if (thisdocument.getElementById(id)) return;

    js = thisdocument.createElement(scriptelement); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js"; //you can use
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
    FB.init({
        appId      : '1449392918617564', // starter1.com`s id: 157488161622140
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.1' // use version 2.1
    });

    // These three cases are handled in the callback function.
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

function facebook_login_func()
{
// This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            _i();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
        }
    }

    function _login() {
        FB.login(function(response) {
            // handle the response
            if(response.status==='connected') {
                _i();
            }
        }, {scope: 'public_profile,email'});
    }

    function _i(){
        FB.api('/me', { locale: 'en_US', fields: 'name, email, first_name, last_name, gender' }, function(response) {
            var first_name = response.first_name;
            var last_name = response.last_name;
            var sex = 2; if ( response.gender == "male" ) sex = 1;
            var email = response.email;

            if ( g_v_t(first_name) ) { alert("Input first name!"); jQuery("#l_signup_firstname").focus(); return; }
            if ( g_v_e(email) ) { alert("Invalid email!"); jQuery("#l_signup_email").focus(); return; }

            var jsonStr = "{" +
                "\"first_name\":\"" + first_name + "\", " +
                "\"last_name\":\"" + last_name + "\", " +
                "\"sex\":\"" + sex + "\", " +
                "\"email\":\"" + email + "\" " +
                "}";

            var dataQuery = "jsonStr=" + jsonStr;
            jQuery.ajax({
                url: BASE_URL + "front/facebook_login",
                type: "post",
                data: dataQuery,
                dataType: "json",
                async: true,
                success: function(data) {
                    if(data.status == "1" ) {
                        location.href = BASE_URL + "front/main";
                    } else {
                        alert("Failed user register!");
                    }
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert("generated database error!");
                }
            });
        });

    }

    _login();
}


/************************************************** facebook login ***************************************************/