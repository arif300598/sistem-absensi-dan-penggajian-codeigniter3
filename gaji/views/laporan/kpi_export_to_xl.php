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
             <th style="text-align: center">Jan</th>
             <th style="text-align: center">Feb</th>						
             <th style="text-align: center">Mar</th>
             <th style="text-align: center">Apr</th>
             <th style="text-align: center">Mei</th>
             <th style="text-align: center">Jun</th>
             <th style="text-align: center">Jul</th>
             <th style="text-align: center">Agu</th>
             <th style="text-align: center">Sep</th>
             <th style="text-align: center">Okt</th>
             <th style="text-align: center">Nov</th>
             <th style="text-align: center">Des</th>
             <th style="text-align: center">Rata-Rata</th>
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
           <td style="text-align: center"><?=$r->Jan; ?></td>
           <td style="text-align: center"><?=$r->Feb; ?></td>
           <td style="text-align: center"><?=$r->Mar; ?></td>
           <td style="text-align: center"><?=$r->Apr; ?></td>
           <td style="text-align: center"><?=$r->Mei; ?></td>
           <td style="text-align: center"><?=$r->Jun; ?></td>
           <td style="text-align: center"><?=$r->Jul; ?></td>
           <td style="text-align: center"><?=$r->Agu; ?></td>
           <td style="text-align: center"><?=$r->Sep; ?></td>
           <td style="text-align: center"><?=$r->Okt; ?></td>
           <td style="text-align: center"><?=$r->Nov; ?></td>
           <td style="text-align: center"><?=$r->Des; ?></td>
           <td style="text-align: center"><?=$r->rata_rata; ?></td>
         </tr>
         <tr><td colspan="14"></td></tr>
       <?php } ?>
          
       </tbody>
    </table>			

  </body>
</html>