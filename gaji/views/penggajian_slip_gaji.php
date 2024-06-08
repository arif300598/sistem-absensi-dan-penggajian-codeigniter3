

<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8">
      <title></title>
      <meta name="generator" content="LibreOffice 4.2.7.2 (Linux)">
      <meta name="author" content="trias ">
      <meta name="created" content="20141125;31950000000000">
      <meta name="changed" content="0;0">
      <style type="text/css">
         <!-- 
            body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Arial"; font-size:x-small }
             -->
      </style>
   </head>
   <body text="#000000">
      <!--
         <table cellspacing="0" border="0">
            <tr>
               <td>TABLE 1</td>
               <td></td>
               <td>TABLE 2</td>
            </tr>
         </table>
      
      -->
      <table cellspacing="0" border="0">
         <?php $i = 1; ?>
         <?php foreach ($rs->result() as $r) { ?>
         
         <?php
            $pengurangan_hari_absen = $r->gaji_pokok - $r->gaji_kotor;
            $gaji_kpi = (($r->kpi >= 100) ? $r->gaji_kotor: $r->gaji_kotor * ($r->kpi/100));
            $total_potongan = doubleval($r->denda_telat) + doubleval($r->potongan_barang) + doubleval($r->potongan_hutang) + doubleval($r->potongan_lain);
            $arr_bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            
            $gaji_kotor = $r->gaji_kotor;
			$gaji_kpi = (($r->kpi >= 100 || $r->kpi == 0) ? $gaji_kotor: $gaji_kotor * ($r->kpi/100));
			$gaji_bersih = ($gaji_kpi + $r->bonus + $r->tunjangan) - ($r->denda_telat + $r->potongan_barang + $r->potongan_hutang + $r->potongan_lain);
            $gaji_diterima = formatRupiah((ROUND($gaji_bersih/1000,0) * 1000));
            
            $table="
               <table cellspacing=\"0\" border=\"0\">
                  <colgroup span=\"3\" width=\"85\"></colgroup>
                  <colgroup width=\"15\"></colgroup>
                  <colgroup span=\"2\" width=\"85\"></colgroup>
                  <tbody>
                     <tr>
                        <td style=\"border-bottom: 2px solid\" colspan=\"6\" rowspan=\"2\" valign=\"middle\" align=\"center\"  height=\"34\"><b><font size=\"5\" color=\"#000000\">CV. SAWERIGADING PUTRA</b></td>
                     </tr>
                     <tr>
                     </tr>
                     <tr>
                        <td style=\"border-top: 2px solid; border-left: 2px solid; border-right: 2px solid\" colspan=\"6\" valign=\"bottom\" align=\"center\"  height=\"29\"><b><u><font size=\"4\" color=\"#000000\">SLIP PEMBAYARAN GAJI KARYAWAN</u></b></td>
                     </tr>
                     <tr>
                        <td style=\"border-bottom: 3px double ; border-left: 2px solid; border-right: 2px solid\" colspan=\"6\" valign=\"bottom\" align=\"center\"  height=\"23\"><b><font size=\"3\" color=\"#000000\">Gaji bulan : " .$arr_bulan[$r->bulan - 1] . " Tahun " .$r->tahun ."</b></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"  height=\"20\">Nama Karyawan</td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td style=\"border-right: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"><b> " . $r->nama_lengkap ."</b></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\">Jabatan</td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td style=\"border-right: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"> ". $r->jabatan ." </td>
                     </tr>
                     <tr>
                        <td style=\"border-bottom: 3px double ; border-left: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"  height=\"20\">Departemen</td>
                        <td style=\"border-bottom: 3px double\"  valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-bottom: 3px double ; border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td style=\"border-bottom: 3px double ; border-right: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"> ". $r->divisi." </td>
                     </tr>
                     <tr>
                        <td style=\"border-bottom: 3px double ; border-left: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"  height=\"20\">Gaji Pokok</td>
                        <td style=\"border-bottom: 3px double\"  valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-bottom: 3px double ; border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td style=\"border-bottom: 3px double ; border-right: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"> ". formatRupiah($r->gaji_pokok)." </td>
                     </tr>
                     
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b><br></b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>

                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><b>Hari Kerja</b></td>
                        <td valign=\"bottom\" align=\"left\"><b>(". $r->jml_hr_kerja. " x " . formatRupiah($r->gaji_per_satu_hari).  ")<br></b></td>
                        <td valign=\"bottom\" align=\"right\">" . formatRupiah($r->jml_hr_kerja * $r->gaji_per_satu_hari ). "<br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b></b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><b>KPI</b></td>
                        <td valign=\"bottom\" align=\"left\"><b>(". $r->kpi.  "%)<br></b></td>
                        <td valign=\"bottom\" align=\"right\">" . formatRupiah($gaji_kpi). "<br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b></b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"></td>
                        <td valign=\"bottom\" align=\"left\"><b><br></b></td>
                        <td valign=\"bottom\" align=\"right\"><b>GAJI AWAL</b></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"><b>" . formatRupiah($gaji_kpi). "</b><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b><br></b></td>
                        <td style=\"border-top: 2px solid; border-bottom: 2px solid\" valign=\"bottom\" align=\"center\"></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid;\" colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\"><b>Tunjangan & Bonus</b></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"center\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid; \" colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\">1.BONUS</td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"> ".formatRupiah($r->bonus)." </td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid; \" colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\">2.SEWA KENDARAAN</td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"> ".formatRupiah($r->sewa_motor)." </td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid;\" colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\">3.BENSIN</td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"> ".formatRupiah($r->bensin)." </td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"left\"  height=\"20\">4.VOUCHER</td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"> ".formatRupiah($r->voucher)." </td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid; \" colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\">5.SERVICE KENDARAAN</td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"> ".formatRupiah($r->service)." </td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b><br></b></td>
                        <td style=\"border-top: 2px solid; border-bottom: 2px solid\" valign=\"bottom\" align=\"left\"><b> ".formatRupiah(doubleval($r->tunjangan) + doubleval($r->bonus))." </b></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid;\" colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\"><b>POTONGAN</b></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\">1.TELAT</td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"> " . formatRupiah($r->denda_telat) . " </td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\">2.BARANG</td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"> " . formatRupiah($r->potongan_barang). " </td>
                     </tr>
                     
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\">3.PINJAMAN</td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"> " . formatRupiah($r->potongan_hutang)." </td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\">4.LAIN-LAIN</td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b>:</b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-right: 2px solid\" valign=\"bottom\" align=\"left\"> " . formatRupiah($r->potongan_lain)." </td>
                     </tr>
                     <tr>
                        <td style=\"border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b><br></b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-top: 2px solid; border-bottom: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><b> ".formatRupiah($total_potongan)." </b></td>
                     </tr>
                     <tr>
                        <td style=\"border-bottom: 2px solid; border-left: 2px solid\" valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td style=\"border-bottom: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-bottom: 2px solid\"  valign=\"bottom\" align=\"right\"><br></td>
                        <td style=\"border-bottom: 2px solid; border-left: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-bottom: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                        <td style=\"border-bottom: 2px solid; border-right: 2px solid\" valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td style=\"border-top: 2px solid; border-bottom: 2px solid; border-left: 2px solid\" colspan=\"4\" valign=\"bottom\" align=\"left\"  height=\"20\"><b>Total gaji bersih yang diterima :</b></td>
                        <td style=\"border-top: 2px solid; border-bottom: 2px solid; border-right: 2px solid\" colspan=\"2\" valign=\"bottom\" align=\"center\"><b> ".$gaji_diterima." </b></td>
                     </tr>
                     <tr>
                        <td valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td colspan=\"3\" valign=\"bottom\" align=\"left\"  height=\"20\"><b>ACCOUNTING</b></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"> PENERIMA </td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td colspan=\"3\" valign=\"bottom\" align=\"center\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td valign=\"bottom\" align=\"left\"  height=\"20\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                     <tr>
                        <td valign=\"bottom\" align=\"left\"  height=\"20\"> " . $r->akuntan. "</td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"right\"><br></td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                        <td valign=\"bottom\" align=\"left\"> " . $r->nama_lengkap ." </td>
                        <td valign=\"bottom\" align=\"left\"><br></td>
                     </tr>
                  </tbody>
               </table>";

         
         ?>
         
         <?php if($i&1){ ?>
         <tr>
            <td>
               <?php echo $table;?>
            </td>
            <td></td>
         <?php }else{ ?>
            <td>
               <?php echo $table;?>
            </td>
         </tr>
         <tr></tr>
         <?php } ?>
         <?php $i++;} ?>
      </table>
   </body>
</html>

