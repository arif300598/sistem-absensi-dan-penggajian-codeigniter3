<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    

    //tipe : pagging, numrows, showall
    function get($tipe = null)
    {
        /*, 
            CONCAT(FLOOR(PERIOD_DIFF(DATE_FORMAT(IF(a.status='aktif',NOW(),a.tgl_resign), '%Y%m'), 
            DATE_FORMAT(a.tgl_masuk_kerja, '%Y%m'))/12), ' Tahun ',
            MOD(PERIOD_DIFF(DATE_FORMAT(IF(a.status='aktif',NOW(),a.tgl_resign), '%Y%m'), 
            DATE_FORMAT(a.tgl_masuk_kerja, '%Y%m')),12), ' Bulan') AS masa_kerja */
        
        $sess_cari = $this->session->userdata('data-cari-karyawan');
        $karyawan_show_all = $this->session->userdata('karyawan-show-all'); 
        $divisi = $this->session->userdata('divisi-karyawan');
        
        $sql = "SELECT a.id, a.id_fingerprint, a.nama_lengkap,a.nik, a.tgl_masuk_kerja, 
                       b.nama AS jabatan, c.nama AS divisi, a.status, 
                       a.tgl_resign, a.no_telp, a.alamat, a.img_badan, a.img_ktp, a.bank_rekening
                FROM karyawan a       
                LEFT JOIN jabatan b ON a.id_jabatan = b.id
                LEFT JOIN divisi c ON b.id_divisi = c.id
                WHERE ";
        
        $sql .= " (a.deleted = 'N' AND b.deleted = 'N' AND c.deleted = 'N')";
        
        if($divisi !== 'all'){
            $sql .= " AND (c.id = $divisi)";
        }
        
        if($karyawan_show_all === 'false' || !$karyawan_show_all){
            $sql .= " AND (a.status = 'aktif')";
        }
        
        if($sess_cari){
            $string_cari = str_replace("%20"," ",$sess_cari);
            $sql .= " AND (a.nama_lengkap LIKE '%$string_cari%' OR
                           b.nama LIKE '%$string_cari%' OR
                           c.nama LIKE '%$string_cari%' OR
                           a.status LIKE '%$string_cari%' OR
                           a.alamat LIKE '%$string_cari%')";
        }
              
        $rs = null;
        
        if($tipe === 'numrows'){
            $rs =  $this->db->query($sql)->num_rows();	    
        }else if($tipe === 'pagging'){
            $sql .= " ORDER BY c.nama ASC,a.nama_lengkap ASC,b.nama ASC";
            $sql .= " LIMIT $this->offset,$this->limit";
            $rs =  $this->db->query($sql);	    
        }else if($tipe === 'showall'){
            $sql .= " ORDER BY c.nama ASC,a.nama_lengkap ASC,b.nama ASC";            
            $rs =  $this->db->query($sql);	    
        }
        
        return $rs;
    }
    
    function get_select($tipe = null){
          
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
        
        
        $select_html = '<select id="id_karyawan" name="id_karyawan" class="form-control chosen-select-deselect" style="width:350px">';
        
        foreach ($divisi->result() as $div){
            
            $this->db->select('a.id,a.nama_lengkap,b.nama as jabatan');
            $this->db->join('jabatan b','a.id_jabatan = b.id','left');
            $this->db->join("(SELECT COUNT(id) as cnt, 
                                     id_karyawan 
                              FROM hutang 
                              WHERE status = 'aktif'
                              GROUP BY id_karyawan) c",'a.id = c.id_karyawan','left');
            
            $filter = array();
            if($tipe === 'no-hutang'){
                $filter = array('b.id_divisi'=>$div->id,
                                'a.status'=>'aktif',
                                'a.deleted'=>'N',
                                'IFNULL(c.cnt,0)'=>'0');
            }else{
                $filter = array('b.id_divisi'=>$div->id,
                                'a.deleted'=>'N',
                                'a.status'=>'aktif');
            }
            
            $karyawan = $this->db->get_where('karyawan a',$filter);   
            
            
            $select_html .= '<optgroup label="'. $div->nama .'">';
            foreach($karyawan->result() as $r){
                $select_html .= ' <option value="'. $r->id .'">'. $r->nama_lengkap . ' (' . $r->jabatan . ')'  .'</option>';    
            }
            $select_html .= '</optgroup>';
        }
        $select_html .= '</select>';
        
        return $select_html;
    
    }
    
    
}

