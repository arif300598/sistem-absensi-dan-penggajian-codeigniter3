<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - index()
 * Classes list:
 * - Sign_in extends CI_Controller
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @todo Description of class Sign_in
 * @author
 * @version
 * @package
 * @subpackage
 * @category
 * @link
 */

class Sign_in extends CI_Controller
{
    /**
     * @todo Description of function __construct
     * @param
     * @return
     */
    
    function __construct()
    {
		
        parent::__construct();
		
		if($this->session->userdata('userid')){
			redirect(base_url() ,'reload');
		}
		
        $this->load->model(array(
            'basecrud_m'
        ));
    }
    /**
     * @todo Description of function index
     * @param
     * @return
     */
    
    function index()
    {
		
        $data = array();
        
        if (!empty($_POST)) {
            $this->form_validation->set_rules('username', 'User Name', 'xss_clean|required');
            $this->form_validation->set_rules('userpass', 'Password', 'xss_clean|required');
            
            if ($this->form_validation->run() == TRUE) {
                
				$username 	= $this->input->post('username');
                $userpass	= md5($this->input->post('userpass'));
                $deleted 	= 'N';
                //$rs = $this->basecrud_m->get_where('user', $data);
				
				$this->db->select("a.id,a.nik,a.nama_lengkap,a.username,a.level,
								   a.id_divisi,b.nama as nama_divisi,a.email,a.img_badan,a.granted_menu");
				$this->db->join("divisi b","a.id_divisi = b.id","left");
				$this->db->where(array(
									   'a.username'=>	$username,
									   'a.userpass'=>	$userpass,
									   'a.deleted' => $deleted
									   )
								 );
                $rs = $this->db->get('user a');
				
                if ($rs->num_rows() != 0) {
                    
					$id = $rs->row()->id;
                    $nik = $rs->row()->nik;
                    $nama_lengkap = $rs->row()->nama_lengkap;
                    $username = $rs->row()->username;
                    $level = $rs->row()->level;
                    $email = $rs->row()->email;
					$img_badan = $rs->row()->img_badan;
					$granted_menu = $rs->row()->granted_menu;
					$divisi = $rs->row()->nama_divisi;
					$id_divisi = $rs->row()->id_divisi;
					
                    $this->session->set_userdata('userid', $id);
                    $this->session->set_userdata('nik', $nik);
                    $this->session->set_userdata('nama_lengkap', $nama_lengkap);
                    $this->session->set_userdata('username', $username);
                    $this->session->set_userdata('level', $level);
                    $this->session->set_userdata('email', $email);
					$this->session->set_userdata('img_badan', $img_badan);
					$this->session->set_userdata('granted_menu', $granted_menu);
					$this->session->set_userdata('divisi', $divisi);
					$this->session->set_userdata('id_divisi', $id_divisi);
					
					$man = $this->db->query("SELECT a.id as id,a.nama as nama FROM divisi a
											 LEFT JOIN settings b ON a.nama = b.value
											 WHERE b.name = 'divisi_management'")->row();
					$id_divisi_management = $man->id;
					$nama_divisi_management = $man->nama;
					$this->session->set_userdata('id_divisi_management', $id_divisi_management);
					$this->session->set_userdata('nama_divisi_management', $nama_divisi_management);
                    
					/*
					if($divisi !== $nama_divisi_management){
						$this->session->set_userdata('divisi_full_access', 'FALSE');
					}else{
						$this->session->set_userdata('divisi_full_access', 'TRUE');
					}
					*/
					
					header("content-type: application/json");
					echo json_encode(array('msg'=>'OK',
										   'css_class'=>'alert alert-danger'));  
					exit(0);
					
                } else {
					header("content-type: application/json");
					echo json_encode(array('msg'=>'UserName Atau Password Salah!',
										   'css_class'=>'alert alert-danger'));  
					exit(0);				
                               
                }
            } else {
				header("content-type: application/json");
				echo json_encode(array('msg'=>validation_errors(),
									   'css_class'=>'alert alert-info'));
				exit(0);
                
            }
        }
        
		
		$data['page_title'] = 'Please SignIn';
        $this->load->view('sign_in',$data);
    }
}

