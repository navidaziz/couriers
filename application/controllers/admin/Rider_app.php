<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rider_app extends Admin_Controller
{

    /**
     * constructor method
     */
    public function __construct()
    {

        parent::__construct();
        $this->load->model("admin/billing_month_model");
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
        $user_id = $this->session->userdata("userId");
        $query = "SELECT users.user_id, users.name, roles.role_title FROM users 
        INNER JOIN roles ON (roles.role_id = users.role_id)
        WHERE user_id = $user_id";
        $rider = $this->db->query($query)->row();
        $this->data['rider'] = $rider;
        $this->data["title"] = $rider->name;
        $this->data["view"] = ADMIN_DIR . "rider_app/index";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }

    public function get_delivery_detail()
    {
        $get_delivery_id = (int) $this->input->post('delivery_id');
        $user_id = $this->session->userdata("userId");
        $query = "SELECT deliveries.*, cs.courier_service_name, cs.logo FROM deliveries 
        INNER JOIN courier_services as cs ON(cs.courier_service_id = deliveries.courier_service_id)
        WHERE delivery_id = ? AND rider_id = ?";
        $delivery = $this->db->query($query, [$get_delivery_id, $user_id])->row();
        $this->data['delivery'] = $delivery;
        $this->load->view(ADMIN_DIR . "rider_app/delivery_detail", $this->data);
    }

    public function deliver()
    {
        $rider_id = $this->session->userdata("userId");
        $delivery_id = (int) $this->input->post('delivery_id');
        $query = "SELECT COUNT(*) as total FROM deliveries WHERE delivery_id = ? and rider_id = ?";
        $rider_delivery = $this->db->query($query, [$delivery_id, $rider_id])->row();
        if ($rider_delivery->total > 0) {
            $inputs['delivered_to'] = $delivered_to =  $this->input->post('delivered_to');
            $inputs['delivered_to_mobile_no'] = $delivered_to_mobile_no =  $this->input->post("delivered_to_mobile_no");
            $inputs['delivered_date'] =  date('Y-m-d H:i:s');
            $inputs['delivery_status'] = 'Delivered';
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
                $log['detail'] = $creater->name . "(" . $creater->role_title . ") Delivered package to " . $delivered_to . "(" . $delivered_to_mobile_no . ") for shipment.";
                $this->db->insert("delivery_logs", $log);
                echo "success";
            } else {
                echo "Error While updating record.";
            }
        } else {
            echo "Package is not assign to you. contact to administration";
        }
    }


    public function cancel()
    {
        $rider_id = $this->session->userdata("userId");
        $delivery_id = (int) $this->input->post('delivery_id');
        $query = "SELECT COUNT(*) as total FROM deliveries WHERE delivery_id = ? and rider_id = ?";
        $rider_delivery = $this->db->query($query, [$delivery_id, $rider_id])->row();
        if ($rider_delivery->total > 0) {
            $inputs['cancelled_date'] =  date('Y-m-d H:i:s');
            $inputs['delivery_status'] = 'Cancelled';
            $inputs['cancelled_reason'] = $cancelled_reason =  $this->input->post('cancelled_reason');
            $inputs['cancelled_by'] = $this->session->userdata("userId");
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
                $log['detail'] = $creater->name . "(" . $creater->role_title . ") Cancelled delivery due to $cancelled_reason";
                $this->db->insert("delivery_logs", $log);
                echo "success";
            } else {
                echo "Error While updating record.";
            }
        } else {
            echo "Package is not assign to you. contact to administration";
        }
    }

    public function onhold()
    {
        $rider_id = $this->session->userdata("userId");
        $delivery_id = (int) $this->input->post('delivery_id');
        $query = "SELECT COUNT(*) as total FROM deliveries WHERE delivery_id = ? and rider_id = ?";
        $rider_delivery = $this->db->query($query, [$delivery_id, $rider_id])->row();
        if ($rider_delivery->total > 0) {
            $inputs['onhold_date'] =  date('Y-m-d H:i:s');
            $inputs['delivery_status'] = 'Onhold';
            $inputs['onhold_reason'] = $onhold_reason =  $this->input->post('onhold_reason');
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
                $log['detail'] = $creater->name . "(" . $creater->role_title . ") Cancelled delivery due to $onhold_reason";
                $this->db->insert("delivery_logs", $log);
                echo "success";
            } else {
                echo "Error While updating record.";
            }
        } else {
            echo "Package is not assign to you. contact to administration";
        }
    }

    public function view_consumers_list($billing_month_id)
    {
        $this->data['billing_month_id'] = $billing_month_id = (int) $billing_month_id;
        $query = "SELECT * FROM `billing_months` 
                  WHERE billing_month_id='" . $billing_month_id . "'";
        $this->data['billing_month'] = $billing_month = $this->db->query($query)->row();

        $this->data["description"] = 'Meter Reading for Month: ' . date("M, Y", strtotime($billing_month->billing_month));
        $this->data["title"] = "Consumers List";
        $this->data["view"] = ADMIN_DIR . "meter_reading_app/consumers_list";
        $this->load->view(ADMIN_DIR . "layout", $this->data);
    }




    // private function get_inputs()
    // {
    //     $input["consumer_monthly_bill_id"] = $this->input->post("consumer_monthly_bill_id");
    //     $input["consumer_id"] = $consumer_id = (int) $this->input->post("consumer_id");
    //     $query = "SELECT consumer_meter_no FROM `consumers` WHERE consumer_id='" . $consumer_id . "'";
    //     $consumer = $this->db->query($query)->row();
    //     $input["meter_no"] = $consumer->consumer_meter_no;
    //     $input["billing_month_id"] = $billing_month_id  =  (int) $this->input->post("billing_month_id");

    //     //current tariff.....................................................
    //     $query = "SELECT * FROM `tariffs` WHERE status=1";
    //     $tariff = $this->db->query($query)->row();
    //     $input["rate"] = $tariff->tariff;
    //     $input["monthly_service_charges"] = $tariff->monthly_service_charges;
    //     $input["taxs"] = $tariff->tax;
    //     //current tariff end ................................................

    //     $query = "SELECT billing_month
    //     FROM `billing_months` 
    //     WHERE status=1
    //     AND billing_month_id = '" . $billing_month_id . "'";
    //     $current_billing = $this->db->query($query)->row();
    //     //list($current_billing_year, $current_billing_month) = explode('-', $current_billing->billing_month);
    //     $current_billing_date = DateTime::createFromFormat('Y-m', $current_billing->billing_month);
    //     $current_billing_date->modify('-1 month');
    //     $previous_billing_month = $current_billing_date->format('Y-m');
    //     $query = "SELECT cmb.current_reading, cmb.last_month_arrears, cmb.dues 
    //     FROM `consumer_monthly_bills` as cmb
    //     INNER JOIN billing_months  as bm ON(bm.billing_month_id = cmb.billing_month_id)
    //     WHERE cmb.consumer_id=1 
    //     AND bm.billing_month = '" . $previous_billing_month . "';";
    //     $previous_month_record = $this->db->query($query)->row();
    //     if ($previous_month_record) {
    //         $input["last_reading"] = $previous_month_record->current_reading;
    //         $input["last_month_arrears"] = $previous_month_record->last_month_arrears;
    //         $input["dues"] = $previous_month_record->dues;
    //     } else {
    //         $input["last_reading"] = 0;
    //         $input["last_month_arrears"] = 0;
    //         $input["dues"] = 0;
    //     }


    //     $input["current_reading"] = $this->input->post("current_reading");
    //     $input["reading_date"] = $this->input->post("reading_date");
    //     $input["unit_cosumed"] = $input["current_reading"] - $input["last_reading"];


    //     $inputs =  (object) $input;
    //     return $inputs;
    // }

    // public function get_meter_reading_form()
    // {

    //     $consumer_monthly_bill_id = (int) $this->input->post("consumer_monthly_bill_id");

    //     if ($consumer_monthly_bill_id == 0) {

    //         $input = $this->get_inputs();
    //     } else {
    //         $query = "SELECT * FROM 
    //         consumer_monthly_bills 
    //         WHERE consumer_monthly_bill_id = $consumer_monthly_bill_id";
    //         $input = $this->db->query($query)->row();
    //     }
    //     $this->data["input"] = $input;
    //     $this->load->view(ADMIN_DIR . "meter_reading_app/meter_reading_form", $this->data);
    // }

    // public function add_monthly_meter_reading()
    // {
    //     $this->form_validation->set_rules("consumer_id", "Consumer Id", "required");
    //     $this->form_validation->set_rules("billing_month_id", "Billing Month Id", "required");
    //     $this->form_validation->set_rules("last_reading", "Last Reading", "required");
    //     $this->form_validation->set_rules("current_reading", "Current Reading", "required");
    //     $this->form_validation->set_rules("reading_date", "Reading Date", "required");


    //     if ($this->form_validation->run() == FALSE) {
    //         echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
    //         exit();
    //     } else {
    //         $inputs = $this->get_inputs();
    //         $inputs->created_by = $this->session->userdata("userId");
    //         $consumer_monthly_bill_id = (int) $this->input->post("consumer_monthly_bill_id");
    //         if ($consumer_monthly_bill_id == 0) {
    //             $this->db->insert("consumer_monthly_bills", $inputs);
    //         } else {
    //             $this->db->where("consumer_monthly_bill_id", $consumer_monthly_bill_id);
    //             $inputs->last_updated = date('Y-m-d H:i:s');
    //             $this->db->update("consumer_monthly_bills", $inputs);
    //         }
    //         echo "success";
    //     }
    // }
}
