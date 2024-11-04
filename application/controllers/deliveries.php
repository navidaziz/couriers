<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
        
class Deliveries extends Public_Controller{
    
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
		$data = $this->delivery_model->get_delivery_list($where,TRUE, TRUE);
		 $this->data["deliveries"] = $data->deliveries;
		 $this->data["pagination"] = $data->pagination;
		 $this->data["title"] = "Deliveries";
         $this->data["view"] = PUBLIC_DIR."deliveries/deliveries";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
    /**
     * get single record by id
     */
    public function view_delivery($delivery_id){
        
        $delivery_id = (int) $delivery_id;
        
        $this->data["deliveries"] = $this->delivery_model->get_delivery($delivery_id);
        $this->data["title"] = "Deliveries Details";
        $this->data["view"] = PUBLIC_DIR."deliveries/view_delivery";
        $this->load->view(PUBLIC_DIR."layout", $this->data);
    }
    //-----------------------------------------------------
    
}        
