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
<style>
  td {
    text-align: center;
    vertical-align: middle;
  }
</style>
</head>
  <body>
    <table class="table table-bordered table-striped table-condensed cf">
       <thead class="cf">
          <tr>
            <th></th>						
            <th>Denda Telat</th>						
            <th>Potongan Barang</th>
            <th>Potongan Lainnya</th>
            <th>Total</th>
          </tr>
       </thead>
       <tbody>
        <?php				  
          foreach ($rs->result() as $r) { ?>
            <tr>                        
                <td>
                   <?=$r->nama_lengkap;?><?=!empty($r->nik) ? ' (' . $r->nik . ')' : '';?><br>
                   <?=$r->divisi; ?> | <?=$r->jabatan; ?><br>
                </td>						
                <td><?=formatRupiah($r->denda_telat);?></td>
                <td><?=formatRupiah($r->potongan_barang);?></td>
                <td><?=formatRupiah($r->potongan_lain);?></td>
                <td><?=formatRupiah($r->total);?></td>
             </tr>
        <?php } ?>   
       </tbody>
    </table>			
  </body>
</html>