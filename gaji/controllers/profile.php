<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Profile extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }    

    function _generate_view($data)
    {        
        $data['username'] = $this->session->userdata('username');
        $this->session->unset_userdata('active_menu');
        $this->session->unset_userdata('active_sub');
        
        $this->load->view('page',$data);
    }
    
    function index()
    {
        if ($this->input->post('ajax')) {
            
            $this->load->view('profile');
            
        } else {
        
            $data['page_title'] = 'Profile';
            $data['page_name'] = 'profile';
            $this->_generate_view($data);
        }	
    }
    
    function loaddata(){
        
        $this->load->model('basecrud_m');
        $id = $this->session->userdata('userid');
        header("content-type: application/json");
        $rs = $this->basecrud_m->get_where('user',array('id'=>$id))->row();
        echo '{"id":"' . $rs->id . '",
               "nik":"' . $rs->nik . '",
               "img_badan":"' . $rs->img_badan . '",
               "nama_lengkap":"' . $rs->nama_lengkap . '",
               "username":"' . $rs->username . '",               
               "email":"' . $rs->email .'"}';              
        exit(0);
    }
    
    function password()
    {
        $this->load->model('basecrud_m');
        
        $id = $this->session->userdata('userid');
        
        $this->form_validation->set_rules('old_pass','Password Lama','xss_clean|required');
        $this->form_validation->set_rules('new_pass','Password Baru','xss_clean|required');
        $this->form_validation->set_rules('repeat_pass','Password Ulangan','xss_clean|required|matches[new_pass]');
        
        if($this->form_validation->run() == TRUE)
        { 
            $old_pass = $this->input->post('old_pass');
            $new_pass = $this->input->post('new_pass');
        
            $ret =  $this->basecrud_m->change_password('user',$old_pass, $new_pass);
            $msg = ($ret == TRUE) ? 'Password berhasil dirubah' : 'Password lama salah!';	
            $msg_status = ($ret == TRUE) ? 'SUCCESS' : 'ERROR';
            
            header("content-type: application/json");
            echo json_encode(array('msg'    =>  '<p>PERINGATAN !<p>' . $msg,
                                   'status' =>  $msg_status));
          
            exit(0);
            
        }else{
            header("content-type: application/json");
            echo json_encode(array('msg'    =>  '<p>PERINGATAN !<p>' . validation_errors(),
                                   'status' =>  'ERROR'));
          
            exit(0);
        }
    }
    
    function update()
    {
        
        $this->load->model('basecrud_m');
        $id = $this->session->userdata('userid');
        
        $this->form_validation->set_rules('nik','NIK','xss_clean|required');
        $this->form_validation->set_rules('nama_lengkap','Nama Lengkap','xss_clean|required');
        $this->form_validation->set_rules('username','User Name','xss_clean|required');        
        $this->form_validation->set_rules('email','Email','xss_clean|required|valid_email');
        
        $upd = array();
        if($this->form_validation->run() == TRUE){
            
            $upl_conf = array(  'upload_path'   =>  './uploaded_files',
                                'allowed_types' =>  'jpeg|jpg|png',
                                'max_width'     =>  '200',
                                'max_height'    =>  '200',
                                'encrypt_name'  =>  TRUE);
            
            
            $this->load->library('upload', $upl_conf);
            
            if(!empty($_FILES['img_badan']['name'])){
                if (!$this->upload->do_upload('img_badan')){
              
                header("content-type: application/json");
                echo json_encode(array('msg'=>$this->upload->display_errors(),
                                       'status'=>'ERROR'));
              
                exit(0);                    
                
                }else{
                    $success = $this->upload->data();
                    $upd['img_badan'] =  $success['file_name'];
                    $this->session->set_userdata('img_badan',$success['file_name']);
                }      
            }
            
            $upd['nik'] = $this->input->post('nik');
            $upd['nama_lengkap'] = $this->input->post('nama_lengkap');
            $upd['username'] = $this->input->post('username');          
            $upd['email'] = $this->input->post('email');
          
            $this->basecrud_m->update('user',$id,$upd);
            
            header("content-type: application/json");
            echo json_encode(array('msg'=>'Data telah terupdate',
                                   'status'=>'SUCCESS'));
          
            exit(0);
          
        }else{
            header("content-type: application/json");
            echo json_encode(array('msg'=>validation_errors(),
                                   'status'=>'ERROR'));
          
            exit(0);
          
        }
        
    }
}

