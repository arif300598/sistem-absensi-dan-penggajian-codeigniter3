<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gaji_m extends CI_Model
{
    
    public $limit;
    public $offset;
    public $sort;
    public $order;
    
    function __construct()
    {
        parent::__construct();
    }
    

    function call_procedure_gaji($id_divisi,$tahun,$bulan){
      $this->db->query("CALL procedure_gaji($id_divisi,$tahun,$bulan)");
    }
    
    function get($get_numrows = false)
    {
       
        
        /***/
        $sess_gaji_cari = $this->session->userdata('gaji-cari');
        $tahun_gaji = $this->session->userdata('tahun-gaji');
        $bulan_gaji = $this->session->userdata('bulan-gaji');        
        $divisi_gaji = $this->session->userdata('divisi-gaji');
        
        //$denda_telat_hr_biasa = $this->db->query("SELECT value FROM settings WHERE name='denda_telat_biasa'")->row()->value;
		//$denda_telat_hr_besar = $this->db->query("SELECT value FROM settings WHERE name='denda_telat_besar'")->row()->value;
                  
        $sql = " SELECT a.id,
                        a.bulan,a.tahun,    
                        b.nama_lengkap,
                        b.nik,b.tgl_masuk_kerja,
                        REPLACE(a.jabatan,'\'','') as jabatan,
                        a.id_divisi,
                        REPLACE(a.divisi,'\'','') as divisi,
                        a.gaji_pokok,
                        a.sewa_motor,
                        a.service,
                        a.voucher,
                        a.bensin,
                        (a.sewa_motor + a.service + a.voucher + a.bensin) as tunjangan,
                        a.kpi,a.bonus,
                        a.jml_hr_kerja,a.jml_hr_absen,
                        a.jml_telat_hr_biasa,a.jml_telat_hr_besar,
                        ((a.jml_telat_hr_biasa * a.denda_telat_hr_biasa) + (a.jml_telat_hr_besar * a.denda_telat_hr_besar)) as denda_telat,
                        a.denda_telat_hr_biasa,a.denda_telat_hr_besar,
                        a.potongan_barang,a.potongan_hutang,a.bonus,
                        a.potongan_lain,
                        IFNULL(c.besar - IFNULL(c.besar_bayar,0),0) as sisa_hutang,
                        c.tanggal as tanggal_hutang,
                        ('$tahun_gaji-$bulan_gaji-01' >= c.tanggal) as show_hutang,
                        (DAY(LAST_DAY('$tahun_gaji-$bulan_gaji-01'))) as jml_hari,
                        (a.gaji_pokok/DAY(LAST_DAY('$tahun_gaji-$bulan_gaji-01'))) as gaji_per_satu_hari,
                        (
                            (
                                ROUND(
                                        ((a.gaji_pokok/DAY(LAST_DAY('$tahun_gaji-$bulan_gaji-01'))) *  a.jml_hr_kerja)/1000 ,0
                                     ) * 1000
                            )
                        ) as gaji_kotor,
                        d.akuntan
                FROM gaji a
                LEFT JOIN karyawan b ON a.id_karyawan = b.id                
                LEFT JOIN (SELECT a.tanggal,a.id_karyawan,a.besar,SUM(b.besar) as besar_bayar
                                     FROM hutang a
                                     LEFT JOIN hutang_bayar b ON a.id = id_hutang
                                     WHERE a.status = 'aktif'
                                     GROUP BY a.id

                                     ) c ON a.id_karyawan = c.id_karyawan
                LEFT JOIN (SELECT a.nama_lengkap as akuntan,b.nama as divisi,b.id as id_divisi
                           FROM user a
                           LEFT JOIN divisi b ON a.id_divisi = b.id
                           WHERE level = 'accounting') d ON a.id_divisi = d.id_divisi                     
                WHERE ";
        
        if($divisi_gaji === 'all'){
            $sql .= " (a.tahun = $tahun_gaji AND a.bulan = $bulan_gaji)";    
        }else{            
            $sql .= " (a.tahun = $tahun_gaji AND a.bulan = $bulan_gaji AND a.id_divisi = $divisi_gaji)";   
        }
        
        if($sess_gaji_cari){
            $string_cari = str_replace("%20"," ",$sess_gaji_cari);
            $sql .= " AND (b.nama_lengkap LIKE '%$string_cari%' OR a.jabatan LIKE '%$string_cari%' OR a.divisi LIKE '%$string_cari%')";
        }
        
        if($divisi_gaji === 'all'){
            $sql .= " ORDER BY a.divisi ASC,b.nama_lengkap ASC,a.jabatan ASC";    
        }else{
            $sql .= " ORDER BY b.nama_lengkap ASC";
        }
        
        $rs = $this->db->query($sql);
        
        return $rs;
    }
    
    
    
}

