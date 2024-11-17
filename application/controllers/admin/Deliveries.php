<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Deliveries extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/delivery_model");
        $this->lang->load("deliveries", 'english');
        $this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------


    /**
     * Default action to be called
     */
    public function index()
    {
        $main_page = base_url() . ADMIN_DIR . $this->router->fetch_class() . "/view";
        redirect($main_page);
    }
    //---------------------------------------------------------------



    /**
     * get a list of all items that are not trashed
     */
    public function view($tab = 'riders')
    {
        $this->data['tab'] = $tab;
        $this->data["title"] = $this->lang->line('Deliveries');
        $this->data["view"] = ADMIN_DIR . "deliveries/deliveries";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get single record by id
     */
    public function view_delivery($delivery_id)
    {

        $delivery_id = (int) $delivery_id;

        $this->data["deliveries"] = $this->delivery_model->get_delivery($delivery_id);
        $this->data["title"] = $this->lang->line('Delivery Details');
        $this->data["view"] = ADMIN_DIR . "deliveries/view_delivery";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * get a list of all trashed items
     */
    public function trashed()
    {

        $where = "`deliveries`.`status` IN (2) ";
        $data = $this->delivery_model->get_delivery_list($where);
        $this->data["deliveries"] = $data->deliveries;
        $this->data["pagination"] = $data->pagination;
        $this->data["title"] = $this->lang->line('Trashed Deliveries');
        $this->data["view"] = ADMIN_DIR . "deliveries/trashed_deliveries";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //-----------------------------------------------------

    /**
     * function to send a user to trash
     */
    public function trash($delivery_id, $page_id = NULL)
    {

        $delivery_id = (int) $delivery_id;


        $this->delivery_model->changeStatus($delivery_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR . "deliveries/view/" . $page_id);
    }

    /**
     * function to restor delivery from trash
     * @param $delivery_id integer
     */
    public function restore($delivery_id, $page_id = NULL)
    {

        $delivery_id = (int) $delivery_id;


        $this->delivery_model->changeStatus($delivery_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR . "deliveries/trashed/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to draft delivery from trash
     * @param $delivery_id integer
     */
    public function draft($delivery_id, $page_id = NULL)
    {

        $delivery_id = (int) $delivery_id;


        $this->delivery_model->changeStatus($delivery_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR . "deliveries/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to publish delivery from trash
     * @param $delivery_id integer
     */
    public function publish($delivery_id, $page_id = NULL)
    {

        $delivery_id = (int) $delivery_id;


        $this->delivery_model->changeStatus($delivery_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR . "deliveries/view/" . $page_id);
    }
    //---------------------------------------------------------------------------

    /**
     * function to permanently delete a Delivery
     * @param $delivery_id integer
     */
    public function delete($delivery_id, $page_id = NULL)
    {

        $delivery_id = (int) $delivery_id;
        //$this->delivery_model->changeStatus($delivery_id, "3");

        $this->delivery_model->delete(array('delivery_id' => $delivery_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR . "deliveries/trashed/" . $page_id);
    }
    //----------------------------------------------------



    /**
     * function to add new Delivery
     */
    public function add()
    {

        $this->data["courier_services"] = $this->delivery_model->getList("courier_services", "courier_service_id", "courier_service_name", $where = "`courier_services`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Add New Delivery');
        $this->data["view"] = ADMIN_DIR . "deliveries/add_delivery";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------
    public function save_data()
    {
        if ($this->delivery_model->validate_form_data() === TRUE) {

            $delivery_id = $this->delivery_model->save_data();
            if ($delivery_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR . "deliveries/edit/$delivery_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "deliveries/add");
            }
        } else {
            $this->add();
        }
    }


    /**
     * function to edit a Delivery
     */
    public function edit($delivery_id)
    {
        $delivery_id = (int) $delivery_id;
        $this->data["delivery"] = $this->delivery_model->get($delivery_id);

        $this->data["courier_services"] = $this->delivery_model->getList("courier_services", "courier_service_id", "courier_service_name", $where = "`courier_services`.`status` IN (1) ");

        $this->data["title"] = $this->lang->line('Edit Delivery');
        $this->data["view"] = ADMIN_DIR . "deliveries/edit_delivery";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    //--------------------------------------------------------------------

    public function update_data($delivery_id)
    {

        $delivery_id = (int) $delivery_id;

        if ($this->delivery_model->validate_form_data() === TRUE) {

            $delivery_id = $this->delivery_model->update_data($delivery_id);
            if ($delivery_id) {
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR . "deliveries/edit/$delivery_id");
            } else {

                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR . "deliveries/edit/$delivery_id");
            }
        } else {
            $this->edit($delivery_id);
        }
    }


    /**
     * get data as a json array 
     */
    public function get_json()
    {
        $where = array("status" => 1);
        $where[$this->uri->segment(3)] = $this->uri->segment(4);
        $data["deliveries"] = $this->delivery_model->getBy($where, false, "delivery_id");
        $j_array[] = array("id" => "", "value" => "delivery");
        foreach ($data["deliveries"] as $delivery) {
            $j_array[] = array("id" => $delivery->delivery_id, "value" => "");
        }
        echo json_encode($j_array);
    }
    //-----------------------------------------------------




    public function deliveries()
    {
        $columns[] = "courier_service_name";
        $columns[] = "batch_no";
        $columns[] = "tracking_number";
        $columns[] = "verified";
        $columns[] = "delivery_type";
        $columns[] = "recipient_address";
        $columns[] = "recipient_contact";
        $columns[] = "recipient_name";
        $columns[] = "expected_delivery_date";
        $columns[] = "amount";
        // $columns[] = "payment_status";
        $columns[] = "courier_notes";
        // $columns[] = "rider_name";
        $columns[] = "assigned_date";
        $columns[] = "delivery_status";
        $columns[] = "delivered_date";
        $columns[] = "delivered_to";
        $columns[] = "delivered_to_mobile_no";
        $columns[] = "cancelled_date";
        $columns[] = "cancelled_reason";
        $columns[] = "onhold_date";
        $columns[] = "onhold_reason";
        $columns[] = "sender_name";
        $columns[] = "sender_address";
        $columns[] = "sender_contact";
        $columns[] = "shipment_date";
        $columns[] = "package_weight";
        $columns[] = "package_dimensions";
        //$columns[] = "updated_by";


        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $delivery_status = $this->db->escape($this->input->post('delivery_status'));

        $search = $this->db->escape("%" . $this->input->post("search")["value"] . "%");
        // Manual SQL query building
        $sql = "SELECT deliveries.*, cs.short_name as courier_service_name, b.batch_no as batch_no, b.payment_status  as batch_payment_status, u.name as rider_name FROM deliveries  
                INNER JOIN courier_services as cs ON(cs.courier_service_id = deliveries.courier_service_id)
                INNER JOIN batches as b ON(b.batch_id = deliveries.batch_id)
                LEFT JOIN users as u ON(u.user_id = deliveries.rider_id)
                WHERE deliveries.delivery_status = " . $delivery_status . " ";

        // Searching
        if (!empty($this->input->post("search")["value"])) {
            $sql .= " AND ";
            foreach ($columns as $column) {
                $sql .= " $column LIKE $search OR ";
            }
            $sql = rtrim($sql, " OR "); // Remove the last "OR"
        }

        // Ordering
        $sql .= " ORDER BY $order $dir";

        // Pagination
        if ($limit != -1) {
            $sql .= " LIMIT $limit OFFSET $start";
        }

        $query = $this->db->query($sql);
        $data = $query->result();

        // Total records count
        $total_records = $this->db->query("SELECT COUNT(*) as count FROM deliveries")->row()->count;

        $output = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,
            "data" => $data
        );

        echo json_encode($output);
    }



    // private function get_inputs(){
    //     $input["delivery_id"] = $this->input->post("delivery_id");
    //     $input["tracking_number"] = $this->input->post("tracking_number");
    //     $input["sender_name"] = $this->input->post("sender_name");
    //     $input["sender_address"] = $this->input->post("sender_address");
    //     $input["sender_contact"] = $this->input->post("sender_contact");
    //     $input["recipient_name"] = $this->input->post("recipient_name");
    //     $input["recipient_address"] = $this->input->post("recipient_address");
    //     $input["recipient_contact"] = $this->input->post("recipient_contact");
    //     $input["courier_service_id"] = $this->input->post("courier_service_id");
    //     $input["shipment_date"] = $this->input->post("shipment_date");
    //     $input["expected_delivery_date"] = $this->input->post("expected_delivery_date");
    //     $input["delivery_status"] = 'Pending';
    //     $input["delivery_type"] = $this->input->post("delivery_type");
    //     $input["package_weight"] = $this->input->post("package_weight");
    //     $input["package_dimensions"] = $this->input->post("package_dimensions");
    //     $input["amount"] = $this->input->post("amount");
    //     $input["payment_status"] = 'No';
    //     $input["courier_notes"] = $this->input->post("courier_notes");
    //     $inputs =  (object) $input;
    // return $inputs;
    // }

    // public function get_delivery_form(){
    //         $delivery_id = (int) $this->input->post("delivery_id");
    //         if ($delivery_id == 0) {

    //         $input = $this->get_inputs();
    //         } else {
    //             $query = "SELECT * FROM 
    //             deliveries 
    //             WHERE delivery_id = $delivery_id";
    //             $input = $this->db->query($query)->row();
    //             }
    //             $this->data["courier_services"] = $this->delivery_model->getList("courier_services", "courier_service_id", "courier_service_name", $where ="`courier_services`.`status` IN (1) ");

    //             $this->data["input"] = $input;
    //             $this->load->view(ADMIN_DIR . "deliveries/get_delivery_form", $this->data);
    //     }
    // public function add_delivery()
    // {
    //     $this->form_validation->set_rules("tracking_number", "Tracking No.", "required");
    //         $this->form_validation->set_rules("sender_name", "Sender Name", "required");
    //         $this->form_validation->set_rules("sender_address", "Sender Address", "required");
    //         $this->form_validation->set_rules("sender_contact", "Sender Contact", "required");
    //         $this->form_validation->set_rules("recipient_name", "Recipient Name", "required");
    //         $this->form_validation->set_rules("recipient_address", "Recipient Address", "required");
    //         $this->form_validation->set_rules("recipient_contact", "Recipient Contact", "required");
    //         $this->form_validation->set_rules("courier_service_id", "Courier Service Id", "required");
    //         $this->form_validation->set_rules("shipment_date", "Shipment Date", "required");
    //         $this->form_validation->set_rules("expected_delivery_date", "Expected Delivery Date", "required");
    //         $this->form_validation->set_rules("delivery_status", "Delivery Status", "required");
    //         $this->form_validation->set_rules("delivery_type", "Delivery Type", "required");
    //         $this->form_validation->set_rules("package_weight", "Package Weight", "required");
    //         $this->form_validation->set_rules("package_dimensions", "Package Dimensions", "required");
    //         $this->form_validation->set_rules("amount", "Amount", "required");
    //         $this->form_validation->set_rules("payment_status", "Payment Status", "required");
    //         $this->form_validation->set_rules("courier_notes", "Courier Notes", "required");

    //     if ($this->form_validation->run() == FALSE) {
    //         echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
    //         exit();
    //     } else {
    //         $inputs = $this->get_inputs();
    //         $inputs->created_by = $this->session->userdata("userId");
    //         $delivery_id = (int) $this->input->post("delivery_id");
    //         if ($delivery_id == 0) {
    //             $this->db->insert("deliveries", $inputs);

    //         } else {
    //             $this->db->where("delivery_id", $delivery_id); 
    //             $inputs["last_updated"] = date('Y-m-d H:i:s');
    //             $this->db->update("deliveries", $inputs);
    //         }
    //         echo "success";
    //     }
    // }

    public function rider_view($rider_id, $tab = 'Shipped')
    {
        $this->data['tab'] = $tab;
        $rider_id = (int) $rider_id;
        $query = "SELECT * FROM users WHERE user_id = $rider_id and role_id=3";
        $rider = $this->db->query($query)->row();
        $this->data["rider"] = $rider;
        $this->data["title"] = $rider->name;
        $this->data["view"] = ADMIN_DIR . "deliveries/rider_view";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }
    public function assign_to_rider()
    {
        $rider_id = (int) $this->input->post('rider_id');
        $delivery_id = (int) $this->input->post('delivery_id');
        $this->add_package_to_rider($rider_id, $delivery_id);
        redirect(ADMIN_DIR . "deliveries/rider_view/" . $rider_id);
    }

    private function  add_package_to_rider($rider_id, $delivery_id)
    {
        $query = "SELECT * FROM deliveries WHERE delivery_id = ?";
        $delivery = $this->db->query($query, [$delivery_id])->row();
        //var_dump($delivery);
        if ($delivery) {
            if (is_null($delivery->rider_id)) {
                $inputs['rider_id'] = $rider_id;
                $inputs['assigned_date'] = date('Y-m-d H:i:s');
                $inputs['delivery_status'] = 'Shipped';
                $this->db->where("delivery_id", $delivery_id);
                $inputs["last_updated"] = date('Y-m-d H:i:s');
                if ($this->db->update("deliveries", $inputs)) {
                    //current user
                    $user_id = $this->session->userdata("userId");
                    $query = "SELECT users.name, roles.role_title FROM users 
                INNER JOIN roles ON (roles.role_id = users.role_id)
                WHERE user_id = $user_id";
                    $creater = $this->db->query($query)->row();
                    //rider detail
                    $query = "SELECT users.name, roles.role_title FROM users 
                    INNER JOIN roles ON (roles.role_id = users.role_id)
                    WHERE user_id = $rider_id";
                    $rider = $this->db->query($query)->row();

                    $log['created_by'] = $creater->name . "(" . $creater->role_title . ")";
                    $log['delivery_id'] = $delivery_id;
                    $log['detail'] = $creater->name . "(" . $creater->role_title . ") assign package to " . $rider->name . "(" . $rider->role_title . ") for shipment.";
                    $this->db->insert("delivery_logs", $log);
                    echo 'success';
                }
            } else {
                $query = "SELECT users.name, roles.role_title FROM users 
                    INNER JOIN roles ON (roles.role_id = users.role_id)
                    WHERE user_id = $delivery->rider_id";
                $rider = $this->db->query($query)->row();
                echo 'Tracking No. <strong>( ' . $delivery->tracking_number . ' ) <br />Status: ' . $delivery->delivery_status . '</strong><br /> Already assigned to:<strong> ' . $rider->name . ' (' . $rider->role_title . ') </strong>';
            }
        } else {
            return 'Package Not Found';
        }
    }

    public function remove_from_rider()
    {

        $rider_id = (int) $this->input->post('rider_id');
        $delivery_id = (int) $this->input->post('delivery_id');
        $inputs['rider_id'] = NULL;
        $this->db->where("delivery_id", $delivery_id);
        $this->db->where("rider_id", $rider_id);
        $this->db->where("delivery_status", 'Cancelled');
        $inputs["last_updated"] = date('Y-m-d H:i:s');
        if ($this->db->update("deliveries", $inputs)) {

            //current user
            $user_id = $this->session->userdata("userId");
            $query = "SELECT users.name, roles.role_title FROM users 
            INNER JOIN roles ON (roles.role_id = users.role_id)
            WHERE user_id = $user_id";
            $creater = $this->db->query($query)->row();
            //rider detail
            $query = "SELECT users.name, roles.role_title FROM users 
            INNER JOIN roles ON (roles.role_id = users.role_id)
            WHERE user_id = $rider_id";
            $rider = $this->db->query($query)->row();

            $log['created_by'] = $creater->name . "(" . $creater->role_title . ")";
            $log['delivery_id'] = $delivery_id;
            $log['detail'] = $creater->name . "(" . $creater->role_title . ") remove assigned package from " . $rider->name . "(" . $rider->role_title . ") as cancelled.";
            $this->db->insert("delivery_logs", $log);
        }

        redirect(ADMIN_DIR . "deliveries/rider_view/" . $rider_id);
    }

    public function remove_rider_assigned_package()
    {

        $rider_id = (int) $this->input->post('rider_id');
        $delivery_id = (int) $this->input->post('delivery_id');
        $inputs['rider_id'] = NULL;
        $inputs['delivery_status'] = 'Pending';
        $this->db->where("delivery_id", $delivery_id);
        $this->db->where("rider_id", $rider_id);
        $inputs["last_updated"] = date('Y-m-d H:i:s');
        if ($this->db->update("deliveries", $inputs)) {

            //current user
            $user_id = $this->session->userdata("userId");
            $query = "SELECT users.name, roles.role_title FROM users 
        INNER JOIN roles ON (roles.role_id = users.role_id)
        WHERE user_id = $user_id";
            $creater = $this->db->query($query)->row();
            //rider detail
            $query = "SELECT users.name, roles.role_title FROM users 
        INNER JOIN roles ON (roles.role_id = users.role_id)
        WHERE user_id = $rider_id";
            $rider = $this->db->query($query)->row();

            $log['created_by'] = $creater->name . "(" . $creater->role_title . ")";
            $log['delivery_id'] = $delivery_id;
            $log['detail'] = $creater->name . "(" . $creater->role_title . ") removed assigned package from " . $rider->name . "(" . $rider->role_title . ") and marked as pending";
            $this->db->insert("delivery_logs", $log);
        }

        redirect(ADMIN_DIR . "deliveries/rider_view/" . $rider_id);
    }

    public function seacrch_by_tracking_no()
    {
        $tracking_no = $this->input->post('tracking_no');
        $parts = explode(",", $tracking_no); // Split the string by commas
        $tracking_no = trim($parts[0]); // Get the first part and remove any extra spaces

        $rider_id = (int) $this->input->post('rider_id');
        $query = "SELECT * FROM deliveries WHERE tracking_number = ?";
        $delivery = $this->db->query($query, [$tracking_no])->row();
        if ($delivery) {
            $this->add_package_to_rider($rider_id, $delivery->delivery_id);
        } else {
            echo 'Tracking No. (<strong>' . $tracking_no . '</strong>) Not Found.';
        }
    }

    public function get_rider_assigned_list()
    {
        $this->data['rider_id'] =   (int) $this->input->post('rider_id');
        $this->load->view(ADMIN_DIR . "deliveries/rider/rider_assigned_list", $this->data);
    }


    public function complete_rider_payments()
    {

        //echo "we are here";
        //exit();

        $rider_id = (int) $this->input->post('rider_id');
        $delivery_ids = $this->input->post('delivery_ids');
        $delivery_ids = explode(',', $delivery_ids);
        $inputs['delivery_status'] = 'Completed';
        $inputs['payment_status'] = 'Yes';

        $inputs["last_updated"] = date('Y-m-d H:i:s');

        // Corrected the variable name in where_in clause
        $this->db->where_in("delivery_id", $delivery_ids);
        $this->db->where("rider_id", $rider_id);

        if ($this->db->update("deliveries", $inputs)) {

            //$delivery_ids = explode(',', $delivery_ids);
            foreach ($delivery_ids as $delivery_id) {
                //current user
                $user_id = $this->session->userdata("userId");
                $query = "SELECT users.name, roles.role_title FROM users 
            INNER JOIN roles ON (roles.role_id = users.role_id)
            WHERE user_id = $user_id";
                $creater = $this->db->query($query)->row();
                //rider detail
                $query = "SELECT users.name, roles.role_title FROM users 
            INNER JOIN roles ON (roles.role_id = users.role_id)
            WHERE user_id = $rider_id";
                $rider = $this->db->query($query)->row();

                $log['created_by'] = $creater->name . "(" . $creater->role_title . ")";
                $log['delivery_id'] = $delivery_id;
                $log['detail'] = $creater->name . "(" . $creater->role_title . ") received dilivery ammount from " . $rider->name . "(" . $rider->role_title . ")";
                $this->db->insert("delivery_logs", $log);
            }
        }

        redirect(ADMIN_DIR . "deliveries/rider_view/" . $rider_id);
    }
}
