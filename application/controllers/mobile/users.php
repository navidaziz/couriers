<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Users extends Admin_Controller_Mobile{
    
    /**
     * constructor method
     */
    public function __construct(){
        
        parent::__construct();
        $this->load->model("admin/user_model");
		$this->lang->load("users", 'english');
		$this->lang->load("system", 'english');
        //$this->output->enable_profiler(TRUE);
		
    }
    


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`users`.`status` IN (0, 1) ";
		$data = $this->user_model->get_user_list($where, false);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_user($user_id){
        
        $user_id = (int) $user_id;
		$data = $this->user_model->get_user($user_id);
        echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`users`.`status` IN (2) ";
		$data = $this->user_model->get_user_list($where, true);
		 echo json_encode($data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($user_id){
        
        $user_id = (int) $user_id;
		$this->user_model->changeStatus($user_id, "2");
        $data["msg_success"] = $this->lang->line("trash_msg_success");
        echo json_encode($data);
    }
    
    /**
      * function to restor user from trash
      * @param $user_id integer
      */
     public function restore($user_id){
        
        $user_id = (int) $user_id;
		$this->user_model->changeStatus($user_id, "1");
		$data["msg_success"] = $this->lang->line("restore_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft user from trash
      * @param $user_id integer
      */
     public function draft($user_id){
        
        $user_id = (int) $user_id;
		$this->user_model->changeStatus($user_id, "0");
		$data["msg_success"] = $this->lang->line("draft_msg_success");
        echo json_encode($data);
       
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish user from trash
      * @param $user_id integer
      */
     public function publish($user_id){
        
        $user_id = (int) $user_id;
		$this->user_model->changeStatus($user_id, "1");
		$data["msg_success"] = $this->lang->line("publish_msg_success");
        echo json_encode($data);
        
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to permanently delete a User
      * @param $user_id integer
      */
     public function delete($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        //$this->user_model->changeStatus($user_id, "3");
        $this->user_model->delete(array( 'user_id' => $user_id));
		$data["msg_success"] = $this->lang->line("delete_msg_success");
        echo json_encode($data);
     }
     //----------------------------------------------------
    public function save_data(){
	
	$user_id = $this->user_model->save_data();
	$data["msg_success"] = $this->lang->line("add_msg_success");
    echo json_encode($data);
	
	 }


    
	 public function update_data($user_id){
		$user_id = $this->user_model->update_data($user_id);
		$data["msg_success"] = $this->lang->line("update_msg_success");
    	echo json_encode($data);
		
		 
		 }
	 
     
}        
