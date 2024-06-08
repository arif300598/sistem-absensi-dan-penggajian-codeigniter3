<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Laporan extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }    

    function index()
    {
        
    }
    
    
    function denda($act = null,$param = null)
    {   
        $data = array();
        $use_ajax = false;
        $this->load->model('divisi_m');
        $this->load->model('laporan_m');        
        
        $now = new DateTime();
        $year_now = $now->format("Y");
        $month_now = $now->format("m");
            
        if($act === 'default')
        {            
            $this->session->unset_userdata('denda-cari');
            $this->session->unset_userdata('tahun-denda');
            $this->session->unset_userdata('bulan-denda'); 
            $this->session->unset_userdata('divisi-denda');
            
            $a = _is_management();
            if( $a === 'TRUE' ){
                
            }else{
                $this->session->set_userdata('divisi-denda',$a); 
            }

        }else if($act === 'search')
        {            
            
            $use_ajax = true;
            if($param != null){
                $this->session->set_userdata('denda-cari',$param);    
            }else{
                $this->session->unset_userdata('denda-cari');            
            }
            
        }else if($act === 'change-filter')
        {
            //tahun-bulan-divisi
            $arr_param = explode("-",$param);
            $this->session->set_userdata('tahun-denda',$arr_param[0]);
            $this->session->set_userdata('bulan-denda',$arr_param[1]);            
            $this->session->set_userdata('divisi-denda',$arr_param[2]);
            
            $use_ajax = true;
        }else if($act === 'export_to_xl'){
            
            $this->load->helper('download');
            
            //default-----------------------------------------
            if(!$this->session->userdata('divisi-denda'))
            {
                $this->session->set_userdata('divisi-denda','all'); 
            }
            
            if(!$this->session->userdata('tahun-denda'))
            {
                $this->session->set_userdata('tahun-denda',$year_now);    
            }
            
            if(!$this->session->userdata('bulan-denda'))
            {
                $this->session->set_userdata('bulan-denda',$month_now);    
            }
            //end default-----------------------------------------
            
            //$data['username'] = $this->session->userdata('username');
            //$data['rs_divisi'] = $this->divisi_m->get_all();
            $data['rs'] = $this->laporan_m->get_denda();
            
            $content = $this->load->view('laporan/denda_export_to_xl',$data,TRUE);
            $file_name = "data_denda.xls";
            force_download($file_name,$content);
            exit(0);
        }
        
        
        //default-----------------------------------------
        if(!$this->session->userdata('divisi-denda'))
        {
            $this->session->set_userdata('divisi-denda','all'); 
        }
        
        if(!$this->session->userdata('tahun-denda'))
        {
            $this->session->set_userdata('tahun-denda',$year_now);    
        }
        
        if(!$this->session->userdata('bulan-denda'))
        {
            $this->session->set_userdata('bulan-denda',$month_now);    
        }
        //end default-----------------------------------------
        
        $data['username'] = $this->session->userdata('username');
        $data['rs_divisi'] = $this->divisi_m->get_all();
        $data['rs'] = $this->laporan_m->get_denda();
        
        if ($this->input->post('ajax') || $use_ajax)
        {
            $this->load->view('laporan/denda',$data);
            
        } else {
			
			$data['page_title'] = 'Laporan Denda';
            $data['page_name'] = 'laporan/denda';
            $this->load->view('page', $data);
        }	
        
    }

    
    function kpi($act = null,$param0 = null){   
        
        $data = array();
        $use_ajax = false;
        $this->load->model('divisi_m');
        $this->load->model('laporan_m');
        
        $now = new DateTime();
        $year_now = $now->format("Y");
        $month_now = $now->format("m");
        
        if($act === 'default')
        {            
            $this->session->unset_userdata('kpi-cari');
            $this->session->unset_userdata('tahun-kpi');            
            $this->session->unset_userdata('divisi-kpi');
            
            $a = _is_management();
            if( $a === 'TRUE' ){
                
            }else{
                $this->session->set_userdata('divisi-kpi',$a); 
            }

        }else if($act === 'search')
        {   
            $use_ajax = true;
            
            if($param0 != null){
                $this->session->set_userdata('kpi-cari',$param0);    
            }else{
                $this->session->unset_userdata('kpi-cari');            
            }
            
        }else if($act === 'change-filter')
        {
            //tahun-bulan-divisi
            $arr_param = explode("-",$param0);
            $this->session->set_userdata('tahun-kpi',$arr_param[0]);                     
            $this->session->set_userdata('divisi-kpi',$arr_param[1]);
            
            $use_ajax = true;
        }else if($act === 'export_to_xl'){
            
            $this->load->helper('download');
            
            //default-----------------------------------------
            if(!$this->session->userdata('divisi-kpi'))
            {
                $this->session->set_userdata('divisi-kpi','all'); 
            }
            
            if(!$this->session->userdata('tahun-kpi'))
            {
                $this->session->set_userdata('tahun-kpi',$year_now);    
            }
        
            //end default-----------------------------------------
            
            
            $data['rs'] = $this->laporan_m->get_kpi();
            
            $content = $this->load->view('laporan/kpi_export_to_xl',$data,TRUE);
            $file_name = "data_kpi.xls";
            force_download($file_name,$content);
            exit(0);
        }
        
          
        
        //default-----------------------------------------
        if(!$this->session->userdata('divisi-kpi'))
        {
            $this->session->set_userdata('divisi-kpi','all'); 
        }
        
        if(!$this->session->userdata('tahun-kpi'))
        {
            $this->session->set_userdata('tahun-kpi',$year_now);    
        }
        
        
        //end default-----------------------------------------
        
        $data['username'] = $this->session->userdata('username');
        $data['rs_divisi'] = $this->divisi_m->get_all();
        $data['rs'] = $this->laporan_m->get_kpi();
		
        if ($this->input->post('ajax') || $use_ajax)
        {
            $this->load->view('laporan/kpi',$data);
            
        } else {
			
			$data['page_title'] = 'Laporan KPI';
            $data['page_name'] = 'laporan/kpi';
            $this->load->view('page', $data);
            
        }	
    }
}

