<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_m extends CI_Model
{
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    
    function get_denda(){
        $sess_cari = $this->session->userdata('denda-cari');
        $tahun = $this->session->userdata('tahun-denda');
        $bulan = $this->session->userdata('bulan-denda');            
        $divisi = $this->session->userdata('divisi-denda');
        
        $sql = "SELECT a.tahun,a.bulan,b.nama_lengkap,
                        b.nik,b.tgl_masuk_kerja,
                        c.nama as jabatan,
                        d.nama as divisi,
                        ((a.jml_telat_hr_biasa * a.denda_telat_hr_biasa) + (a.jml_telat_hr_besar * a.denda_telat_hr_besar)) as denda_telat,
                        a.potongan_barang,a.potongan_lain,
                        ((a.jml_telat_hr_biasa * a.denda_telat_hr_biasa) + 
                           (a.jml_telat_hr_besar * a.denda_telat_hr_besar) + 
                           a.potongan_barang + a.potongan_lain
                           ) as total
                 FROM gaji a
                 LEFT JOIN karyawan b ON a.id_karyawan = b.id
                 LEFT JOIN jabatan c ON b.id_jabatan = c.id
                 LEFT JOIN divisi d ON c.id_divisi  = d.id
                 WHERE ";
        
        if($divisi === 'all'){
            if($bulan === 'all'){
                $sql .= " (a.tahun = $tahun)";        
            }else{
                $sql .= " (a.tahun = $tahun AND a.bulan = $bulan)";        
            }
            
        }else{
            if($bulan === 'all'){
                $sql .= " (a.tahun = $tahun AND d.id = $divisi)";       
            }else{
                $sql .= " (a.tahun = $tahun AND a.bulan = $bulan AND d.id = $divisi)";       
            }            
        }
        
        if($sess_cari){
            $string_cari = str_replace("%20"," ",$sess_cari);
            $sql .= " AND (b.nama_lengkap LIKE '%$string_cari%' OR
                          d.nama LIKE '%$string_cari%' OR
                          c.nama LIKE '%$string_cari%')";
        }
        
        $sql .= " ORDER BY ((a.jml_telat_hr_biasa * a.denda_telat_hr_biasa) + 
                                (a.jml_telat_hr_besar * a.denda_telat_hr_besar) + 
                                a.potongan_barang + a.potongan_lain
                               ) DESC,b.nama_lengkap ASC";
        
        $rs = $this->db->query($sql);
        
        return $rs;
    }
    
    function kpi_for_dashboard($divisi = 'all',$tahun = 'all',$bulan = 'all'){
        
        $sql = "SELECT T1.id_karyawan,b.nik,
                        b.nama_lengkap,
                        c.nama as jabatan, 
                        d.nama as divisi,";
        if($bulan === 'all'){
            $sql .= "   ROUND(T1.Jan,2) AS Jan,
                        ROUND(T1.Feb,2) AS Feb,
                        ROUND(T1.Mar,2) AS Mar,
                        ROUND(T1.Apr,2) AS Apr,
                        ROUND(T1.Mei,2) AS Mei,
                        ROUND(T1.Jun,2) AS Jun,
                        ROUND(T1.Jul,2) AS Jul,
                        ROUND(T1.Agu,2) AS Agu,
                        ROUND(T1.Sep,2) AS Sep,
                        ROUND(T1.Okt,2) AS Okt,
                        ROUND(T1.Nov,2) AS Nov,
                        ROUND(T1.Des,2) AS Des,
                        (T1.Jan + T1.Feb + T1.Mar + T1.Apr + T1.Mei + T1.Jun + T1.Jul + T1.Agu + T1.Sep + T1.Okt + T1.Nov + T1.Des) as total,
                        ROUND(T1.rata_rata,2) AS rata_rata ";  
        }else{
          $sql .= "ROUND(T1.current_bulan,2) as current_bulan " ;
        }
        
        $sql .="       FROM (SELECT a.id_karyawan,a.tahun,";
        if($bulan === 'all'){                       
                       $sql .="SUM(CASE WHEN a.bulan = 1 THEN a.kpi ELSE 0 END) AS Jan,
                               SUM(CASE WHEN a.bulan = 2 THEN a.kpi ELSE 0 END) AS Feb,
                               SUM(CASE WHEN a.bulan = 3 THEN a.kpi ELSE 0 END) AS Mar,
                               SUM(CASE WHEN a.bulan = 4 THEN a.kpi ELSE 0 END) AS Apr,
                               SUM(CASE WHEN a.bulan = 5 THEN a.kpi ELSE 0 END) AS Mei,
                               SUM(CASE WHEN a.bulan = 6 THEN a.kpi ELSE 0 END) AS Jun,
                               SUM(CASE WHEN a.bulan = 7 THEN a.kpi ELSE 0 END) AS Jul,
                               SUM(CASE WHEN a.bulan = 8 THEN a.kpi ELSE 0 END) AS Agu,
                               SUM(CASE WHEN a.bulan = 9 THEN a.kpi ELSE 0 END) AS Sep,
                               SUM(CASE WHEN a.bulan = 10 THEN a.kpi ELSE 0 END) AS Okt,
                               SUM(CASE WHEN a.bulan = 11 THEN a.kpi ELSE 0 END) AS Nov,
                               SUM(CASE WHEN a.bulan = 12 THEN a.kpi ELSE 0 END) AS Des,
                               AVG(a.kpi) as rata_rata
                             FROM gaji a ";
        }else{
          $sql .="SUM(CASE WHEN a.bulan = $bulan THEN a.kpi ELSE 0 END) AS current_bulan 
                  FROM gaji a";
        }
        
        if($tahun !== 'all'){
              $sql .= " WHERE a.tahun = $tahun";
        } 


            $sql .="    GROUP BY a.id_karyawan
                       ) as T1
               LEFT JOIN karyawan b ON T1.id_karyawan = b.id
               LEFT JOIN jabatan c ON b.id_jabatan = c.id
               LEFT JOIN divisi d ON c.id_divisi = d.id ";
            
            if($divisi !== 'all'){
                $sql .= " WHERE d.id = $divisi ";
            }  
        
        if($bulan === 'all'){
            $sql .=" ORDER BY T1.rata_rata DESC,b.nama_lengkap ASC
                    LIMIT 1";  
        }else{
            $sql .=" ORDER BY T1.current_bulan DESC,b.nama_lengkap ASC
                    LIMIT 1";  
        }
        

        $rs = $this->db->query($sql);        
        return $rs;            
        //return $sql;            
    }

    function get_kpi(){
      
        $sess_cari = $this->session->userdata('kpi-cari');
        $tahun = $this->session->userdata('tahun-kpi');            
        $divisi = $this->session->userdata('divisi-kpi');
      
        $sql = "SELECT T1.id_karyawan,b.nik,
                        b.nama_lengkap,
                        c.nama as jabatan, 
                        d.nama as divisi,
                        ROUND(T1.Jan,2) AS Jan,
                        ROUND(T1.Feb,2) AS Feb,
                        ROUND(T1.Mar,2) AS Mar,
                        ROUND(T1.Apr,2) AS Apr,
                        ROUND(T1.Mei,2) AS Mei,
                        ROUND(T1.Jun,2) AS Jun,
                        ROUND(T1.Jul,2) AS Jul,
                        ROUND(T1.Agu,2) AS Agu,
                        ROUND(T1.Sep,2) AS Sep,
                        ROUND(T1.Okt,2) AS Okt,
                        ROUND(T1.Nov,2) AS Nov,
                        ROUND(T1.Des,2) AS Des,
                        (T1.Jan + T1.Feb + T1.Mar + T1.Apr + T1.Mei + T1.Jun + T1.Jul + T1.Agu + T1.Sep + T1.Okt + T1.Nov + T1.Des) as total,
                        ROUND(T1.rata_rata,2) AS rata_rata
               FROM (SELECT a.id_karyawan,a.tahun,
                               SUM(CASE WHEN a.bulan = 1 THEN a.kpi ELSE 0 END) AS Jan,
                               SUM(CASE WHEN a.bulan = 2 THEN a.kpi ELSE 0 END) AS Feb,
                               SUM(CASE WHEN a.bulan = 3 THEN a.kpi ELSE 0 END) AS Mar,
                               SUM(CASE WHEN a.bulan = 4 THEN a.kpi ELSE 0 END) AS Apr,
                               SUM(CASE WHEN a.bulan = 5 THEN a.kpi ELSE 0 END) AS Mei,
                               SUM(CASE WHEN a.bulan = 6 THEN a.kpi ELSE 0 END) AS Jun,
                               SUM(CASE WHEN a.bulan = 7 THEN a.kpi ELSE 0 END) AS Jul,
                               SUM(CASE WHEN a.bulan = 8 THEN a.kpi ELSE 0 END) AS Agu,
                               SUM(CASE WHEN a.bulan = 9 THEN a.kpi ELSE 0 END) AS Sep,
                               SUM(CASE WHEN a.bulan = 10 THEN a.kpi ELSE 0 END) AS Okt,
                               SUM(CASE WHEN a.bulan = 11 THEN a.kpi ELSE 0 END) AS Nov,
                               SUM(CASE WHEN a.bulan = 12 THEN a.kpi ELSE 0 END) AS Des,
                               AVG(a.kpi) as rata_rata
                       FROM gaji a
                       WHERE a.tahun = $tahun		
                       GROUP BY a.id_karyawan
                       ) as T1
               LEFT JOIN karyawan b ON T1.id_karyawan = b.id
               LEFT JOIN jabatan c ON b.id_jabatan = c.id
               LEFT JOIN divisi d ON c.id_divisi = d.id";
        
        
        
        if($divisi === 'all'){
          
            if($sess_cari){
                $string_cari = str_replace("%20"," ",$sess_cari);
                $sql .= " WHERE (b.nama_lengkap LIKE '%$string_cari%' OR c.nama LIKE '%$string_cari%' OR d.nama LIKE '%$string_cari%')";
            }
            
        }else{
          
          $sql .= " WHERE d.id = $divisi ";
        
          if($sess_cari){
              $string_cari = str_replace("%20"," ",$sess_cari);
              $sql .= " AND (b.nama_lengkap LIKE '%$string_cari%' OR c.nama LIKE '%$string_cari%' OR d.nama LIKE '%$string_cari%')";
          }
                   
        }             
        
        
        $sql .= " ORDER BY T1.rata_rata DESC,b.nama_lengkap ASC";
        
        $rs = $this->db->query($sql);        
        return $rs;
    }
}