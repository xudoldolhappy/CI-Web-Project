<?php
class AdminModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->library('GoogleAuthenticator');
    }

    /**
     * add new user in backend
     * @return $ret 1=> success, 0=> failed
     */
    public function add_new_user()
    {
        $is_reset_2fa = $this->input->post("is_reset_2fa");
        $gaobj = new GoogleAuthenticator();
        $secret = $gaobj->createSecret();

        $data = array(
            "first_name" => $this->input->post("fname"),
            "last_name" => $this->input->post("lname"),
            "midlde_name" => $this->input->post("mname"),
            "username" => $this->input->post("username"),
            "gender" => $this->input->post("gender"),
            "birthday" => $this->input->post("birthday"),
            "email" => $this->input->post("email"),
            "password" => $this->input->post("password"),
            "country" => $this->input->post("country"),
            "state" => $this->input->post("state"),
            "address1" => $this->input->post("address1"),
            "address2" => $this->input->post("address2"),
            "city" => $this->input->post("city"),
            "zip" => $this->input->post("zip"),
            "phone" => $this->input->post("phone"),
            "company" => $this->input->post("company"),
            "auth" => $this->input->post("authority")
        );

        $id = $this->input->post("did");

        /** current user info update */
        if ( isset($id) && $id != "" ) {
            if ( isset( $is_reset_2fa ) && $is_reset_2fa == "1" ) {
                $data["auth_key"] = $secret;
            }
            $data["is_2fa"] = $this->input->post("is_2fa");

            $this->db->where( array("id"=>$id));
            $ret = $this->db->update("users", $data);
            if ( $ret ) {
                return 3;
            } else {
                return 0;
            }
        }

        $data["auth_key"] = $secret;

        /** confirm weather duplicate email */
        $ret = $this->db->get_where("users", array("email"=>$this->input->post("email")))->row();
        if ( $ret ) return 2;

        /** new user info insert */
        $ret = $this->db->insert("users", $data);
        if ( $ret ) return 1;
        else return 0;
    }

    /**
     * user login info confirm
     * @return 1=>seuccess, 0=> failed
     */
    public function login_confirm()
    {

        $row = $this->db->get_where("users", array(
            "email" =>$this->input->post("email"),
            "password" =>$this->input->post("password"),
            "auth" => "1"
        ))->row();

        if(isset($row)) {
            // register login log
            $sql = "INSERT INTO users_logs (`user`, `datetime`)
                VALUES(?, CURRENT_TIME)";
            $this->db->query($sql, array($row->id));
        }
        return $row;
    }

    /**
     * get all user
     * @return all users list
     */
    public function get_all_users()
    {
        $sql = "select a.*, b.nicename as country_name, c.name as state_name 
                from users a 
                left join countries b on ( a.country=b.iso) 
                left join regions c on( a.country=c.country and a.state=c.code )
                order by a.`id` desc";
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get recetn user
     * @param $limit: number of recent users
     * @return all users list
     */
    public function get_recent_users($limit)
    {
        $sql = "select a.*, b.nicename as country_name, c.name as state_name 
                from users a 
                left join countries b on ( a.country=b.iso) 
                left join regions c on( a.country=c.country and a.state=c.code )
                order by a.`id` desc
                limit $limit offset 0";
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get one user via primary key
     * @param $id: user`s primary key
     * @return $ret: user`s info
     */
    public function get_one_user( $id )
    {
        if ( !isset( $id ) ) return;
        $sql = "select a.*, b.nicename as country_name, c.name as state_name 
                from users a 
                left join countries b on ( a.country=b.iso) 
                left join regions c on( a.country=c.country and a.state=c.code ) 
                where a.`id`=$id ";
        $query = $this->db->query($sql);
        $ret = $query->row();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get all user
     * @return all users login log list
     */
    public function get_all_users_logs()
    {
        $sql = "select a.datetime as logintime, b.*, c.nicename as country_name, d.name as state_name 
                from users_logs a 
                left join users b on (a.user=b.id)
                left join countries c on ( b.country=c.iso) 
                left join regions d on( b.country=d.country and b.state=d.code ) 
                order by logintime desc";
        $query = $this->db->query($sql);
        $ret = $query->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * delete on user
     * @param $id: user`s primary key
     * @return $ret: 1=>success, 0=>failed
     */
    public function delete_one_user( $id )
    {
        $ret = $this->db->delete("users", array( "id"=>$id ));
        return $ret;
    }

    /**
     * get products categories
     * @return @ret: categories list
     */
    public function get_products_categories()
    {
        $this->db->from("pcategories");
        $this->db->where(array("state"=>"1"));
        $this->db->order_by("order", "asc");
        $ret = $this->db->get()->result_array();

        $sor = array();
        $sub = array();
        $l1 = 1;

        if ( count( $ret ) > 0 ) {
            for ($i = 1; $i < count($ret); $i++) {
                $curl = $ret[$i]["level"];
                if ($l1 == $curl) {
                    if ($i != 1) array_push($sor, $sub);
                    $sub = array();
                    array_push($sub, $ret[$i]);
                } else {
                    array_push($sub, $ret[$i]);
                }
            }
            array_push($sor, $sub);

            usort($sor, function ($x, $y) {
                if ($x[0]["title"] == $y[0]["title"]) {
                    return 0;
                }
                if (strcmp(strtolower($x[0]["title"]), strtolower($y[0]["title"])) > 0) return 1;
                else return -1;
            });

            $las = array();
            array_push($las, $ret[0]);
            for ($i = 0; $i < count($sor); $i++) {
                for ($j = 0; $j < count($sor[$i]); $j++)
                    array_push($las, $sor[$i][$j]);
            }

            return $las;
        } else {
            return null;
        }
    }

    /**
     * add new product category
     * @return 1=>success, 0=>failed
     */
    public function add_new_product_category()
    {
        $title = $this->input->post("title");
        $parent_id = $this->input->post("parent_id");
        $level = $this->input->post("level");
        $slug = $this->input->post("slug");
        $description = $this->input->post("description");
        $photo = $this->input->post("photo");

        // get order
        $sql = "SELECT MAX(`order`) as cur_order FROM pcategories WHERE 
                `id`=? OR 
                `parent_id`=? OR 
                `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id`=?) OR 
                `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id`=?)) OR 
                `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id`=?))) OR
                `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id`=?)))) OR 
                `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id`=?))))) OR 
                `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id` IN (SELECT `id` FROM pcategories WHERE `parent_id`=?)))))) ";
        $order = $this->db->query($sql, array( $parent_id, $parent_id, $parent_id , $parent_id , $parent_id , $parent_id, $parent_id, $parent_id ))->row()->cur_order;

        // order increase
        $sql = "update pcategories set `order`=`order`+1 where `order`>$order";
        $this->db->query($sql);

        $order = intval($order) + 1;

        $sql = "insert into pcategories (`title`, `parent_id`, `level`, `order`, `state`, `slug`, `description`, `photo`) 
                values( '$title', $parent_id, $level, $order, 1, '$slug', '$description', '$photo')";
        $ret = $this->db->query($sql);

        return $ret;
    }

    /**
     * delete one product category via primary key
     * @param $id: primary key will delete
     * @return $ret: 1=> success, 0=>failed
     */
    public function delete_one_product_category( $id )
    {
        $sql = "SELECT `id` FROM pcategories 
                  WHERE id=$id OR 
                        id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) OR 
                        id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) ) OR 
                        id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) ) ) OR 
                        id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) ) ) ) OR 
                        id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) ) ) ) ) OR
                        id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) ) ) ) ) ) OR 
                        id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id IN (SELECT `id` FROM pcategories WHERE parent_id=$id ) ) ) ) ) ) )";
        $ids = $this->db->query($sql)->result_array();

        for ( $i = 0; $i < count($ids); $i ++ ) {
            $id = $ids[$i]["id"];
            // delete categories
            $sql = "delete from pcategories where `id`=$id";
            $this->db->query($sql);
            // delete product_categories
            $sql = "delete from products_categories where `category`=$id";
            $this->db->query($sql);
        }

        return 1;
    }

    /**
     * add new product attribute make
     * @param $title: new make title
     * @return $ret: all make attributes list
     */
    public function add_new_product_attribute_make( $title ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pa_make", array("title"=>$title))->row();
        if ( !$ret ) {
            $this->db->insert("pa_make", array("title"=>$title, "state"=>"1"));
        }
        $ret = $this->db->get_where("pa_make", array("state"=>"1"))->result_array();
        return $ret;
    }

    /**
     * get all make list
     * @return $ret: all list
     */
    public function get_product_attribute_makes()
    {
        $this->db->order_by("title", "asc");
        $ret = $this->db->get_where("pa_make", array("state"=>"1"))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * delete one make via primary key
     * @param $id: make`s primary key
     * @param $kind: 1=>make, 2=>type. 3=>model, 4=>year, 5=>engine, 6=>option
     * @return $ret: 1=>success, =>failed
     */
    public function delete_product_attribute_via_id($id, $kind)
    {
        if ( $kind == "1" ) {           // dlete make item and related items ( type, model, etc..) and delete product application info
            // delete make from db
            $this->db->delete("pa_make", array("id"=>$id));
            // delete this make`s children type items
            $types = $this->db->query("select `type` from product_application where `make`=$id group by `type`")->result_array();
            foreach ( $types as $type ) {
                $item = $type["type"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_type where `id`=$item");
            }
            // delet this make`s children model
            $models = $this->db->query("select `model` from product_application where `make`=$id group by `model`")->result_array();
            foreach ( $models as $model ) {
                $item = $model["model"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_model where `id`=$item");
            }
            // delet this make`s children year
            $years = $this->db->query("select `year` from product_application where `make`=$id group by `year`")->result_array();
            foreach ( $years as $year ) {
                $item = $year["year"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_year where `id`=$item");
            }
            // delet this make`s children engine
            $engines = $this->db->query("select `engine` from product_application where `make`=$id group by `engine`")->result_array();
            foreach ( $engines as $engine ) {
                $item = $engine["engine"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_engine where `id`=$item");
            }
            // delete product application data has this make
            $this->db->delete("product_application", array("make"=>$id));
        } else if ( $kind == "2" ) {    // delete type
            // delete type from db
            $this->db->delete("pa_type", array("id"=>$id));
            // delet this type`s children model
            $models = $this->db->query("select `model` from product_application where `type`=$id group by `model`")->result_array();
            foreach ( $models as $model ) {
                $item = $model["model"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_model where `id`=$item");
            }
            // delet this type`s children year
            $years = $this->db->query("select `year` from product_application where `type`=$id group by `year`")->result_array();
            foreach ( $years as $year ) {
                $item = $year["year"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_year where `id`=$item");
            }
            // delet this type`s children engine
            $engines = $this->db->query("select `engine` from product_application where `type`=$id group by `engine`")->result_array();
            foreach ( $engines as $engine ) {
                $item = $engine["engine"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_engine where `id`=$item");
            }
            // delete product application data has this type
            $this->db->delete("product_application", array("type"=>$id));
        } else if ( $kind == "3" ) {    // delete model
            // delete model from db
            $this->db->delete("pa_model", array("id"=>$id));
            // delet this model`s children year
            $years = $this->db->query("select `year` from product_application where `model`=$id group by `year`")->result_array();
            foreach ( $years as $year ) {
                $item = $year["year"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_year where `id`=$item");
            }
            // delet this model`s children engine
            $engines = $this->db->query("select `engine` from product_application where `model`=$id group by `engine`")->result_array();
            foreach ( $engines as $engine ) {
                $item = $engine["engine"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_engine where `id`=$item");
            }
            // delete product application data has this model
            $this->db->delete("product_application", array("type"=>$id));
        } else if ( $kind == "4" ) {    // delete year
            // delete year from db
            $this->db->delete("pa_year", array("id"=>$id));
            // delet this year`s children engine
            $engines = $this->db->query("select `engine` from product_application where `year`=$id group by `engine`")->result_array();
            foreach ( $engines as $engine ) {
                $item = $engine["engine"];
                if ( isset($item) && $item != null && $item != "" )
                    $this->db->query("delete from pa_engine where `id`=$item");
            }
            // delete product application data has this year
            $this->db->delete("product_application", array("year"=>$id));
        } else if ( $kind == "5" ) {    // delete engine
            // delete engine from db
            $this->db->delete("pa_engine", array("id"=>$id));
            // delete product application data has this year
            $this->db->delete("product_application", array("engine"=>$id));
        } else if ( $kind == "6" ) {    // delete option

        } else {

        }
        return 1;
    }

    /**
     * add new product attribute type
     * @param $title: new type title
     * @param $make: make primary key
     * @return $ret: all make attributes list
     */
    public function add_new_product_attribute_type( $title, $make ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pa_type", array("title"=>$title, "make"=>$make))->row();
        if ( !$ret ) {
            $this->db->insert("pa_type", array("title"=>$title, "make"=>$make, "state"=>"1"));
        }
        $ret = $this->db->get_where("pa_type", array("make"=>$make, "state"=>"1"))->result_array();
        return $ret;
    }

    /**
     * get all type list related a make
     * @param $make: make primary key
     * @return $ret: all list
     */
    public function get_product_attribute_types( $make )
    {
        $this->db->order_by("title", "asc");
        $ret = $this->db->get_where("pa_type", array("make"=>$make, "state"=>"1"))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * add new product attribute model
     * @param $title: new model title
     * @param $make: make primary key
     * @return $ret: all make attributes list
     */
    public function add_new_product_attribute_model( $title, $type ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pa_model", array("title"=>$title, "type"=>$type))->row();
        if ( !$ret ) {
            $this->db->insert("pa_model", array("title"=>$title, "type"=>$type, "state"=>"1"));
        }
        $ret = $this->db->get_where("pa_model", array("type"=>$type, "state"=>"1"))->result_array();
        return $ret;
    }

    /**
     * get all type list related a type
     * @param $make: make primary key
     * @return $ret: all list
     */
    public function get_product_attribute_models( $type )
    {
        $this->db->order_by("title", "asc");
        $ret = $this->db->get_where("pa_model", array("type"=>$type, "state"=>"1"))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * add new product attribute year
     * @param $title: new model title
     * @param $model: type primary key
     * @return $ret: all make attributes list
     */
    public function add_new_product_attribute_year( $title, $model ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pa_year", array("title"=>$title, "model"=>$model))->row();
        if ( !$ret ) {
            $this->db->insert("pa_year", array("title"=>$title, "model"=>$model, "state"=>"1"));
        }
        $ret = $this->db->get_where("pa_year", array("model"=>$model, "state"=>"1"))->result_array();
        return $ret;
    }

    /**
     * get all year list related a model
     * @param $model: model primary key
     * @return $ret: all list
     */
    public function get_product_attribute_years( $model )
    {
        $this->db->order_by("title", "asc");
        $ret = $this->db->get_where("pa_year", array("model"=>$model, "state"=>"1"))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get all engine list related a year
     * @param $year: year primary key
     * @return $ret: all list
     */
    public function get_product_attribute_engines( $year )
    {
        $this->db->order_by("title", "asc");
        $ret = $this->db->get_where("pa_engine", array("year"=>$year, "state"=>"1"))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * add new product attribute engine
     * @param $title: new engine title
     * @param $year: year primary key
     * @return $ret: all engine attributes list
     */
    public function add_new_product_attribute_engine( $title, $year ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pa_engine", array("title"=>$title, "year"=>$year))->row();
        if ( !$ret ) {
            $this->db->insert("pa_engine", array("title"=>$title, "year"=>$year, "state"=>"1"));
        }
        $ret = $this->db->get_where("pa_engine", array("year"=>$year, "state"=>"1"))->result_array();
        return $ret;
    }

    /**
     * get all options list related a engine
     * @param $engine: engine primary key
     * @return $ret: all list
     */
    public function get_product_attribute_options( $engine )
    {
        $ret = $this->db->get_where("pa_option", array("engine"=>$engine, "state"=>"1"))->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * add new product attribute option
     * @param $title: new option title
     * @param $engine: engien primary key
     * @return $ret: all option attributes list
     */
    public function add_new_product_attribute_option( $title, $engine ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pa_option", array("title"=>$title, "engine"=>$engine))->row();
        if ( !$ret ) {
            $this->db->insert("pa_option", array("title"=>$title, "engine"=>$engine, "state"=>"1"));
        }
        $ret = $this->db->get_where("pa_option", array("engine"=>$engine, "state"=>"1"))->result_array();
        return $ret;
    }

    /**
     * publish new product or update
     * @return $ret: 1=>success, 0=>failed
     */
    public function publish_products()
    {
        $did = $this->input->post("did");
        // insert application data
        $is_application_update = $this->input->post("is_application_update");
        $curdate = $this->db->query("select curdate() as curdate")->row()->curdate;
        $product = array(
            "code" => $this->input->post("code"),
            "quanity" => $this->input->post("quanity"),
            "name" => $this->input->post("name"),
            "reference" => $this->input->post("reference"),
            "favorite" => $this->input->post("favorite"),
            "short_description" => $this->input->post("short_description"),
            "description" => $this->input->post("description"),
            "regular_price" => $this->input->post("regular_price"),
            "sale_price" => $this->input->post("sale_price"),
            "core_fee" => $this->input->post("core_fee"),
            "start_date" => $this->input->post("start_date"),
            "end_date" => $this->input->post("end_date"),
            "weight" => $this->input->post("weight"),
            "length" => $this->input->post("length"),
            "width" => $this->input->post("width"),
            "height" => $this->input->post("height"),
            "create_date" => $curdate // date("Y-m-d")
        );
        $ret = $did;
        if ( isset($did) && $did != "" && $did != null ) {      // update
            $this->db->where(array("id"=>$did));
            $this->db->update("products", $product);
        } else {                                                // insert
            // insert product info
            $this->db->insert("products", $product);
            $ret = $this->db->insert_id();
            $is_application_update = "1";
        }

        // insert product photo
        $photo = array();
        $c = explode(",", $this->input->post("photo"));
        for ( $i = 0; $i < count($c); $i ++ ) {
            $main = 0; if ( $i == 0 ) $main = 1;
            array_push($photo, array(
                "product" => $ret,
                "filename" => $c[$i],
                "main" => $main
            ));
        }
        $this->db->delete("product_images", array("product"=>$ret));
        $this->db->insert_batch('product_images', $photo);

        // insert categories
        $categories = array();
        $c = explode(",", $this->input->post("categories"));
        for ( $i = 0; $i < count($c); $i ++ ) {
            array_push($categories, array(
                "product" => $ret,
                "category" => $c[$i]
            ));
        }
        $this->db->delete("products_categories", array("product"=>$ret));
        $this->db->insert_batch('products_categories', $categories);

        // insert advanced data
        $a = explode("##", $this->input->post("advanced"));
        $advace = array();
        for ( $i = 0; $i < count($a); $i ++ ) {
            $aa = explode("&&", $a[$i]);
            if ( $aa[0] != "" && $aa[0] != null )
                array_push($advace, array(
                    "product" => $ret,
                    "spec" => $aa[0],
                    "value" => $aa[1]
                ));
        }
        $this->db->delete("product_advance", array("product" => $ret));
        if ( count($advace) > 0 ) {
            $this->db->insert_batch('product_advance', $advace);
        }

        // insert service parts data
        $a = explode("##", $this->input->post("service_parts"));
        $service_parts = array();
        for ( $i = 0; $i < count($a); $i ++ ) {
            $aa = explode("&&", $a[$i]);
            if ( $aa[0] != "" && $aa[0] != null )
                array_push($service_parts, array(
                    "product" => $ret,
                    "service" => $aa[0],
                    "value" => $aa[1]
                ));
        }
        $this->db->delete("product_service_parts", array("product" => $ret));
        if ( count($service_parts) > 0 ) {
            $this->db->insert_batch('product_service_parts', $service_parts);
        }

        // insert replacement brands data
        $a = explode("##", $this->input->post("brand"));
        $brand = array();
        for ( $i = 0; $i < count($a); $i ++ ) {
            $aa = explode("&&", $a[$i]);
            if ( $aa[0] != "" && $aa[0] != null )
                array_push($brand, array(
                    "product" => $ret,
                    "brand" => $aa[0],
                    "value" => $aa[1]
                ));
        }
        $this->db->delete("product_replacement_brand", array("product" => $ret));
        if ( count($brand) > 0 ) {
            $this->db->insert_batch('product_replacement_brand', $brand);
        }
        // replacement search table update
        $this->db->delete("s_product_for_replacement", array("id" => $ret));
        $sql = 'select a.id, a.name, a.code, a.quanity, a.sale_price, a.reference, a.favorite, b.filename as photo, c.value as replacement
                        from products a
                        left join product_images b on ( a.id=b.product and main=1)
                        left join product_replacement_brand c on ( a.id=c.product )
                        where a.id='.$ret;
        $data = $this->db->query( $sql )->result_array();
        $this->db->insert_batch( "s_product_for_replacement", $data );

        if ( $is_application_update == "1" ) {
            $ap = explode("##", $this->input->post("application"));
            $application = array();
            for ( $i = 0; $i < count($ap); $i ++ ) {
                $app = explode("&&", $ap[$i]);
                if ( $app[0] != "" && $app[0] != null )
                    array_push($application, array(
                        "product" => $ret,
                        "make" => $app[0],
                        "type" => $app[1],
                        "model" => $app[2],
                        "year" => $app[3],
                        "engine" => $app[4]
                    ));
            }
            $this->db->delete("product_application", array("product" => $ret));
            if ( count($application) > 0 ) {
                $this->db->insert_batch('product_application', $application);
            }
        }

        $this->db->delete("product_alternative", array("product" => $ret));

        $product_alternative = $this->input->post("product_alternative");
        if ( isset($product_alternative) && $product_alternative != "" && $product_alternative != null ) {
            $pal = explode(":", $this->input->post("product_alternative") );
            if ( count($pal) > 0 ) {
                $pal_code = trim($pal[0]);
                $pal_name = trim($pal[1]);
                $sql = "insert into product_alternative (`product`, `alternative`) 
                values($ret, (select `id` from products where `code`='$pal_code' and `name`='$pal_name'))";
                $this->db->query($sql);
            }
        }

        return $ret;
    }

    /**
     * get_product_application_list_for_edit
    */
    public function get_product_application_list_for_edit()
    {
        $make = $this->input->post("make");
        $type = $this->input->post("type");
        $model = $this->input->post("model");
        $year = $this->input->post("year");

        $ret = array();
        $ret["make_list"]=  $this->get_product_attribute_makes();
        $ret["type_list"]=  $this->get_product_attribute_types($make);
        $ret["model_list"]=  $this->get_product_attribute_models($type);
        $ret["year_list"]=  $this->get_product_attribute_years($model);
        $ret["engine_list"]=  $this->get_product_attribute_engines($year);
        return $ret;
    }

    /**
     * get all product list
     * @return $ret: products list
     */
    public function get_product_list()
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select * from products order by name desc";
        $ret = $this->db->query($sql)->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get all product list
     * @return $ret: products list
     */
    public function get_product_list_for_autocomplete($query)
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select concat(`code`, ' : ', `name`) as item from products 
                where name like '%$query%' or code like '%$query%'  
                order by name desc
                limit 10 offset 0  ";
        $ret = $this->db->query($sql)->result_array();

        $res = array();
        for ( $i = 0; $i < count($ret); $i ++ ) {
            array_push($res, $ret[$i]["item"]);
        }

        return $res;
    }

    /**
     * get all product list
     * @param $search_key : search key
     * @param $limit: tha count of products that display in one page
     * @param $pagenum: page number
     * @return $ret: products list
     */
    public function get_product_list_bysearch( $search_key, $limit, $pagenum )
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');
        $where = "";
        $offset = ( $pagenum - 1 ) * $limit;

        if ( isset($search_key) && $search_key != null && $search_key != "" ) {
            $where = " where name like '%$search_key%' or code like '%$search_key%' ";
        }

        // get all count of products
        $sql = "select count(*) as cnt from products $where";
        $ret["cnt"] = $this->db->query($sql)->row()->cnt;

        $sql = "select * from products 
                $where
                order by `id` desc
                limit $limit offset $offset ";
        $ret["list"] = $this->db->query($sql)->result_array();

        return $ret;
    }

    /**
     * get all product list
     * @param $limit: the number of recent products
     * @return $ret: products list
     */
    public function get_recent_products($limit)
    {
        $this->db->query('SET SQL_BIG_SELECTS=1');

        $sql = "select * from products order by id desc 
                  limit $limit offset 0";
        $ret = $this->db->query($sql)->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * delete selected product
     * @param $did: product primary key
     * @return $ret: 1=>success, 0=>failed
     */
    public function delete_one_product( $did )
    {
        $this->db->delete("product_images", array("product"=>$did));
        $this->db->delete("products_categories", array("product"=>$did));
        $this->db->delete("product_application", array("product"=>$did));
        $this->db->delete("product_replacement_brand", array("product"=>$did));
        $this->db->delete("product_alternative", array("product"=>$did));
        $this->db->delete("product_service_parts", array("product"=>$did));
        $this->db->delete("product_advance", array("product"=>$did));
        $ret = $this->db->delete("products", array("id"=>$did));
        $ret = $this->db->delete("s_product_for_replacement", array("id"=>$did));
        if ( $ret ) return 1;
        else return 0;
    }

    /**
     * get one product info via primary key
     * @param $did: primary key
     * @return $ret: product related all info
     */
    public function get_product_info_viaId($did)
    {
        if ( isset($did) == false || $did == "" || $did == null ) return null;
        $ret = array();

        $this->db->query('SET SQL_BIG_SELECTS=1');

        // product general info
        $ret["product"] = $this->db->get_where("products", array("id"=>$did))->row();

        // product photo info
        $ret["image"] = $this->db->get_where("product_images", array("product"=>$did))->result_array();

        // product categories detail info
        $sql = "select a.*, b.title as title from products_categories a 
                  left join pcategories b on (a.category=b.id)
                  where a.product=$did;";
        $ret["products_categories"] =$this->db->query($sql)->result_array();

        // product advanced info list
        $sql = "select a.*, b.title as spec_title from product_advance a 
                left join pproduct_specs b on (a.spec=b.id) 
                where a.product=$did";
        $ret["product_advances"] =$this->db->query($sql)->result_array();

        //service parts info list
        $sql = "select a.*, b.title as service_title, c.id as p_id, 
                        c.name as p_name, c.sale_price as p_price, c.core_fee as p_fee,  
                        c.quanity as p_quanity, d.filename as p_filename    
                from product_service_parts a 
                left join pproduct_service_items b on (a.service=b.id) 
                left join products c on ( a.value=c.code )
                left join product_images d on ( c.id=d.product and d.main=1 )
                where a.product=$did";
        $ret["service_parts"] =$this->db->query($sql)->result_array();

        // replacement brands info list
        $sql = "select a.*, b.title as brand_title from product_replacement_brand a 
                left join preplacement_brands b on (a.brand=b.id) 
                where a.product=$did";
        $ret["replacement_brands"] = $this->db->query($sql)->result_array();

        // product applications detail list info
        $sql = "select a.*, b.title as make_title, bb.title as type_title, c.title as model_title, d.title as year_title, e.title as engine_title  
                  from product_application a 
                  left join pa_make b on (a.make=b.id)
                  left join pa_type bb on (a.type=bb.id)
                  left join pa_model c on (a.model=c.id) 
                  left join pa_year d on (a.year=d.id) 
                  left join pa_engine e on (a.engine=e.id)  
                  where a.product=$did;";
        $papp =$this->db->query($sql)->result_array();
//        $product_applications = array();

        /*
        foreach ( $papp as $val ) {
            $temp = array();
            $temp["make"] = $val["make"];
            $temp["type"] = $val["type"];
            $temp["model"] = $val["model"];
            $temp["year"] = $val["year"];
            $temp["engine"] = $val["engine"];

            $temp["make_title"] = $val["make_title"];
            $temp["type_title"] = $val["type_title"];
            $temp["model_title"] = $val["model_title"];
            $temp["year_title"] = $val["year_title"];
            $temp["engine_title"] = $val["engine_title"];

            $temp["type_arr"]=  $this->get_product_attribute_types($val["make"]);
            $temp["model_arr"]=  $this->get_product_attribute_models($val["type"]);
            $temp["year_arr"]=  $this->get_product_attribute_years($val["model"]);
            $temp["engine_arr"]=  $this->get_product_attribute_engines($val["year"]);

            array_push($product_applications, $temp);
        }
        */

        $ret["product_applications"] = $papp;//$product_applications;
        // product review info list
        $ret["product_reviews"] = $this->db->get_where("product_reviews", array("product"=>$did))->result_array();

        // get product`s alternative products
        $sql = "select a.*, b.name, b.sale_price, b.id as pid, b.quanity, c.filename as photo 
                from product_alternative a 
                left join  products b on(a.alternative=b.id)  
                left join product_images c on ( b.id=c.product and c.main=1)
                where a.product=$did";

        // get alternative product info
        $sql = "select concat(`code`, ' : ', `name`) as alternative from products 
                where `id`=(select `alternative` from product_alternative where `product`=$did)";
        $alternative = $this->db->query($sql)->row();
        if ( ! $alternative ) $ret["alternative"] ="";
        else $ret["alternative"] = $alternative->alternative;

        return $ret;

    }

    /**
     * get product detail info via primary key
    */
    public function get_product_info_viaId_inFrontEnd($did)
    {
        if ( isset($did) == false || $did == "" || $did == null ) return null;
        $ret = array();

        $this->db->query('SET SQL_BIG_SELECTS=1');

        // product general info
        $ret["product"] = $this->db->get_where("products", array("id"=>$did))->row();

        // product photo info
        $ret["image"] = $this->db->get_where("product_images", array("product"=>$did))->result_array();

        // product categories detail info
        $sql = "select a.*, b.title as title from products_categories a 
                  left join pcategories b on (a.category=b.id)
                  where a.product=$did;";
        $ret["products_categories"] =$this->db->query($sql)->result_array();

        // product advanced info list
        $sql = "select a.*, b.title as spec_title from product_advance a 
                left join pproduct_specs b on (a.spec=b.id) 
                where a.product=$did";
        $ret["product_advances"] =$this->db->query($sql)->result_array();

        //service parts info list
        $sql = "select a.*, b.title as service_title, c.id as p_id, 
                        c.name as p_name, c.sale_price as p_price, c.core_fee as p_fee,  
                        c.quanity as p_quanity, d.filename as p_filename    
                from product_service_parts a 
                left join pproduct_service_items b on (a.service=b.id) 
                left join products c on ( a.value=c.code )
                left join product_images d on ( c.id=d.product and d.main=1 )
                where a.product=$did";
        $ret["service_parts"] =$this->db->query($sql)->result_array();

        // replacement brands info list
        $sql = "select a.*, b.title as brand_title from product_replacement_brand a 
                left join preplacement_brands b on (a.brand=b.id) 
                where a.product=$did";
        $ret["replacement_brands"] = $this->db->query($sql)->result_array();

        // product applications detail list info
        $sql = "select a.*, b.title as make_title, bb.title as type_title, c.title as model_title, d.title as year_title, e.title as engine_title  
                  from product_application a 
                  left join pa_make b on (a.make=b.id)
                  left join pa_type bb on (a.type=bb.id)
                  left join pa_model c on (a.model=c.id) 
                  left join pa_year d on (a.year=d.id) 
                  left join pa_engine e on (a.engine=e.id)  
                  where a.product=$did;";
        $papp =$this->db->query($sql)->result_array();

        $ret["product_applications"] = $papp;
        // product review info list
        $ret["product_reviews"] = $this->db->get_where("product_reviews", array("product"=>$did))->result_array();

        // get product`s alternative products
        $sql = "select a.*, b.name, b.sale_price, b.id as pid, b.quanity, c.filename as photo 
                from product_alternative a 
                left join  products b on(a.alternative=b.id)  
                left join product_images c on ( b.id=c.product and c.main=1)
                where a.product=$did";
        $ret["alternative"] = $this->db->query($sql)->result_array();

        return $ret;

    }

    /**
     * get product list by serach paramets
     * @param $type: 1=> home page search ( only  by product name),
     *                  2=> by categories and product name,
     *                  3=> by application attribute
     * @param  $limit: the number of one page
     * @param $pagenum: page number
     * @return $ret: searched products
     */
    public function get_searched_product( $type, $limit, $pagenum )
    {
        $where = "";
        $offset = ( $pagenum - 1 ) * $limit;

        // make query via replacement product id
        // have to select any product if it`s replacement`s product id is like search parameter

        $this->db->query('SET SQL_BIG_SELECTS=1');

        if ( $type == 1 ) {
            $name = trim($this->input->get("name"));
            $where = " ";
            if ( isset($name) && $name != "" && $name != null ) {
                /*
                $where = " where  ( a.`name` like '%$name%' or a.`reference` like '%$name%' or a.`code` like '%$name%' or c.value like '%$name%' )";

                // get all count
                $sql1 = "select count( DISTINCT a.id) as cnt
                        from products a
                        left join product_images b on ( a.id=b.product and main=1)
                        left join product_replacement_brand c on ( a.id=c.product )
                        $where";

                $sql2 = "select a.*, b.filename as photo
                        from products a
                        left join product_images b on ( a.id=b.product and main=1)
                        left join product_replacement_brand c on ( a.id=c.product )
                        $where
                        group by a.id
                        order by a.id desc
                        limit $limit offset $offset ";
                */
                /*
                $where = " where  ( `name` like '%$name%' or `reference` like '%$name%' or `code` like '%$name%' ) and `favorite`=1";

                // get all count
                $sql1 = "select count( * ) as cnt
                        from products
                        $where";

                $sql2 = "select a.*, b.filename as photo
                        from ( select * from products $where ) a
                        left join product_images b on ( a.id=b.product and main=1)
                        group by a.id
                        order by a.id desc
                        limit $limit offset $offset ";
                */
                $where = " where  ( `name` like '%$name%' or `reference` like '%$name%' or `code` like '%$name%' or `replacement` like '%$name%' ) and `favorite`=1";

                // get all count
                $sql1 = "select count( DISTINCT id) as cnt
                        from s_product_for_replacement      
                        $where";

                $sql2 = "select * from s_product_for_replacement $where
                          group by id  
                          order by id 
                          desc limit $limit offset $offset";


            } else {
                // get all count
                $sql1 = "select count( * ) as cnt
                        from products a 
                        where a.`favorite`=1";

                $sql2 = "select a.*, b.filename as photo
                        from ( select * from products where `favorite`=1 limit $limit offset $offset ) a 
                        left join product_images b on ( a.id=b.product and main=1)
                        order by a.id desc";
            }

        } else if ( $type == 2 ) {          // shop by category
            $name = trim($this->input->get("name"));
            $where1 = "";
            if ( isset($name) && $name != "" && $name != null )
                $where1 = " where `name` like '%$name%' or`reference` like '%$name%' or `code` like '%$name%' ";
            $category = $this->input->get("category");
            $where2 = "";
            if ( isset($category) && $category != "" && $category != null && $category != "0" )
            {
                $where2 .= " where c0=$category or c1=$category or c2=$category or c3=$category or 
                            c4=$category or c5=$category or c6=$category or c7=$category";
            }

            if ( $where1 == "" && $where2 == "" ) {
                // get all count
                $sql1 = "select count(*) as cnt
                          from products";

                $sql2 = "select a.*, b.filename as photo
                        from ( select * from products 
                              order by id desc 
                              limit $limit offset $offset ) a 
                        left join product_images b on ( a.id=b.product and b.main=1)";
            } else if ( $where1 != "" && $where2 == "" ) {
                $sql1 = "select count(DISTINCT id) as cnt 
                        from s_product_for_replacement $where1 or `replacement` like '%$name%'";

                $sql2 = "select * from s_product_for_replacement 
                              $where1  or `replacement` like '%$name%' 
                              group by id 
                              order by id desc  
                              limit $limit offset $offset ";
            } else if ( $where1 == "" && $where2 != "" ) {
                $sql1 = "select count(distinct product) as cnt 
                          from v_product_categories 
                          $where2";
                $sql2 = "select b.*, c.filename as photo from 
                          (select * from v_product_categories 
                                $where2
                                group by product 
                                order by product desc 
                                limit $limit offset $offset) a 
                          left join products b on(a.product=b.id) 
                          left join product_images c on(c.product=b.id and c.main=1)";
            } else if ( $where1 != "" && $where2 != "" ) {
                $where1 = " where `name` like '%$name%' or`reference` like '%$name%' or `code` like '%$name%' or replacement like '%$name%' ";
                $sql1 = "select count(distinct a.id) as cnt 
                         from (select * from s_product_for_replacement $where1 ) a 
                         inner join (select * from v_product_categories $where2 ) b on (a.id=b.product)";
                $sql2 = "select a.*,c.filename as photo 
                        from (select * from s_product_for_replacement $where1 ) a 
                        inner join (select * from v_product_categories $where2 ) b on (a.id=b.product) 
                        left join product_images c on(a.id=c.product and c.main=1 )
                        group by a.id 
                        order by a.id desc 
                        limit $limit offset $offset";
            } else {
                /*
                // get all count
                $sql1 = "select count( DISTINCT a.id) as cnt
                            from products a
                            left join product_images b on ( a.id=b.product and main=1)
                            left join v_product_categories c on ( a.id=c.product )
                            left join product_replacement_brand d on ( a.id=d.product )
                            $where";

                $where .= " group by a.id ";

                $sql2 = "select a.*, b.filename as photo
                            from products a
                            left join product_images b on ( a.id=b.product and main=1)
                            left join v_product_categories c on ( a.id=c.product )
                            left join product_replacement_brand d on ( a.id=d.product )
                            $where
                            order by a.id desc
                            limit $limit offset $offset ";
                */
            }


        } else if ( $type == 3 ) {
            $name = trim($this->input->get("name"));
            $where1 = "";
            if ( isset($name) && $name != "" && $name != null ){
//                $where = " where ( a.`name` like '%$name%' or a.`reference` like '%$name%' or a.`code` like '%$name%' or d.value like '%$name%'  )";
                $where1 = " where `name` like '%$name%' or `reference` like '%$name%' or `code` like '%$name%' ";
            }

            $make = $this->input->get("make");
            $type = $this->input->get("type");
            $model = $this->input->get("model");
            $year = $this->input->get("year");
            $engine = $this->input->get("engine");

            $where2 = "";
            if ( isset( $make ) && $make != "null" ) {
                $where2 .= " where make=$make ";
            }

            if ( isset( $type ) && $type != "null" ) {
                $where2 .= " and type=$type ";
            }

            if ( isset( $model ) && $model != "null" ) {
                $where2 .= " and model=$model ";
            }

            if ( isset( $year ) && $year != "null" ) {
                $where2 .= " and year=$year ";
            }

            if ( isset( $engine ) && $engine != "null" ) {
                $where2 .= " and engine=$engine ";
            }

            if ( $where1 == "" && $where2 == "" ) {
                // get all count
                $sql1 = "select count(*) as cnt
                        from products";

                $sql2 = "select a.*, b.filename as photo
                        from ( select * from products order by id desc  limit $limit offset $offset ) a 
                        left join product_images b on ( a.id=b.product and main=1)";
            } else if ( $where1 != "" && $where2 == "" ) {

                $sql1 = "select count(DISTINCT id) as cnt 
                        from s_product_for_replacement $where1 or `replacement` like '%$name%'";

                $sql2 = "select * from s_product_for_replacement 
                              $where1  or `replacement` like '%$name%' 
                              group by id 
                              order by id desc  
                              limit $limit offset $offset ";

            } else if ( $where1 == "" && $where2 != "" ) {

                $sql1 = "select count(distinct product) as cnt 
                        from product_application $where2";
                $sql2 = "select b.*, c.filename as photo 
                         from (select * from product_application $where2
                              group by product 
                              order by product desc 
                              limit $limit offset $offset) a  
                         left join products b on(a.product=b.id) 
                         left join product_images c on(c.product=b.id and c.main=1)";
            } else if ( $where1 != "" && $where2 != "" ) {
                $where1 = " where `name` like '%$name%' or`reference` like '%$name%' or `code` like '%$name%' or replacement like '%$name%' ";
                $sql1 = "select count(distinct a.id) as cnt  
                        from (select * from s_product_for_replacement $where1) a 
                        inner join (select *from product_application $where2 ) b on(a.id=b.product)";

                $sql2 = "select a.*, c.filename as photo 
                        from (select * from s_product_for_replacement $where1) a                              
                        inner join (select *from product_application $where2 ) b on(a.id=b.product)
                        left join product_images c on(a.id=c.product and c.main=1) 
                        group by a.id
                        order by a.id
                        limit $limit offset $offset";
            } else {
                /*
                // get all count
                $sql1 = "select count(DISTINCT a.id) as cnt
                        from products a 
                        left join product_images b on ( a.id=b.product and main=1) 
                        left join product_application c on ( a.id=c.product ) 
                        left join product_replacement_brand d on ( a.id=d.product ) 
                        $where";

                $where .= " group by a.id ";

                $sql2 = "select a.*, b.filename as photo
                        from products a 
                        left join product_images b on ( a.id=b.product and b.main=1)
                        left join product_application c on ( a.id=c.product )  
                        left join product_replacement_brand d on ( a.id=d.product ) 
                        $where 
                        order by a.id desc 
                        limit $limit offset $offset ";
                */
            }
        } else if ( $type == 4 ) {
            $user = $_SESSION["userid"];
            $where = " where b.user=$user";
            // get all count
            $sql1 = "select count(a.id) as cnt
                from products a 
                left join user_viewed_products b on ( a.id=b.product) 
                $where";

            $sql2 = "select a.*, c.filename as photo
                from products a 
                left join user_viewed_products b on ( a.id=b.product) 
                left join product_images c on ( a.id=c.product and c.main=1)
                $where order by a.id desc 
                limit $limit offset $offset ";
        } else if ( $type == 5 ) { // shop page
            $name = trim($this->input->get("name"));
            $where = " ";
            if ( isset($name) && $name != "" && $name != null ) {

                $where = " where  ( a.`name` like '%$name%' or a.`reference` like '%$name%' or a.`code` like '%$name%' or c.value like '%$name%' )";
                /*
                // get all count
                $sql1 = "select count( DISTINCT a.id ) as cnt
                from products a
                left join product_replacement_brand c on ( a.id=c.product )
                $where";

                $sql2 = "select a.*, b.filename as photo
                from products a
                left join product_images b on ( a.id=b.product and main=1)
                left join product_replacement_brand c on ( a.id=c.product )
                $where
                group by a.id
                order by a.id desc
                limit $limit offset $offset";
                */
                $where = " where  ( `name` like '%$name%' or `reference` like '%$name%' or `code` like '%$name%' or `replacement` like '%$name%' )";

                // get all count
                $sql1 = "select count( DISTINCT id) as cnt
                        from s_product_for_replacement      
                        $where";

                $sql2 = "select * from s_product_for_replacement $where
                          group by id  
                          order by id 
                          desc limit $limit offset $offset";
            } else {
                // get all count
                $sql1 = "select count( * ) as cnt
                        from products";

                $sql2 = "select a.*, b.filename as photo
                        from (select * from products  
                        order by id desc  limit $limit offset $offset ) a 
                        left join product_images b on ( a.id=b.product and main=1)";
            }

        }

        $cnt = 0;
        $row = $this->db->query($sql1)->row(); if ( $row ) $cnt = $row->cnt;

        $list = $this->db->query($sql2)->result_array();

        $ret = array();
        $ret["cnt"] = $cnt;
        $ret["list"] = $list;

        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * write new product review
     *@return $ret: 1=>success, 0=>failed
     */
    public function write_product_review()
    {
        $data = array(
            "product"=>$this->input->post("product"),
            "name"=>$this->input->post("name"),
            "email"=>$this->input->post("email"),
            "rating"=>$this->input->post("rating"),
            "subject"=>$this->input->post("subject"),
            "comment"=>$this->input->post("comment"),
            "date"=>date("Y-m-d")
        );
        $ret = $this->db->insert( "product_reviews", $data );
        return $ret;
    }

    /**
     * add product to cart
     * @return product list related cartid in cart
     */
    public function add_product_tocart()
    {
        $cartid = $this->input->get("cartid");
        $product = $this->input->get("product");
        $count = $this->input->get("count");

        // get cartid
        if ( !isset( $cartid ) || $cartid == "" || $cartid == null ) {
            $sql = "select max(id) as cartid from cart";
            $cartid = $this->db->query( $sql )->row()->cartid;
        }
        if ( !isset( $cartid ) || $cartid == "" || $cartid == null ) $cartid = 1;

        // regiseter cartid to session
        $this->session->userdata['cartid'] = $cartid;

        // determin whenever there are already by cartid and product
        $cart_info = $this->db->get_where( "cart", array( "cartid"=>$cartid, "product"=>$product) )->row();
        $id = null;
        $state =  null;
        if ( isset($cart_info) ) {
            $id = $cart_info->id;
            $state =  $cart_info->state;
        }

        $ret = null;

        if ( isset($id) && $id != "" && $state == "1" ) { // if arelady exist, then increse count
            // update count
            $sql = "update cart set `count`=`count`+$count where `id`=$id";
            $ret = $this->db->query($sql);
        } else {    // add newly
            // add product to cart
            $sql = "insert into cart ( `cartid`, `product`, `count`, `state`, `cartdate`) 
              values( $cartid, $product, $count, 1, now())";
            $ret = $this->db->query( $sql );
        }
        return $ret;

    }

    /**
     * get products by cartid
     * @param $cartid: cartid
     * @return $ret product list and count info by cartid
     */
    public function get_products_bycartid( $cartid )
    {
        if ( !isset($cartid) || $cartid == null ) return;
        // get product list from cart via cartid
        $sql = "select b.*, a.`count` as `count`, c.filename, a.`id` as cart_id  
                from cart a
                left join products b on ( b.id=a.product ) 
                left join product_images c on ( a.product=c.product and c.main=1 )
                where a.`cartid`=$cartid and a.`state`=1 order by a.`id` desc";
        $list = $this->db->query( $sql )->result_array();

        // get product count from cart via cartid
        $sql = "select sum(`count`) as `count` from cart
                where `cartid`=$cartid and `state`=1";
        $cnt = $this->db->query( $sql )->row()->count;

        $ret = array();
        $ret["list"] = $list;
        $ret["cnt"] = $cnt;
        return $ret;
    }

    /**
     * update cart`s product number
     * @retun $ret: 1=>success, 0=>failed
     */
    public function update_cart_product_count()
    {
        $this->db->where( array("id"=>$this->input->post("did")) );
        $ret = $this->db->update( "cart", array("count"=>$this->input->post("count")) );
        return $ret;
    }

    /**
     * remove product from cart by id
     * @param $id: cart`s primary key
     * @retun $ret: 1=>success, 0=>failed
     */
    public function remove_product_incart_byid( $id )
    {
        $this->db->where( array("id"=>$id) );
        return $this->db->update( "cart", array("state"=>0));
//        return $this->db->delete( "cart", array("id"=>$id) );
    }


    /**
     * add new product spec item
     * @param $title: new option title
     * @return $ret: 1=>success, 0=>failed
     */
    public function add_new_product_spec( $title ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pproduct_specs", array("title"=>$title) )->row();
        if ( !$ret ) {
            $ret = $this->db->insert("pproduct_specs", array("title"=>$title, "state"=>"1"));
        } else {
            $ret = null;
        }
        return $ret;
    }

    /**
     * delete current product spec item
     * @param $did: db primary key
     * @return $ret: 1=>success, 0=>failed
     */
    public function delete_current_product_spec( $did ) {
        return $this->db->delete("pproduct_specs", array("id"=>$did) );
    }

    /**
     * get all product spec items
     * @return $ret: all list
     */
    public function get_product_spec_items()
    {
        $this->db->order_by( "title asc" );
        return $this->db->get_where( "pproduct_specs", array( "state"=>1 ) )->result_array();
    }


    /**
     * add new replacement brand item
     * @param $title: new title
     * @return $ret: 1=>success, 0=>failed
     */
    public function add_new_replacement_brand( $title ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("preplacement_brands", array("title"=>$title) )->row();
        if ( !$ret ) {
            $ret = $this->db->insert("preplacement_brands", array("title"=>$title, "state"=>"1"));
        } else {
            $ret = null;
        }
        return $ret;
    }

    /**
     * delete current replacement brand item
     * @param $did: db primary key
     * @return $ret: 1=>success, 0=>failed
     */
    public function delete_current_replacement_brand( $did ) {
        return $this->db->delete("preplacement_brands", array("id"=>$did) );
    }

    /**
     * delete current service part item
     * @param $did: db primary key
     * @return $ret: 1=>success, 0=>failed
     */
    public function delete_current_service_part( $did ) {
        return $this->db->delete("pproduct_service_items", array("id"=>$did) );
    }

    /**
     * add new service part item
     * @param $title: new title
     * @return $ret: 1=>success, 0=>failed
     */
    public function add_new_replacement_service_part( $title ) {
        // confirm whether there are new title already
        $ret = $this->db->get_where("pproduct_service_items", array("title"=>$title) )->row();
        if ( !$ret ) {
            $ret = $this->db->insert("pproduct_service_items", array("title"=>$title, "state"=>"1"));
        } else {
            $ret = null;
        }
        return $ret;
    }

    /**
     * get all replacement items manage
     * @return $ret: all list
     */
    public function get_replacement_brand_items()
    {
        $this->db->order_by( "title asc" );
        return $this->db->get_where( "preplacement_brands", array( "state"=>1 ) )->result_array();
    }

    /**
     * get all service part items manage
     * @return $ret: all list
     */
    public function get_replacement_services_items()
    {
        $this->db->order_by( "title asc" );
        return $this->db->get_where( "pproduct_service_items", array( "state"=>1 ) )->result_array();
    }

    /**
     * import replacement brands csv file and insert to db
     * @param $csv: imported replacement json object
     * @return $ret: replacement brands list
     */
    public function import_replacement_brads_csv ( $csv )
    {
        $IDS = array();
        foreach ( $csv["brand"] as $brand ) {
            $is = $this->db->get_where( "preplacement_brands", array("title"=>$brand) )->row();
            if ( $is ) {    // register this brand already
                array_push($IDS, $is->id );
            } else {        // otherwise insert newly
                $this->db->insert( "preplacement_brands", array("title"=>$brand, "state"=>1) );
                $id = $this->db->insert_id();
                array_push($IDS, $id );
            }
        }

        $list = $this->db->get_where("preplacement_brands", array("state"=>1))->result_array();
        $csv["list"] = $list;
        $csv["ids"] = $IDS;
        return $csv;
    }

    /**
     * import product spec csv file and insert to db
     * @param $csv: imported replacement json object
     * @return $ret: replacement brands list
     */
    public function import_product_spec_csv ( $csv )
    {
        $IDS = array();
        foreach ( $csv["spec"] as $spec ) {
            $is = $this->db->get_where( "pproduct_specs", array("title"=>$spec) )->row();
            if ( $is ) {    // register this brand already
                array_push($IDS, $is->id );
            } else {        // otherwise insert newly
                $this->db->insert( "pproduct_specs", array("title"=>$spec, "state"=>1) );
                $id = $this->db->insert_id();
                array_push($IDS, $id );
            }
        }

        $list = $this->db->get_where("pproduct_specs", array("state"=>1))->result_array();
        $csv["list"] = $list;
        $csv["ids"] = $IDS;
        return $csv;
    }

    /**
     * import service parts file and insert to db
     * @param $csv: imported service parts json object
     * @return $ret: service parts list
     */
    public function import_service_parts_csv ( $csv )
    {
        $IDS = array();
        foreach ( $csv["service"] as $service ) {
            $is = $this->db->get_where( "pproduct_service_items", array("title"=>$service) )->row();
            if ( $is ) {    // register this brand already
                array_push($IDS, $is->id );
            } else {        // otherwise insert newly
                $this->db->insert( "pproduct_service_items", array("title"=>$service, "state"=>1) );
                $id = $this->db->insert_id();
                array_push($IDS, $id );
            }
        }

        $list = $this->db->get_where("pproduct_service_items", array("state"=>1))->result_array();
        $csv["products"] = $this->get_product_list();
        $csv["list"] = $list;
        $csv["ids"] = $IDS;
        return $csv;
    }

    /**
     * import application list csv file and update related database
     * @param $csv: imported application list info from csv file
     * @return $ret: application list info that will display in backend product add page`s application tab`s content
     */
    public function import_application_list_csv ( $csv )
    {
        $makes = $csv["make"];
        $types = $csv["type"];
        $models = $csv["model"];
        $years = $csv["year"];
        $engines = $csv["engine"];

        $ret = array();

        /*** update db ************************************************************************************/
        for ( $i = 0; $i < count( $makes ); $i ++ )
        {
            $item = array();

            // update make db via imported make title
            $make = $makes[$i];             // imported make title
            $is_make = $this->db->get_where( "pa_make", array( "title"=>$make ))->row();
            if ( !$is_make )
            {                        //  if there is not same make yet
                $this->db->insert( "pa_make",  array( "title"=>$make, "state"=>"1") );
                $item["make_id"] = $this->db->insert_id();
            } else {
                $item["make_id"] = $is_make->id;
            }
            $item["make_title"] = $make;

            // update type db via imported type title and got make id
            $type = $types[$i];             // imported type title
            $make_id = $item["make_id"];
            $is_type = $this->db->get_where( "pa_type", array( "title"=>$type, "make"=>$make_id ))->row();
            if ( !$is_type ) {                        //  if there is not same make yet
                $this->db->insert( "pa_type",  array( "title"=>$type, "make"=>$make_id,  "state"=>"1") );
                $item["type_id"] = $this->db->insert_id();
            } else {
                $item["type_id"] = $is_type->id;
            }
            $item["type_title"] = $type;

            // update type db via imported model title and got type id
            $model = $models[$i];             // imported model title
            $type_id = $item["type_id"];
            $is_model = $this->db->get_where( "pa_model", array( "title"=>$model, "type"=>$type_id ))->row();
            if ( !$is_model ) {                        //  if there is not same make yet
                $this->db->insert( "pa_model",  array( "title"=>$model, "type"=>$type_id, "state"=>"1") );
                $item["model_id"] = $this->db->insert_id();
            } else {
                $item["model_id"] = $is_model->id;
            }
            $item["model_title"] = $model;

            // update year db via imported year title and got model id
            $year = $years[$i];             // imported type title
            $model_id = $item["model_id"];
            $is_year = $this->db->get_where( "pa_year", array( "title"=>$year, "model"=>$model_id ))->row();
            if ( !$is_year ) {                        //  if there is not same make yet
                $this->db->insert( "pa_year",  array( "title"=>$year, "model"=>$model_id, "state"=>"1") );
                $item["year_id"] = $this->db->insert_id();
            } else {
                $item["year_id"] = $is_year->id;
            }
            $item["year_title"] = $year;

            // update engine db via imported engine title and got year id
            $engine = $engines[$i];             // imported type title
            $year_id = $item["year_id"];
            $is_engine = $this->db->get_where( "pa_engine", array( "title"=>$engine, "year"=>$year_id ))->row();
            if ( !$is_engine ) {                        //  if there is not same make yet
                $this->db->insert( "pa_engine",  array( "title"=>$engine, "year"=>$year_id, "state"=>"1") );
                $item["engine_id"] = $this->db->insert_id();
            } else {
                $item["engine_id"] = $is_engine->id;
            }
            $item["engine_title"] = $engine;

            array_push( $ret, $item );
        }
        return $ret;
    }

    /**
     * get application update info via product primary key
     * @param $did: product` primary key
    */
    public function get_application_info_via_productid($did)
    {
        $sql = "select a.make, a.type, a.model, a.year, a.engine, 
                        a1.title as make_title, 
                        a2.title as type_title,
                        a3.title as model_title, 
                        a4.title as year_title, 
                        a5.title as engine_title   
                  from ( select * from product_application where product=$did) a 
                  left join pa_make a1 on(a.make=a1.id)
                  left join pa_type a2 on(a.type=a2.id)
                  left join pa_model a3 on(a.model=a3.id)
                  left join pa_year a4 on(a.year=a4.id)
                  left join pa_engine a5 on(a.engine=a5.id)
                  ;";
        $ret =$this->db->query($sql)->result_array();

        return $ret;
    }

    /**
     * get paypal setting info
     * @return $ret: paypal setting info
     */
    public function get_paypal_setting_info()
    {
        $ret = $this->db->get_where("s_paypal_info", array("id", "1"))->row();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get shipping methods
     * @return $ret: shipping method array
     */
    public function get_shipping_methods()
    {
        $ret = $this->db->get("s_shipping_methods")->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * update admin paypal info
     * @return $ret: 1=> success, 0=> failed
     */
    public function update_admin_paypal_info()
    {
        $data = array(
            "is_live_paypal" => $this->input->post("is_live_paypal"),
            "p_client_id" => $this->input->post("p_client_id"),
            "p_secret_key" => $this->input->post("p_secret_key"),
            "s_client_id" => $this->input->post("s_client_id"),
            "s_secret_key" => $this->input->post("s_secret_key")
        );

        $this->db->where( array("id" => "1") );
        return $this->db->update( "s_paypal_info", $data );
    }

    /**
     * add new shipping method
     * @return $ret: 1=> success, 0=>failed
     */
    public function add_new_shipping_method()
    {
        $data = array(
            "title" => $this->input->post("title"),
            "price" => $this->input->post("price")
        );

        return $this->db->insert( "s_shipping_methods", $data );
    }

    /**
     * update current shipping method
     * @return $ret: 1=> success, 0=>failed
     */
    public function update_current_shipping_method()
    {
        $data = array(
            "title" => $this->input->post("title"),
            "price" => $this->input->post("price")
        );

        $this->db->where( array( "id"=>$this->input->post("id") ) );
        return $this->db->update( "s_shipping_methods", $data );
    }

    /**
     * delete current shipping method
     * @return $ret: 1=> success, 0=>failed
     */
    public function remove_current_shipping_method()
    {
        return $this->db->delete( "s_shipping_methods", array("id"=>$this->input->post("id") ) );
    }

    /**
     * get orders list via search parameters
     * @param $user: loginned user`s primary key
     * @return $ret: orders list
     */
    public function get_all_orders_info( $user )
    {
        $ww = "";
        if ( isset($user) && $user != "" ) $ww = " and a.`user`=$user ";
        $sql = "select a.*, b.first_name, b.last_name, b.phone, b.company, 
                  c.title as s_title, c.price as s_price  
                  from orders a
                  left join users b on(a.user=b.id) 
                  left join s_shipping_methods c on (a.shipping_method=c.id) 
                  left join o_shipping_address d on(a.shipping_address=c.id) 
                  where a.`payment_kind`>0 $ww
                  order by a.`order_date` desc";
        $ret = $this->db->query( $sql )->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get product reviews list via search parameters
     * @param $rating: select reviews that rating is bigger that $rating
     * @return $ret: product reviews list
     */
    public function get_all_product_reviews( $rating )
    {
        $where = "";
        if ( $rating != null ) $where = " where a.`rating`>$rating ";
        $sql = "select a.*, b.name as p_name 
                  from product_reviews a
                  left join products b on(a.product=b.id) 
                  $where
                  order by a.`date` desc";
        $ret = $this->db->query( $sql )->result_array();
        if ( $ret ) return $ret;
        else return null;
    }

    /**
     * get all customer contacts info
     * @return $ret: all list
     */
    public function get_all_customer_contacts()
    {
        $this->db->order_by("date", "desc");
        return $this->db->get("contact")->result_array();
    }

    /**
     * reply customer contact message
     * @return $ret: 1=> success, 0=>failed
     */
    public function reply_customer_contact_message()
    {
        $id = $this->input->post("id");
        $this->db->where( array("id"=>$id) );
        return $this->db->update( "contact", array(
            "reply_user" => $_SESSION["userid"],
            "reply_commment" => $this->input->post("content") ) );
    }

    /**
     * chnage_one_product_quanity
     * @return $ret: 1=>success, 0=>failed
     */
    public function chnage_one_product_quanity()
    {
        $this->db->where( array("id"=>$this->input->post("id")) );
        return $this->db->update( "products", array("quanity"=>$this->input->post("quanity")));
    }

    /**
     * chnage_one_product_sale_price
     * @return $ret: 1=>success, 0=>failed
     */
    public function chnage_one_product_sale_price()
    {
        $this->db->where( array("id"=>$this->input->post("id")) );
        $this->db->update( "products", array("sale_price"=>$this->input->post("sale_price")));

        $this->db->where( array("id"=>$this->input->post("id")) );
        $this->db->update( "s_product_for_replacement", array("sale_price"=>$this->input->post("sale_price")));

        return 1;
    }

    /**
     * import categories info from csv file
     */
    public function import_categpries_data_csv_in_setting($result)
    {
        $this->db->empty_table("pcategories");

        $data = array();
        for ( $i = 0; $i < count($result["title"]); $i ++ ) {
            $val = array(
                "id" => $result["temp"][$i],
                "title" => $result["title"][$i],
                "parent_id" => $result["parent_id"][$i],
                "level" => $result["level"][$i],
                "order" => $result["order"][$i],
                "state" => 1,
                "temp" => $result["temp"][$i]
            );
            array_push( $data, $val );
        }
        $this->db->insert_batch("pcategories", $data );

        return 1;
    }

    /**
     * import products info fron csv file
     */
    public function import_products_data_csv_in_setting($result)
    {
        $data = array();
        for ( $i = 0; $i < count($result["name"]); $i ++ ) {
            $val = array(
                "name" => $result["name"][$i],
                "code" => $result["code"][$i],
                "sale_price" => $result["price"][$i],
                "temp" => $result["temp"][$i]
            );
            array_push($data, $val);
        }

        $this->db->insert_batch("products", $data);

        return 1;
    }

    /**
     * import product photo`s info from csv file
     */
    public function import_products_photos_data_csv_in_setting($result)
    {
        $data = array();
        for ( $i = 0; $i < count($result["filename"]); $i ++ ) {
            $main = 0;
            $t = explode("_", $result["filename"][$i]);
            if ( $t[1] == "1.jpg" ) $main = 1;
            $val = array(
                "filename" => $result["filename"][$i],
                "product" => $this->db->get_where("products", array("temp"=>$result["product_id"][$i]))->row()->id,
                "main" => $main
            );
            array_push( $data, $val );
        }

        $this->db->insert_batch("product_images", $data);

        return 1;
    }

    /**
     * import product categories info from csv file
     */
    public function import_products_categories_data_csv_in_setting($result)
    {
        $data = array();
        for ( $i = 0; $i < count($result["product_id"]); $i ++ ) {
            $val = array(
                "product" => $this->db->get_where("products", array("temp"=>$result["product_id"][$i]))->row()->id,
                "category" => $this->db->get_where("pcategories", array("temp"=>$result["category_id"][$i]))->row()->id
            );
            array_push( $data, $val );
        }

        $this->db->insert_batch("products_categories", $data);

        return 1;
    }

    /**
     * import application list info from csv file
     */
    public function import_products_applications_data_csv_in_setting($csv)
    {
        $makes = $csv["make"];
        $types = $csv["type"];
        $models = $csv["model"];
        $years = $csv["year"];
        $engines = $csv["engine"];
        $product_id = $csv["product_id"];

        $ret = array();

        /*** update db ************************************************************************************/
        for ( $i = 0; $i < count( $makes ); $i ++ )
        {
            $item = array();

            if ( $types[$i] == null || $types[$i] == "" || $years[$i] == null || $years[$i] == ""  ) continue;

            // update make db via imported make title
            $make = $makes[$i];             // imported make title
            $is_make = $this->db->get_where( "pa_make", array( "title"=>$make ))->row();
            if ( !$is_make )
            {                        //  if there is not same make yet
                $this->db->insert( "pa_make",  array( "title"=>$make, "state"=>"1") );
                $item["make_id"] = $this->db->insert_id();
            } else {
                $item["make_id"] = $is_make->id;
            }

            // update type db via imported type title and got make id
            $type = $types[$i];             // imported type title
            $make_id = $item["make_id"];
            $is_type = $this->db->get_where( "pa_type", array( "title"=>$type, "make"=>$make_id ))->row();
            if ( !$is_type ) {                        //  if there is not same make yet
                if ( $type != null && $type != "" ) {
                    $this->db->insert( "pa_type",  array( "title"=>$type, "make"=>$make_id,  "state"=>"1") );
                    $item["type_id"] = $this->db->insert_id();
                } else {
                    $item["type_id"] = null;
                }
            } else {
                $item["type_id"] = $is_type->id;
            }

            // update type db via imported model title and got type id
            $model = $models[$i];             // imported model title
            $type_id = $item["type_id"];
            $is_model = $this->db->get_where( "pa_model", array( "title"=>$model, "type"=>$type_id ))->row();
            if ( !$is_model ) {                        //  if there is not same make yet
                if ( $model != null && $model != "" ) {
                    $this->db->insert( "pa_model",  array( "title"=>$model, "type"=>$type_id, "state"=>"1") );
                    $item["model_id"] = $this->db->insert_id();
                } else {
                    $item["model_id"] = null;
                }
            } else {
                $item["model_id"] = $is_model->id;
            }

            // update year db via imported year title and got model id
            $year = $years[$i];             // imported type title
            $model_id = $item["model_id"];
            $is_year = $this->db->get_where( "pa_year", array( "title"=>$year, "model"=>$model_id ))->row();
            if ( !$is_year ) {                        //  if there is not same make yet
                if ( $year != null && $year != "" ) {
                    $this->db->insert( "pa_year",  array( "title"=>$year, "model"=>$model_id, "state"=>"1") );
                    $item["year_id"] = $this->db->insert_id();
                } else {
                    $item["year_id"] = null;
                }
            } else {
                $item["year_id"] = $is_year->id;
            }

            // update engine db via imported engine title and got year id
            $engine = $engines[$i];             // imported type title
            $year_id = $item["year_id"];
            $is_engine = $this->db->get_where( "pa_engine", array( "title"=>$engine, "year"=>$year_id ))->row();
            if ( !$is_engine ) {                        //  if there is not same make yet
                if ( $engine != null && $engine != "" ) {
                    $this->db->insert( "pa_engine",  array( "title"=>$engine, "year"=>$year_id, "state"=>"1") );
                    $item["engine_id"] = $this->db->insert_id();
                } else {
                    $item["engine_id"] = null;
                }
            } else {
                $item["engine_id"] = $is_engine->id;
            }

            $item["product"] = $this->db->get_where("products", array("temp"=>$product_id[$i]))->row()->id;

            $val = array(
                "product" => $item["product"],
                "make" => $item["make_id"],
                "type" => $item["type_id"],
                "model" => $item["model_id"],
                "year" => $item["year_id"],
                "engine" => $item["engine_id"]
            );
            array_push($ret, $val);
        }

        $this->db->insert_batch("product_application", $ret);
        return 1;
    }

    /**
     * import replacement brand data from csv file
     */
    public function import_products_replacements_data_csv_in_setting( $csv )
    {
        $data = array();
        for ( $i = 0; $i < count($csv["brand"]); $i ++ )
        {
            $replacement_id = null;
            $is_replacement = $this->db->get_where( "preplacement_brands", array( "title"=>$csv["brand"][$i] ))->row();
            if ( !$is_replacement )
            {                        //  if there is not same make yet
                $this->db->insert( "preplacement_brands",  array( "title"=>$csv["brand"][$i], "state"=>"1") );
                $replacement_id = $this->db->insert_id();
            } else {
                $replacement_id = $is_replacement->id;
            }

            $val = array(
                "product" => $this->db->get_where ("products", array("temp"=>$csv["product_id"][$i]))->row()->id,
                "brand" => $replacement_id,
                "value" => $csv["value"][$i]
            );
            array_push( $data, $val );
        }
        $this->db->insert_batch( "product_replacement_brand", $data );

        return 1;
    }

    /**
     * import advanced spec data from csv file
     */
    public function import_products_advanced_data_csv_in_setting( $csv )
    {
        $data = array();
        for ( $i = 0; $i < count($csv["spec"]); $i ++ )
        {
            $spec_id = null;
            $is_spec = $this->db->get_where( "pproduct_specs", array( "title"=>$csv["spec"][$i] ))->row();
            if ( !$is_spec )
            {                        //  if there is not same make yet
                $this->db->insert( "pproduct_specs",  array( "title"=>$csv["spec"][$i], "state"=>"1") );
                $spec_id = $this->db->insert_id();
            } else {
                $spec_id = $is_spec->id;
            }

            $val = array(
                "product" => $this->db->get_where ("products", array("temp"=>$csv["product_id"][$i]))->row()->id,
                "spec" => $spec_id,
                "value" => $csv["value"][$i]
            );
            array_push( $data, $val );
        }
        $this->db->insert_batch( "product_advance", $data );

        return 1;
    }

    /**
     * make replacement product table for search
     */
    public function make_replacement_search_product_table()
    {

        $this->db->empty_table("s_product_for_replacement");

        $sql = 'select a.id, a.name, a.code, a.quanity, a.sale_price, a.reference, a.favorite, b.filename as photo, c.value as replacement
                        from products a
                        left join product_images b on ( a.id=b.product and main=1)
                        left join product_replacement_brand c on ( a.id=c.product )';

        $data = $this->db->query( $sql )->result_array();
        $this->db->insert_batch( "s_product_for_replacement", $data );

    }
}
