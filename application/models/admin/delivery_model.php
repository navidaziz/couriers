<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Delivery_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "deliveries";
        $this->pk = "delivery_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "tracking_number",
                            "label"  =>  "Tracking No.",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "sender_name",
                            "label"  =>  "Sender Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "sender_address",
                            "label"  =>  "Sender Address",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "sender_contact",
                            "label"  =>  "Sender Contact",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "recipient_name",
                            "label"  =>  "Recipient Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "recipient_address",
                            "label"  =>  "Recipient Address",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "recipient_contact",
                            "label"  =>  "Recipient Contact",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "courier_service_id",
                            "label"  =>  "Courier Service Id",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "shipment_date",
                            "label"  =>  "Shipment Date",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "expected_delivery_date",
                            "label"  =>  "Expected Delivery Date",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "delivery_status",
                            "label"  =>  "Delivery Status",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "delivery_type",
                            "label"  =>  "Delivery Type",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "package_weight",
                            "label"  =>  "Package Weight",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "package_dimensions",
                            "label"  =>  "Package Dimensions",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "amount",
                            "label"  =>  "Amount",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "payment_status",
                            "label"  =>  "Payment Status",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "courier_notes",
                            "label"  =>  "Courier Notes",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "created_at",
                            "label"  =>  "Created At",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "updated_at",
                            "label"  =>  "Updated At",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["tracking_number"]  =  $this->input->post("tracking_number");
                    
                    $inputs["sender_name"]  =  $this->input->post("sender_name");
                    
                    $inputs["sender_address"]  =  $this->input->post("sender_address");
                    
                    $inputs["sender_contact"]  =  $this->input->post("sender_contact");
                    
                    $inputs["recipient_name"]  =  $this->input->post("recipient_name");
                    
                    $inputs["recipient_address"]  =  $this->input->post("recipient_address");
                    
                    $inputs["recipient_contact"]  =  $this->input->post("recipient_contact");
                    
                    $inputs["courier_service_id"]  =  $this->input->post("courier_service_id");
                    
                    $inputs["shipment_date"]  =  $this->input->post("shipment_date");
                    
                    $inputs["expected_delivery_date"]  =  $this->input->post("expected_delivery_date");
                    
                    $inputs["delivery_status"]  =  $this->input->post("delivery_status");
                    
                    $inputs["delivery_type"]  =  $this->input->post("delivery_type");
                    
                    $inputs["package_weight"]  =  $this->input->post("package_weight");
                    
                    $inputs["package_dimensions"]  =  $this->input->post("package_dimensions");
                    
                    $inputs["amount"]  =  $this->input->post("amount");
                    
                    $inputs["payment_status"]  =  $this->input->post("payment_status");
                    
                    $inputs["courier_notes"]  =  $this->input->post("courier_notes");
                    
                    $inputs["created_at"]  =  $this->input->post("created_at");
                    
                    $inputs["updated_at"]  =  $this->input->post("updated_at");
                    
	return $this->delivery_model->save($inputs);
	}	 	

public function update_data($delivery_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["tracking_number"]  =  $this->input->post("tracking_number");
                    
                    $inputs["sender_name"]  =  $this->input->post("sender_name");
                    
                    $inputs["sender_address"]  =  $this->input->post("sender_address");
                    
                    $inputs["sender_contact"]  =  $this->input->post("sender_contact");
                    
                    $inputs["recipient_name"]  =  $this->input->post("recipient_name");
                    
                    $inputs["recipient_address"]  =  $this->input->post("recipient_address");
                    
                    $inputs["recipient_contact"]  =  $this->input->post("recipient_contact");
                    
                    $inputs["courier_service_id"]  =  $this->input->post("courier_service_id");
                    
                    $inputs["shipment_date"]  =  $this->input->post("shipment_date");
                    
                    $inputs["expected_delivery_date"]  =  $this->input->post("expected_delivery_date");
                    
                    $inputs["delivery_status"]  =  $this->input->post("delivery_status");
                    
                    $inputs["delivery_type"]  =  $this->input->post("delivery_type");
                    
                    $inputs["package_weight"]  =  $this->input->post("package_weight");
                    
                    $inputs["package_dimensions"]  =  $this->input->post("package_dimensions");
                    
                    $inputs["amount"]  =  $this->input->post("amount");
                    
                    $inputs["payment_status"]  =  $this->input->post("payment_status");
                    
                    $inputs["courier_notes"]  =  $this->input->post("courier_notes");
                    
                    $inputs["created_at"]  =  $this->input->post("created_at");
                    
                    $inputs["updated_at"]  =  $this->input->post("updated_at");
                    
	return $this->delivery_model->save($inputs, $delivery_id);
	}	
	
    //----------------------------------------------------------------
 public function get_delivery_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("deliveries.*"
                , "courier_services.courier_service_name"
            );
		$join_table = array(
            "courier_services" => "courier_services.courier_service_id = deliveries.courier_service_id",
        );
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->delivery_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->delivery_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->delivery_model->joinGet($fields, "deliveries", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->deliveries = $this->delivery_model->joinGet($fields, "deliveries", $join_table, $where);
			return $data;
		}else{
			return $this->delivery_model->joinGet($fields, "deliveries", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_delivery($delivery_id){
	
		$fields = array("deliveries.*"
                , "courier_services.courier_service_name"
            );
		$join_table = array(
            "courier_services" => "courier_services.courier_service_id = deliveries.courier_service_id",
        );
		$where = "deliveries.delivery_id = $delivery_id";
		
		return $this->delivery_model->joinGet($fields, "deliveries", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

