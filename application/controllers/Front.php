<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * date: 2018/01/30
 * coder: hmc
 * detail: front end manage
 */
class Front extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("userModel","user",true);
        $this->load->model("adminModel","admin",true);
        $this->load->helper(array('form', 'url'));
    }

    /**************************--goto page--****************************/
    // goto landing page
    public function index()
    {
        redirect_developer_login();

        redirect("front/main");
        $this->load->view('frontend/index');
    }

    // go to user login page
    public function login()
    {
        redirect_developer_login();

        $data["menu"] =  7; // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $this->load->view('frontend/login', $data);
    }

    // developer login page
    public function developer_login()
    {
        $this->load->view('frontend/developer_login');
    }

    // confirm developer login passwrod
    public function developer_login_confirm()
    {
        $password = $this->input->post("password");
        if ( $password == "developer" )
            $_SESSION["developer"] = $password;
        redirect("/");
    }

    // user login confirm
    public function login_confirm()
    {
        $jsonStr = $this->input->post('jsonStr');

        $res = $this->user->login_confirm($jsonStr);

        res_write($res);
    }

    // user logout
    public function logout() {
        $this->session->userdata['isUserLogin'] = false;
        $this->session->userdata['role'] = '';
        $this->session->userdata['eamil'] = '';
        $this->session->userdata['userid'] = '';

        redirect('/');
    }

    // go to womans page before login
    public function l_signup()
    {
        redirect_developer_login();

        $data["menu"] =  8; // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["countries"] =  $this->user->get_countries(); // countries list
        $this->load->view('frontend/l_signup', $data);
    }

    // facebooklogin
    public function facebook_login()
    {
        $jsonStr = $this->input->post('jsonStr');

        $res = $this->user->facebook_login($jsonStr);

        res_write($res);
    }

    // go to main page
    public function main()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page

        $pagenum = $this->input->get('pagenum');                                            // page number
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 6;

        $info = $this->admin->get_searched_product(1, $limit, $pagenum);

        $data["menu"] =  0;
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["list"] = $info["list"];
        $data["cnt"] = $info["cnt"];

        $data["pagenum"] = $pagenum;
        $data["limit"] = $limit;

        // search parameters
        $data["name"] = $this->input->get("name");
        $this->load->view('frontend/main', $data);
    }

    // go to main page
    public function shop()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page

        $pagenum = $this->input->get('pagenum');                                            // page number
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 12;

        $info = $this->admin->get_searched_product(5, $limit, $pagenum);

        $data["menu"] =  9;
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["list"] = $info["list"];
        $data["cnt"] = $info["cnt"];

        $data["pagenum"] = $pagenum;
        $data["limit"] = $limit;

        // search parameters
        $data["name"] = $this->input->get("name");
        $this->load->view('frontend/shop', $data);
    }

    // go to shop_bycategories page
    public function shop_bycategories()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $pagenum = $this->input->get('pagenum');                                            // page number
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 8;

        $info = $this->admin->get_searched_product(2, $limit, $pagenum);

        $data["menu"] =  0;
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["list"] = $info["list"];
        $data["cnt"] = $info["cnt"];// for menu active
        $data["categories"] = $this->admin->get_products_categories();

        $data["pagenum"] = $pagenum;
        $data["limit"] = $limit;

        // search parameters
        $data["name"] = $this->input->get("name");
        $data["category"] = $this->input->get("category");              // selected category id
        $data["trees_dis"] = $this->input->get("trees_dis");                // categories tree display state
        $data["trees_open"] = $this->input->get("trees_open");               // categories tree open state

        $this->load->view('frontend/shop_bycategories', $data);
    }

    // go to main page
    public function shop_byadvanced()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $pagenum = $this->input->get('pagenum');                                            // page number
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 8;

        $info = $this->admin->get_searched_product(3, $limit, $pagenum);

        $data["menu"] =  0;
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["makes"] = $this->admin->get_product_attribute_makes();
        $data["list"] = $info["list"];
        $data["cnt"] = $info["cnt"];// for menu active

        $data["pagenum"] = $pagenum;
        $data["limit"] = $limit;

        // search parameters
        $data["name"] = $this->input->get("name");
        $data["make"] = $this->input->get("make");
        $data["type"] = $this->input->get("type");
        $data["model"] = $this->input->get("model");
        $data["year"] = $this->input->get("year");
        $data["engine"] = $this->input->get("engine");

        if ( $data["make"] != "null" ) $data["types"] = $this->admin->get_product_attribute_types($data["make"]);
        if ( $data["type"] != "null" ) $data["models"] = $this->admin->get_product_attribute_models($data["type"]);
        if ( $data["model"] != "null" ) $data["years"] = $this->admin->get_product_attribute_years($data["model"]);
        if ( $data["year"] != "null" ) $data["engines"] = $this->admin->get_product_attribute_engines($data["year"]);
        $this->load->view('frontend/shop_byadvanced', $data);
    }

    // go to product detail page
    public function product()
    {
        redirect_developer_login();

        $did = $this->input->get("did");
        $data["menu"] =  0;                                                                 // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        if ( isset($_SESSION["userid"]) ) $this->user->add_veiwed_product_byuser( $_SESSION["userid"], $did);
        $data["info"] = $this->admin->get_product_info_viaId_inFrontEnd($did);
        $this->load->view('frontend/product', $data);
    }

    // go to about page
    public function about()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $data["menu"] =  1;                                                                 // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $this->load->view('frontend/about', $data);
    }

    // go to reviews page
    public function reviews()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $data["menu"] =  2;                                                                 // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["reviews"] = $this->admin->get_all_product_reviews(4); // select reviews that rating is bigger that 4 star

        $this->load->view('frontend/reviews', $data);
    }

    // go to returns page
    public function returns()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $data["menu"] =  3;                                                                 // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $this->load->view('frontend/returns', $data);
    }

    // go to contact page
    public function contact()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $data["menu"] =  4;
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $user = null;
        if ( isset($_SESSION["userid"]) ) $user = $_SESSION["userid"];

        $data["user_profile_info"] =  $this->user->get_user_profile_info($user);// for menu active
        $this->load->view('frontend/contact', $data);
    }

    // go to faq page
    public function faq()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page
        $data["menu"] =  5;                                                                 // for menu active
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $this->load->view('frontend/faq', $data);
    }

    // go to online members page
    public function policies()
    {
        redirect_developer_login();

//        redirect_user_home(); // if user did not logined then go to login page

        $data["menu"] =  6;
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $this->load->view('frontend/policies', $data);
    }

    // go to online u_orders page
    public function u_orders()
    {
        redirect_developer_login();

        redirect_user_home(); // if user did not logined then go to login page

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["orders"] = $this->admin->get_all_orders_info( $_SESSION["userid"] );

        $this->load->view('frontend/u_orders', $data);
    }

    // go to online u_messages page
    public function u_messages()
    {
        redirect_developer_login();

        redirect_user_home(); // if user did not logined then go to login page

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );
        $this->load->view('frontend/u_messages', $data);
    }

    // go to online u_addresses page
    public function u_addresses()
    {
        redirect_developer_login();

        redirect_user_home(); // if user did not logined then go to login page

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["user_profile_info"] =  $this->user->get_user_profile_info($_SESSION["userid"]);
        $data["countries"] =  $this->user->get_countries(); // countries list
        if ( isset($data["user_profile_info"]) ) $data["states"] = $this->user->get_provinces_bycountryiso($data["user_profile_info"]->country);
        $this->load->view('frontend/u_addresses', $data);
    }

    // go to online u_wish_lists page
    public function u_wish_lists()
    {
        redirect_developer_login();

        redirect_user_home(); // if user did not logined then go to login page
        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $this->load->view('frontend/u_wish_lists', $data);
    }


    // go to online u_recently_iewed page
    public function u_recently_iewed()
    {
        redirect_developer_login();

        redirect_user_home(); // if user did not logined then go to login page

        $info = $this->admin->get_searched_product(4, 12, 1);

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["list"] =  $info["list"]; // recetly viewed product list

        $this->load->view('frontend/u_recently_iewed', $data);
    }

    // go to online u_account_settings page
    public function u_account_settings()
    {
        redirect_developer_login();

        redirect_user_home(); // if user did not logined then go to login page

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );

        $data["user_profile_info"] =  $this->user->get_user_profile_info($_SESSION["userid"]);
        $this->load->view('frontend/u_account_settings', $data);
    }

    /**
     * go to cart page
     */
    public function cart()
    {
        redirect_developer_login();

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );
        $this->load->view('frontend/cart', $data);
    }

    /**
     * go to checkout page
     */
    public function checkout()
    {
        redirect_developer_login();

        redirect_user_home();                                                                   // if user did not logined then go to login page

        $tab = $this->input->get("tab");
        if ( !isset($tab) || $tab == "" ) $tab = 0;
        $data["tab"] = $tab;

        $cartid = null; if (isset($_SESSION["cartid"])) $cartid = $_SESSION["cartid"];
        $data["cart_product_info"] =  $this->admin->get_products_bycartid( $cartid );           // cart`s product info related current user`s session
        $data["user_info"] = $this->user->get_user_profile_info($_SESSION["userid"]);           // loginned user info
        $data["countries"] =  $this->user->get_countries();                                     // countries list
        $data["billing_address"] = $this->user->get_not_ordered_billing_address_via_curuser();  // billing address info
        $data["shipping_address"] = $this->user->get_not_ordered_shipping_address_via_curuser();// billing address info

        if ( isset($data["billing_address"]) ) $data["b_states"] = $this->user->get_provinces_bycountryiso($data["billing_address"]->country);
        if ( isset($data["shipping_address"]) ) $data["s_states"] = $this->user->get_provinces_bycountryiso($data["shipping_address"]->country);

        $data["shipping_methods"] = $this->admin->get_shipping_methods();                       // shipping methods info
        $data["order"] = $this->user->get_nopaid_onlyordered_row($_SESSION["userid"]);          // non ordered order row
        $data["paypal_info"] = $this->admin->get_paypal_setting_info();                         // get paypal info


        $this->load->view('frontend/checkout', $data);
    }

    // user profile update
    public function user_profile_update()
    {
        $res = $this->user->user_profile_update();

        $res_data = array(
            'status' => 0
        );

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        }

        res_write($res_data);
    }

    // update loginned user`s email
    public function update_user_email()
    {
        $email = $this->input->post("email");
        $res = $this->user->update_user_email($_SESSION["userid"], $email);

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
            $_SESSION["email"] = $email;
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // update loginned user`s password
    public function update_user_password()
    {
        $password = $this->input->post("password");
        $res = $this->user->update_user_password($_SESSION["userid"], $password);

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // submit contact
    public function submit_contact_us_info()
    {
        $res = $this->user->submit_contact();

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // submit product review
    public function write_product_review()
    {
        $res = $this->admin->write_product_review();

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * add new product to cart
    */
    public function add_product_tocart()
    {
        $ret =  $this->admin->add_product_tocart();

        redirect("front/cart");
    }

    /**
     * update cart`s product number
    */
    public function update_cart_product_count()
    {
        $res = $this->admin->update_cart_product_count();

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * remove product in cart by id
    */
    public function remove_product_incart_byid()
    {
        $ret =  $this->admin->remove_product_incart_byid( $this->input->get("did") );
        redirect("front/cart");
    }

    /**
     * set billing address via user`s address
     */
    public function set_billing_address_via_useraddress()
    {
        $res = $this->user->set_billing_address_via_useraddress();

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'id'=>$res
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * set billing address newly
     */
    public function set_billing_address_newly()
    {
        $res = $this->user->set_billing_address_newly();

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'id'=>$res
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * set shipping address via user`s address
     */
    public function set_shipping_address_via_useraddress()
    {
        $res = $this->user->set_shipping_address_via_useraddress();

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'id'=>$res
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * set shipping address newly
     */
    public function set_shipping_address_newly()
    {
        $res = $this->user->set_shipping_address_newly();

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'id'=>$res
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * set order in checkout page
     */
    public function set_order_incheckout()
    {
        $res = $this->user->set_order_incheckout();

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'id'=>$res
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * set order in checkout page
     */
    public function set_order_confirm_incheckout()
    {
        $res = $this->user->set_order_confirm_incheckout();

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    /**
     * payment complete process
     */
    public function payment_complete_proc()
    {
        $res = $this->user->payment_complete_proc();

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // confirm user password
    public function confirm_user_password()
    {
        $password = $this->input->post("password");

        $res = $this->user->confirm_user_password( $_SESSION["userid"], $password );

        if( $res ) {
            $res_data = array(
                'status' => 1
            );
        } else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // get all provinces of relative country
    public function get_provinces()
    {
        $country = $this->input->post('country');

        $res = $this->user->get_provinces_bycountryiso($country);

        if( $res != null ) {
            $res_data = array(
                'status' => 1,
                'list'=>$res
            );
        }
        else {
            $res_data = array(
                'status' => 0,
                'list'=>''
            );
        }

        res_write($res_data);
    }





/////////////////////////////////////////////////////////////////////////////////
/// *********************************************************************////////
/////////////////////////////////////////////////////////////////////////////////



    // go to matches page
    public function h_matches()
    {
        redirect_user_home(); // if user did not logined then go to login page


        $pagenum = $this->input->get('pagenum');
        if ( isset($pagenum) == false ) $pagenum = 1;
        $grid = $this->input->get('grid');
        if ( isset($grid) == false ) $grid = 0;
        $limit = 12;

        $info = $this->user->get_users_list(5, null, $limit, $pagenum);

        $data["menu"] =  2; // for menu active
        $data["pagenum"] = $pagenum;
        $data["grid"] = $grid;
        $data["limit"] = $limit;
        $data["cnt"] = $info["cnt"];
        $data["list"] = $info["list"];
        $this->load->view('frontend/h_matches', $data);
    }

    // go to matches page
    public function h_search()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $pagenum = $this->input->get('pagenum');
        if ( isset($pagenum) == false ) $pagenum = 1;
        $grid = $this->input->get('grid');
        if ( isset($grid) == false ) $grid = 0;
        $limit = 12;
        $search_type = $this->input->get('search_type');    // 7=> saved search
        if ( isset($search_type) == false ) $search_type = 6;
        $search = $this->input->get('search');              // users_search table`s primary key
        if ( isset($search) == false ) $search = null;


        $info = $this->user->get_users_list(intval($search_type), $search, $limit, $pagenum);

//        $data["menu"] =  3; // for menu active
        $data["pagenum"] = $pagenum;
        $data["grid"] = $grid;
        $data["limit"] = $limit;
        $data["cnt"] = $info["cnt"];
        $data["search_type"] = $search_type;
        $data["list"] = $info["list"];
        $this->load->view('frontend/h_search', $data);
    }

    // go to search page
    public function h_search_advanced()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $data["menu"] =  3; // for menu active
        $data["countries"] =  $this->user->get_countries(); // countries list
        $data["saved_search"] = $this->user->get_saved_searchinfo_byid($this->input->get('did'));
        if ( isset($data["saved_search"]) ) $data["states"] = $this->user->get_provinces_bycountryiso($data["saved_search"]->country);
        $this->load->view('frontend/h_search_advanced', $data);
    }

    // go to search page
    public function h_search_saved()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $data["menu"] =  3; // for menu active
        $data["list"] = $this->user->get_saved_search_byuser();
        $this->load->view('frontend/h_search_saved', $data);
    }

    // go to search page
    public function h_search_cupid()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $data["menu"] =  3; // for menu active
        $this->load->view('frontend/h_search_cupid', $data);
    }

    // go to messages page
    public function h_messages()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $data["menu"] =  4; // for menu active
        $this->load->view('frontend/h_messages', $data);
    }

    // go to user`s info view page
    public function display_user_profile()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $user = $this->input->get("user");

        // register user profile view
        $this->user->register_viewed_user( $_SESSION["userid"], $user );

        $data["user_profile_info"] =  $this->user->get_user_profile_info($user);                    // user profile
        $data["photos"] = $this->user->get_user_photos($user);                                      // get all photos that registered before. the max count is 5
        $data["match"] =  $this->user->get_matchinfo_byuser($user);                                 // user match info
        $data["interest"] =  $this->user->get_interestinfo_byuser($user);                           // user interest info
        $data["personality"] =  $this->user->get_personalityinfo_byuser($user);                     // user personality info

        $data["countries"] =  $this->user->get_countries();
        if ( isset($data["user_profile_info"]) ) $data["states"] = $this->user->get_provinces_bycountryiso($data["user_profile_info"]->country);

        $this->load->view('frontend/u_profile', $data);
    }

    // go to profile  page of edit profile
    public function ep_profile()
    {
        redirect_user_home(); // if user did not logined then go to login page

        $data["user_profile_info"] =  $this->user->get_user_profile_info($_SESSION["userid"]); // user profile
        $data["countries"] =  $this->user->get_countries(); // countries list
        if ( isset($data["user_profile_info"]) ) $data["states"] = $this->user->get_provinces_bycountryiso($data["user_profile_info"]->country);
        $this->load->view('frontend/ep_profile', $data);
    }

    // go to photos  page of edit profile
    public function ep_photos()
    {
        redirect_user_home();                                                   // if user did not logined then go to login page
        $data["photos"] = $this->user->get_user_photos($_SESSION["userid"]);    // get all photos that registered before. the max count is 5
        $this->load->view('frontend/ep_photos', $data);
    }

    // go to matchs vof edit profile
    public function ep_matchs()
    {
        redirect_user_home();                                                       // if user did not logined then go to login page
        $data["user_profile_info"] =  $this->user->get_user_profile_info($_SESSION["userid"]);         // user profile
        $data["countries"] =  $this->user->get_countries();                         // countries list
        $data["match"] =  $this->user->get_matchinfo_byuser($_SESSION["userid"]);   // user match info
        if ( isset($data["match"]) ) $data["states"] = $this->user->get_provinces_bycountryiso($data["match"]->country);
        $this->load->view('frontend/ep_matchs', $data);
    }

    // go to interest  page of edit profile
    public function ep_interest()
    {
        redirect_user_home(); // if user did not logined then go to login page
        $data["interest"] =  $this->user->get_interestinfo_byuser($_SESSION["userid"]); // user interest info
        $this->load->view('frontend/ep_interest', $data);
    }

    // go to personality  page of edit profile
    public function ep_personality()
    {
        redirect_user_home(); // if user did not logined then go to login page
        $data["personality"] =  $this->user->get_personalityinfo_byuser($_SESSION["userid"]); // user personality info
        $this->load->view('frontend/ep_personality', $data);
    }


    // go to verufy  page of edit profile
    public function ep_verify()
    {
        redirect_user_home(); // if user did not logined then go to login page
        $data["verify"] =  $this->user->get_verifyinfo_byuser($_SESSION["userid"]); // user personality info
        $this->load->view('frontend/ep_verify', $data);
    }

    // go to cupidtags page of edit profile
    public function ep_cupidtags()
    {
        redirect_user_home(); // if user did not logined then go to login page
        $data["cupids"] =  $this->user->get_cupidlist_byuser($_SESSION["userid"]); // user cupid list info
        $this->load->view('frontend/ep_cupidtags', $data);
    }

    // go to imbra page of edit profile
    public function ep_imbra()
    {
        redirect_user_home(); // if user did not logined then go to login page
        $data["countries"] =  $this->user->get_countries(); // countries list
        $data["user"] =  $this->user->get_user_profile_info($_SESSION["userid"]); // user profile
        $data["residences"] =  $this->user->get_residence_list_byuser($_SESSION["userid"]);
        $data["imbra"] =  $this->user->get_imbra_byuser($_SESSION["userid"]);
        $this->load->view('frontend/ep_imbra', $data);
    }

    // go to womans page before login
    public function l_women()
    {
        $pagenum = $this->input->get('pagenum');
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 6;

        $info = $this->user->get_users_list(2, null, $limit, $pagenum);

        $data["menu"] =  6; // for menu active
        $data["pagenum"] = $pagenum;
        $data["limit"] = $limit;
        $data["cnt"] = $info["cnt"];
        $data["list"] = $info["list"];
        $this->load->view('frontend/l_women', $data);
    }

    // go to womans page before login
    public function l_men()
    {
        $pagenum = $this->input->get('pagenum');
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 6;

        $info = $this->user->get_users_list(1, null, $limit, $pagenum);

        $data["menu"] =  7; // for menu active
        $data["cnt"] = $info["cnt"];
        $data["pagenum"] = $pagenum;
        $data["limit"] = $limit;
        $data["list"] = $info["list"];
        $this->load->view('frontend/l_men', $data);
    }

    // go to email change page
    public function as_email()
    {
        $data["user"] =  $this->user->get_user_profile_info($_SESSION["userid"]); // user profile
        $this->load->view('frontend/as_email', $data);
    }

    // go to email change page
    public function as_password()
    {
        $data["user"] =  $this->user->get_user_profile_info($_SESSION["userid"]); // user profile
        $this->load->view('frontend/as_password', $data);
    }

    // go to email change page
    public function as_billing()
    {
        $data["user"] =  $this->user->get_user_profile_info($_SESSION["userid"]); // user profile
        $this->load->view('frontend/as_billing', $data);
    }

    // go to email change page
    public function as_notification()
    {
        if ( $this->input->post("notification") )
            $this->user->set_user_notification( $_SESSION["userid"] );
        $data["user"] =  $this->user->get_user_profile_info($_SESSION["userid"]); // user profile
        $data["notification"] = $this->user->get_user_notification( $_SESSION["userid"] );
        $this->load->view('frontend/as_notification', $data);
    }

    // go to interested in me page
    public function act_interested_mine()
    {
        $this->load->view('frontend/act_interested_mine');
    }

    // go to favorited in me page
    public function act_favorited_mine()
    {
        $this->load->view('frontend/act_favorited_mine');
    }

    // go to interested in me page
    public function act_viewed_myprofile()
    {
        $this->load->view('frontend/act_viewed_myprofile');
    }

    // go to interested in me page
    public function act_myinterests()
    {
        $this->load->view('frontend/act_myinterests');
    }

    // go to interested in me page
    public function act_myfavorites()
    {
        $this->load->view('frontend/act_myfavorites');
    }

    // go to interested in me page
    public function act_myviews()
    {
        $this->load->view('frontend/act_myviews');
    }

    // go to interested in me page
    public function act_blocklists()
    {
        $this->load->view('frontend/act_blocklists');
    }

    /*****************************--ajx--*****************************/
    // new user free sign up in landing page
    public function lsignup()
    {
        $jsonStr = $this->input->post('jsonStr');

        $res = $this->user->free_user_lsignup($jsonStr);

        res_write($res);
    }

    // get all provinces   of relative country
    public function get_cities()
    {
        $country = $this->input->post('country');
        $region = $this->input->post('region');

        $res = $this->user->get_cities_byregioncode($country, $region);

        if( $res = null ) {
            $res_data = array(
                'status' => 1,
                'list'=>$res
            );
        }
        else {
            $res_data = array(
                'status' => 0,
                'list'=>''
            );
        }

        res_write($res_data);
    }

    // user photos upload
    public function user_photo_upload()
    {
        $config['upload_path']          = './uploads/users/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $photoid =  $region = $this->input->post('photoid'); // if insert then => 0 or null, else if update (repalce), then => val > 0

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('errors/upload_error', $error);
        }
        else
        {
            $upalod_data = $this->upload->data();
            $upalod_data["photoid"] = $photoid;
            // db register
            $res = $this->user->user_photo_add($upalod_data);
           redirect("front/ep_photos");
        }
    }

    // user verify code upload
    public function user_verify_card_upload()
    {
        $config['upload_path']          = './uploads/usercards/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 5000000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('errors/upload_error', $error);
        }
        else
        {
            $upalod_data = $this->upload->data();
            // db register
            $res = $this->user->user_verify_card_add($upalod_data);
            redirect("front/ep_verify");
        }
    }

    // insert or update user matche info
    public function ep_update_matche_info()
    {
        $res = $this->user->user_matche_update();
        redirect("front/ep_matchs");
    }

    // insert or update user interest info
    public function ep_update_interest_info()
    {
        $res = $this->user->user_interest_update();
        redirect("front/ep_interest");
    }

    // insert or update user personality info
    public function ep_update_personality_info()
    {
        $res = $this->user->user_personality_update();
        redirect("front/ep_personality");
    }

    // add user`s new cupid
    public function ep_add_cupid_info()
    {
        $res = $this->user->user_cupid_add();
        redirect("front/ep_cupidtags");
    }

    // remove current cupid tag
    public function ep_remove_cupidtag()
    {
        $did = $this->input->post("did");
        $res = $this->user->ep_remove_cupidtag($did);

        if($res) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // rename current saved search
    public function h_search_rename()
    {
        $did = $this->input->post("did");
        $title = $this->input->post("title");
        $res = $this->user->h_search_rename($did, $title);

        if($res) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }
    // remove current saved search
    public function h_search_remove()
    {
        $did = $this->input->post("did");
        $res = $this->user->h_search_remove($did);

        if($res) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // add new residence
    public function ep_add_new_residence()
    {
        $country = $this->input->post("country");
        $state = $this->input->post("state");
        $res = $this->user->add_new_residence($country, $state);

        if($res) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // remove selected residence
    public function ep_remove_cur_residence()
    {
        $id = $this->input->post("id");
        $res = $this->user->remove_cur_residence($id);

        if($res) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        res_write($res_data);
    }

    // insert or update residence via user
    public function ep_update_residenceinfo()
    {
        $res = $this->user->update_residenceinfo();

        redirect("front/ep_imbra");
    }

    // record ( update ) logined current time
    public function record_current_state()
    {
        $res = $this->user->record_current_state();
        if($res) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }
        res_write($res_data);
    }

    // get user info
    public function get_user_profile_info()
    {
        $user = $this->input->post("user");
        $info = $this->user->get_other_user_profile_info($user, $_SESSION["userid"]);
        if($info) {
            $res_data = array(
                'status' => 1,
                'info' => $info
            );
        }
        else {
            $res_data = array(
                'status' => 0,
                'info' => null
            );
        }
        res_write($res_data);
    }

    // set interest
    public function set_interest()
    {
        $touser = $this->input->post("user");
        $state = $this->input->post("state");

        $info = $this->user->set_interest($_SESSION["userid"], $touser, $state);
        if($info) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }
        res_write($res_data);
    }

    // set favorite
    public function set_favorite()
    {
        $touser = $this->input->post("user");
        $state = $this->input->post("state");

        $info = $this->user->set_favorite($_SESSION["userid"], $touser, $state);
        if($info) {
            $res_data = array(
                'status' => 1
            );
        }
        else {
            $res_data = array(
                'status' => 0
            );
        }
        res_write($res_data);
    }

    // set block
    public function set_block()
    {
        $touser = $this->input->post("user");
        $state = $this->input->post("state");

        $info = $this->user->set_block($_SESSION["userid"], $touser, $state);
        if($info) {
        $res_data = array(
            'status' => 1
        );
    }
    else {
        $res_data = array(
            'status' => 0
        );
    }
        res_write($res_data);
    }
}

