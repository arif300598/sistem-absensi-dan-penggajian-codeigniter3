<?php

  function _is_management(){
    
    $CI =& get_instance();
    
    $result = "";
    
    $divisi = $CI->session->userdata('divisi');
    $nama_divisi_management = $CI->session->userdata('nama_divisi_management');
    
    if($divisi === $nama_divisi_management){
      $result = "TRUE";  
    }else{
      $divisi_ku = $CI->session->userdata('id_divisi');
      $result = $divisi_ku;
    }
    
    return $result;    
  }