<?php
/**
 * Class and Function List:
 * Function list:
 * - __construct()
 * - insert()
 * - update()
 * - delete()
 * - get_where()
 * Classes list:
 * - Basecrud_m extends CI_Model
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @todo Description of class Basecrud_m
 * @author 
 * @version 
 * @package 
 * @subpackage 
 * @category 
 * @link 
 */
class Basecrud_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    //public $tbl_name;
    
    /**
     * @todo Description of function __construct
     * @param 
     * @return 
     */
    function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * @todo Description of function insert
     * @param  $data
     * @return 
     */
    function insert($tbl_name,$data)
    {
        $this->db->insert($tbl_name, $data);
    }
    
    
    /**
     * @todo Description of function update
     * @param  $id 
     * @param  $data
     * @return 
     */
    function update($tbl_name,$id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($tbl_name, $data);
    }
    
    
    /**
     * @todo Description of function delete
     * @param  $id
     * @return 
     */
    function delete($tbl_name,$data)
    {        
        $this->db->delete($tbl_name,$data);
    }
    
    
    /**
     * @todo Description of function get_where
     * @param  $tblname 
     * @param  $data
     * @return 
     */
    function get_where($tblname, $data,$sort = null,$order = null)
    {
        if($sort != null && $order != null){
            $this->db->order_by("$sort","$order");    
        }
        
        $rs = $this->db->get_where($tblname, $data);
        return $rs;
    }
    
    function get($tblname){
        $rs = $this->db->get($tblname);
        return $rs;
    }
    
    function change_password($tablename,$old_pass,$new_pass){
		
		$id =  $this->session->userdata('userid');
                
		$this->db->where('userpass',md5($old_pass));
        $this->db->where('id',  $id);
        $query = $this->db->get($tablename);
        
        if ($query->num_rows() > 0){
            $this->db->flush_cache();    
			
            $data['userpass'] = md5($new_pass);
            $this->db->where('id', $id);
            $this->db->update($tablename, $data);
            
            return TRUE;
        }else{
            return FALSE;
        }
	}
}

