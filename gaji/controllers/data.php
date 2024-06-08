<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - _generate_view()
 * - index()
 * Classes list:
 * - Data extends CI_Controller
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data extends MY_Controller
{
    
    function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        parent::__construct();
        //$this->session->unset_userdata('hutang-cari');
        //var_dump($this->router->class);
    }
    
    function _generate_view($data)
    {        
        $data['username'] = $this->session->userdata('username');
        $this->session->set_userdata('active_menu','DATA');        
        $this->load->view('page', $data);
    }
    
    
    function index()
    {
        
    }
    
    function user($act = null,$id = null){
                
        $data = array();
        $use_ajax = false;
        
        $this->load->model('basecrud_m');
        $this->load->model('user_m');
        $this->load->model('divisi_m');    
        
        if($act === 'simpan'){    
            
            $this->form_validation->set_rules('nik','NIK','xss_clean|required|is_unique[user.nik]');
            $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','xss_clean|required');
            $this->form_validation->set_rules('username','User Name','xss_clean|required|is_unique[user.username]');
            $this->form_validation->set_rules('id_divisi','Divisi','xss_clean|required');
            $this->form_validation->set_rules('level','Level','xss_clean|required');
            $this->form_validation->set_rules('email','Email','xss_clean|required|valid_email');
            
            if($this->form_validation->run() == TRUE){
              
              $ins['nik'] = $this->input->post('nik');
              $ins['nama_lengkap'] = $this->input->post('nama_lengkap');
              $ins['username'] = $this->input->post('username');
              $ins['userpass'] = md5($this->input->post('username'));
              $ins['id_divisi'] = $this->input->post('id_divisi');
              
              $ins['email'] = $this->input->post('email');
              
              $man_id = $this->session->userdata('id_divisi_management');
                                           
              if($ins['id_divisi'] != $man_id){
                
                $ins['level'] = $this->input->post('level');
                
                if($ins['level'] === 'custom'){
                    $ins['granted_menu'] = $this->input->post('granted_menu');  
                }else{
                    $this->db->select("granted_menu");
                    $this->db->where('nama',$ins['level']);                
                    $granted_menu = $this->db->get("template_level")->row()->granted_menu;
                    $ins['granted_menu'] = $granted_menu;  
                }
                
              }else{
                $this->db->select("granted_menu");
                $this->db->where('nama','management');                
                $granted_menu = $this->db->get("template_level")->row()->granted_menu;
                $ins['granted_menu'] = $granted_menu;
                $ins['level'] = 'full access';
              }
              
              
              $this->basecrud_m->insert('user',$ins);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
        }else if($act === 'get'){
            
            header("content-type: application/json");
            //$rs = $this->basecrud_m->get_where('user',array('id'=>$id))->row();
            $rs = $this->user_m->get_where(array('a.id'=>$id))->row();
            echo '{"id":"' . $rs->id . '",
                   "nik":"' . $rs->nik . '",
                   "nama_lengkap":"' . $rs->nama_lengkap . '",
                   "username":"' . $rs->username . '",
                   "id_divisi":"' . $rs->id_divisi .'",
                   "divisi":"' . $rs->divisi .'",
                   "level":"' . $rs->level .'",
                   "granted_menu":"' . $rs->granted_menu .'",
                   "email":"' . $rs->email .'"}';              
            exit(0);
            
        }else if($act === 'delete'){
            
            $use_ajax = true;
            //hard delete
            //$this->basecrud_m->delete('divisi',array('id'=>$id));
            
            //soft delete
            
            //$uri = $this->uri->uri_string();
            //echo "<script>alert('$uri')</script>";
            //exit(0);
            
            $this->basecrud_m->update('user',$id,array('deleted'=>'Y'));
            
            
            
        }else if($act === 'update'){
            
            $this->form_validation->set_rules('nik','NIK','xss_clean|required');
            $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','xss_clean|required');
            $this->form_validation->set_rules('username','User Name','xss_clean|required');
            $this->form_validation->set_rules('id_divisi','Divisi','xss_clean|required');
            $this->form_validation->set_rules('level','Level','xss_clean|required');
            $this->form_validation->set_rules('email','Email','xss_clean|required|valid_email');
            
            if($this->form_validation->run() == TRUE){
              
              $upd['nik'] = $this->input->post('nik');
              $upd['nama_lengkap'] = $this->input->post('nama_lengkap');
              $upd['username'] = $this->input->post('username');
              $upd['id_divisi'] = $this->input->post('id_divisi');
              
              $upd['email'] = $this->input->post('email');
              $upd['granted_menu'] = $this->input->post('granted_menu');
              
              $man_id = $this->session->userdata('id_divisi_management');
                                           
              if($upd['id_divisi'] != $man_id){
                
                 $upd['level'] = $this->input->post('level');
                 
                if($upd['level'] === 'custom'){
                    $upd['granted_menu'] = $this->input->post('granted_menu');  
                }else{
                    $this->db->select("granted_menu");
                    $this->db->where('nama',$upd['level']);                
                    $granted_menu = $this->db->get("template_level")->row()->granted_menu;                    
                    $upd['granted_menu'] = $granted_menu;  
                }
                
              }else{
                $this->db->select("granted_menu");
                $this->db->where('nama','management');                
                $granted_menu = $this->db->get("template_level")->row()->granted_menu;
                $upd['granted_menu'] = $granted_menu;
                $upd['level'] = 'full access';
              }
              
              /*
              if($upd['level'] === 'custom'){
                $upd['granted_menu'] = $this->input->post('granted_menu');  
              }else{
                $this->db->select("granted_menu");
                $this->db->where('nama',$upd['level']);                
                $granted_menu = $this->db->get("template_level")->row()->granted_menu;
                $upd['granted_menu'] = $granted_menu;  
              }
              */
              $this->basecrud_m->update('user',$id,$upd);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
            
        }
        
        $url = base_url() . 'data/user/';
		$res = $this->user_m->get(true);
        $per_page = 25;
		
		$config = paginate($url,$res,$per_page,3);
		$this->pagination->initialize($config);

        $this->user_m->limit = $per_page;
		
		if($this->uri->segment(3) == TRUE){
            $this->user_m->offset = $this->uri->segment(3);
        }else{
            $this->user_m->offset = 0;
        }
        
        $this->user_m->sort = 'nama_lengkap'; 
        $this->user_m->order = 'ASC';
        
        $data['rs'] = $this->user_m->get();
        $data['rs_divisi'] = $this->divisi_m->get_all();
        
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('data/user', $data);
            
        } else {
        
            $data['page_title'] = 'User Web';
            $data['page_name'] = 'data/user';
            $this->_generate_view($data);
        }	
    }
    
    function divisi($act = null,$id = null){
        
        $data = array();
        $use_ajax = false;
        
        $this->load->model('basecrud_m');
        $this->load->model('divisi_m');
        
        
        if($act === 'simpan'){    
            
            $this->form_validation->set_rules('nama','Nama Divisi','xss_clean|required|is_unique[divisi.nama]');
            
            if($this->form_validation->run() == TRUE){
              
              $ins['nama'] = $this->input->post('nama');              
              $this->basecrud_m->insert('divisi',$ins);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
        }else if($act === 'get'){
            
            header("content-type: application/json");
            $rs = $this->basecrud_m->get_where('divisi',array('id'=>$id))->row();
            echo '{"id":"' . $rs->id . '","nama":"' . $rs->nama . '"}';              
            exit(0);
            
        }else if($act === 'delete'){
            
            $use_ajax = true;
            //hard delete
            //$this->basecrud_m->delete('divisi',array('id'=>$id));
            
            //soft delete
            $this->basecrud_m->update('divisi',$id,array('deleted'=>'Y'));
            
        }else if($act === 'update'){
            
            $this->form_validation->set_rules('nama','Nama Divisi','xss_clean|required');
            
            if($this->form_validation->run() == TRUE){
              
              $upd['nama'] = $this->input->post('nama');              
              $this->basecrud_m->update('divisi',$id,$upd);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);              
            }
            
        }
        
        $url = base_url() . 'data/divisi/';
		$res = $this->divisi_m->get(true);
        $per_page = 50;
		
		$config = paginate($url,$res,$per_page,3);
		$this->pagination->initialize($config);

        $this->divisi_m->limit = $per_page;
		
		if($this->uri->segment(3) == TRUE){
            $this->divisi_m->offset = $this->uri->segment(3);
        }else{
            $this->divisi_m->offset = 0;
        }
        
        $this->divisi_m->sort = 'id'; 
        $this->divisi_m->order = 'ASC';
        
        $data['rs'] = $this->divisi_m->get();
        
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('data/divisi', $data);
            
        } else {
        
            $data['page_title'] = 'Divisi';
            $data['page_name'] = 'data/divisi';
            $this->_generate_view($data);
        }	
    }
    
    function jabatan($act = null,$param = null){
                
        $data = array();
        $use_ajax = false;
        
        $this->load->model('basecrud_m');
        $this->load->model('jabatan_m');
        $this->load->model('divisi_m');
        
        
        if($act === 'default'){
            
            $this->session->unset_userdata('data-cari-jabatan');
            $this->session->unset_userdata('divisi-jabatan');
            
            $a = _is_management();
            if( $a === 'TRUE' ){
                
            }else{
                $this->session->set_userdata('divisi-jabatan',$a); 
            }
            
        }else if($act === 'search'){
            $use_ajax = true;
            
            if($param != null){
                $this->session->set_userdata('data-cari-jabatan',$param);    
            }else{
                $this->session->unset_userdata('data-cari-jabatan');            
            }
            
            
        }else if($act === 'change-filter')
        {
            $use_ajax = true;
            $this->session->set_userdata('divisi-jabatan',$param);            
            
        }else if($act === 'simpan'){    
            
            $this->form_validation->set_rules('id_divisi','Divisi','xss_clean|required');
            $this->form_validation->set_rules('nama','Nama Jabatan','xss_clean|required');
            $this->form_validation->set_rules('gaji_pokok','Gaji Pokok','xss_clean|required');
            $this->form_validation->set_rules('sewa_motor','Tunjangan Sewa Motor','xss_clean');
            $this->form_validation->set_rules('bensin','Tunjangan Bensin','xss_clean');
            $this->form_validation->set_rules('service','Tunjangan Service','xss_clean');
            $this->form_validation->set_rules('voucher','Tunjangan Voucher','xss_clean');
            
            if($this->form_validation->run() == TRUE){
              
              $ins['id_divisi'] = $this->input->post('id_divisi');
              $ins['nama'] = $this->input->post('nama');
              $ins['gaji_pokok'] = $this->input->post('gaji_pokok');
              $ins['sewa_motor'] = $this->input->post('sewa_motor');
              $ins['bensin'] = $this->input->post('bensin');
              $ins['service'] = $this->input->post('service');
              $ins['voucher'] = $this->input->post('voucher');
              
              $this->basecrud_m->insert('jabatan',$ins);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
        }else if($act === 'get'){
            
            header("content-type: application/json");
            $rs = $this->basecrud_m->get_where('jabatan',array('id'=>$param))->row();
            echo '{"id":"' . $rs->id . '",
                   "id_divisi":"' . $rs->id_divisi . '",
                   "nama":"' . $rs->nama . '",
                   "gaji_pokok":"' . $rs->gaji_pokok . '",
                   "sewa_motor":"' . $rs->sewa_motor .'",
                   "bensin":"' . $rs->bensin .'",
                   "service":"' . $rs->service .'",                   
                   "voucher":"' . $rs->voucher  .'"}';              
            exit(0);
            
        }else if($act === 'delete'){
            
            $use_ajax = true;
            //hard delete
            //$this->basecrud_m->delete('divisi',array('id'=>$param));
            
            //soft delete
            $this->basecrud_m->update('jabatan',$param,array('deleted'=>'Y'));
            
        }else if($act === 'update'){
            
            $this->form_validation->set_rules('id_divisi','Divisi','xss_clean|required');
            $this->form_validation->set_rules('nama','Nama Jabatan','xss_clean|required');
            $this->form_validation->set_rules('gaji_pokok','Gaji Pokok','xss_clean|required');
            $this->form_validation->set_rules('sewa_motor','Tunjangan Sewa Motor','xss_clean');
            $this->form_validation->set_rules('bensin','Tunjangan Bensin','xss_clean');
            $this->form_validation->set_rules('service','Tunjangan Service','xss_clean');
            $this->form_validation->set_rules('voucher','Tunjangan Voucher','xss_clean');
            
            if($this->form_validation->run() == TRUE){
              
              $upd['id_divisi'] = $this->input->post('id_divisi');
              $upd['nama'] = $this->input->post('nama');
              $upd['gaji_pokok'] = $this->input->post('gaji_pokok');
              $upd['sewa_motor'] = $this->input->post('sewa_motor');
              $upd['bensin'] = $this->input->post('bensin');
              $upd['service'] = $this->input->post('service');
              $upd['voucher'] = $this->input->post('voucher');
              
              $this->basecrud_m->update('jabatan',$param,$upd);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
            
        }else if($act === 'export_to_xl'){
            
            $this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');
            
            $objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
            
            $objPHPExcel->setActiveSheetIndex(0);
			// Field names in the first row
			
            $rs = $this->jabatan_m->get('showall');
			$fields = $rs->list_fields();
			$col = 0;
			foreach ($fields as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, strtoupper($field));
				$col++;
			}
            
            // Fetching the table data
			$row = 2;
			foreach($rs->result() as $data)
			{
				$col = 0;
				foreach ($fields as $field)
				{
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    
					$col++;
				}			 
				$row++;
			}
            
            foreach(range('A','F') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
											  ->setAutoSize(true);
				
			}
            
            $objPHPExcel->getActiveSheet()->removeColumn('A',1);
            $objPHPExcel->setActiveSheetIndex(0);
	 
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="data_jabatan'.date('dMy').'.xls"');
			header('Cache-Control: max-age=0');
	 
			$objWriter->save('php://output');
            exit(0);
            
        }
        
        //default-----------------------------------------
        if(!$this->session->userdata('divisi-jabatan'))
        {
            $this->session->set_userdata('divisi-jabatan','all'); 
        }
        
        $base_link = base_url() . 'data/jabatan/'; 
        $url = ($param == null) ?  $base_link . $act . '/' : $base_link . $act . '/' . $param . '/';
        
		$res = $this->jabatan_m->get('numrows');
        $per_page = 25;
		
        $page_limit = ($param == null ? 4 : 5);
		$config = paginate($url,$res,$per_page,$page_limit);
		$this->pagination->initialize($config);

        $this->jabatan_m->limit = $per_page;
		
		if($this->uri->segment($page_limit) == TRUE){
            $this->jabatan_m->offset = $this->uri->segment($page_limit);
        }else{
            $this->jabatan_m->offset = 0;
        }
        
        $this->jabatan_m->sort = 'b.nama'; 
        $this->jabatan_m->order = 'ASC';
        
        $data['rs'] = $this->jabatan_m->get('pagging');
        $data['rs_divisi'] = $this->divisi_m->get_all();
        
        //var_dump($this->divisi_m->get_all());
        //exit(0);
        
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('data/jabatan', $data);
            
        } else {
        
            $data['page_title'] = 'User Web';
            $data['page_name'] = 'data/jabatan';
            $this->_generate_view($data);
        }	
    }
    
    
    function karyawan($act = null,$param = null){
                
        $data = array();
        $use_ajax = false;
        
        $this->load->model('basecrud_m');
        $this->load->model('karyawan_m');
        $this->load->model('jabatan_m');
        $this->load->model('divisi_m');
        
        //$this->load->model('divisi_m');
        
        
        if($act === 'default'){
            
            $this->session->unset_userdata('data-cari-karyawan');
            $this->session->unset_userdata('karyawan-show-all');
            $this->session->unset_userdata('divisi-karyawan'); 
            
            $a = _is_management();
            if( $a === 'TRUE' ){
                
            }else{
                $this->session->set_userdata('divisi-karyawan',$a); 
            }
            
        }else if($act === 'search'){
            $use_ajax = true;
            
            if($param != null){
                $this->session->set_userdata('data-cari-karyawan',$param);    
            }else{
                $this->session->unset_userdata('data-cari-karyawan');            
            }
            
            
        }else if($act === 'show_all'){
            $use_ajax = true;
            
            if(!$this->session->userdata('karyawan-show-all')){
                $this->session->set_userdata('karyawan-show-all',"false");
            }
            
            $this->session->set_userdata('karyawan-show-all',"$param");
            
            
        }else if($act === 'change-filter')
        {
            $use_ajax = true;
            $this->session->set_userdata('divisi-karyawan',$param);            
            
        }else if($act === 'simpan'){    
            
            $this->form_validation->set_rules('id_jabatan','ID Jabatan','xss_clean|required');
            $this->form_validation->set_rules('id_fingerprint','ID Fingerprint','xss_clean|required');
            $this->form_validation->set_rules('nik','NIK','xss_clean|required');
            $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','xss_clean|required');
            $this->form_validation->set_rules('tgl_masuk_kerja','Tanggal Masuk Kerja','xss_clean|required');
            
            //$this->form_validation->set_rules('status','Status','xss_clean');
            //$this->form_validation->set_rules('tgl_resign','Tanggal Resign','xss_clean');
            $this->form_validation->set_rules('no_telp','No telp','xss_clean|required');
            $this->form_validation->set_rules('alamat','Alamat','xss_clean');
            //$this->form_validation->set_rules('img_badan','Foto Badan','xss_clean');
            //$this->form_validation->set_rules('img_ktp','Foto KTP','xss_clean');
            //$this->form_validation->set_rules('bank_nama','Nama Bank','xss_clean');
            $this->form_validation->set_rules('bank_rekening','Nama Bank dan No.Rekening','xss_clean');
            
            
            $ins = array();
            
            if($this->form_validation->run() == TRUE){
              
                $upl_conf = array('upload_path'=>'./uploaded_files',
                                  'allowed_types'=>'jpeg|jpg|png',
                                  'encrypt_name'=>TRUE);
                
                
                $this->load->library('upload', $upl_conf);
                
                if(!empty($_FILES['img_badan']['name'])){
                    if (!$this->upload->do_upload('img_badan')){
                    
                    header("content-type: application/json");
                    echo json_encode(array('msg'=>$this->upload->display_errors() . ' img-badan',
                                           'status'=>'ERROR'));
              
                    exit(0);    
                    
                    
                    }else{
                        $success = $this->upload->data();
                        $ins['img_badan'] =  $success['file_name'];
                    }      
                }
               
                $this->load->library('upload', $upl_conf);
                if(!empty($_FILES['img_ktp']['name'])){
                    if (!$this->upload->do_upload('img_ktp')){
                        
                        header("content-type: application/json");
                        echo json_encode(array('msg'=>$this->upload->display_errors() . ' img-ktp',
                                               'status'=>'ERROR'));
                  
                        exit(0);    
                        
                    }else{
                        $success = $this->upload->data();
                        $ins['img_ktp'] =  $success['file_name'];
                    }  
                    
                }
              
                $ins['id_jabatan'] = $this->input->post('id_jabatan');
                $ins['id_fingerprint'] = $this->input->post('id_fingerprint');
                $ins['nama_lengkap'] = $this->input->post('nama_lengkap');
                $ins['nik'] = $this->input->post('nik');
                $ins['tgl_masuk_kerja'] = $this->input->post('tgl_masuk_kerja');
                
                //$ins['status'] = $this->input->post('status');
                //$ins['tgl_resign'] = $this->input->post('tgl_resign');
                $ins['no_telp'] = $this->input->post('no_telp');
                $ins['alamat'] = $this->input->post('alamat');
                //$ins['img_badan'] = $this->input->post('img_badan');
                //$ins['img_ktp'] = $this->input->post('img_ktp');
                //$ins['bank_nama'] = $this->input->post('bank_nama');
                $ins['bank_rekening'] = $this->input->post('bank_rekening');              
                
                $this->basecrud_m->insert('karyawan',$ins);
                
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
        }else if($act === 'get'){
            
            header("content-type: application/json");
            $rs = $this->basecrud_m->get_where('karyawan',array('id'=>$param))->row();
            echo '{"id":"' . $rs->id . '",
                   "id_jabatan":"' . $rs->id_jabatan .'",
                   "id_fingerprint":"' . $rs->id_fingerprint . '",
                   "nama_lengkap":"' . $rs->nama_lengkap . '",
                   "nik":"' . $rs->nik . '",
                   "tgl_masuk_kerja":"' . $rs->tgl_masuk_kerja . '",            
                   "status":"' . $rs->status .'",
                   "tgl_resign":"' . $rs->tgl_resign .'",
                   "no_telp":"' . $rs->no_telp .'",
                   "alamat":"' . $rs->alamat .'",
                   "img_badan":"' . $rs->img_badan .'",
                   "img_ktp":"' . $rs->img_ktp .'",                   
                   "bank_rekening":"' . $rs->bank_rekening  .'"}';              
            exit(0);
            
        }else if($act === 'delete'){
            
            $use_ajax = true;
            //hard delete
            //$this->basecrud_m->delete('divisi',array('id'=>$id));
            
            //soft delete
            $this->basecrud_m->update('karyawan',$param,array('deleted'=>'Y'));
            
        }else if($act === 'update'){
            
            $this->form_validation->set_rules('id_jabatan','ID Jabatan','xss_clean|required');
            $this->form_validation->set_rules('id_fingerprint','ID Fingerprint','xss_clean|required');
            $this->form_validation->set_rules('nik','NIK','xss_clean|required');
            $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','xss_clean|required');
            $this->form_validation->set_rules('tgl_masuk_kerja','Tanggal Masuk Kerja','xss_clean|required');
           
            $this->form_validation->set_rules('status','Status','xss_clean');
            $this->form_validation->set_rules('tgl_resign','Tanggal Resign','xss_clean');
            $this->form_validation->set_rules('no_telp','No telp','xss_clean|required');
            $this->form_validation->set_rules('alamat','Alamat','xss_clean');
            //$this->form_validation->set_rules('img_badan','Foto Badan','xss_clean');
            //$this->form_validation->set_rules('img_ktp','Foto KTP','xss_clean');
            //$this->form_validation->set_rules('bank_nama','Nama Bank','xss_clean');
            $this->form_validation->set_rules('bank_rekening','Nama Bank dan No.Rekening','xss_clean');
            
            $upd = array();
            
            if($this->form_validation->run() == TRUE){
              
                $upl_conf = array('upload_path'=>'./uploaded_files',
                                  'allowed_types'=>'jpeg|jpg|png',
                                  'encrypt_name'=>TRUE);
                
                
                $this->load->library('upload', $upl_conf);
                if(!empty($_FILES['img_badan']['name'])){
                    if (!$this->upload->do_upload('img_badan')){
                    
                    header("content-type: application/json");
                    echo json_encode(array('msg'=>$this->upload->display_errors() . ' img-badan',
                                           'status'=>'ERROR'));
              
                    exit(0);    
                    
                    
                    }else{
                        $success = $this->upload->data();
                        $upd['img_badan'] =  $success['file_name'];
                    }      
                }
               
                $this->load->library('upload', $upl_conf);
                if(!empty($_FILES['img_ktp']['name'])){
                    if (!$this->upload->do_upload('img_ktp')){
                        
                        header("content-type: application/json");
                        echo json_encode(array('msg'=>$this->upload->display_errors() . ' img-ktp',
                                               'status'=>'ERROR'));
                  
                        exit(0);    
                        
                    }else{
                        $success = $this->upload->data();
                        $upd['img_ktp'] =  $success['file_name'];
                    }  
                    
                }
                
              
              
                $upd['id_jabatan'] = $this->input->post('id_jabatan');
                $upd['id_fingerprint'] = $this->input->post('id_fingerprint');
                $upd['nik'] = $this->input->post('nik');
                $upd['nama_lengkap'] = $this->input->post('nama_lengkap');
                $upd['tgl_masuk_kerja'] = $this->input->post('tgl_masuk_kerja');
                
                $upd['status'] = $this->input->post('status');
                $upd['tgl_resign'] = $this->input->post('tgl_resign');
                $upd['no_telp'] = $this->input->post('no_telp');
                $upd['alamat'] = $this->input->post('alamat');
                //$upd['img_badan'] = $this->input->post('img_badan');
                //$upd['img_ktp'] = $this->input->post('img_ktp');
                //$upd['bank_nama'] = $this->input->post('bank_nama');
                $upd['bank_rekening'] = $this->input->post('bank_rekening');              
                
                $this->basecrud_m->update('karyawan',$param,$upd);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
            
        }else if($act === 'export_to_xl'){
            
            $this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');
            
            $objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
            
            $objPHPExcel->setActiveSheetIndex(0);
			// Field names in the first row
			
            $rs = $this->karyawan_m->get('showall');
			$fields = $rs->list_fields();
			$col = 0;
			foreach ($fields as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, strtoupper($field));
				$col++;
			}
            
            // Fetching the table data
			$row = 2;
			foreach($rs->result() as $data)
			{
				$col = 0;
				foreach ($fields as $field)
				{   
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    
					$col++;
				}			 
				$row++;
			}
            
            foreach(range('A','F') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
											  ->setAutoSize(true);
				
			}
            
            $objPHPExcel->getActiveSheet()->removeColumn('M',1);
            $objPHPExcel->getActiveSheet()->removeColumn('L',1);
            $objPHPExcel->getActiveSheet()->removeColumn('B',1);
            $objPHPExcel->getActiveSheet()->removeColumn('A',1);
            
            $objPHPExcel->setActiveSheetIndex(0);
	 
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="data_karyawan'.date('dMy').'.xls"');
			header('Cache-Control: max-age=0');
	 
			$objWriter->save('php://output');
            exit(0);
            
        }
        
        //default-----------------------------------------
        if(!$this->session->userdata('divisi-karyawan'))
        {
            $this->session->set_userdata('divisi-karyawan','all'); 
        }
        
        $base_link = base_url() . 'data/karyawan/';
        
        $url = ($param == null) ?  $base_link . $act . '/' : $base_link . $act . '/' . $param . '/';
		$res = $this->karyawan_m->get('numrows');
        $per_page = 25;
		
        $page_limit = ($param == null ? 4 : 5);
		$config = paginate($url,$res,$per_page, $page_limit);
		$this->pagination->initialize($config);

        $this->karyawan_m->limit = $per_page;
		
		if($this->uri->segment($page_limit) == TRUE){
            $this->karyawan_m->offset = $this->uri->segment($page_limit);
        }else{
            $this->karyawan_m->offset = 0;
        }
        
        $this->karyawan_m->sort = 'c.nama'; 
        $this->karyawan_m->order = 'ASC';
        
        $data['rs'] = $this->karyawan_m->get('pagging');
        $data['select_jabatan'] = $this->jabatan_m->get_all();
        $data['rs_divisi'] = $this->divisi_m->get_all();
        
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('data/karyawan', $data);
            
        } else {
        
            $data['page_title'] = 'Karyawan';
            $data['page_name'] = 'data/karyawan';
            $this->_generate_view($data);
        }	
    }   
    
    
}

