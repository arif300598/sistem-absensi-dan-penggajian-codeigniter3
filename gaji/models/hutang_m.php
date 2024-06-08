<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Hutang_m extends CI_Model
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
    function get($tipe = false)
    {
        $sess_cari = $this->session->userdata('hutang-cari');
        $hutang_show_all = $this->session->userdata('hutang-show-all'); 
        $divisi = $this->session->userdata('divisi-hutang');
        
        $sql = "SELECT  a.id as id_hutang,
                        b.nama_lengkap,
                        c.nama as jabatan,
                        d.nama as divisi,
                        a.tanggal as tgl_hutang,
                        a.besar as besar_hutang,
                        a.status as status_hutang,
                        IF(a.status = 'lunas','default','warning') as label_css,
                        (a.besar - IFNULL(SUM(e.besar),0)) as sisa_hutang,
                        a.tgl_lunas as tgl_lunas
                FROM hutang a        
                LEFT JOIN karyawan b ON a.id_karyawan = b.id
                LEFT JOIN jabatan c ON b.id_jabatan = c.id
                LEFT JOIN divisi d ON c.id_divisi = d.id
                LEFT JOIN hutang_bayar e ON a.id = e.id_hutang
                WHERE ";
        
        $sql .= " (b.deleted = 'N' AND c.deleted = 'N' AND d.deleted = 'N')";
        
        if($divisi !== 'all'){
            $sql .= " AND (d.id = $divisi)";
        }
        
        if($hutang_show_all === 'false' || !$hutang_show_all){
            $sql .= " AND (a.status = 'aktif')";
        }
        
        if($sess_cari){
            $string_cari = str_replace("%20"," ",$sess_cari);
            $sql .= " AND (b.nama_lengkap LIKE '%$string_cari%' OR
                           c.nama LIKE '%$string_cari%' OR
                           d.nama LIKE '%$string_cari%')";
        }
        
        
        $rs = null;
        
        if($tipe === 'numrows'){
            $rs =  $this->db->query($sql)->num_rows();	     
        }else if($tipe === 'pagging'){
            $sql .= " GROUP BY a.id";
            $sql .= " ORDER BY $this->sort $this->order";
            $sql .= " LIMIT $this->offset,$this->limit";
            $rs =  $this->db->query($sql);    
        }else if($tipe === 'showall'){
            $sql .= " GROUP BY a.id";
            $sql .= " ORDER BY $this->sort $this->order";            
            $rs =  $this->db->query($sql);    
        }
        
        return $rs;
    }
    
    
}

