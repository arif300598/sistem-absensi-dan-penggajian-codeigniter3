<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:x='urn:schemas-microsoft-com:office:excel' xmlns='http://www.w3.org/TR/REC-html40'>
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
<!--[if gte mso 9]>
<xml>
<x:ExcelWorkbook>
<x:ExcelWorksheets>
<x:ExcelWorksheet>
<x:Name>Data Gaji</x:Name>
<x:WorksheetOptions>
<x:DisplayGridlines/>
</x:WorksheetOptions>
</x:ExcelWorksheet>
</x:ExcelWorksheets>
</x:ExcelWorkbook></xml><![endif]-->
</head>
  <body>
    <table class='table table-bordered table-striped table-condensed cf' id='tblExport'>
        <thead class='cf'>
           <tr>                                              
              <th style='width: 300px'></th>
              <th style='width: 100px;text-align: center'>Gaji Pokok</th>
              <th style='width: 50px;text-align: center'>Kerja</th>
			  <th style='text-align: center'>KPI</th>
              <th style='width: 150px;text-align: center'>Telat</th>
			  <th style="text-align: center">Tunjangan</th>	
              <th style='text-align: center'>Bonus</th>              
              <th style='text-align: center'>Potongan</th>
              <th style='text-align: center'>Gaji Diterima</th>
           </tr>
        </thead>
        <tbody>
          <?php				  
            foreach ($rs->result() as $r) { ?>            
            <tr style="background-color: #DDD">                      
                <td>
                   <?=$r->nama_lengkap;?><?=!empty($r->nik) ? ' (' . $r->nik . ')' : '';?><br>
                   <?=$r->divisi; ?> | <?=$r->jabatan; ?><br>
                   <?php
                      $today = date_create(date('Y-m-d'));
                      //$tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja . '-1 days')));
                      $tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja)));
                      $diff = date_diff($today, $tgl_masuk);
                      echo 'Masa Kerja: '.date_interval_format($diff, "%y tahun %m bulan dan %d hari");
                   ?><br>
                   
                   <?php if($r->sisa_hutang != 0 && ($r->show_hutang == 1)){ ?>
                   <span class="label label-warning">Sisa Hutang : <?=formatRupiah($r->sisa_hutang);?></span>
                   <?php } ?>
                   
                </td>
                <td><?=formatRupiah($r->gaji_pokok);?></td>
                <td style="text-align: center">
                   <?=$r->jml_hr_kerja;?>						   
                </td>
                <td><?=$r->kpi;?></td>
                <td style="text-align: right">
                   Hari Biasa: <?=$r->jml_telat_hr_biasa;?><br>
                   Hari Besar: <?=$r->jml_telat_hr_besar;?><br>
                   Denda : <?=formatRupiah($r->denda_telat);?>
                </td>
				<td><?=formatRupiah($r->tunjangan);?></td>
                <td><?=formatRupiah($r->bonus);?></td>                
                <td style="text-align: right">
                   Barang&nbsp;:&nbsp;&nbsp;&nbsp;<?=formatRupiah($r->potongan_barang);?><br>
                   Hutang :&nbsp;&nbsp;&nbsp;<?=formatRupiah($r->potongan_hutang);?><br>
                   Lainnya :&nbsp;&nbsp;&nbsp;<?=formatRupiah($r->potongan_lain);?>
                </td>
                <td>
					<?php $gaji_kotor = $r->gaji_kotor;?>
					<?php $gaji_kpi = (($r->kpi >= 100) ? $gaji_kotor: $gaji_kotor * ($r->kpi/100));?>
					<?php $gaji_bersih = ($gaji_kpi + $r->bonus + $r->tunjangan) - ($r->denda_telat + $r->potongan_barang + $r->potongan_hutang + $r->potongan_lain);?>
					<?=formatRupiah((ROUND($gaji_bersih/1000,0) * 1000));?><br>                   
                </td>
                
            </tr>
			<tr><td colspan="8" style="background-color: #DDD"></td></tr>
			<?php } ?>
                               
        </tbody>
      </table>
  </body>
</html>