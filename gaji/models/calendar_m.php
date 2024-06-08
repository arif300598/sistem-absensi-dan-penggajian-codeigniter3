<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendar_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    function get(){
        
        $sess_cari = $this->session->userdata('cari-day-off');
        $tahun = $this->session->userdata('tahun-day-off');
        $bulan = $this->session->userdata('bulan-day-off');
        
        $sql = "SELECT a.id,
                       a.tanggal,
                       a.jenis,
                       a.keterangan
                FROM calendar_exception a
                WHERE (YEAR(a.tanggal) = $tahun AND MONTH(a.tanggal) = $bulan) ";
        
        if($sess_cari){
            $string_cari = str_replace("%20"," ",$sess_cari);
            $sql .= " AND (a.jenis LIKE '%$string_cari%' OR
                           a.keterangan LIKE '%$string_cari%')";
        }      
        
        
        $sql .= " ORDER BY a.tanggal DESC";
        $rs = $this->db->query($sql);
        return $rs;
    }
    
}

/*

*/