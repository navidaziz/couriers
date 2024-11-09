<?php if (!defined('BASEPATH')) exit('Direct access not allowed!');

class User_model extends MY_Model
{

    public function __construct()
    {

        parent::__construct();
        $this->table = "users";
        $this->pk = "user_id";
        $this->status = "status";
        $this->order = "order";
    }

    public function validate_form_data()
    {
        $validation_config = array(

            array(
                "field"  =>  "franchise_id",
                "label"  =>  "Franchise Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "role_id",
                "label"  =>  "Role Id",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "name",
                "label"  =>  "Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "father_name",
                "label"  =>  "Father Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "cnic",
                "label"  =>  "Cnic",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "user_email",
                "label"  =>  "User Email",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "user_mobile_number",
                "label"  =>  "User Mobile Number",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "user_name",
                "label"  =>  "User Name",
                "rules"  =>  "required"
            ),

            array(
                "field"  =>  "user_password",
                "label"  =>  "User Password",
                "rules"  =>  "required"
            ),

            // array(
            //     "field"  =>  "user_image",
            //     "label"  =>  "User Image",
            //     "rules"  =>  "required"
            // ),

        );
        //set and run the validation
        $this->form_validation->set_rules($validation_config);
        return $this->form_validation->run();
    }

    public function save_data($image_field = NULL)
    {
        $inputs = array();

        $inputs["franchise_id"]  =  $this->input->post("franchise_id");

        $inputs["role_id"]  =  $this->input->post("role_id");

        $inputs["name"]  =  $this->input->post("name");

        $inputs["father_name"]  =  $this->input->post("father_name");

        $inputs["cnic"]  =  $this->input->post("cnic");

        $inputs["user_email"]  =  $this->input->post("user_email");

        $inputs["user_mobile_number"]  =  $this->input->post("user_mobile_number");

        $inputs["user_name"]  =  $this->input->post("user_name");

        $inputs["user_password"]  =  $this->input->post("user_password");

        $inputs["user_image"]  =  $this->input->post("user_image");

        return $this->user_model->save($inputs);
    }

    public function update_data($user_id, $image_field = NULL)
    {
        $inputs = array();

        $inputs["franchise_id"]  =  $this->input->post("franchise_id");

        $inputs["role_id"]  =  $this->input->post("role_id");

        $inputs["name"]  =  $this->input->post("name");

        $inputs["father_name"]  =  $this->input->post("father_name");

        $inputs["cnic"]  =  $this->input->post("cnic");

        $inputs["user_email"]  =  $this->input->post("user_email");

        $inputs["user_mobile_number"]  =  $this->input->post("user_mobile_number");

        $inputs["user_name"]  =  $this->input->post("user_name");

        $inputs["user_password"]  =  $this->input->post("user_password");

        $inputs["user_image"]  =  $this->input->post("user_image");

        return $this->user_model->save($inputs, $user_id);
    }

    //----------------------------------------------------------------
    public function get_user_list($where_condition = NULL, $pagination = TRUE, $public = FALSE)
    {
        $data = (object) array();
        $fields = array(
            "users.*",
            "franchises.franchise_name",
            "roles.role_title"
        );
        $join_table = array(
            "franchises" => "franchises.franchise_id = users.franchise_id",

            "roles" => "roles.role_id = users.role_id",
        );
        if (!is_null($where_condition)) {
            $where = $where_condition;
        } else {
            $where = "";
        }

        if ($pagination) {
            //configure the pagination
            $this->load->library("pagination");

            if ($public) {
                $config['per_page'] = 10;
                $config['uri_segment'] = 3;
                $this->user_model->uri_segment = $this->uri->segment(3);
                $config["base_url"]  = base_url($this->uri->segment(1) . "/" . $this->uri->segment(2));
            } else {
                $this->user_model->uri_segment = $this->uri->segment(4);
                $config["base_url"]  = base_url(ADMIN_DIR . $this->uri->segment(2) . "/" . $this->uri->segment(3));
            }
            $config["total_rows"] = $this->user_model->joinGet($fields, "users", $join_table, $where, true);
            $this->pagination->initialize($config);
            $data->pagination = $this->pagination->create_links();
            $data->users = $this->user_model->joinGet($fields, "users", $join_table, $where);
            return $data;
        } else {
            return $this->user_model->joinGet($fields, "users", $join_table, $where, FALSE, TRUE);
        }
    }

    public function get_user($user_id)
    {

        $fields = array(
            "users.*",
            "franchises.franchise_name",
            "roles.role_title"
        );
        $join_table = array(
            "franchises" => "franchises.franchise_id = users.franchise_id",

            "roles" => "roles.role_id = users.role_id",
        );
        $where = "users.user_id = $user_id";

        return $this->user_model->joinGet($fields, "users", $join_table, $where, FALSE, TRUE);
    }
}
