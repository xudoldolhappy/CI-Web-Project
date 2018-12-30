<?php
class UserModel extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /**
     * new user free sign up in landing page
     * @param : $jsonStr: sign up info
     * @return : 1=> sign up success, 0=> failed, 2=> email exist in db already
    */
    public function free_user_lsignup($jsonStr)
    {
        $json = json_decode($jsonStr);

        $first_name = $json->first_name;
        $last_name = $json->last_name;
        $email = $json->email;
        $phone = $json->phone;
        $password = $json->password;
        $country = $json->country;
        $state = $json->state;
        $address1 = $json->address1;
        $address2 = $json->address2;
        $city = $json->city;
        $zip = $json->zip;

        // confirm weather duplicate email
        $sql = "SELECT * FROM users WHERE `email`=?;";
        $query = $this->db->query($sql, array($email));
        $row = $query->row();
        if (isset($row)) {
            $res_data = array(
                'status' => 2
            );

            return $res_data;
        }

        // new suer register in landing page
        $sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `password`, `country`, `state`, `address1`, 
                `address2`, `city`, `zip`, `phone`) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
        $res = $this->db->query($sql, array($first_name, $last_name, $email, $password, $country, $state, $address1,
                $address2, $city, $zip, $phone ));
        $userid = $this->db->insert_id();

        if($res) {
            $res_data = array(
                'status' => 1
            );

            // register to session
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['role'] = 'user';
            $this->session->userdata['eamil'] = $email;
            $this->session->userdata['userid'] = $userid;

        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        // register login log
        $sql = "INSERT INTO users_logs (`user`, `datetime`)
                VALUES((select max(id) from users), now())";
        $this->db->query($sql);

        return $res_data;
    }

    /**
     * face book login
    */
    public function facebook_login($jsonStr)
    {
        $json = json_decode($jsonStr);

        $first_name = $json->first_name;
        $last_name = $json->last_name;
//        $sex = $json->sex;
        $email = $json->email;

        // confirm weather duplicate email
        $sql = "SELECT * FROM users WHERE `email`=?;";
        $query = $this->db->query($sql, array($email));
        $row = $query->row();
        if (isset($row)) {
            $res_data = array(
                'status' => 1
            );

            // register to session
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['role'] = 'user';
            $this->session->userdata['email'] = $row->email;
            $this->session->userdata['userid'] = $row->id;

            return $res_data;
        }

        // new suer register in landing page
        $sql = "INSERT INTO users (`first_name`, `last_name`, `email` ) 
                VALUES(?, ?, ?)";
        $res = $this->db->query($sql, array($first_name, $last_name, $email ));
        $userid = $this->db->insert_id();

        if($res) {
            $res_data = array(
                'status' => 1
            );

            // register to session
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['role'] = 'user';
            $this->session->userdata['email'] = $email;
            $this->session->userdata['userid'] = $userid;

        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        // register login log
        $sql = "INSERT INTO users_logs (`user`, `datetime`)
                VALUES((select max(id) from users), now())";
        $this->db->query($sql);

        return $res_data;
    }

    /**
     * user login info confirm
     * @param $jsonStr: login info ( email and password )
     * @return 1=>seuccess, 0=> failed
    */
    public function login_confirm($jsonStr)
    {
        $jsonStr = $this->input->post('jsonStr');
        $json = json_decode($jsonStr);

        $email = $json->email;
        $password = $json->password;

        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $res = $this->db->query($sql, array($email, $password));

        $row = $res->row();

        $id = "";

        if(isset($row)) {
            $res_data = array(
                'status' => 1
            );

            // register to session
            $this->session->userdata['isUserLogin'] = true;
            $this->session->userdata['userid'] = $row->id;
            $this->session->userdata['role'] = 'user';
            $this->session->userdata['email'] = $email;

            // register login log
            $sql = "INSERT INTO users_logs (`user`, `datetime`)
                VALUES(?, CURRENT_TIME)";
            $this->db->query($sql, array($row->id));

        }
        else {
            $res_data = array(
                'status' => 0
            );
        }

        return $res_data;
    }

    /**
     * get all couties list
     * @return $res: countreis list
    */
    public function get_countries()
    {
        $sql = "SELECT * FROM countries ";
        $res = $this->db->query($sql);

        return $res->result_array();
    }

    /**
     * get all provices list of relative country
     * @param $country: relative country iso
     * @return $res: countreis list
     */
    public function get_provinces_bycountryiso($country)
    {
        if ( !isset($country) || $country == "" || $country == null || $country == "0" ) return null;
        $sql = "SELECT * FROM regions where country = ?";
        $res = $this->db->query($sql, array($country));

        if(isset($res)) {
            return $res->result_array();
        }
        else {
            return null;
        }
    }

    /**
     * get user profile info of loginned user
     * @param $user: user primary key
     */
    public function get_user_profile_info($user)
    {
        if ( $user == null ) return null;

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select a.*, b.name as country_name, c.name as state_name 
                from users a 
                left join countries b on(a.country=b.iso) 
                left join regions c on (a.state=c.code and a.country=c.country) 
                where a.id=$user";
        $res = $this->db->query( $sql );
        if ( $res ) return $res->row();
        else return null;
    }

    /**
     * user profile update
     */
    public function user_profile_update()
    {
        $this->db->where(array("id"=>$_SESSION["userid"]));

        $ret = $this->db->update("users", array(
            "first_name"=>$this->input->post("first_name"),
            "last_name"=>$this->input->post("last_name"),
            "company"=>$this->input->post("company"),
            "phone"=>$this->input->post("phone"),
            "country"=>$this->input->post("country"),
            "state"=>$this->input->post("state"),
            "address1"=>$this->input->post("address1"),
            "address2"=>$this->input->post("address2"),
            "city"=>$this->input->post("city"),
            "zip"=>$this->input->post("zip")
        ));

        return $ret;

    }

    /**
     * update user`s email
     * @param $user: user`s primary key
     * @param $password: new password will update
     * @return $ret: 1=> success, 0=> failed
     */
    public function update_user_password( $user, $password )
    {
        $this->db->where(array("id"=>$user));
        $ret = $this->db->update("users", array("password"=>$password));
        return $ret;
    }

    /**
     * submit contact info
     * @return $ret: 1=> success, 0=> failed
    */
    public function submit_contact()
    {
        $ret = $this->db->insert("contact", array(
            "first_name" => $this->input->post("first_name"),
            "phone" => $this->input->post("phone"),
            "email" => $this->input->post("email"),
            "order" => $this->input->post("order"),
            "company" => $this->input->post("company"),
            "rma" => $this->input->post("rma"),
            "commment" => $this->input->post("commment"),
            "date" => date("Y-m-d h:i:sa")
        ));

        return $ret;
    }

    /**
     * add new product tp viewd product
     * @param $user: user`s primary key that get from seesion
     * @param $product: product`s primary key
     * @return $ret: 1=>success, 0=>failed
    */
    public function add_veiwed_product_byuser ( $user, $product )
    {
        // determine whether registered already this product to this user
        $ret = $this->db->get_where( "user_viewed_products",  array("user"=>$user, "product"=>$product) )->row();
        if ( isset($ret) ) $id = $ret->id;

        $sql = "insert into user_viewed_products (`user`, `product`, `viwed_count`, `last_datetime`) 
                  values($user, $product, 1, now())";
        if ( isset($id) && $id != "" )
            $sql = "update user_viewed_products set `viwed_count`=`viwed_count`+1, `last_datetime`=now() where `id`=$id";
        $ret = $this->db->query($sql);
        if ( $ret ) return 1;
        else return 0;
    }

    /**
     * get last billing address related loginned user that did not ordered yet
     * @return $ret: if there is the address, billing address that did not orderd yet , else return null
    */
    public function get_not_ordered_billing_address_via_curuser()
    {
        $user = $_SESSION["userid"];
        $sql = "select * from o_billing_address
                where `user`=$user and `order`=0 
                order by `id` desc limit 1";
        $ret = $this->db->query( $sql )->row();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get last shipping address related loginned user that did not ordered yet
     * @return $ret: if there is the address, shipping address that did not orderd yet , else return null
     */
    public function get_not_ordered_shipping_address_via_curuser()
    {
        $user = $_SESSION["userid"];
        $sql = "select * from o_shipping_address
                where `user`=$user and `order`=0 
                order by `id` desc limit 1";
        $ret = $this->db->query( $sql )->row();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * set billing address via user`s address
     * @return $ret: 1=>success, 0=>failed
    */
    public function set_billing_address_via_useraddress()
    {
        $id = $this->input->post("did");
        $sid = $this->input->post("sdid");
        $as_sipping = $this->input->post("as_shipping");

        // get user`s info
        $user = $this->db->get_where( "users", array("id"=>$_SESSION["userid"]) )->row();
        $data = array(
            "user"=>$_SESSION["userid"],
            "first_name"=>$user->first_name,
            "last_name"=>$user->last_name,
            "company"=>$user->company,
            "phone"=>$user->phone,
            "address1"=>$user->address1,
            "address2"=>$user->address2,
            "city"=>$user->city,
            "country"=>$user->country,
            "state"=>$user->state,
            "zip"=>$user->zip
        );

        if ( isset($id) && $id != "" && $id != null ) {             // update via user`s info
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_billing_address", $data );
    } else {                                                        // insert newly via user`s info
            $this->db->insert( "o_billing_address", $data );
            $id = $this->db->insert_id();
        }

        if ( isset($as_sipping) && $as_sipping == "1" ) {           // insert sipping address via user`s address

            if ( isset($sid) && $sid != "" && $sid != null ) {      // update via user`s info
                $this->db->where( array("id"=>$sid) );
                $this->db->update( "o_shipping_address", $data );
            } else {                                                // insert newly via user`s info
                $this->db->insert( "o_shipping_address", $data );
                $sid = $this->db->insert_id();
            }

            // update billing as shipping parameter
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_billing_address", array("as_shipping"=>1) );
        } else {
            // update billing as shipping parameter
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_billing_address", array("as_shipping"=>0) );
        }

        return $id."##".$sid;
    }

    /**
     * set billing address newly
     * @return $ret: 1=>success, 0=>failed
     */
    public function set_billing_address_newly()
    {
        $id = $this->input->post("did");
        $sid = $this->input->post("sdid");
        $as_sipping = $this->input->post("as_shipping");    // if 1, use current billing address as shipping address, else if 0, not any action
        $as_profile = $this->input->post("as_profile");     // if 1, update user`s address info as current billing address info, else if 0, not any action

        // get user`s info
        $data = array(
            "user"=>$_SESSION["userid"],
            "first_name"=>$this->input->post("first_name"),
            "last_name"=>$this->input->post("last_name"),
            "company"=>$this->input->post("company"),
            "phone"=>$this->input->post("phone"),
            "address1"=>$this->input->post("address1"),
            "address2"=>$this->input->post("address2"),
            "city"=>$this->input->post("city"),
            "country"=>$this->input->post("country"),
            "state"=>$this->input->post("state"),
            "zip"=>$this->input->post("zip")
        );

        /*** set billing address ***/
        if ( isset($id) && $id != "" && $id != null ) {             // update via user`s info
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_billing_address", $data );
        } else {                                                        // insert newly via user`s info
            $this->db->insert( "o_billing_address", $data );
            $id = $this->db->insert_id();
        }

        /*** set shipping address ***/
        if ( isset($as_sipping) && $as_sipping == "1" ) {           // insert sipping address via user`s address

            if ( isset($sid) && $sid != "" && $sid != null ) {      // update via user`s info
                $this->db->where( array("id"=>$sid) );
                $this->db->update( "o_shipping_address", $data );
            } else {                                                // insert newly via user`s info
                $this->db->insert( "o_shipping_address", $data );
                $sid = $this->db->insert_id();
            }

            // update billing as shipping parameter
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_billing_address", array("as_shipping"=>1) );
        } else {
            // update billing as shipping parameter
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_billing_address", array("as_shipping"=>0) );
        }

        /*** set user`s address by billing address ***/
        $udata = array(
            "first_name"=>$this->input->post("first_name"),
            "last_name"=>$this->input->post("last_name"),
            "company"=>$this->input->post("company"),
            "phone"=>$this->input->post("phone"),
            "address1"=>$this->input->post("address1"),
            "address2"=>$this->input->post("address2"),
            "city"=>$this->input->post("city"),
            "country"=>$this->input->post("country"),
            "state"=>$this->input->post("state"),
            "zip"=>$this->input->post("zip")
        );
        if ( isset($as_profile) && $as_profile == "1" ) {
            $this->db->where( array("id"=>$_SESSION["userid"]) );
            $this->db->update( "users", $udata );
        }

        return $id."##".$sid;
    }

    /**
     * set shipping address via user`s address
     * @return $ret: 1=>success, 0=>failed
     */
    public function set_shipping_address_via_useraddress()
    {
        $id = $this->input->post("sdid");

        // get user`s info
        $user = $this->db->get_where( "users", array("id"=>$_SESSION["userid"]) )->row();
        $data = array(
            "user"=>$_SESSION["userid"],
            "first_name"=>$user->first_name,
            "last_name"=>$user->last_name,
            "company"=>$user->company,
            "phone"=>$user->phone,
            "address1"=>$user->address1,
            "address2"=>$user->address2,
            "city"=>$user->city,
            "country"=>$user->country,
            "state"=>$user->state,
            "zip"=>$user->zip
        );

        if ( isset($id) && $id != "" && $id != null ) {             // update via user`s info
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_shipping_address", $data );
        } else {                                                        // insert newly via user`s info
            $this->db->insert( "o_shipping_address", $data );
            $id = $this->db->insert_id();
        }

        return $id;
    }

    /**
     * set billing address newly
     * @return $ret: 1=>success, 0=>failed
     */
    public function set_shipping_address_newly()
    {
        $id = $this->input->post("sdid");
        $as_profile = $this->input->post("as_profile");     // if 1, update user`s address info as current billing address info, else if 0, not any action

        // get user`s info
        $data = array(
            "user"=>$_SESSION["userid"],
            "first_name"=>$this->input->post("first_name"),
            "last_name"=>$this->input->post("last_name"),
            "company"=>$this->input->post("company"),
            "phone"=>$this->input->post("phone"),
            "address1"=>$this->input->post("address1"),
            "address2"=>$this->input->post("address2"),
            "city"=>$this->input->post("city"),
            "country"=>$this->input->post("country"),
            "state"=>$this->input->post("state"),
            "zip"=>$this->input->post("zip")
        );

        /*** set billing address ***/
        if ( isset($id) && $id != "" && $id != null ) {             // update via user`s info
            $this->db->where( array("id"=>$id) );
            $this->db->update( "o_shipping_address", $data );
        } else {                                                        // insert newly via user`s info
            $this->db->insert( "o_shipping_address", $data );
            $id = $this->db->insert_id();
        }

        /*** set user`s address by billing address ***/
        $udata = array(
            "first_name"=>$this->input->post("first_name"),
            "last_name"=>$this->input->post("last_name"),
            "company"=>$this->input->post("company"),
            "phone"=>$this->input->post("phone"),
            "address1"=>$this->input->post("address1"),
            "address2"=>$this->input->post("address2"),
            "city"=>$this->input->post("city"),
            "country"=>$this->input->post("country"),
            "state"=>$this->input->post("state"),
            "zip"=>$this->input->post("zip")
        );
        if ( isset($as_profile) && $as_profile == "1" ) {
            $this->db->where( array("id"=>$_SESSION["userid"]) );
            $this->db->update( "users", $udata );
        }

        return $id;
    }

    /**
     * set order in checkout page
     * @return $ret: inserted order primary key
    */
    public function set_order_incheckout()
    {
        $id = $this->input->post("did");
        $data = array(
          "user" => $_SESSION["userid"],
          "billing_address" => $this->input->post("billing_address"),
          "shipping_address" => $this->input->post("shipping_address"),
          "shipping_method" => $this->input->post("shipping_method")
        );

        if ( isset( $id) && $id != null && $id != "" ) {
            $this->db->where( array("id"=>$id) );
            $this->db->update( "orders", $data );
        } else {
            $this->db->insert( "orders", $data );
            $id = $this->db->insert_id();
        }

        return $id;
    }

    /**
     * get non paid and only ordered orer row
     * @return $ret: non ordered order
    */
    public function get_nopaid_onlyordered_row($user)
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select a.*, b.price as shipping_price from orders a 
                  left join s_shipping_methods b on(a.shipping_method=b.id)  
                  where a.`is_paid`=0 and a.`user`=$user";
        $ret = $this->db->query( $sql )->row();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * order confirm
     * @return $ret: 1=>success, 0=>failed
    */
    public function set_order_confirm_incheckout()
    {
        // decrease current cart`s product quanities
        $products = $this->db->get_where( "cart", array(
            "cartid"=>$_SESSION["cartid"],
            "state"=>"1") )->result_array();
        for ( $i = 0; $i < count($products); $i ++ ) {
            $id = $products[$i]["product"];
            $quanity = $products[$i]["count"];
            $sql = "update products set quanity=quanity-$quanity where id=$id";
            $this->db->query( $sql );
        }

        // order confirm process
        $id = $this->input->post("did");
        $payment_kind = $this->input->post("payment_kind");
        $subtotal = $this->input->post("subtotal");
        $sql = "update orders 
                  set `subtotal`=$subtotal, `order_date`=now(), `payment_kind`=$payment_kind 
                  where `id`=$id";
        return $this->db->query($sql);

    }

    /**
     * payment complete process
     * @return $ret: 1=>success, 0=>failed
    */
    public function payment_complete_proc()
    {
        $oid = $this->input->post("did");
        $bid = $this->input->post("billing_address");
        $sid = $this->input->post("shipping_address");

        // order table update as is_paid to 1
        $this->db->where( array("id"=>$oid) );
        $this->db->update( "orders", array( "is_paid"=>1 ) );

        // o_billing_address table update as order to 1
        $this->db->where( array("id"=>$bid) );
        $this->db->update( "o_billing_address", array( "order"=>1 ) );

        // o_shipping_address table update as order to 1
        $this->db->where( array("id"=>$sid) );
        $this->db->update( "o_shipping_address", array( "order"=>1 ) );

        /*** record selled product ***/
        $cid = $_SESSION["cartid"];
        // get selling product list
        $pds = $this->db->get_where("cart", array( "cartid"=>$cid, "state"=>"1" ))->result_array();
        for ( $i = 0; $i < count($pds); $i ++ ) {
            $data = array(
                "user"=>$_SESSION["userid"],
                "product"=>$pds[$i]["product"],
                "order"=>$oid,
                "count"=>$pds[$i]["count"]
            );
            $this->db->insert( "o_products", $data );
        }

        // emplty cart
        $this->db->where( array( "cartid"=>$cid ) );
        $this->db->update( "cart", array( "state"=>0 ) );
        $_SESSION["cartid"] = "";

        return 1;

    }









/////////////////////////////////////////////////////////////////////////////////
/// *********************************************************************////////
/////////////////////////////////////////////////////////////////////////////////




    /**
     * user password confirm
     * @param $user: user`s primary key
     * @param $password: password will confirm
     * @return $ret: 1=>success, 0=>failed
     */
    public function confirm_user_password( $user, $password ) {
        return $this->db->get_where("users", array("id"=>$user, "password"=>$password))->row();
    }

    /**
     * get all cities list of relative region
     * @param $country: relative country iso
     * @param $region: relative region code
     * @return $res: cities list
     */
    public function get_cities_byregioncode($country, $region)
    {
        $sql = "SELECT * FROM cities where country=? and region = ?";
        $res = $this->db->query($sql, array($country, $region));

        if(isset($res)) {
            return $res->result_array();
        }
        else {
            return null;
        }
    }

    /**
     * update user`s email
     * @param $user: user`s primary key
     * @param $email: new email will update
     * @return $ret: 1=> success, 0=> failed
    */
    public function update_user_email( $user, $email )
    {
        $this->db->where(array("id"=>$user));
        $ret = $this->db->update("users", array("email"=>$email));
        return $ret;
    }

    /**
     * insert or update users notification
     * @param $user: user`s primary key
    */
    public function set_user_notification( $user )
    {
        $did  = $this->input->post("did");
        $data = array(
            "user"=>$user,
            "e_message"=>$this->input->post("e_message"),
            "e_interest"=>$this->input->post("e_interest"),
            "e_match"=>$this->input->post("e_match"),
            "r_message"=>$this->input->post("r_message"),
            "r_interest"=>$this->input->post("r_interest"),
            "r_profile"=>$this->input->post("r_profile"),
            "r_favorite"=>$this->input->post("r_favorite"),
            "r_match"=>$this->input->post("r_match")
        );
        if ( isset($did) && $did != null && $did != "" ) {
            $this->db->where ( array( "id"=>$did ) );
            return $this->db->update( "users_notifications_setting", $data );
        }
        return $this->db->insert("users_notifications_setting", $data);
    }

    /**
     * get notification of related user
     * @param $user: user`s primary key
     * @return $ret: user`s notification row
    */
    public function get_user_notification( $user )
    {
        $ret = $this->db->get_where( "users_notifications_setting", array( "user"=>$user ) )->row();
        if ( $ret ) return $ret;
        else return null;
    }


    /**
     * get user profile info of other user
     * @param $user: user primary key
     * @param $luser: loginned user`s primary key
     */
    public function get_other_user_profile_info($user, $luser)
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "SELECT a.*, b.nicename as country_title, c.name as state_title, d.filename as photo, 
                    e.state as interest, f.state as favorite, g.state as block  
                    FROM users a 
                    left join countries b on (a.country=b.iso) 
                    left join regions c on(a.state=c.code and a.`country`=c.`country`)
                    left join users_photos d on (a.id=d.user)
                    left join activity_interests e on( e.touser=? and e.user=? )
                    left join activity_favorites f on( f.touser=? and f.user=? )
                    left join activity_blocks g on( g.touser=? and g.user=? )
                    where a.id=? and 
                    ( d.`id`=(select min(`id`) from users_photos where `user`=?) or ( select count(*) from users_photos where `user`=? ) < 1) 
                    order by a.id desc";

        $res = $this->db->query($sql, array( $user, $luser, $user, $luser, $user, $luser, $user, $user, $user ));
        return $res->row();
    }

    /**
     * regoster view user profile log
     * @param $user: loginned user primary key
     * @param $touser: be viewed user primary key
     * @return 1=>succeess, 0=> failed
     */
    public function register_viewed_user($user, $touser)
    {
        $sql = "insert into activity_profile_viewds(`user`, `touser`, `datetime`) values(?, ?, now())";
        $ret = $this->db->query($sql, array( $user, $touser ));
        return $ret;
    }

    /**
     * set interest
     * @param $user: loginned user primary key
     * @param $touser: ineterest user primary key
    */
    public function set_interest( $user, $touser, $state )
    {
        // get primary key
        $ret = $this->db->get_where("activity_interests", array('user'=>$user, 'touser'=>$touser))->row();

        if ( $ret ) {
            $id = $ret->id;

            if ( $state == "1" ) $state = 0;
            else $state = "1";

            $sql = "update activity_interests set `datetime`=now(), `state`=? where `id`=?;";
            $ret = $this->db->query($sql, array( $state, $id ));
            return $ret;
        } else {
            $sql = "insert into activity_interests(`user`, `touser`, `datetime`, `state`) values(?, ?, now(), ?)";
            $ret = $this->db->query($sql, array( $user, $touser, 1 ));
            return $ret;
        }
    }

    /**
     * set interest
     * @param $user: loginned user primary key
     * @param $touser: ineterest user primary key
     */
    public function set_favorite( $user, $touser, $state )
    {
        // get primary key
        $ret = $this->db->get_where("activity_favorites", array('user'=>$user, 'touser'=>$touser))->row();

        if ( $ret ) {
            $id = $ret->id;

            if ( $state == "1" ) $state = 0;
            else $state = "1";

            $sql = "update activity_favorites set `datetime`=now(), `state`=? where `id`=?;";
            $ret = $this->db->query($sql, array( $state, $id ));
            return $ret;
        } else {
            $sql = "insert into activity_favorites(`user`, `touser`, `datetime`, `state`) values(?, ?, now(), ?)";
            $ret = $this->db->query($sql, array( $user, $touser, 1 ));
            return $ret;
        }
    }

    /**
     * set interest
     * @param $user: loginned user primary key
     * @param $touser: ineterest user primary key
     */
    public function set_block( $user, $touser, $state )
    {
        // get primary key
        $ret = $this->db->get_where("activity_blocks", array('user'=>$user, 'touser'=>$touser))->row();

        if ( $ret ) {
            $id = $ret->id;

            if ( $state == "1" ) $state = 0;
            else $state = "1";

            $sql = "update activity_blocks set `datetime`=now(), `state`=? where `id`=?;";
            $ret = $this->db->query($sql, array( $state, $id ));
            return $ret;
        } else {
            $sql = "insert into activity_blocks(`user`, `touser`, `datetime`, `state`) values(?, ?, now(), ?)";
            $ret = $this->db->query($sql, array( $user, $touser, 1 ));
            return $ret;
        }
    }

    /**
     * get user`s photos
     * @param $user: user`s primary key
     * @return $res : user`s photos
    */
    public function get_user_profile_photos($user)
    {
        $ret = $this->db->get_where("users_photos", array("user"=>$user))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * insert users photo
     * @param $upalod_data: uploaded file info
    */
    public function user_photo_add($upalod_data)
    {
        $userid = $_SESSION["userid"];  // loginned user primary key
        $photoid = $upalod_data["photoid"];
        $filename = $upalod_data["file_name"];

        if ( isset($photoid) && intval($photoid) > 0 ) {
            $sql = "update users_photos set `filename` = ? where `id` = ?;";
            $this->db->query($sql, array( $filename, $photoid ));
        } else {
            $sql = "INSERT INTO users_photos (`user`, `filename`) 
                VALUES(?, ?)";
            $this->db->query($sql, array($userid, $filename));
            $photoid = $this->db->insert_id();
        }

        return $photoid;
    }

    /**
     * insert users verify card
     * @param $upalod_data: uploaded file info
     */
    public function user_verify_card_add($upalod_data)
    {
        $userid = $_SESSION["userid"];         // loginned user primary key
        $filename = $upalod_data["file_name"]; // card image file name
        $data = array(
          "user" => $userid,
          "filename" => $filename
        );

        $res = $this->db->get_where('users_verifies', array('user' => $userid));
        if ( !$res->row() ) {    // insert
            $this->db->insert('users_verifies',$data);
        } else {                // update
            $this->db->update('users_verifies', $data, array('user'=> $userid));
        }
     }

     /**
      * get verify info
      * @param $user: user primary key
     */
     public function get_verifyinfo_byuser($userid)
     {
         return $this->db->get_where('users_verifies', array('user' => $userid))->row();
     }

    /**
     * get all photos that registered before. the max coutn is 5
     * @param $user: user primary key
     * @return $res: photo`s list ( file name )
    */
    public function get_user_photos($user)
    {
        $sql = "SELECT * FROM users_photos where `user` = ?;";
        $res = $this->db->query($sql, array( $user ))->result_array();
        if ($res) return $res;
        else return null;
    }

    /**
     * update user`s match info
    */
    public function user_matche_update()
    {
        $user = $_SESSION["userid"];
        $data = array(
          'user' => $_SESSION["userid"],
          'gender' => $this->input->post('gender'),
          'sage' => $this->input->post('sage'),
          'eage' => $this->input->post('eage'),
          'country' => $this->input->post('country'),
          'province' => $this->input->post('province'),
          'city' => $this->input->post('city'),
          'sheight' => $this->input->post('sheight'),
          'eheight' => $this->input->post('eheight'),
          'swegiht' => $this->input->post('swegiht'),
          'ewegiht' => $this->input->post('ewegiht'),
          'body_types' => cimplode($this->input->post('body_types')),
          'eithnicitys' => cimplode($this->input->post('eithnicitys')),
          'appearances' => cimplode($this->input->post('appearances')),
          'hair_colors' => cimplode($this->input->post('hair_colors')),
          'hiar_lengths' => cimplode($this->input->post('hiar_lengths')),
          'hair_types' => cimplode($this->input->post('hair_types')),
          'eye_colors' => cimplode($this->input->post('eye_colors')),
          'eye_wers' => cimplode($this->input->post('eye_wers')),
          'health_states' => cimplode($this->input->post('health_states')),
          'smokes' => cimplode($this->input->post('smokes')),
          'drinks' => cimplode($this->input->post('drinks')),
          'willings' => cimplode($this->input->post('willings')),
          'marital_states' => cimplode($this->input->post('marital_states')),
          'have_childrens' => cimplode($this->input->post('have_childrens')),
          'children_numbers' => $this->input->post('children_numbers'),
          'youngest_childs' => $this->input->post('youngest_childs'),
          'oldest_childs' => $this->input->post('oldest_childs'),
          'more_childrens' => $this->input->post('more_childrens'),
          'eating_habits' => cimplode($this->input->post('eating_habits')),
          'occupations' => cimplode($this->input->post('occupations')),
          'employement_status' => cimplode($this->input->post('employement_status')),
          'annual_income' => $this->input->post('annual_income'),
          'home_types' => cimplode($this->input->post('home_types')),
          'living_situations' => cimplode($this->input->post('living_situations')),
          'residency_status' => cimplode($this->input->post('residency_status')),
          'nationalities' => $this->input->post('nationalities'),
          'languages' => $this->input->post('languages'),
          'education' => $this->input->post('education'),
          'born_reverted' => cimplode($this->input->post('born_reverted')),
          'religion_values' => cimplode($this->input->post('religion_values')),
          'religion_services' => cimplode($this->input->post('religion_services')),
          'read_quans' => cimplode($this->input->post('read_quans')),
          'polygamy' => cimplode($this->input->post('polygamy')),
          'family_values' => cimplode($this->input->post('family_values')),
          'profile_creators' => cimplode($this->input->post('profile_creators'))
    );

          // determin whether update or insert
        $res = $this->db->get_where('users_matches', array('user' => $user));
        if ( !$res->row() ) {    // update
            $this->db->insert('users_matches',$data);
        } else {                // insert
            $this->db->update('users_matches', $data, array('user'=> $user));
        }


    }

    /**
     * get current logined user matche info
     * @param $user: loginned user primary key
    */
    public function get_matchinfo_byuser($user)
    {
        $res = $this->db->get_where('users_matches', array('user' => $user))->row();
        if ( $res ) return $res;
        else return null;
    }

    /**
     * insert or update user`s interest
    */
    public function user_interest_update()
    {
        $user = $_SESSION["userid"];
        $data = array(
            'user' => $_SESSION["userid"],
            'fun_entertaiments' => cimplode($this->input->post('fun_entertaiments')),
            'like_foods' => cimplode($this->input->post('like_foods')),
            'like_musics' => cimplode($this->input->post('like_musics')),
            'like_sports' => cimplode($this->input->post('like_sports'))
        );

        // determin whether update or insert
        $res = $this->db->get_where('users_interests', array('user' => $user));
        if ( !$res->row() ) {    // insert
            $this->db->insert('users_interests',$data);
        } else {                // update
            $this->db->update('users_interests', $data, array('user'=> $user));
        }
    }

    /**
     * get current logined user matche info
     * @param $user: loginned user primary key
     */
    public function get_interestinfo_byuser($user)
    {
        $res = $this->db->get_where('users_interests', array('user' => $user))->row();
        return $res;
    }

    /**
     * insert or update user`s personality
     */
    public function user_personality_update()
    {
        $user = $_SESSION["userid"];
        $data = array(
            'user' => $_SESSION["userid"],
            'favorite_movie' => $this->input->post('favorite_movie'),
            'favorite_book' => $this->input->post('favorite_book'),
            'favorite_food' => $this->input->post('favorite_food'),
            'favorite_music' => $this->input->post('favorite_music'),
            'hobbies' => $this->input->post('hobbies'),
            'dress' => $this->input->post('dress'),
            'sense_humor' => $this->input->post('sense_humor'),
            'personality' => $this->input->post('personality'),
            'like_travel' => $this->input->post('like_travel'),
            'partner' => $this->input->post('partner'),
            'romantic_weekend' => $this->input->post('romantic_weekend'),
            'perfect_match' => $this->input->post('perfect_match')
        );

        // determin whether update or insert
        $res = $this->db->get_where('users_personalities', array('user' => $user));
        if ( !$res->row() ) {    // insert
            $this->db->insert('users_personalities',$data);
        } else {                // update
            $this->db->update('users_personalities', $data, array('user'=> $user));
        }
    }

    /**
     * get current logined user personality info
     * @param $user: loginned user primary key
     */
    public function get_personalityinfo_byuser($user)
    {
        $res = $this->db->get_where('users_personalities', array('user' => $user))->row();
        return $res;
    }

    /**
     * add new cupid tag of current loginned user
    */
    public function user_cupid_add()
    {
        $data = array(
            "user" => $_SESSION["userid"],
            "cupid" => $this->input->post("cupid")
        );
        $this->db->insert('users_cupidtag',$data);
        return $this->db->insert_id();
    }

    /**
     * get all cupid tags list of current user
     * @param $user: related user`s primary key
     * @return $res: related user`s cupid tags list
    */
    public function get_cupidlist_byuser($user)
    {
        return $this->db->get_where("users_cupidtag", array("user"=>$user))->result_array();
    }

    /**
 * remove curretn cupid tag
 * @param $did: primary id
 * @return 1=> success, 0=> failed
 */
    public function ep_remove_cupidtag($did)
    {
        return $this->db->delete("users_cupidtag", array("id"=>$did));
    }

    /**
     * rename saved search title
     * @param $did: primary id
     * @param $title: new title
     * @return 1=> success, 0=> failed
     */
    public function h_search_rename($did, $title)
    {
        $this->db->where('id',$did);
        $res = $this->db->update('users_searchs',array("title"=>$title));
        return $res;
    }

    /**
     * remove saved search title
     * @param $did: primary id
     * @return 1=> success, 0=> failed
     */
    public function h_search_remove($did)
    {
        $res = $this->db->delete('users_searchs',array("id"=>$did));
        return $res;
    }

    /**
     * add new residence
     * @param $country: coutnry iso
     * @param $state: region code
     * @return 1=> success, 0=>failed
    */
    public function add_new_residence($country, $state)
    {
        return $this->db->insert("users_imbra_residence", array("user"=>$_SESSION["userid"], "country" => $country, "state" => $state));
    }

    /**
     * get all residence list of related user
     * @param $user: user`s primary key
     * @return $res: residence list of given user
    */
    public function get_residence_list_byuser($user)
    {
        $sql = "SELECT a.*, b.nicename as country_title, c.name as state_title FROM users_imbra_residence a 
                    left join countries b on (a.country=b.iso) 
                    left join regions c on(a.state=c.code) where a.user=? and c.country=a.country";
        $res = $this->db->query($sql, array( $user ));
        return $res->result_array();
    }

    /**
     *remove cur residence via promary key
     * @param $id: primary key
     * @return $res: 1=>success, 0=>failed
    */
    public function remove_cur_residence($id)
    {
        return $this->db->delete("users_imbra_residence", array("id"=>$id));
    }

    /**
     *record ( update ) logined current time
    */
    public function record_current_state()
    {
        $user = $_SESSION["userid"];
        $sql = "update users set `current_time`=now() where `id`=$user";
        $res = $this->db->query($sql);
        return $res;
    }

    /**
     * insert or update residence info
     * @return $re : 1=>success, 0=>failed
    */
    public function update_residenceinfo()
    {
        $user = $_SESSION["userid"];
        $data = array(
            'user' => $_SESSION["userid"],
            'is_court' => $this->input->post('is_court'),
            'is_convited' => cimplode($this->input->post('is_convited')),
            'is_alchol' => $this->input->post('is_alchol'),
            'is_arrested' => cimplode($this->input->post('is_arrested')),
            'is_married' => $this->input->post('is_married'),
            'were_married' => $this->input->post('were_married'),
            'were_sponser' => $this->input->post('were_sponser'),
            'children_age' => $this->input->post('children_age')
        );

        // determin whether update or insert
        $res = $this->db->get_where('users_imbra', array('user' => $user));
        if ( !$res->row() ) {    // insert
            $this->db->insert('users_imbra',$data);
        } else {                // update
            $this->db->update('users_imbra', $data, array('user'=> $user));
        }

        // update user profile
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'midlde_name' => $this->input->post('midlde_name'),
            'birthday' => $this->input->post('birthday')
        );
        $res = $this->db->update('users', $data, array('id'=> $user));
        return $res;
    }

    /**
     * get imbra info via user
     * @param $user: user`s primary key
     * @return $res: tmbra info of related user
    */
    public function get_imbra_byuser($user)
    {
        return $this->db->get_where("users_imbra", array("user"=>$user))->row();
    }

    /**
     * add new saved search
     * @param: search parameter value info
     * @return $res: 1=> success, 0=>failed
    */
    public function add_saved_search( $title, $sarr, $iarr, $marr, $has_photo, $last_active, $did )
    {
        $info = array(
            'title'=>$title,
            'user'=>$_SESSION["userid"],
            'gender'=>$sarr["gender"],
            'country'=>$sarr["country"],
            'state'=>$sarr["state"],
            'city'=>$sarr["city"],
            'children_numbers'=>$sarr["children_numbers"],
            'youngest_childs'=>$sarr["youngest_childs"],
            'oldest_childs'=>$sarr["oldest_childs"],
            'more_childrens'=>$sarr["more_childrens"],
            'annual_income'=>$sarr["annual_income"],
            'education'=>$sarr["education"],
            'sage'=>$iarr["sage"],
            'eage'=>$iarr["eage"],
            'sheight'=>$iarr["sheight"],
            'eheight'=>$iarr["eheight"],
            'sweight'=>$iarr["sweight"],
            'eweight'=>$iarr["eweight"],
            'body_type'=>cimplode ($marr["body_type"]),
            'eithnicity'=>cimplode ($marr["eithnicity"]),
            'appearance'=>cimplode ($marr["appearance"]),
            'hair_color'=>cimplode ($marr["hair_color"]),
            'hair_length'=>cimplode ($marr["hair_length"]),
            'hair_type'=>cimplode ($marr["hair_type"]),
            'eye_color'=>cimplode ($marr["eye_color"]),
            'eye_wear'=>cimplode ($marr["eye_wear"]),
            'health_state'=>cimplode ($marr["health_state"]),
            'smoke'=>cimplode ($marr["smoke"]),
            'drink'=>cimplode ($marr["drink"]),
            'willing'=>cimplode ($marr["willing"]),
            'complexion'=>cimplode ($marr["complexion"]),
            'religion'=>cimplode ($marr["religion"]),
            'marital_state'=>cimplode ($marr["marital_state"]),
            'have_children'=>cimplode ($marr["have_children"]),
            'eating_habit'=>cimplode ($marr["eating_habit"]),
            'occupation'=>cimplode ($marr["occupation"]),
            'employement_status'=>cimplode ($marr["employement_status"]),
            'home_type'=>cimplode ($marr["home_type"]),
            'living_situation'=>cimplode ($marr["living_situation"]),
            'residency_status'=>cimplode ($marr["residency_status"]),
            'nationality'=>$marr["nationality"],
            'language'=>$marr["language"],
            'born_reverted'=>cimplode ($marr["born_reverted"]),
            'religion_value'=>cimplode ($marr["religion_value"]),
            'religion_service'=>cimplode ($marr["religion_service"]),
            'read_quran'=>cimplode ($marr["read_quran"]),
            'polygamy'=>cimplode ($marr["polygamy"]),
            'family_value'=>cimplode ($marr["family_value"]),
            'profile_creator'=>cimplode ($marr["profile_creator"]),
            'has_photo'=>$has_photo,
            'last_activity'=>$last_active
        );
        if ( isset($did) && $did != null && $did != "" ) {  // update
            $this->db->where(array("id"=>$did));
            $res = $this->db->update('users_searchs',$info);
        } else {                                            // insert
            $res = $this->db->insert('users_searchs',$info);
        }
        return $res;
    }

    /**
     * get saved searchs list of logined user
     * @return $res: saved searchs list
    */
    public function get_saved_search_byuser()
    {
        $res = $this->db->get_where("users_searchs", array("user"=>$_SESSION["userid"]))->result_array();
        if ( $res ) return $res;
        else return null;
    }

    /**
     * get saved search info via primary key
     * @param $did: primary key
     * @return related saved search ros
    */
    public function get_saved_searchinfo_byid($did)
    {
        if ( !isset($did) || $did == null ) return null;

        $res = $this->db->get_where("users_searchs", array("id"=>$did))->row();
        if ( $res ) return $res;
        else return null;
    }

    /**
     * get user`s list via search parameter
     * @param $type: 1=>men list ( unlogined state ), 2=>women list ( unlogined state )
     *                  3=> main page users list ( logined state )
     *                  4=> online members ( logined state )
     * @param $search : search parameter
     * @return user`s list
     *
    */
    public function get_users_list($type, $search, $limit, $pageNum) {

        $ret = array();

        $user = 0;        // current logined user
        if ( isset($_SESSION["userid"]) && $_SESSION["userid"] != null && $_SESSION["userid"] != "" ) $user = $_SESSION["userid"];


        $where = "";
        if ( $type == 1 ) {            // male user`s list in login main page
            $where = " where a.`gender`=1 and ";
        } else if ( $type == 2 ) {     // female user`s list in login main page
            $where = " where a.`gender`=2 and ";
        } else if ( $type == 3 ) {
            $where = " where  ";
            $gender = $search["s_gender"];
            $sage = $search["s_sage"];
            $eage = $search["s_eage"];
            $country = $search["s_country"];
            $state = $search["s_state"];
            $with_photo = $search["s_with_photo"];
            $last_active = $search["s_last_active"];
            if ( isset($gender) && $gender != "0" ) {
                $where .= "a.`gender`=$gender ";
            }
            if ( isset($sage) && $sage != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`age`>=$sage ";
            }
            if ( isset($eage) && $eage != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`age`<=$eage ";
            }
            if ( isset($country) && $country != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`country`='$country' ";
            }

            if ( isset($state) && $state != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`state`='$state' ";
            }

            if ( isset($with_photo) && $with_photo != "" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= " (select count(*) from users_photos cc where cc.`user`=a.`id`)>0 ";
            }

            if ( isset($last_active) && $last_active != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $days = 0;
                switch (intval($last_active))
                {
                    case 1:                     // this week  7 days
                        $days = 7;
                        break;
                    case 2:                     // 1 month 31 days
                        $days = 31;
                        break;
                    case 3:                     // 3 month 93 days
                        $days = 93;
                        break;
                    case 4:                     // 6 month 186 days
                        $days = 186;
                        break;
                    case 5:                     // 1 years
                        $days = 366;
                        break;
                }
                $where .= " DATEDIFF(NOW(), h.`datetime`)<$days ";
            }

            if ( trim($where) != "where" ) $where .= "and";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 4 ) {
            $where = " where  ";
            $gender = $search["s_gender"];
            $sage = $search["s_sage"];
            $eage = $search["s_eage"];
            $country = $search["s_country"];
            $with_photo = $search["s_with_photo"];
            if ( isset($gender) && $gender != "0" ) {
                $where .= "a.`gender`=$gender ";
            }
            if ( isset($sage) && $sage != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`age`>=$sage ";
            }
            if ( isset($eage) && $eage != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`age`<=$eage ";
            }
            if ( isset($country) && $country != "0" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= "a.`country`='$country' ";
            }

            if ( isset($with_photo) && $with_photo != "" ) {
                if ( trim($where) != "where" ) $where .= " and ";
                $where .= " (select count(*) from users_photos cc where cc.`user`=a.`id`)>0 ";
            }
            if ( trim($where) != "where" ) $where .= "and";

            $where .= " ( ( (TIME_TO_SEC(now()) - TIME_TO_SEC(a.`current_time`) ) / 60 ) < 6 ) and 
                        ( DATEDIFF(NOW() , a.`current_time`) <= 0 ) and 
                         a.`id`<>$user and ";
        } else if ( $type == 5 ) {
            $where = " where  ";
            $match = $this->get_matchinfo_byuser($user);
            if ( $match != null ) {
               $sarr = array("gender"=>$match->gender,
                              "country"=>$match->country,
                              "state"=>$match->province,
                              "city"=>$match->city,
                              "children_numbers"=>$match->children_numbers,
                              "youngest_childs"=>$match->youngest_childs,
                              "oldest_childs"=>$match->oldest_childs,
                              "more_childrens"=>$match->more_childrens,
                              "annual_income"=>$match->annual_income,
                              "education"=>$match->education
               );

            $iarr = array("sage"=>$match->sage,
                            "eage"=>$match->eage,
                            "sheight"=>$match->sheight,
                            "eheight"=>$match->eheight,
                            "sweight"=>$match->swegiht,
                            "eweight"=>$match->ewegiht
            );

            $marr = array("body_type"=>$match->body_types,
                            "eithnicity"=>$match->eithnicitys,
                            "appearance"=>$match->appearances,
                            "hair_color"=>$match->hair_colors,
                            "hair_length"=>$match->hiar_lengths,
                            "hair_type"=>$match->hair_types,
                            "eye_color"=>$match->eye_colors,
                            "eye_wear"=>$match->eye_wers,
                            "health_state"=>$match->health_states,
                            "smoke"=>$match->smokes,
                            "drink"=>$match->drinks,
                            "willing"=>$match->willings,
                            "marital_state"=>$match->marital_states,
                            "have_children"=>$match->have_childrens,
                            "eating_habit"=>$match->eating_habits,
                            "occupation"=>$match->occupations,
                            "employement_status"=>$match->employement_status,
                            "home_type"=>$match->home_types,
                            "living_situation"=>$match->living_situations,
                            "residency_status"=>$match->residency_status,
                            "nationalitie"=>$match->nationalities,
                            "language"=>$match->languages,
                            "born_reverted"=>$match->born_reverted,
                            "religion_value"=>$match->religion_values,
                            "religion_service"=>$match->religion_services,
                            "read_quran"=>$match->read_quans,
                            "polygamy"=>$match->polygamy,
                            "family_value"=>$match->family_values,
                            "profile_creator"=>$match->profile_creators
                );

                foreach ($sarr as $key=>$val )
                {
                    if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                        if ( $key == "country" || $key == "state" || $key == "city" ) $where .= " a.`$key`='$val' and ";
                        else $where .= " a.`$key`=$val and ";
                    }
                }

                foreach ($iarr as $key=>$val )
                {
                    $k = substr($key, 1);
                    if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                        if ( $key == "sage" || $key == "sheight" || $key == "sweight" ) $where .= " a.`$k`>=$val and ";
                        else $where .= " a.`$k`<=$val and ";
                    }
                }

                foreach ($marr as $key=>$val )
                {
                    if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                       $v_arr = explode(",", $val);
                       $where .= " ( ";
                       for ( $i = 0; $i < count($v_arr); $i ++ ) {
                           $v = $v_arr[$i];
                           if ( $i != 0 ) $where .= " or ";
                           $where .= " a.`$key`=$v";
                       }
                        $where .= " ) and ";
                    }
                }
            }

            $where .= " a.`id`<>$user and ";
        } else if ( $type == 6 ) {      // advanced search
            $where = " where  ";

            $sarr = array("gender"=>$this->input->post("gender"),
                    "country"=>$this->input->post("country"),
                    "state"=>$this->input->post("province"),
                    "city"=>$this->input->post("city"),
                    "children_numbers"=>$this->input->post("children_numbers"),
                    "youngest_childs"=>$this->input->post("youngest_childs"),
                    "oldest_childs"=>$this->input->post("oldest_childs"),
                    "more_childrens"=>$this->input->post("more_childrens"),
                    "annual_income"=>$this->input->post("annual_income"),
                    "education"=>$this->input->post("education")
            );

            $iarr = array("sage"=>$this->input->post("sage"),
                    "eage"=>$this->input->post("eage"),
                    "sheight"=>$this->input->post("sheight"),
                    "eheight"=>$this->input->post("eheight"),
                    "sweight"=>$this->input->post("swegiht"),
                    "eweight"=>$this->input->post("ewegiht")
            );

            $marr = array("body_type"=>$this->input->post("body_types"),
                    "eithnicity"=>$this->input->post("eithnicitys"),
                    "appearance"=>$this->input->post("appearances"),
                    "hair_color"=>$this->input->post("hair_colors"),
                    "hair_length"=>$this->input->post("hiar_lengths"),
                    "hair_type"=>$this->input->post("hair_types"),
                    "eye_color"=>$this->input->post("eye_colors"),
                    "eye_wear"=>$this->input->post("eye_wers"),
                    "health_state"=>$this->input->post("health_states"),
                    "smoke"=>$this->input->post("smokes"),
                    "drink"=>$this->input->post("drinks"),
                    "willing"=>$this->input->post("willings"),
                    "complexion"=>$this->input->post("complexions"),
                    "religion"=>$this->input->post("religions"),
                    "marital_state"=>$this->input->post("marital_states"),
                    "have_children"=>$this->input->post("have_childrens"),
                    "eating_habit"=>$this->input->post("eating_habits"),
                    "occupation"=>$this->input->post("occupations"),
                    "employement_status"=>$this->input->post("employement_status"),
                    "home_type"=>$this->input->post("home_types"),
                    "living_situation"=>$this->input->post("living_situations"),
                    "residency_status"=>$this->input->post("residency_status"),
                    "nationality"=>$this->input->post("nationalities"),
                    "language"=>$this->input->post("languages"),
                    "born_reverted"=>$this->input->post("born_reverted"),
                    "religion_value"=>$this->input->post("religion_values"),
                    "religion_service"=>$this->input->post("religion_services"),
                    "read_quran"=>$this->input->post("read_quans"),
                    "polygamy"=>$this->input->post("polygamy"),
                    "family_value"=>$this->input->post("family_values"),
                    "profile_creator"=>$this->input->post("profile_creators")
            );

            foreach ($sarr as $key=>$val )
            {
                if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                    if ( $key == "country" || $key == "state" || $key == "city" ) $where .= " a.`$key`='$val' and ";
                    else $where .= " a.`$key`=$val and ";
                }
            }

            foreach ($iarr as $key=>$val )
            {
                $k = substr($key, 1);
                if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                    if ( $key == "sage" || $key == "sheight" || $key == "sweight" ) $where .= " a.`$k`>=$val and ";
                    else $where .= " a.`$k`<=$val and ";
                }
            }

            foreach ($marr as $key=>$val )
            {
                if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                    if ( $key == "language" || $key == "nationality" ) $val = explode(",", $val);
                    $where .= " ( ";
                    for ( $i = 0; $i < count($val); $i ++ ) {
                        $v = $val[$i];
                        if ( $i != 0 ) $where .= " or ";
                        $where .= " a.`$key`=$v";
                    }
                    $where .= " ) and ";
                }
            }

            $has_photo = $this->input->post("has_photo");
            if ( isset($has_photo) && $has_photo == "1" ) $where .= " (select count(*) from users_photos cc where cc.`user`=a.`id`)>0 and ";

            $last_active = $this->input->post("last_activity");
            if ( isset($last_active) && $last_active != "0" ) {
                $days = 0;
                switch (intval($last_active))
                {
                    case 1:                     // this week  7 days
                        $days = 7;
                        break;
                    case 2:                     // 1 month 31 days
                        $days = 31;
                        break;
                    case 3:                     // 3 month 93 days
                        $days = 93;
                        break;
                    case 4:                     // 6 month 186 days
                        $days = 186;
                        break;
                    case 5:                     // 1 years
                        $days = 366;
                        break;
                }
                $where .= " DATEDIFF(NOW(), h.`datetime`)<$days and ";
            }

            $where .= " a.`id`<>$user and ";

            // add new saved search
            $save_search = $this->input->post("save_search_title");
            if ( isset($save_search) && $save_search != null && $save_search != "" ) {
                $this->add_saved_search( $save_search, $sarr, $iarr, $marr, $has_photo, $last_active, $this->input->post("did") );
            }
        } else if ( $type == 7 ) {

            $where = " where ";

            // get saved search info
            $match = $this->get_saved_searchinfo_byid($search);
            if ( $match != null ) {
                $sarr = array("gender"=>$match->gender,
                    "country"=>$match->country,
                    "state"=>$match->state,
                    "city"=>$match->city,
                    "children_numbers"=>$match->children_numbers,
                    "youngest_childs"=>$match->youngest_childs,
                    "oldest_childs"=>$match->oldest_childs,
                    "more_childrens"=>$match->more_childrens,
                    "annual_income"=>$match->annual_income,
                    "education"=>$match->education
                );

                $iarr = array("sage"=>$match->sage,
                    "eage"=>$match->eage,
                    "sheight"=>$match->sheight,
                    "eheight"=>$match->eheight,
                    "sweight"=>$match->sweight,
                    "eweight"=>$match->eweight
                );

                $marr = array("body_type"=>$match->body_type,
                    "eithnicity"=>$match->eithnicity,
                    "appearance"=>$match->appearance,
                    "hair_color"=>$match->hair_color,
                    "hair_length"=>$match->hair_length,
                    "hair_type"=>$match->hair_type,
                    "eye_color"=>$match->eye_color,
                    "eye_wear"=>$match->eye_wear,
                    "health_state"=>$match->health_state,
                    "smoke"=>$match->smoke,
                    "drink"=>$match->drink,
                    "willing"=>$match->willing,
                    "complexion"=>$match->complexion,
                    "religion"=>$match->religion,
                    "marital_state"=>$match->marital_state,
                    "have_children"=>$match->have_children,
                    "eating_habit"=>$match->eating_habit,
                    "occupation"=>$match->occupation,
                    "employement_status"=>$match->employement_status,
                    "home_type"=>$match->home_type,
                    "living_situation"=>$match->living_situation,
                    "residency_status"=>$match->residency_status,
                    "nationality"=>$match->nationality,
                    "language"=>$match->language,
                    "born_reverted"=>$match->born_reverted,
                    "religion_value"=>$match->religion_value,
                    "religion_service"=>$match->religion_service,
                    "read_quran"=>$match->read_quran,
                    "polygamy"=>$match->polygamy,
                    "family_value"=>$match->family_value,
                    "profile_creator"=>$match->profile_creator
                );

                foreach ($sarr as $key=>$val )
                {
                    if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                        if ( $key == "country" || $key == "state" || $key == "city" ) $where .= " a.`$key`='$val' and ";
                        else $where .= " a.`$key`=$val and ";
                    }
                }

                foreach ($iarr as $key=>$val )
                {
                    $k = substr($key, 1);
                    if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                        if ( $key == "sage" || $key == "sheight" || $key == "sweight" ) $where .= " a.`$k`>=$val and ";
                        else $where .= " a.`$k`<=$val and ";
                    }
                }

                foreach ($marr as $key=>$val )
                {
                    if ( isset($val) && $val != "" && $val != "0" && $val != null ) {
                        $v_arr = explode(",", $val);
                        $where .= " ( ";
                        for ( $i = 0; $i < count($v_arr); $i ++ ) {
                            $v = $v_arr[$i];
                            if ( $i != 0 ) $where .= " or ";
                            $where .= " a.`$key`=$v";
                        }
                        $where .= " ) and ";
                    }
                }
            }

            $has_photo = $match->has_photo;
            if ( isset($has_photo) && $has_photo == "1" ) $where .= " (select count(*) from users_photos cc where cc.`user`=a.`id`)>0 and ";

            $last_active = $match->last_activity;
            if ( isset($last_active) && $last_active != "0" ) {
                $days = 0;
                switch (intval($last_active))
                {
                    case 1:                     // this week  7 days
                        $days = 7;
                        break;
                    case 2:                     // 1 month 31 days
                        $days = 31;
                        break;
                    case 3:                     // 3 month 93 days
                        $days = 93;
                        break;
                    case 4:                     // 6 month 186 days
                        $days = 186;
                        break;
                    case 5:                     // 1 years
                        $days = 366;
                        break;
                }
                $where .= " DATEDIFF(NOW(), h.`datetime`)<$days and ";
            }

            $where .= " a.`id`<>$user and ";

        } else if ( $type == 8 ) {              // Interested In Me
            $where = " where ";
            $where .= " ii.touser=$user and ii.state=1 and ";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 9 ) {              // I'm Their Favorite
            $where = " where ";
            $where .= " jj.touser=$user and jj.state=1 and ";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 10 ) {             // Viewed My Profile
            $where = " where ";
            $where .= " kk.touser=$user and ";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 11 ) {             // My Interests
            $where = " where ";
            $where .= " i.user=$user and i.state=1 and ";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 12 ) {             // My Favorites
            $where = " where ";
            $where .= " j.user=$user and j.state=1 and ";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 13 ) {             // Profiles I Viewed
            $where = " where ";
            $where .= " k.user=$user and ";
            $where .= " a.`id`<>$user and ";
        } else if ( $type == 14 ) {             // Block List
            $where = " where ";
            $where .= " l.user=$user and l.state=1 and ";
            $where .= " a.`id`<>$user and ";
        }

        $offset = ( $pageNum - 1 ) * $limit;

        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select count(*) as cnt from users a 
                    left join users_photos b on (a.`id`=b.`user`) 
                    left join countries d on(a.`country`=d.`iso`) 
                    left join regions e ON(a.`state`=e.`code` and a.`country`=e.`country`) 
                    left join cities f on (a.`city`=f.`id`) 
                    left join users_matches g ON(a.`id`=g.`user`) 
                    left join users_logs h on (h.`user`=a.`id`) 
                    left join activity_interests i on(a.id=i.touser and i.user=$user) 
                    left join activity_favorites j on(a.id=j.touser and j.user=$user)
                    left join activity_profile_viewds k on(a.id=k.touser and k.user=$user 
                      and k.id=(select max(id) from activity_profile_viewds where a.id=touser and user=$user ) ) 
                    left join activity_blocks l on(a.id=l.touser and l.user=$user)
                    left join activity_interests ii on(a.id=ii.user and ii.touser=$user) 
                    left join activity_favorites jj on(a.id=jj.user and jj.touser=$user)
                    left join activity_profile_viewds kk on(a.id=kk.user and kk.touser=$user 
                      and kk.id=(select max(id) from activity_profile_viewds where a.id=user and touser=$user ) ) 
                    left join activity_blocks ll on(a.id=ll.user and ll.touser=$user)  
                    $where ( b.`id`=(select min(c.`id`) from users_photos c where c.`user`=a.`id`) or 
	                (select count(*) from users_photos cc where cc.`user`=a.`id`) < 1 ) 
                        and ( h.`id`=(select max(hh.`id`) from users_logs hh where hh.`user`=a.`id`) or 
                    (select count(*) from users_logs hhh where hhh.`user`=a.`id`) < 1 ) ";
        $res = $this->db->query($sql);
        $cnt = $res->row()->cnt;

        $sql = "select a.*, b.`filename`, d.`nicename` as country, e.`name` as state, f.`name` as `city`, 
                    g.`sage` AS `m_sage`, g.`eage` AS `m_eage`, g.`gender` AS `m_gender`, 
                    DATEDIFF(NOW(), h.`datetime`) AS `lastLogin`, i.state as interest, j.`state` as favorite   
                    from users a 
                    left join users_photos b on (a.`id`=b.`user`) 
                    left join countries d on(a.`country`=d.`iso`)
                    left join regions e ON(a.`state`=e.`code` and a.`country`=e.`country`) 
                    left join cities f on (a.`city`=f.`id`) 
                    left join users_matches g ON(a.`id`=g.`user`)
                    left join users_logs h on (h.`user`=a.`id`) 
                    left join activity_interests i on(a.id=i.touser and i.user=$user) 
                    left join activity_favorites j on(a.id=j.touser and j.user=$user)
                    left join activity_profile_viewds k on(a.id=k.touser and k.user=$user 
                      and k.id=(select max(id) from activity_profile_viewds where a.id=touser and user=$user ) ) 
                    left join activity_blocks l on(a.id=l.touser and l.user=$user)  
                    left join activity_interests ii on(a.id=ii.user and ii.touser=$user) 
                    left join activity_favorites jj on(a.id=jj.user and jj.touser=$user)
                    left join activity_profile_viewds kk on(a.id=kk.user and kk.touser=$user 
                      and kk.id=(select max(id) from activity_profile_viewds where a.id=user and touser=$user ) ) 
                    left join activity_blocks ll on(a.id=ll.user and ll.touser=$user)
                    $where ( b.`id`=(select min(c.`id`) from users_photos c where c.`user`=a.`id`) or 
	                (select count(*) from users_photos cc where cc.`user`=a.`id`) < 1 )
                        and ( h.`id`=(select max(hh.`id`) from users_logs hh where hh.`user`=a.`id`) or 
                    (select count(*) from users_logs hhh where hhh.`user`=a.`id`) < 1 )  
	                order by a.`id` desc
	                limit $limit offset $offset ";
        $res = $this->db->query($sql);

        $list = null;
        if(isset($res)) {
            $list = $res->result_array();
        }

        $ret["cnt"] = $cnt;
        $ret["list"] = $list;

        return $ret;
    }


}
