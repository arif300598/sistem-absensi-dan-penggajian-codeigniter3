<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('userid')) {
            redirect(base_url() . 'sign_in', 'refresh');
        }
    }
    
    function _generate_view($data)
    {		
        $data['username'] = $this->session->userdata('username');
        $this->load->view('page', $data);
    }
	
	function change($id,$value){
		
		$this->load->model('basecrud_m');
		//function update($tbl_name,$id, $data)
		
		$hari 	=	array('%27','%20','Senin'	,'Selasa'	,'Rabu'		,'Kamis'	,'Jumat'	,'Sabtu'	,'Minggu');
		$day 	= 	array("'",' ','Monday'	,'Tuesday'	,'Wednesday','Thursday'	,'Friday'	,'Saturday'	,'Sunday');
		
		$value 	= 	str_replace($hari,$day,$value);
		
		$this->basecrud_m->update('settings',$id,array('value'=>$value));		
	}
    
    function index()
    {
        $data = array();
		$this->load->model('basecrud_m');
		
		$this->session->set_userdata('active_menu','SETTINGS');
		$this->session->unset_userdata('active_sub');		
		
		$data['rs'] = $this->basecrud_m->get('settings');
		
        if ($this->input->post('ajax')) {
            $this->load->view('settings', $data);
        } else {
			
			$data['page_title'] = 'Web Settings';
            $data['page_name'] = 'settings';
            $this->_generate_view($data);
        }	
        
    }
}

