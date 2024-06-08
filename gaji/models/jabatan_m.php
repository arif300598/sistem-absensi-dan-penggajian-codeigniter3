<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan_m extends CI_Model
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
        /*
        $this->db->select("a.id,CONCAT(a.nama,' - ',b.nama) as jabatan");
        $this->db->join('divisi b','a.id_divisi = b.id','left');
        $this->db->where(array('deleted'=>'N'));
        $this->db->order_by('a.id ASC,a.nama ASC');
        return $this->db->get("jabatan a");
        */
        
        $data = array();
        $divisi = "";
        
        $a = _is_management();
        if( $a === 'TRUE' ){
           $divisi = $this->db->get_where('divisi',array('deleted'=>'N')); 
        }else{
           $divisi = $this->db->get_where('divisi',array(
                                                         'deleted'=>'N',
                                                         'id'=>$a
                                                         ));
        }
        
        
        $select_html = '<select id="id_jabatan" name="id_jabatan" class="form-control  chosen-select-deselect">';
        
        foreach ($divisi->result() as $div){
            $jabatan = $this->db->get_where('jabatan',array('id_divisi'=>$div->id,'deleted'=>'N'));
            $select_html .= '<optgroup label="'. $div->nama .'">';
            foreach($jabatan->result() as $jab){
                $select_html .= ' <option value="'. $jab->id .'">'. $jab->nama .'</option>';    
            }
            $select_html .= '</optgroup>';
        }
        $select_html .= '</select>';
        
        return $select_html;
        
    }

    /*
        tipe : pagging, numrows, showall
    */
    function get($tipe = null)
    {
        $sess_cari = $this->session->userdata('data-cari-jabatan');        
        $divisi = $this->session->userdata('divisi-jabatan');
        
        $sql = "SELECT a.id,b.nama as divisi,a.nama,a.gaji_pokok,
                       a.sewa_motor,a.bensin,a.service,a.voucher
                 FROM jabatan a
                 LEFT JOIN divisi b ON a.id_divisi = b.id
                 WHERE (a.deleted = 'N' AND b.deleted = 'N') ";
        
        
        if($divisi !== 'all'){
            $sql .= " AND (b.id = $divisi)";
        }
        
        if($sess_cari){
            $string_cari = str_replace("%20"," ",$sess_cari);
            $sql .= " AND (b.nama LIKE '%$string_cari%' OR
                           a.nama LIKE '%$string_cari%')";
        }
        
        
        $rs = null;
        
        if($tipe === 'numrows'){
            $rs =  $this->db->query($sql)->num_rows();	
        }else if($tipe === 'pagging'){
            $sql .= " ORDER BY b.nama ASC,a.nama ASC";
            $sql .= " LIMIT $this->offset,$this->limit";
            $rs =  $this->db->query($sql);
        }else if($tipe === 'showall'){
            $sql .= " ORDER BY b.nama ASC,a.nama ASC";            
            $rs =  $this->db->query($sql);
        }
        
        return $rs;
    }
    
    
}

