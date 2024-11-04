<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Courier_services extends Public_Controller{
    
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
		$data = $this->courier_service_model->get_courier_service_list($where,TRUE, TRUE);
		 $this->data["courier_services"] = $data->courier_services;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Courier Services";
         $this->data["view"] = PUBLIC_DIR."courier_services/courier_services";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_courier_service($courier_service_id){
        
        $courier_service_id = (int) $courier_service_id;
        
        $this->data["courier_services"] = $this->courier_service_model->get_courier_service($courier_service_id);
        $this->data["title"] = "Courier Services Details";
        $this->data["view"] = PUBLIC_DIR."courier_services/view_courier_service";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------


     }        
