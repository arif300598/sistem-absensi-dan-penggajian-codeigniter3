<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Hutang extends MY_Controller
{
    function __construct()
    {
        parent::__construct();        
    }    

    function _generate_view($data)
    {
        
        $data['username'] = $this->session->userdata('username');            
        $this->load->view('page', $data);
    }
    
    function index($act = null,$param = null){
                
        $data = array();
        $use_ajax = false;        
        
        $this->load->model('hutang_m');
        $this->load->model('basecrud_m');
        $this->load->model('karyawan_m');
        $this->load->model('divisi_m');
        
                
        if($act ==='default'){
            
            $this->session->unset_userdata('hutang-cari');
            $this->session->unset_userdata('hutang-show-all');
            $this->session->unset_userdata('divisi-hutang');
            
            $a = _is_management();
            if( $a === 'TRUE' ){
                
            }else{
                $this->session->set_userdata('divisi-hutang',$a); 
            }
                
        }else if($act === 'search'){
            $use_ajax = true;
            
            if($param != null){
                $this->session->set_userdata('hutang-cari',$param);    
            }else{
                $this->session->unset_userdata('hutang-cari');            
            }
            
            
        }else if($act === 'show_all'){
            $use_ajax = true;
            
            if(!$this->session->userdata('hutang-show-all')){
                $this->session->set_userdata('hutang-show-all',"$param");
            }
            
            $this->session->set_userdata('hutang-show-all',"$param");
            
            
        }else if($act === 'change-filter')
        {
            $use_ajax = true;
            $this->session->set_userdata('divisi-hutang',$param);            
            
        }else if($act === 'simpan-hutang'){    
            
            $this->form_validation->set_rules('id_karyawan','Nama Karyawan','xss_clean|required');
            $this->form_validation->set_rules('tanggal','Tanggal','xss_clean|required');
            $this->form_validation->set_rules('besar','Nominal Hutang','xss_clean|required|numeric');                        
            
            if($this->form_validation->run() == TRUE){
              
              $ins['id_karyawan'] = $this->input->post('id_karyawan');
              $ins['tanggal'] = $this->input->post('tanggal');
              $ins['besar'] = $this->input->post('besar');
              
              $this->basecrud_m->insert('hutang',$ins);
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
        }else if($act === 'get-hutang-bayar'){
            
            header("content-type: application/json");
            $rs = $this->basecrud_m->get_where('hutang_bayar',array('id_hutang'=>$param),'tanggal','DESC');            
            echo '{"items":' . json_encode($rs->result()) . '}';
            exit(0);
            
        }else if($act === 'delete-hutang'){
            
            $use_ajax = true;
            //hard delete
            
            //update data hutang di tabel gaji
            $rs = $this->db->query("SELECT id FROM hutang_bayar WHERE id_hutang = $param");
            foreach($rs->result() as $r){
                $this->db->query("UPDATE gaji
                                  SET potongan_hutang = 0 ,
                                      id_hutang_bayar = NULL
                                  WHERE id_hutang_bayar = $r->id");    
            }
            
            //delete data
            $this->basecrud_m->delete('hutang_bayar',array('id_hutang'=>$param));
            $this->basecrud_m->delete('hutang',array('id'=>$param));
            
            //soft delete
            //$this->basecrud_m->update('hutang',$param,array('deleted'=>'Y'));
            
        }else if($act === 'delete-hutang-bayar'){
            //$use_ajax = true;
            $this->basecrud_m->delete('hutang_bayar',array('id'=>$param));
            exit(0);
            
        }else if($act === 'simpan-hutang-bayar'){
            
            //$this->form_validation->set_rules('id_hutang','ID Hutang','xss_clean|required');
            $this->form_validation->set_rules('tanggal','Tanggal','xss_clean|required');
            $this->form_validation->set_rules('besar','Nominal Bayar','xss_clean|required|numeric');                        
            
            if($this->form_validation->run() == TRUE){
              
              $ins['id_hutang'] = $param;
              $ins['tanggal'] = $this->input->post('tanggal');
              $ins['besar'] = $this->input->post('besar');
              
              $this->basecrud_m->insert('hutang_bayar',$ins);
              
              $status = $this->input->post('status_hutang');
              $tanggal = $this->input->post('tanggal');
              
              $arr_status = array();
              if($status === 'lunas'){
                $arr_status = array(
                                    'status'=>'lunas',
                                    'tgl_lunas'=>$tanggal
                                    );
              }else{
                $arr_status = array(
                                    'status'=>'aktif'
                                    );
              }
              
              $this->basecrud_m->update('hutang',
                                        $param,
                                        $arr_status
                                        );
              
            }else{
                header("content-type: application/json");
                echo json_encode(array('msg'=>validation_errors(),
                    				   'status'=>'ERROR'));
              
                exit(0);
              
            }
           
            
        }else if($act === 'export_to_xl'){
            
            $this->hutang_m->sort = 'a.tanggal'; 
            $this->hutang_m->order = 'DESC';
        
            $this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');
            
            $objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
            
            $objPHPExcel->setActiveSheetIndex(0);
			// Field names in the first row
			
            $rs = $this->hutang_m->get('showall');
			$fields = $rs->list_fields();
			$col = 0;
			foreach ($fields as $field)
			{
                $header = str_replace("_"," ",$field);
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, strtoupper($header));
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
            
            foreach(range('A','J') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
											  ->setAutoSize(true);
				
			}
            
            $objPHPExcel->getActiveSheet()->removeColumn('H',1);
            //$objPHPExcel->getActiveSheet()->removeColumn('L',1);
            //$objPHPExcel->getActiveSheet()->removeColumn('B',1);
            //$objPHPExcel->getActiveSheet()->removeColumn('A',1);
            
            $objPHPExcel->setActiveSheetIndex(0);
	 
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="data_hutang_karyawan'.date('dMy').'.xls"');
			header('Cache-Control: max-age=0');
	 
			$objWriter->save('php://output');
            exit(0);
            
        }
        
         //default-----------------------------------------
        if(!$this->session->userdata('divisi-hutang'))
        {
            $this->session->set_userdata('divisi-hutang','all'); 
        }
        
        $base_link = base_url() . 'hutang/index/';        
        $url = ($param == null) ?  $base_link . $act . '/' : $base_link . $act . '/' . $param . '/';
       
		$res = $this->hutang_m->get('numrows');
        $per_page = 25;
		
        $page_limit = ($param == null ? 4 : 5);
		$config = paginate($url,$res,$per_page,$page_limit);
		$this->pagination->initialize($config);

        $this->hutang_m->limit = $per_page;
		
		if($this->uri->segment($page_limit) == TRUE){
            $this->hutang_m->offset = $this->uri->segment($page_limit);
        }else{
            $this->hutang_m->offset = 0;
        }
        
        $this->hutang_m->sort = 'a.tanggal'; 
        $this->hutang_m->order = 'DESC';
        
        $data['rs'] = $this->hutang_m->get('pagging');
        $data['karyawan_select'] = $this->karyawan_m->get_select('no-hutang');
        $data['rs_divisi'] = $this->divisi_m->get_all();
        
        if ($this->input->post('ajax') || $use_ajax) {
            
            $this->load->view('hutang', $data);
            
        } else {
        
            $data['page_title'] = 'Data Hutang Karyawan';
            $data['page_name'] = 'hutang';
            $this->_generate_view($data);
        }	
    }
    
    
  
}

