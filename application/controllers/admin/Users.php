<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Users extends Admin_Controller{
    
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
        $main_page=base_url().ADMIN_DIR.$this->router->fetch_class()."/view";
  		redirect($main_page); 
    }
    //---------------------------------------------------------------


	
    /**
     * get a list of all items that are not trashed
     */
    public function view(){
		
        $where = "`users`.`status` IN (0, 1) ";
		$data = $this->user_model->get_user_list($where);
		 $this->data["users"] = $data->users;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Users');
		$this->data["view"] = ADMIN_DIR."users/users";
		$this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_user($user_id){
        
        $user_id = (int) $user_id;
        
        $this->data["users"] = $this->user_model->get_user($user_id);
        $this->data["title"] = $this->lang->line('User Details');
		$this->data["view"] = ADMIN_DIR."users/view_user";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get a list of all trashed items
     */
    public function trashed(){
	
        $where = "`users`.`status` IN (2) ";
		$data = $this->user_model->get_user_list($where);
		 $this->data["users"] = $data->users;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = $this->lang->line('Trashed Users');
		$this->data["view"] = ADMIN_DIR."users/trashed_users";
        $this->load->view(ADMIN_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * function to send a user to trash
     */
    public function trash($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->user_model->changeStatus($user_id, "2");
        $this->session->set_flashdata("msg_success", $this->lang->line("trash_msg_success"));
        redirect(ADMIN_DIR."users/view/".$page_id);
    }
    
    /**
      * function to restor user from trash
      * @param $user_id integer
      */
     public function restore($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->user_model->changeStatus($user_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("restore_msg_success"));
        redirect(ADMIN_DIR."users/trashed/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to draft user from trash
      * @param $user_id integer
      */
     public function draft($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->user_model->changeStatus($user_id, "0");
        $this->session->set_flashdata("msg_success", $this->lang->line("draft_msg_success"));
        redirect(ADMIN_DIR."users/view/".$page_id);
     }
     //---------------------------------------------------------------------------
    
    /**
      * function to publish user from trash
      * @param $user_id integer
      */
     public function publish($user_id, $page_id = NULL){
        
        $user_id = (int) $user_id;
        
        
        $this->user_model->changeStatus($user_id, "1");
        $this->session->set_flashdata("msg_success", $this->lang->line("publish_msg_success"));
        redirect(ADMIN_DIR."users/view/".$page_id);
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
        $this->session->set_flashdata("msg_success", $this->lang->line("delete_msg_success"));
        redirect(ADMIN_DIR."users/trashed/".$page_id);
     }
     //----------------------------------------------------
    
	 
	 
     /**
      * function to add new User
      */
     public function add(){
		
    $this->data["franchises"] = $this->user_model->getList("franchises", "franchise_id", "franchise_name", $where ="`franchises`.`status` IN (1) ");
    
    $this->data["roles"] = $this->user_model->getList("roles", "role_id", "role_title", $where ="`roles`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Add New User');$this->data["view"] = ADMIN_DIR."users/add_user";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
     public function save_data(){
	  if($this->user_model->validate_form_data() === TRUE){
		  
		  $user_id = $this->user_model->save_data();
          if($user_id){
				$this->session->set_flashdata("msg_success", $this->lang->line("add_msg_success"));
                redirect(ADMIN_DIR."users/edit/$user_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."users/add");
            }
        }else{
			$this->add();
			}
	 }


     /**
      * function to edit a User
      */
     public function edit($user_id){
		 $user_id = (int) $user_id;
        $this->data["user"] = $this->user_model->get($user_id);
		  
    $this->data["franchises"] = $this->user_model->getList("franchises", "franchise_id", "franchise_name", $where ="`franchises`.`status` IN (1) ");
    
    $this->data["roles"] = $this->user_model->getList("roles", "role_id", "role_title", $where ="`roles`.`status` IN (1) ");
    
        $this->data["title"] = $this->lang->line('Edit User');$this->data["view"] = ADMIN_DIR."users/edit_user";
        $this->load->view(ADMIN_DIR."layout", $this->data);
     }
     //--------------------------------------------------------------------
	 
	 public function update_data($user_id){
		 
		 $user_id = (int) $user_id;
       
	   if($this->user_model->validate_form_data() === TRUE){
		  
		  $user_id = $this->user_model->update_data($user_id);
          if($user_id){
                
                $this->session->set_flashdata("msg_success", $this->lang->line("update_msg_success"));
                redirect(ADMIN_DIR."users/edit/$user_id");
            }else{
                
                $this->session->set_flashdata("msg_error", $this->lang->line("msg_error"));
                redirect(ADMIN_DIR."users/edit/$user_id");
            }
        }else{
			$this->edit($user_id);
			}
		 
		 }
	 
     
    /**
     * get data as a json array 
     */
    public function get_json(){
				$where = array("status" =>1);
				$where[$this->uri->segment(3)]= $this->uri->segment(4);
				$data["users"] = $this->user_model->getBy($where, false, "user_id" );
				$j_array[]=array("id" => "", "value" => "user");
				foreach($data["users"] as $user ){
					$j_array[]=array("id" => $user->user_id, "value" => "");
					}
					echo json_encode($j_array);
			
       
    }
    //-----------------------------------------------------
    
}        
