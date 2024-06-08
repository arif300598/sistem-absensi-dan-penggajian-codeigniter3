<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    function call_fill_calendar($start_date){
      $this->db->query("CALL fill_calendar('$start_date')");
    }
    
    function update_id_karyawan(){
      $this->db->query("UPDATE absensi a
                        LEFT JOIN karyawan b ON a.id_fingerprint = b.id_fingerprint
                        LEFT JOIN jabatan c ON b.id_jabatan = c.id
                        LEFT JOIN divisi d ON c.id_divisi = d.id
                        SET a.id_karyawan = b.id
                        WHERE d.id = a.id_divisi AND
                              b.id_fingerprint = a.id_fingerprint AND
                              a.id_karyawan IS NULL");
    }
    
    function get(){
        $this->db->select("a.id,
                           a.tanggal,
                           a.status,
                           a.keterangan,
                           b.nama_lengkap,
                           c.nama as jabatan,
                           d.nama as divisi",FALSE);
        $this->db->join("karyawan b","a.id_karyawan = b.id","left");
        $this->db->join("jabatan c","b.id_jabatan = c.id","left");
        $this->db->join("divisi d","c.id_divisi = d.id","left");
        
        $sess_absensi_cari = $this->session->userdata('absensi-cari-ijin');
        $tahun_ijin = $this->session->userdata('tahun-ijin');
        $bulan_ijin = $this->session->userdata('bulan-ijin');
        
        if($sess_absensi_cari){            
            $string_cari = str_replace("%20"," ",$sess_absensi_cari);            
            $this->db->like('b.nama_lengkap',$string_cari);
            $this->db->or_like('a.status',$string_cari);            
            $this->db->or_like('c.nama',$string_cari);
            $this->db->or_like('d.nama',$string_cari);            
        }
        
        $this->db->where(array(
                               'YEAR(a.tanggal)' => $tahun_ijin,
                               'MONTH(a.tanggal)' => $bulan_ijin,
                               'b.deleted'=>'N'
                               )
                        );
        
        $this->db->order_by("a.tanggal DESC");
        $rs =  $this->db->get("absensi_ijin a");
        
        return $rs;
    }
    
}

/*

*/