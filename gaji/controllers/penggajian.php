<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Penggajian extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }    

    function index($act = null,$param0 = null,$param1 = null)
    {   
        $data = array();
        $use_ajax = false;
        $this->load->model('divisi_m');
        $this->load->model('gaji_m');
        
        
        $now = new DateTime();
        $year_now = $now->format("Y");
        $month_now = $now->format("m");
            
        if($act === 'default')
        {
            
            $this->session->unset_userdata('gaji-cari');
            $this->session->unset_userdata('tahun-gaji');
            $this->session->unset_userdata('bulan-gaji'); 
            $this->session->unset_userdata('divisi-gaji');
            
            $a = _is_management();
            if( $a === 'TRUE' ){
                
            }else{
                $this->session->set_userdata('divisi-gaji',$a); 
            }

        }else if($act === 'search')
        {            
            
            $use_ajax = true;
            if($param0 != null){
                $this->session->set_userdata('gaji-cari',$param0);    
            }else{
                $this->session->unset_userdata('gaji-cari');            
            }
            
        }else if($act === 'change-filter')
        {
            //tahun-bulan-divisi
            $arr_param = explode("-",$param0);
            $this->session->set_userdata('tahun-gaji',$arr_param[0]);
            $this->session->set_userdata('bulan-gaji',$arr_param[1]);            
            $this->session->set_userdata('divisi-gaji',$arr_param[2]);
            
            $use_ajax = true;
        }else if($act === 'export_to_xl' || $act === 'slip_gaji' ){
            
            $this->load->helper('download');
            
            //default-----------------------------------------
            if(!$this->session->userdata('divisi-gaji'))
            {
                $this->session->set_userdata('divisi-gaji','all'); 
            }
            
            if(!$this->session->userdata('tahun-gaji'))
            {
                $this->session->set_userdata('tahun-gaji',$year_now);    
            }
            
            if(!$this->session->userdata('bulan-gaji'))
            {
                $this->session->set_userdata('bulan-gaji',$month_now);    
            }
            //end default-----------------------------------------
            
            //$data['username'] = $this->session->userdata('username');
            //$data['rs_divisi'] = $this->divisi_m->get_all();
            $data['rs'] = $this->gaji_m->get();
            
            $file_name = "";
            $content = "";
            if($act === 'export_to_xl'){
                $content = $this->load->view('penggajian_export_to_xl',$data,TRUE);
                $file_name = "data_penggajian.xls";    
            }else{
                
                $content = $this->load->view('penggajian_slip_gaji',$data,TRUE);
                $file_name = "slip_penggajian.xls";
            }
            
            force_download($file_name,$content);
            exit(0);
        }
        
        //$now = new DateTime();
        //$year_now = $now->format("Y");
        //$month_now = $now->format("m");        
        
        //default-----------------------------------------
        if(!$this->session->userdata('divisi-gaji'))
        {
            $this->session->set_userdata('divisi-gaji','all'); 
        }
        
        if(!$this->session->userdata('tahun-gaji'))
        {
            $this->session->set_userdata('tahun-gaji',$year_now);    
        }
        
        if(!$this->session->userdata('bulan-gaji'))
        {
            $this->session->set_userdata('bulan-gaji',$month_now);    
        }
        //end default-----------------------------------------
        
        $data['username'] = $this->session->userdata('username');
        $data['rs_divisi'] = $this->divisi_m->get_all();
        $data['rs'] = $this->gaji_m->get();
        
		
		
        if ($this->input->post('ajax') || $use_ajax)
        {
            $this->load->view('penggajian',$data);
            
        } else {
			
			$data['page_title'] = 'Penggajian';
            $data['page_name'] = 'penggajian';
            $this->load->view('page', $data);
            
        }	
        
    }
    
    function _clean_rupiah($rupiah){
        $remove_this = array(",", ".", " ");
        return str_replace($remove_this, "", $rupiah);
    }
    
    function update()
    {
        /*
        'jml_hr_kerja' 			: txt_jmlkerja,
        'jml_telat_hr_biasa' 	: txt_telatbiasa,
        'jml_telat_hr_besar' 	: txt_telatbesar,
        'bonus'					: txt_bonus,
        'kpi'					: txt_kpi,
        'potongan_barang'		: txt_potbarang,
        'potongan_hutang'		: txt_pothutang,
        'potongan_lain'			: txt_potlain
        */
        
        $this->load->model('basecrud_m');
        
        $id = $this->input->post('id_gaji');
        $jml_hari = $this->input->post('jml_hari');
        $gaji_pokok = $this->input->post('gaji_pokok');
        $tunjangan = $this->input->post('tunjangan');
        //$gaji_kotor = $this->input->post('gaji_kotor');
        $kpi = $this->input->post('kpi');
        $bonus = $this->_clean_rupiah($this->input->post('bonus'));
        $potongan_barang = $this->_clean_rupiah($this->input->post('potongan_barang'));
        $potongan_hutang = $this->_clean_rupiah($this->input->post('potongan_hutang'));
        $potongan_lain = $this->_clean_rupiah($this->input->post('potongan_lain'));
        $denda_telat_hr_biasa = $this->input->post('denda_telat_hr_biasa');
        $denda_telat_hr_besar = $this->input->post('denda_telat_hr_besar');
        $jml_telat_hr_biasa = $this->input->post('jml_telat_hr_biasa');
        $jml_telat_hr_besar = $this->input->post('jml_telat_hr_besar');
        $jml_hr_kerja = $this->input->post('jml_hr_kerja');
        
        $upd['jml_hr_kerja'] = $jml_hr_kerja;
        $upd['jml_telat_hr_biasa'] = $jml_telat_hr_biasa;
        $upd['jml_telat_hr_besar'] = $jml_telat_hr_besar;
        $upd['bonus'] = $bonus;
        $upd['kpi'] = $kpi;
        $upd['potongan_barang'] = $potongan_barang;
        $upd['potongan_hutang'] = $potongan_hutang;
        $upd['potongan_lain'] = $potongan_lain;
        //$upd['id_hutang_bayar'] = NULL; //lihat trigger gaji_after_update 
        
        $this->basecrud_m->update('gaji',$id,$upd);
        
        $gaji_kotor = ROUND((($gaji_pokok/$jml_hari) *  $jml_hr_kerja)/1000 ,0) * 1000;
        $gaji_kpi = (($kpi >= 100) ? $gaji_kotor : $gaji_kotor * ($kpi/100));        
        $denda_telat = (($jml_telat_hr_biasa * $denda_telat_hr_biasa) + ($jml_telat_hr_besar * $denda_telat_hr_besar));        
        $gaji_bersih = ($gaji_kpi + $bonus + $tunjangan) - ($denda_telat + $potongan_barang + $potongan_hutang + $potongan_lain);
       
        header("content-type: application/json");
        echo json_encode(array('gaji_bersih'=>formatRupiah((ROUND($gaji_bersih/1000,0) * 1000)),
                               'denda_telat'=>'Denda:' . formatRupiah($denda_telat)));
        
    }
    
    function search()
    {
        
    }
    
    function cek_gaji_list(){
        $tahun = $_GET['th'];
        $bulan = $_GET['bln'];
        $divisi = $_GET['div'];
        
         //status : OK,DATA-ABSENSI-NOT-FOUND,SUDAH-ADA
         
        $cek = $this->db->query("SELECT COUNT(tanggal) as jml FROM absensi
                                 WHERE YEAR(tanggal) = $tahun AND
                                       MONTH(tanggal) = $bulan AND
                                       id_divisi = $divisi")->row();
        
        $status = "";
        if($cek->jml == 0){
            $status = "DATA-ABSENSI-NOT-FOUND";
        }else{
            $cek = $this->db->query("SELECT COUNT(id) as jml FROM gaji
                                     WHERE tahun = $tahun AND
                                           bulan = $bulan AND
                                           id_divisi = $divisi")->row();
            if($cek->jml > 0){
                $status = "SUDAH-ADA";
            }else{
                $status = "OK";    
            }
            
        }
        
        header("content-type: application/json");
        echo json_encode(array('status'=>$status));
          
        exit(0);
    }
    
    function generate()
    {
        
        $this->form_validation->set_rules('id_divisi','Divisi','xss_clean|required');
        $this->form_validation->set_rules('tahun','Divisi','xss_clean|required');
        $this->form_validation->set_rules('bulan','Divisi','xss_clean|required');
        
        if($this->form_validation->run() == TRUE)
		{
            $this->load->model('absensi_m');
            $this->load->model('gaji_m');
            
            $id_divisi  = $this->input->post('id_divisi');
            $tahun      = $this->input->post('tahun');
            $bulan      = $this->input->post('bulan');
            
            //Generate callendar
            $this->absensi_m->call_fill_calendar($tahun . '-' . $bulan . '-' . '01');
            $this->gaji_m->call_procedure_gaji($id_divisi,$tahun,$bulan);
            
            header("content-type: application/json");
            echo json_encode(array('msg'=>'GENERATING-GAJI-SUCCESS',
                 				   'status'=>'OK'));
              
            exit(0);
                
        }else
        {
            header("content-type: application/json");
            echo json_encode(array('msg'=>validation_errors(),
                 				   'status'=>'ERROR'));
              
            exit(0);
        }
        
    }
}

