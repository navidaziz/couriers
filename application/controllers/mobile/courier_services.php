<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Courier_services extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/courier_service_model");
		$this->lang->load("courier_services", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`courier_services`.`status` IN (0, 1) ";
		$data = $this->courier_service_model->get_courier_service_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_courier_service($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
		$data = $this->courier_service_model->get_courier_service($courier_service_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`courier_services`.`status` IN (2) ";
		$data = $this->courier_service_model->get_courier_service_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
		$this->courier_service_model->changeStatus($courier_service_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor courier_service from trash
      * @param $courier_service_id integer
      */
     public function restore($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
		$this->courier_service_model->changeStatus($courier_service_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft courier_service from trash
      * @param $courier_service_id integer
      */
     public function draft($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
		$this->courier_service_model->changeStatus($courier_service_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish courier_service from trash
      * @param $courier_service_id integer
      */
     public function publish($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
		$this->courier_service_model->changeStatus($courier_service_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
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
						$this->courier_service_model->delete_file($file_path);$this->courier_service_model->delete(array( 'courier_service_id' => $courier_service_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$courier_service_id = $this->courier_service_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($courier_service_id){
		$courier_service_id = $this->courier_service_model->update_data($courier_service_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
