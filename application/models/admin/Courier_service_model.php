<?php if(!defined('BASEPATH')) exit('Direct access not allowed!');

class Courier_service_model extends MY_Model{
    
    public function __construct(){
        
        parent::__construct();
        $this->table = "courier_services";
        $this->pk = "courier_service_id";
        $this->status = "status";
        $this->order = "order";
    }
	
 public function validate_form_data(){
	 $validation_config = array(
            
                        array(
                            "field"  =>  "courier_service_name",
                            "label"  =>  "Courier Service Name",
                            "rules"  =>  "required"
                        ),
                        
                        array(
                            "field"  =>  "short_name",
                            "label"  =>  "Short Name",
                            "rules"  =>  "required"
                        ),
                        
            );
	 //set and run the validation
        $this->form_validation->set_rules($validation_config);
	 return $this->form_validation->run();
	 
	 }	

public function save_data($image_field= NULL){
	$inputs = array();
            
                    $inputs["courier_service_name"]  =  $this->input->post("courier_service_name");
                    
                    $inputs["short_name"]  =  $this->input->post("short_name");
                    
                    if($_FILES["logo"]["size"] > 0){
                        $inputs["logo"]  =  $this->router->fetch_class()."/".$this->input->post("logo");
                    }
                    
	return $this->courier_service_model->save($inputs);
	}	 	

public function update_data($courier_service_id, $image_field= NULL){
	$inputs = array();
            
                    $inputs["courier_service_name"]  =  $this->input->post("courier_service_name");
                    
                    $inputs["short_name"]  =  $this->input->post("short_name");
                    
                    if($_FILES["logo"]["size"] > 0){
						//remove previous file....
						$courier_services = $this->get_courier_service($courier_service_id);
						$file_path = $courier_services[0]->logo;
						$this->delete_file($file_path);
                        $inputs["logo"]  =  $this->router->fetch_class()."/".$this->input->post("logo");
                    }
                    
	return $this->courier_service_model->save($inputs, $courier_service_id);
	}	
	
    //----------------------------------------------------------------
 public function get_courier_service_list($where_condition=NULL, $pagination=TRUE, $public = FALSE){
		$data = (object) array();
		$fields = array("courier_services.*");
		$join_table = array();
		if(!is_null($where_condition)){ $where = $where_condition; }else{ $where = ""; }
		
		if($pagination){
				//configure the pagination
	        $this->load->library("pagination");
			
			if($public){
					$config['per_page'] = 10;
					$config['uri_segment'] = 3;
					$this->courier_service_model->uri_segment = $this->uri->segment(3);
					$config["base_url"]  = base_url($this->uri->segment(1)."/".$this->uri->segment(2));
				}else{
					$this->courier_service_model->uri_segment = $this->uri->segment(4);
					$config["base_url"]  = base_url(ADMIN_DIR.$this->uri->segment(2)."/".$this->uri->segment(3));
					}
			$config["total_rows"] = $this->courier_service_model->joinGet($fields, "courier_services", $join_table, $where, true);
	        $this->pagination->initialize($config);
	        $data->pagination = $this->pagination->create_links();
			$data->courier_services = $this->courier_service_model->joinGet($fields, "courier_services", $join_table, $where);
			return $data;
		}else{
			return $this->courier_service_model->joinGet($fields, "courier_services", $join_table, $where, FALSE, TRUE);
		}
		
	}

public function get_courier_service($courier_service_id){
	
		$fields = array("courier_services.*");
		$join_table = array();
		$where = "courier_services.courier_service_id = $courier_service_id";
		
		return $this->courier_service_model->joinGet($fields, "courier_services", $join_table, $where, FALSE, TRUE);
		
	}
	
	


}


	

