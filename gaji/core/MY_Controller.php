<?php

class MY_Controller extends CI_Controller{
  
    protected $_open_controllers = array('sign_in');
    
    public function __construct()
    {
        parent::__construct();
        
        $this->_check_auth();
    }
    
    private function _check_auth(){
      
      if(!$this->session->userdata('userid')){
            if ( ! in_array($this->router->class, $this->_open_controllers))
            {
              redirect('sign_in','reload');    
            }
      }else{
          $restricted_menu = explode(',',$this->session->userdata('restricted_menu'));
          //$uri = $this->uri->uri_string();
          //$method = $this->router->method();
          //$curr_menu = $this->db->query("SELECT id FROM menu WHERE ") ;
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');  
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
      }
      
    }
}