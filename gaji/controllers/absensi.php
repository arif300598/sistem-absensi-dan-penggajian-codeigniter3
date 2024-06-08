<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Absensi extends MY_Controller
{
    function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();        
        
    }    

    function index()
    {
        $data = array();
        $this->load->model('divisi_m');
        $data['username'] = $this->session->userdata('username');
        $data['rs_divisi'] = $this->divisi_m->get_all();
        		
		
        if ($this->input->post('ajax')) {
            
            $this->load->view('absensi/upload',$data);
            
        } else {
			
			$data['page_title'] = 'Upload Absensi';
            $data['page_name'] = 'absensi/upload';
            $this->load->view('page', $data);
            
        }	
    }
    
    function upload(){
        
        if(!empty($_POST)){
            
            $this->form_validation->set_rules('id_divisi','Divisi','xss_clean|required');
            
            if($this->form_validation->run() == TRUE)
			{
                $upl_conf = array('upload_path'=>'./uploaded_files',
                                  'allowed_types'=>'xls');
                $this->load->library('upload', $upl_conf);
                
                if (!$this->upload->do_upload('file_absensi')){
                    
                    header("content-type: application/json");
                    echo json_encode(array('msg'=>$this->upload->display_errors(),
                                           'status'=>'ERROR'));
              
                    exit(0);    
                    
                    
                }else{
                    //$success = $this->upload->data();
                    //$file_absensi =  $success['file_name'];
                    
                    //......................START PROCESSING HERE...............................
                    
                    include_once ( APPPATH."libraries/excel_reader2.php");
                    $xl_data = new Spreadsheet_Excel_Reader($_FILES['file_absensi']['tmp_name']);
                    
                    $id_divisi = $this->input->post('id_divisi');
                    
                    $arr_tanggal_awal = explode("/",trim($xl_data->val(2, 4)));
                    $tahun = substr($arr_tanggal_awal[2],0,4);
                    $bulan = $arr_tanggal_awal[1];
                    $tanggal_awal = $tahun . '-' . $bulan . '-' . '01';
                    
                    //delete old data's
                    $this->db->query("DELETE FROM absensi
                                      WHERE id_divisi = $id_divisi AND
                                            YEAR(tanggal) = $tahun AND
                                            MONTH(tanggal) = $bulan");
                    
                    //baris data dimulai dari baris ke 2
                    $data_insert = "";
                    
                    for ($i = 2; $i <= ($xl_data->rowcount($sheet_index=0)); $i++){
                        //Department ,	Name ,	No. ,Date/Time
                        //OUR COMPANY ,	ANSORI, 11,	01/08/2014 8:01:17                        
                        $id_fingerprint = $xl_data->val($i, 3);
                        $arr_tanggal = explode("/",trim($xl_data->val($i, 4)));
                        $tanggal = substr($arr_tanggal[2],0,4) . '-' . $arr_tanggal[1] . '-' . $arr_tanggal[0];
                        $arr_jam = explode(" ",trim($xl_data->val($i, 4)));
                        $jam_masuk = $arr_jam[1];                        
                        
                        $data_insert .= "('$tanggal',$id_divisi,$id_fingerprint,'$jam_masuk'),";              
                        
                    }
                    
                    @chmod(FCPATH . str_replace(' ','_','uploaded_files/'. $_FILES['file_absensi']['name']),0777); // CHMOD file
                    
                    $filename = FCPATH . str_replace(' ','_','uploaded_files/'. $_FILES['file_absensi']['name']);
                    
                    @unlink($filename);
                    
                    $data_insert = substr($data_insert,0, - 1);
                    $this->db->query("INSERT IGNORE INTO absensi(tanggal,id_divisi,id_fingerprint,jam_masuk)
                                      VALUES $data_insert");                    
                    
                    
                    $this->load->model('absensi_m');
                    $this->absensi_m->call_fill_calendar($tanggal_awal);
                    $this->absensi_m->update_id_karyawan();
                    
                    
                    header("content-type: application/json");
                    echo json_encode(array('msg'=>'File telah berhasil diupload',
                    				   'status'=>'SUCCESS'));
              
                    exit(0);
                } 
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
            }
			
        }
    }
    
    function ijin_karyawan($act = null,$param_0 = null, $param_1 = null,$param_2 = null){
        
        $data = array();
                
        $this->load->model('karyawan_m');
        $this->load->model('absensi_m');
        $this->load->model('basecrud_m');
        
        $data['username'] = $this->session->userdata('username');
        
        if($act === 'default'){
            
            $this->session->unset_userdata('bulan-ijin');
            $this->session->unset_userdata('tahun-ijin');
            $this->session->unset_userdata('absensi-cari-ijin');            
            
        }else if($act === 'change-bulan-tahun-ijin'){
            
            $this->session->set_userdata('bulan-ijin',$param_0);
            $this->session->set_userdata('tahun-ijin',$param_1);
            
            $use_ajax = true;
            
        }else if($act === 'search'){
            
            $use_ajax = true;
            if($param_2 != null){
                $this->session->set_userdata('absensi-cari-ijin',$param_2);    
            }else{
                $this->session->unset_userdata('absensi-cari-ijin');            
            }
            
        }else if($act === 'insert'){
            
            $this->form_validation->set_rules('id_karyawan','Nama Karyawan','xss_clean|required');
            $this->form_validation->set_rules('tgl_mulai_ijin','Tanggal Mulai Ijin','xss_clean|required');
            $this->form_validation->set_rules('tgl_selesai_ijin','Tanggal Selesai Ijin','xss_clean|required');
            $this->form_validation->set_rules('keterangan','Keterangan','xss_clean|required');
            
            $post_tgl_mulai_ijin = $this->input->post('tgl_mulai_ijin');
            $post_tgl_selesai_ijin = $this->input->post('tgl_selesai_ijin');
              
            if($this->form_validation->run() == TRUE){
              
              if(strtotime($post_tgl_selesai_ijin) < strtotime($post_tgl_mulai_ijin)){
                
                header("content-type: application/json");
                echo json_encode(array('msg'=>'Tanggal Mulai Ijin lebih BESAR dari Tanggal Selesai Ijin',
                    				   'status'=>'ERROR'));
              
                exit(0);
                
              }else{
                
                $current = $post_tgl_mulai_ijin;
                $ins = null;
                
                while(date_create($current) <= date_create($post_tgl_selesai_ijin)){
                    
                    $ins['tanggal'] = $current;
                    $ins['id_karyawan'] = $this->input->post('id_karyawan');
                    $ins['status'] = $this->input->post('status');
                    $ins['keterangan'] = $this->input->post('keterangan');                    
                
                    $this->basecrud_m->insert('absensi_ijin',$ins);
                    $current = date("Y-m-d", strtotime($current . "+1 day"));
                    
                }
                
              }           
              
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
           
            
        }else if($act === 'delete'){
            $use_ajax = true;
            //hard delete            
            $this->basecrud_m->delete('absensi_ijin',array('id'=>$param_0));            
        }
        
        
        $data['karyawan_select'] = $this->karyawan_m->get_select();
        
        $now = new DateTime();
        $year_now = $now->format("Y");
        $month_now = $now->format("m");        
        
        if(!$this->session->userdata('tahun-ijin')){
            $this->session->set_userdata('tahun-ijin',$year_now);    
        }
        
        if(!$this->session->userdata('bulan-ijin')){
            $this->session->set_userdata('bulan-ijin',$month_now);    
        }
        
        $data['rs'] = $this->absensi_m->get();
        
		//$this->session->set_userdata('active_menu','ABSENSI');
		//$this->session->set_userdata('active_sub','ABSENSI-IJIN');		
		
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('absensi/ijin_karyawan',$data);
            
        } else {
			
			$data['page_title'] = 'Ijin Karyawan';
            $data['page_name'] = 'absensi/ijin_karyawan';
            $this->load->view('page', $data);
            
        }       
        
    }
    
    function day_off($act = null,$param = null){
        
        $data = array();                
        
        $this->load->model('calendar_m');
        $this->load->model('basecrud_m');
        
        $data['username'] = $this->session->userdata('username');
        
        if($act === 'default'){
            
            $this->session->unset_userdata('bulan-day-off');
            $this->session->unset_userdata('tahun-day-off');
            $this->session->unset_userdata('cari-day-off');
            
        }else if($act === 'change-filter'){
            
            $arr_param = explode('-',$param);
            $this->session->set_userdata('bulan-day-off',$arr_param[0]);
            $this->session->set_userdata('tahun-day-off',$arr_param[1]);
            
            $use_ajax = true;
            
        }else if($act === 'search'){
            $use_ajax = true;
            if($param != null){
                $this->session->set_userdata('cari-day-off',$param);    
            }else{
                $this->session->unset_userdata('cari-day-off');            
            }
        }else if($act === 'insert'){
            
            $this->form_validation->set_rules('tanggal','Tanggal','xss_clean|required|is_unique[calendar_exception.tanggal]');
            $this->form_validation->set_rules('jenis','jenis','xss_clean|required');
            $this->form_validation->set_rules('keterangan','Keterangan','xss_clean|required');
            
            
              
            if($this->form_validation->run() == TRUE){
              
                $ins['tanggal'] = $this->input->post('tanggal');
                $ins['jenis'] = $this->input->post('jenis');                
                $ins['keterangan'] = $this->input->post('keterangan');                    
            
                $this->basecrud_m->insert('calendar_exception',$ins);              
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
           
            
        }else if($act === 'delete'){
            $use_ajax = true;
            //hard delete            
            $this->basecrud_m->delete('calendar_exception',array('id'=>$param));            
        }
        
        
        $now = new DateTime();
        $year_now = $now->format("Y");
        $month_now = $now->format("m");        
        
        if(!$this->session->userdata('tahun-day-off')){
            $this->session->set_userdata('tahun-day-off',$year_now);    
        }
        
        if(!$this->session->userdata('bulan-day-off')){
            $this->session->set_userdata('bulan-day-off',$month_now);    
        }
        
        $data['rs'] = $this->calendar_m->get();
        
		//$this->session->set_userdata('active_menu','ABSENSI');
		//$this->session->set_userdata('active_sub','ABSENSI-HARI-BESAR-LIBUR');		
		
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('absensi/day_off',$data);
            
        } else {
			
			$data['page_title'] = 'Day Off';
            $data['page_name'] = 'absensi/day_off';
            $this->load->view('page', $data);
            
        }
    }
}

