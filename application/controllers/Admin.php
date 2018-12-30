<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * date: 2018/01/30
 * coder: hmc
 * detail: back end manage
 */
class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("adminModel","admin",true);
        $this->load->model("userModel","user",true);
        $this->load->helper(array('form', 'url'));
        $this->load->library('GoogleAuthenticator');
    }

    // go to index page
    public function index()
    {
        redirect_admin_home();

        $data["rusers"] = $this->admin->get_recent_users(5);
        $data["rproducts"] = $this->admin->get_recent_products(5);
        $this->load->view('backend/index', $data);
    }

    // go to login page
    public function login()
    {
        $this->load->view('backend/login');
    }

    // confirm login
    public function login_confirm()
    {
        $ret = $this->admin->login_confirm();
        if ( $ret ) {
            // register to session
            $this->session->userdata['userid'] = $ret->id;
            $this->session->userdata['email'] = $ret->email;

            if ( $ret->is_2fa == "1" ) {
                redirect("admin/go_2fa");
            } else {
                $this->session->userdata['isUserLogin'] = true;
                $this->session->userdata['role'] = 'admin';
                redirect("admin/");
            }
        } else {
            $data["alert"] = "Invalid email or password. Please try again.";
            $this->load->view('backend/login', $data);
        }

    }

    /**
     * confirm 2fa code
     * 2018-11-04 by hmc
    */
    public function go_2fa()
    {
       $this->load->view('backend/confirm_2fa');
    }

    /**
     * confirm 2fa code
     * 2018-11-04 by hmc
     */
    public function confirm_2fa()
    {
        $admin = $this->admin->get_one_user($_SESSION["userid"]);
        $gaobj = new GoogleAuthenticator();
        $oneCode = $this->input->post('token');
        $checkResult = true; // $gaobj->verifyCode($admin->auth_key, $oneCode, 2); // 2 = 2*30sec clock tolerance
        if ( $checkResult ) {
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['role'] = 'admin';
            redirect("admin/");
        } else {
            $data["alert"] = "Invalid 2FA Code.";
            $this->load->view('backend/confirm_2fa', $data);
        }
    }

    // go to product_new page
    public function product_new()
    {
        redirect_admin_home();

        $data["did"] = $this->input->get("did");
        $data["info"] = $this->admin->get_product_info_viaId($this->input->get("did"));
        $data["list"] = $this->admin->get_products_categories();
        $data["makes"] = $this->admin->get_product_attribute_makes();
        $data["specs"] = $this->admin->get_product_spec_items();
        $data["products"] = $this->admin->get_product_list();
        $data["brands"] = $this->admin->get_replacement_brand_items();
        $data["services"] = $this->admin->get_replacement_services_items();

        $this->load->view('backend/product_new', $data);
    }

    // get product name & code json list info
    public function get_product_list_for_autocomplete()
    {
        $res = $this->admin->get_product_list_for_autocomplete($this->input->post("query"));

        $res_data = array(
            'status' => 0
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // go to products_all page
    public function products_all()
    {
        redirect_admin_home();
        $search_key = $this->input->get("search_key");
        $pagenum = $this->input->get('pagenum');                                            // page number
        if ( isset($pagenum) == false ) $pagenum = 1;
        $limit = 15;

        $info = $this->admin->get_product_list_bysearch( $search_key, $limit, $pagenum );

        $data["list"] = $info["list"];
        $data["cnt"] = $info["cnt"];
        $data["search_key"] = $search_key;
        $data["limit"] = $limit;
        $data["pagenum"] = $pagenum;
        $this->load->view('backend/products_all', $data);
    }

    // go to product_categories page
    public function product_categories()
    {
        redirect_admin_home();

        $data["list"] = $this->admin->get_products_categories();
        $this->load->view('backend/product_categories', $data);
    }

    // go to product_attributes page
    public function product_attributes()
    {
        redirect_admin_home();

        $data["makes"] = $this->admin->get_product_attribute_makes();
        $this->load->view('backend/product_attributes', $data);
    }

    // go to product_spec_bran_items page
    public function product_spec_bran_items()
    {
        redirect_admin_home();

        $data["spces"] = $this->admin->get_product_spec_items();
        $data["brands"] = $this->admin->get_replacement_brand_items();
        $data["services"] = $this->admin->get_replacement_services_items();
        $this->load->view('backend/product_spec_bran_items', $data);
    }

    // go to orders page
    public function orders()
    {
        redirect_admin_home();

        $data["orders"] = $this->admin->get_all_orders_info( null );
        $this->load->view('backend/orders', $data);
    }

    // go to user_add page
    public function user_add()
    {
        redirect_admin_home();

        $data["user"] = $this->admin->get_one_user( $this->input->get("id") );
        $data["countries"] =  $this->user->get_countries(); // countries list
        if ( isset($data["user"]) ) $data["states"] = $this->user->get_provinces_bycountryiso($data["user"]->country);
        $this->load->view('backend/user_add', $data);
    }


    // go to users_all page
    public function users_all()
    {
        redirect_admin_home();

        $data["list"] = $this->admin->get_all_users();
        $this->load->view('backend/users_all', $data);
    }

    // go to user_log page
    public function user_log()
    {
        redirect_admin_home();

        $data["list"] = $this->admin->get_all_users_logs();
        $this->load->view('backend/user_log', $data);
    }

    // go to reviews page
    public function reviews()
    {
        redirect_admin_home();

        $data["reviews"] = $this->admin->get_all_product_reviews(null);
        $this->load->view('backend/reviews', $data);
    }

    // go to customer_contact page
    public function customer_contact()
    {
        redirect_admin_home();

        $data["contacts"] = $this->admin->get_all_customer_contacts();
        $this->load->view('backend/customer_contact', $data);
    }

    // go to setting_general page
    public function setting_general()
    {
        redirect_admin_home();
        $this->load->view('backend/setting_general');
    }

    // go to setting_payment page
    public function setting_payment()
    {
        redirect_admin_home();

        $data["paypal_info"] = $this->admin->get_paypal_setting_info();
//        $data["shipping_methods"] = $this->admin->get_shipping_methods();
        $this->load->view('backend/setting_payment', $data);
    }

    // go to setting_shipping_method page
    public function setting_shipping_method()
    {
        redirect_admin_home();

//        $data["paypal_info"] = $this->admin->get_paypal_setting_info();
        $data["shipping_methods"] = $this->admin->get_shipping_methods();
        $this->load->view('backend/setting_shipping_method', $data);
    }

    // go to setting_import_csv page
    public function setting_import_csv()
    {
        redirect_admin_home();

        $this->load->view('backend/setting_import_csv');
    }

    // go to setting_myprofile page
    public function setting_myprofile()
    {
        redirect_admin_home();
        $this->load->view('backend/setting_myprofile');
    }

    // go to chat_manage page
    public function chat_manage()
    {
        redirect_admin_home();
        $this->load->view('backend/chat_manage');
    }

    // log out
    public function logout()
    {
        $this->session->userdata['isUserLogin'] = false;
        $this->session->userdata['role'] = '';
        $this->session->userdata['eamil'] = '';
        $this->session->userdata['userid'] = '';

        redirect('admin/');
    }

    /********************** data manage ***********************/
    // add new user
    public function add_new_user()
    {
        $ret = $this->admin->add_new_user();
        if ( $ret == 3 ) {
            redirect( "admin/users_all" );
        } else if ( $ret == 2 ) {
            $data["alert"] = "Current email exist already. Please try to enter other email.";
            $this->load->view('backend/user_add', $data);
        } else {
            $this->load->view('backend/user_add');
        }
    }

    // delete one user
    public function delete_one_user()
    {
        $id = $this->input->get("id");
        $ret = $this->admin->delete_one_user( $id );
        redirect("admin/users_all");
    }

    // user photos upload
    public function user_photo_upload()
    {
        header('Content-Type: application/json');
        $config['upload_path']   = './uploads/pcategories/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        }else {
            $data = $this->upload->data();
            $success = ['success'=>$data['file_name']];
            echo json_encode($success);
        }
    }

    // add new product category
    public function add_new_product_category()
    {
        $res = $this->admin->add_new_product_category();

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

    // delete one product category
    public function delete_one_product_category()
    {
        $res = $this->admin->delete_one_product_category( $this->input->post("id") );

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

    // add new prodcut attribute make
    public function add_new_product_attribute_make()
    {
        $res = $this->admin->add_new_product_attribute_make( $this->input->post("title") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // delete prodcut attribute make
    public function delete_product_attribute_via_id()
    {
        $res = $this->admin->delete_product_attribute_via_id( $this->input->post("id"), $this->input->post("kind") );

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

    // add new prodcut attribute type
    public function add_new_product_attribute_type()
    {
        $res = $this->admin->add_new_product_attribute_type( $this->input->post("title"), $this->input->post("make") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // get all types related a make
    public function get_product_attribute_types()
    {
        $res = $this->admin->get_product_attribute_types( $this->input->post("make") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // add new prodcut attribute model
    public function add_new_product_attribute_model()
    {
        $res = $this->admin->add_new_product_attribute_model( $this->input->post("title"), $this->input->post("type") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // get all models related a type
    public function get_product_attribute_models()
    {
        $res = $this->admin->get_product_attribute_models( $this->input->post("type") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // get all years related a model
    public function get_product_attribute_years()
    {
        $res = $this->admin->get_product_attribute_years( $this->input->post("model") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // add new prodcut attribute year
    public function add_new_product_attribute_year()
    {
        $res = $this->admin->add_new_product_attribute_year( $this->input->post("title"), $this->input->post("model") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // get all engines related a year
    public function get_product_attribute_engines()
    {
        $res = $this->admin->get_product_attribute_engines( $this->input->post("year") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // add new prodcut attribute engine
    public function add_new_product_attribute_engine()
    {
        $res = $this->admin->add_new_product_attribute_engine( $this->input->post("title"), $this->input->post("year") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // get all options related a year
    public function get_product_attribute_options()
    {
        $res = $this->admin->get_product_attribute_options( $this->input->post("engine") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // add new prodcut attribute option
    public function add_new_product_attribute_option()
    {
        $res = $this->admin->add_new_product_attribute_option( $this->input->post("title"), $this->input->post("engine") );

        $res_data = array(
            'status' => 0,
            'list' => null
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'list' => $res
            );
        }

        res_write($res_data);
    }

    // publish product
    public function publish_products()
    {
        $res = $this->admin->publish_products();

        $res_data = array(
            'status' => 0,
            'did' => ""
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'did' => $res
            );
        }
        res_write($res_data);
    }

    // get_product_application_list_for_edit
    public function get_product_application_list_for_edit()
    {
        $res = $this->admin->get_product_application_list_for_edit();

        $res_data = array(
            'status' => 0,
            'json' => ""
        );

        if( $res ) {
            $res_data = array(
                'status' => 1,
                'json' => $res
            );
        }
        res_write($res_data);
    }

    // delete this product
    public function delete_one_product()
    {
        $res = $this->admin->delete_one_product( $this->input->get("did") );

        redirect("admin/products_all");
    }

    // delete this product
    public function delete_one_product_inaddingpage()
    {
        $res = $this->admin->delete_one_product( $this->input->post("did") );

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


    // add_new_product_spec
    public function add_new_product_spec()
    {
        $res = $this->admin->add_new_product_spec( $this->input->post("title") );

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
    // delete current produc spec item
    public function delete_current_product_spec()
    {
        $res = $this->admin->delete_current_product_spec( $this->input->post("did") );

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

    // add new replacement item
    public function add_new_replacement_brand()
    {
        $res = $this->admin->add_new_replacement_brand( $this->input->post("title") );

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

    // add_new_replacement_service_part item
    public function add_new_replacement_service_part()
    {
        $res = $this->admin->add_new_replacement_service_part( $this->input->post("title") );

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

    // delete current replacement item
    public function delete_current_replacement_brand()
    {
        $res = $this->admin->delete_current_replacement_brand( $this->input->post("did") );

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

    // delete_current_service_part
    public function delete_current_service_part()
    {
        $res = $this->admin->delete_current_service_part( $this->input->post("did") );

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

    // update admin paypal info
    public function update_admin_paypal_info()
    {
        $res = $this->admin->update_admin_paypal_info();

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

    // add new shipping method
    public function add_new_shipping_method()
    {
        $res = $this->admin->add_new_shipping_method();

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

    // update current shipping method
    public function update_current_shipping_method()
    {
        $res = $this->admin->update_current_shipping_method();

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

    // delete current shipping method
    public function remove_current_shipping_method()
    {
        $res = $this->admin->remove_current_shipping_method();

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

    // reply_customer_contact_message
    public function reply_customer_contact_message()
    {
        $res = $this->admin->reply_customer_contact_message();

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

    // chnage_one_product_quanity
    public function chnage_one_product_quanity()
    {
        $res = $this->admin->chnage_one_product_quanity();

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

    // chnage_one_product_sale_price
    public function chnage_one_product_sale_price()
    {
        $res = $this->admin->chnage_one_product_sale_price();

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


    // import replacement list csv
    public function import_replacement_data_csv()
    {
        $path = $_FILES["employee_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["brand"] = array();
        $result["value"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( $i ==0 && ( strtolower($data[0]) == "brand" || strtolower($data[0]) == "value" ) ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_replacement_brads_csv($result);

        $res_data = array(
            'status' => 1,
            'json'=>$res
        );
        res_write($res_data);
    }

    // import product spec csv
    public function import_product_spec_csv()
    {
        $path = $_FILES["productspec_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["spec"] = array();
        $result["value"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( $i ==0 && ( strtolower($data[0]) == "spec" || strtolower($data[0]) == "value" ) ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_product_spec_csv($result);

        $res_data = array(
            'status' => 1,
            'json'=>$res
        );
        res_write($res_data);
    }

    // import service parts csv
    public function import_service_parts_csv()
    {
        $path = $_FILES["service_parts"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["service"] = array();
        $result["value"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( $i ==0 && ( trim(strtolower($data[0])) == "description" || trim(strtolower($data[0])) == "part number" ) ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_service_parts_csv($result);

        $res_data = array(
            'status' => 1,
            'json'=>$res
        );
        res_write($res_data);
    }


    // import application list csv file info
    public function import_application_data_csv()
    {
        $path = $_FILES["application_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["make"] = array();
        $result["type"] = array();
        $result["model"] = array();
        $result["year"] = array();
        $result["engine"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( $i ==0 && ( strtolower($data[0]) == "make" ||
                            strtolower($data[0]) == "type" ||
                            strtolower($data[0]) == "model" ||
                            strtolower($data[0]) == "year" ||
                            strtolower($data[0]) == "engine" ) ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_application_list_csv($result);

        $res_data = array(
            'status' => 1,
            'json'=>$res
        );
        res_write($res_data);
    }

    // get application update info via product primary key
    public function get_application_info_via_productid()
    {
        $res = $this->admin->get_application_info_via_productid($this->input->post("id"));
        $res_data = array(
            'status' => 1,
            'json'=>$res
        );
        res_write($res_data);
    }

    // import cetegories in setting
    public function import_categpries_data_csv_in_setting()
    {
        $path = $_FILES["categories_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["temp"] = array();
        $result["parent_id"] = array();
        $result["title"] = array();
        $result["level"] = array();
        $result["order"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( strtolower($data[$i]) == "ppp_temp" ||
                            strtolower($data[$i]) == "ppp_title" ||
                            strtolower($data[$i]) == "ppp_parent_id" ||
                            strtolower($data[$i]) == "ppp_level" ||
                            strtolower($data[$i]) == "ppp_order" ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_categpries_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // import products in setting
    public function import_products_data_csv_in_setting()
    {
        $path = $_FILES["products_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["temp"] = array();
        $result["name"] = array();
        $result["code"] = array();
        $result["price"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( strtolower($data[$i]) == "ppp_temp" ||
                        strtolower($data[$i]) == "ppp_name" ||
                        strtolower($data[$i]) == "ppp_code" ||
                        strtolower($data[$i]) == "ppp_price" ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_products_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // import product`s photos in setting
    public function import_products_photos_data_csv_in_setting()
    {
        $path = $_FILES["products_photos_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["filename"] = array();
        $result["product_id"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( strtolower($data[$i]) == "filename" ||
                        strtolower($data[$i]) == "product_id" ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_products_photos_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // import product`s categories in setting
    public function import_products_categories_data_csv_in_setting()
    {
        $path = $_FILES["products_categories_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["product_id"] = array();
        $result["category_id"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( strtolower($data[$i]) == "product_id" ||
                        strtolower($data[$i]) == "category_id" ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_products_categories_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // import product`s applications in setting
    public function import_products_applications_data_csv_in_setting()
    {
        $path = $_FILES["products_applications_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["make"] = array();
        $result["type"] = array();
        $result["model"] = array();
        $result["year"] = array();
        $result["engine"] = array();
        $result["product_id"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( strtolower($data[0]) == "make" ||
                            strtolower($data[0]) == "type" ||
                            strtolower($data[0]) == "model" ||
                            strtolower($data[0]) == "year" ||
                            strtolower($data[0]) == "engine" ||
                            strtolower($data[0]) == "product_id" ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_products_applications_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // import product`s replacements in setting
    public function import_products_replacements_data_csv_in_setting()
    {
        $path = $_FILES["products_replacements_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["brand"] = array();
        $result["value"] = array();
        $result["product_id"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( strtolower($data[0]) == "brand" ||
                            strtolower($data[0]) == "value" ||
                            strtolower($data[0]) == "product_id" ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_products_replacements_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // import product`s advance spec in setting
    public function import_products_advanced_data_csv_in_setting()
    {
        $path = $_FILES["products_advanced_file"]["tmp_name"];
        $file_handle = fopen($path, "r");
        $result = array();
        $result["spec"] = array();
        $result["value"] = array();
        $result["product_id"] = array();
        if ($file_handle !== FALSE) {
            while (($data = fgetcsv($file_handle)) !== FALSE) {
                $i = 0;
                foreach($result as &$column) {
                    if ( $i ==0 && ( strtolower($data[0]) == "spec" ||
                            strtolower($data[0]) == "value" ||
                            strtolower($data[0]) == "product_id" ) ) continue;
                    $column[] = $data[$i++];
                }
            }
            fclose($file_handle);
        }

        $res = $this->admin->import_products_advanced_data_csv_in_setting($result);

        $res_data = array(
            'status' => 1
        );
        res_write($res_data);
    }

    // make replacement product page for search
    public function make_replacement_search_product_table()
    {
        $this->admin->make_replacement_search_product_table();
        $this->load->view('backend/setting_import_csv');
    }

}
