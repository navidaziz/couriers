<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Users extends Public_Controller{
    
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
    //---------------------------------------------------------------
    
    
    /**
     * Default action to be called
     */ 
    public function index(){
        $this->view();
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`status` IN (1) ";
		$data = $this->user_model->get_user_list($where,TRUE, TRUE);
		 $this->data["users"] = $data->users;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Users";
         $this->data["view"] = PUBLIC_DIR."users/users";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_user($user_id){
        
        $user_id = (int) $user_id;
        
        $this->data["users"] = $this->user_model->get_user($user_id);
        $this->data["title"] = "Users Details";
        $this->data["view"] = PUBLIC_DIR."users/view_user";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        
