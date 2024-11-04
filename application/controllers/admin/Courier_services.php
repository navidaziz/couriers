<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Courier_services extends Admin_Controller{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/courier_service_model");
        $this->load->model("admin/delivery_model");
        
		$this->lang->load("courier_services", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
    }
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`courier_services`.`status` IN (0, 1) ";
		$data = $this->courier_service_model->get_courier_service_list($where);
		 $this->data["courier_services"] = $data->courier_services;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Courier Services');
		$this->data["view"] = ADMIN_DIR."courier_services/courier_services";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_courier_service($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
        
        $this->data["courier_service"] = $courier_service = $this->courier_service_model->get_courier_service($courier_service_id)[0];
        $this->data["title"] = $courier_service->courier_service_name;
		$this->data["view"] = ADMIN_DIR."courier_services/view_courier_service";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`courier_services`.`status` IN (2) ";
		$data = $this->courier_service_model->get_courier_service_list($where);
		 $this->data["courier_services"] = $data->courier_services;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Courier Services');
		$this->data["view"] = ADMIN_DIR."courier_services/trashed_courier_services";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($courier_service_id, $page_id = NULL){
        
        $courier_service_id = (int) $courier_service_id;
        
        
        $this->courier_service_model->changeStatus($courier_service_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."courier_services/view/".$page_id);
    }
    
    /**
      * function to restor courier_service from trash
      * @param $courier_service_id integer
      */
     public function restore($courier_service_id, $page_id = NULL){
        
        $courier_service_id = (int) $courier_service_id;
        
        
        $this->courier_service_model->changeStatus($courier_service_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."courier_services/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft courier_service from trash
      * @param $courier_service_id integer
      */
     public function draft($courier_service_id, $page_id = NULL){
        
        $courier_service_id = (int) $courier_service_id;
        
        
        $this->courier_service_model->changeStatus($courier_service_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."courier_services/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish courier_service from trash
      * @param $courier_service_id integer
      */
     public function publish($courier_service_id, $page_id = NULL){
        
        $courier_service_id = (int) $courier_service_id;
        
        
        $this->courier_service_model->changeStatus($courier_service_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."courier_services/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Courier_service
      * @param $courier_service_id integer
      */
     public function delete($courier_service_id, $page_id = NULL){
        
        $courier_service_id = (int) $courier_service_id;
        //$this->courier_service_model->changeStatus($courier_service_id, "3");
        //Remove file....
						$courier_services = $this->courier_service_model->get_courier_service($courier_service_id);
						$file_path = $courier_services[0]->logo;
						$this->courier_service_model->delete_file($file_path);
		$this->courier_service_model->delete(array( 'courier_service_id' => $courier_service_id));
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."courier_services/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new Courier_service
      */
     public function add(){
		
        $this->data["title"] = $this->lang->line('Add New Courier Service');$this->data["view"] = ADMIN_DIR."courier_services/add_courier_service";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->courier_service_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("logo")){
                       $_POST['logo'] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $courier_service_id = $this->courier_service_model->save_data();
          if($courier_service_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."courier_services/edit/$courier_service_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."courier_services/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a Courier_service
      */
     public function edit($courier_service_id){
		 $courier_service_id = (int) $courier_service_id;
        $this->data["courier_service"] = $this->courier_service_model->get($courier_service_id);
		  
        $this->data["title"] = $this->lang->line('Edit Courier Service');$this->data["view"] = ADMIN_DIR."courier_services/edit_courier_service";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($courier_service_id){
		 
		 $courier_service_id = (int) $courier_service_id;
       
	   if($this->courier_service_model->validate_form_data() === TRUE){
		  
                    if($this->upload_file("logo")){
                         $_POST["logo"] = $this->data["upload_data"]["file_name"];
                    }
                    
		  $courier_service_id = $this->courier_service_model->update_data($courier_service_id);
          if($courier_service_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."courier_services/edit/$courier_service_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."courier_services/edit/$courier_service_id");
            }
        }else{
			$this->edit($courier_service_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["courier_services"] = $this->courier_service_model->getBy($where, false, "courier_service_id" );
				$j_array[]=array("id" => "", "value" => "courier_service");
				foreach($data["courier_services"] as $courier_service ){
					$j_array[]=array("id" => $courier_service->courier_service_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------


    public function batches() {
            $columns[] = "courier_service_name";
            $columns[] = "batch_no";
            $columns[] = "batch_date";
            $columns[] = "batch_detail";
            
        
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        $courier_service_id = (int) $this->input->post("courier_service_id");

        $search = $this->db->escape("%".$this->input->post("search")["value"]."%");
            // Manual SQL query building
            $sql = "SELECT batches.*, cs.courier_service_name  FROM batches INNER JOIN courier_services as cs ON(cs.courier_service_id = batches.courier_service_id)";
            $sql .= " WHERE cs.courier_service_id = '".$courier_service_id."'";
            // Searching
            if(!empty($this->input->post("search")["value"])) {
                //$sql .= " WHERE ";
                foreach($columns as $column) {
                    $sql .= "$column LIKE $search OR ";
                }
                $sql = rtrim($sql, "OR "); // Remove the last "OR"
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
            $total_records = $this->db->query("SELECT COUNT(*) as count FROM batches")->row()->count;
    
            $output = array(
                "draw" => intval($this->input->post("draw")),
                "recordsTotal" => $total_records,
                "recordsFiltered" => $total_records,
                "data" => $data
            );
    
            echo json_encode($output);
        }
    
public function courier_service_batche($courier_service_id, $batch_id){
        
        $courier_service_id = (int) $courier_service_id;
         $batch_id = (int) $batch_id;
        
        $this->data["courier_service"] = $this->courier_service_model->get_courier_service($courier_service_id)[0];
        $query="SELECT batches.*, cs.courier_service_name FROM batches 
        INNER JOIN courier_services as cs ON(cs.courier_service_id = batches.courier_service_id)
        WHERE batch_id = '".$batch_id."'";
        $this->data['batch'] = $batch = $this->db->query($query)->row();
        
        $this->data["title"] = "Batch No: ".$batch->batch_no;
        $this->data["description"] = $this->lang->line('Courier Service Details');
		$this->data["view"] = ADMIN_DIR."courier_services/courier_service_batche";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }

     private function get_inputs(){
            $input["batch_id"] = $this->input->post("batch_id");
            $input["courier_service_id"] = $this->input->post("courier_service_id");
            $input["batch_no"] = $this->input->post("batch_no");
             $input["batch_date"] = $this->input->post("batch_date");
            $input["batch_detail"] = $this->input->post("batch_detail");
            $inputs =  (object) $input;
        return $inputs;
        }
         
        public function get_batch_form(){
        $batch_id = (int) $this->input->post("batch_id");
        $courier_service_id = (int) $this->input->post("courier_service_id");
        if ($batch_id == 0) {
            
        $input = $this->get_inputs();
           } else {
            $query = "SELECT * FROM 
            batches 
            WHERE batch_id = $batch_id";
            $input = $this->db->query($query)->row();
            }
            $this->data["input"] = $input;
            $this->load->view(ADMIN_DIR . "courier_services/get_batch_form", $this->data);
            }

        public function add_batch()
        {
            $this->form_validation->set_rules("courier_service_id", "Courier Service Id", "required");
                $this->form_validation->set_rules("batch_no", "Batch No", "required");
                $this->form_validation->set_rules("batch_detail", "Batch Detail", "required");
                
            if ($this->form_validation->run() == FALSE) {
                echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
                exit();
            } else {
                $inputs = $this->get_inputs();
                $inputs->created_by = $this->session->userdata("userId");
                $batch_id = (int) $this->input->post("batch_id");
                if ($batch_id == 0) {
                    $this->db->insert("batches", $inputs);

                } else {
                    $this->db->where("batch_id", $batch_id); 
                    $inputs->last_updated = date('Y-m-d H:i:s');
                    $this->db->update("batches", $inputs);
                }
                echo "success";
            }
        }
        public function delete_batch($batch_id)
        {
            $batch_id = (int) $batch_id;
            $this->db->where("batch_id", $batch_id);
            $this->db->delete("batches");
            $requested_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($requested_url);
        }


         private function get_delivery_inputs(){
            $input["delivery_id"] = $this->input->post("delivery_id");
            $input["courier_service_id"] = $this->input->post("courier_service_id");
            $input["batch_id"] = $this->input->post("batch_id");
            $input["tracking_number"] = $this->input->post("tracking_number");
            $input["sender_name"] = $this->input->post("sender_name");
            $input["sender_address"] = $this->input->post("sender_address");
            $input["sender_contact"] = $this->input->post("sender_contact");
            $input["recipient_name"] = $this->input->post("recipient_name");
            $input["recipient_address"] = $this->input->post("recipient_address");
            $input["recipient_contact"] = $this->input->post("recipient_contact");
            $input["shipment_date"] = $this->input->post("shipment_date");
            $input["expected_delivery_date"] = $this->input->post("expected_delivery_date");
            $input["delivery_status"] = 'Pending';
            $input["delivery_type"] = $this->input->post("delivery_type");
            $input["package_weight"] = $this->input->post("package_weight");
            $input["package_dimensions"] = $this->input->post("package_dimensions");
            $input["delivery_cost"] = $this->input->post("delivery_cost");
            $input["payment_status"] = 'No';
            $input["courier_notes"] = $this->input->post("courier_notes");
            $inputs =  (object) $input;
        return $inputs;
        }
         
        public function get_delivery_form(){
                $delivery_id = (int) $this->input->post("delivery_id");
                if ($delivery_id == 0) {
                    
                $input = $this->get_delivery_inputs();
                } else {
                    $query = "SELECT * FROM 
                    deliveries 
                    WHERE delivery_id = $delivery_id";
                    $input = $this->db->query($query)->row();
                    }
                    $this->data["courier_services"] = $this->delivery_model->getList("courier_services", "courier_service_id", "courier_service_name", $where ="`courier_services`.`status` IN (1) ");
            
                    $this->data["input"] = $input;
                    $this->load->view(ADMIN_DIR . "courier_services/get_delivery_form", $this->data);
            }
        public function add_delivery()
        {
                $this->form_validation->set_rules("tracking_number", "Tracking Number", "required");
                $this->form_validation->set_rules("sender_name", "Sender Name", "required");
                $this->form_validation->set_rules("sender_address", "Sender Address", "required");
                $this->form_validation->set_rules("sender_contact", "Sender Contact", "required");
                $this->form_validation->set_rules("recipient_name", "Recipient Name", "required");
                $this->form_validation->set_rules("recipient_address", "Recipient Address", "required");
                $this->form_validation->set_rules("recipient_contact", "Recipient Contact", "required");
                $this->form_validation->set_rules("courier_service_id", "Courier Service Id", "required");
                $this->form_validation->set_rules("shipment_date", "Shipment Date", "required");
                $this->form_validation->set_rules("expected_delivery_date", "Expected Delivery Date", "required");
                //$this->form_validation->set_rules("delivery_status", "Delivery Status", "required");
                $this->form_validation->set_rules("delivery_type", "Delivery Type", "required");
                $this->form_validation->set_rules("package_weight", "Package Weight", "required");
                $this->form_validation->set_rules("package_dimensions", "Package Dimensions", "required");
                $this->form_validation->set_rules("delivery_cost", "Delivery Cost", "required");
                //$this->form_validation->set_rules("payment_status", "Payment Status", "required");
                //$this->form_validation->set_rules("courier_notes", "Courier Notes", "required");
                
            if ($this->form_validation->run() == FALSE) {
                echo '<div class="alert alert-danger">' . validation_errors() . "</div>";
                exit();
            } else {
                $inputs = $this->get_delivery_inputs();
                $inputs->created_by = $this->session->userdata("userId");
                $delivery_id = (int) $this->input->post("delivery_id");
                if ($delivery_id == 0) {
                    $inputs->delivery_status ='Pending';
                    $inputs->payment_status ='No';
                    $inputs->verified ='Yes';
                    $this->db->insert("deliveries", $inputs);

                } else {
                    $this->db->where("delivery_id", $delivery_id); 
                    $inputs["last_updated"] = date('Y-m-d H:i:s');
                    $this->db->update("deliveries", $inputs);
                }
                echo "success";
            }
        }
        
    
    
}        
