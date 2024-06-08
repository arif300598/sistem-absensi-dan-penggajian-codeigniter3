<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model
{    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    

    function get($get_numrows = false)
    {
        $this->db->select("a.id,a.nik,a.nama_lengkap,a.username,
                           b.nama as divisi,b.id as id_divisi,
                           a.level,a.email");
        $this->db->join("divisi b","a.id_divisi = b.id","left");
        $this->db->where(array('a.deleted'=>'N'));
        
        $rs = null;
        
        if($get_numrows){
            $rs =  $this->db->get("user a")->num_rows();	    
        }else{
            $this->db->order_by("$this->sort","$this->order");
            $rs =  $this->db->get("user a", $this->limit,$this->offset);	    
        }
        
        return $rs;
    }
    
    function get_where($data){
        
        $this->db->select("a.id,a.nik,a.nama_lengkap,a.username,a.granted_menu,
                           b.nama as divisi,b.id as id_divisi,
                           a.level,a.email");
        $this->db->join("divisi b","a.id_divisi = b.id","left");
        $rs = $this->db->get_where("user a", $data);
        return $rs;
        
    }
    

    
    
}

