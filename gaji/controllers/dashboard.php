<?php
/**
* Class and Function List:
* Function list:
* - __construct()
* - _generate_view()
* - index()
* Classes list:
* - Dashboard extends CI_Controller
*/

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        if (!$this->session->userdata('userid')) {
            redirect(base_url() . 'sign_in', 'reload');
        }
		
		$this->session->unset_userdata('data-cari-jabatan');
        $this->session->unset_userdata('data-cari-karyawan');
		$this->session->unset_userdata('hutang-cari');
    }
    
    function _generate_view($data)
    {
		//$this->output->cache(60); // Will expire in 60 minutes
        $data['username'] = $this->session->userdata('username');
        $this->load->view('page', $data);
    }
    
    function index()
    {
        
        $data = array();
        $this->load->model(array('laporan_m','basecrud_m'));
        //data KPI rata2 terbaik, KPI terbaik tahun ini, KPI terbaik bulan ini 
        //-> buat untuk semua divisi dan current divisi
        //

        
        $a = _is_management();
        $data['curr_divisi'] = $a;
        $now = new DateTime();
        $year_now = $now->format("Y");
        $month_now = $now->format("m");        

        $data['all_divisi_all_all'] =  $this->laporan_m->kpi_for_dashboard();
        $data['all_divisi_curryear_all'] =  $this->laporan_m->kpi_for_dashboard('all',$year_now);
        $data['all_divisi_curryear_currmonth'] =  $this->laporan_m->kpi_for_dashboard('all',$year_now,$month_now);

        if( $a !== 'TRUE' ){
            //$this->session->set_userdata('divisi-karyawan',$a);         
            $data['curr_divisi_all_all'] =  $this->laporan_m->kpi_for_dashboard($a);
            $data['curr_divisi_curryear_all'] =  $this->laporan_m->kpi_for_dashboard($a,$year_now);
            $data['curr_divisi_curryear_currmonth'] =  $this->laporan_m->kpi_for_dashboard($a,$year_now,$month_now);
        }

		
        if ($this->input->post('ajax')) {
            $this->load->view('dashboard', $data);
        } else {
			
			$data['page_title'] = 'Dashboard';
            $data['page_name'] = 'dashboard';
            $this->_generate_view($data);
        }	
        
    }
}

