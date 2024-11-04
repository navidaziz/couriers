<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Deliveries extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/delivery_model");
		$this->lang->load("deliveries", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`deliveries`.`status` IN (0, 1) ";
		$data = $this->delivery_model->get_delivery_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_delivery($delivery_id){
        
        $delivery_id = (int) $delivery_id;
		$data = $this->delivery_model->get_delivery($delivery_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`deliveries`.`status` IN (2) ";
		$data = $this->delivery_model->get_delivery_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($delivery_id){
        
        $delivery_id = (int) $delivery_id;
		$this->delivery_model->changeStatus($delivery_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor delivery from trash
      * @param $delivery_id integer
      */
     public function restore($delivery_id){
        
        $delivery_id = (int) $delivery_id;
		$this->delivery_model->changeStatus($delivery_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft delivery from trash
      * @param $delivery_id integer
      */
     public function draft($delivery_id){
        
        $delivery_id = (int) $delivery_id;
		$this->delivery_model->changeStatus($delivery_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish delivery from trash
      * @param $delivery_id integer
      */
     public function publish($delivery_id){
        
        $delivery_id = (int) $delivery_id;
		$this->delivery_model->changeStatus($delivery_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a Delivery
      * @param $delivery_id integer
      */
     public function delete($delivery_id, $page_id = NULL){
        
        $delivery_id = (int) $delivery_id;
        //$this->delivery_model->changeStatus($delivery_id, "3");
        $this->delivery_model->delete(array( 'delivery_id' => $delivery_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$delivery_id = $this->delivery_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($delivery_id){
		$delivery_id = $this->delivery_model->update_data($delivery_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
