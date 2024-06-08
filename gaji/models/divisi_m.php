<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Divisi_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_all(){
        $this->db->select("id,nama");        
        $this->db->where(array('deleted'=>'N'));
        return $this->db->get("divisi");	  
    }

    function get($get_numrows = false)
    {
        $this->db->select("id,nama");
        $this->db->where(array('deleted'=>'N'));
        
        $rs = null;
        
        if($get_numrows){
            $rs =  $this->db->get("divisi")->num_rows();	    
        }else{
            $this->db->order_by("$this->sort","$this->order");
            $rs =  $this->db->get("divisi", $this->limit,$this->offset);	    
        }
        
        return $rs;
    }
    
    
}

