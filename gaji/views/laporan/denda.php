<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
         <div class="content-panel">			
            <button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>
            <h4><i class="fa fa-angle-right"></i> Data Denda</h4>
			
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>

					 <td style="width:  150px" id="divisi-denda-row">
						<div class="input-group">						   	
						   <select class="form-control" id="divisi-denda" name="divisi-denda">
							 <?php $divisi_denda= $this->session->userdata('divisi-denda');?>
							 <option value="all">Semua Divisi</option>
							 <?php foreach($rs_divisi->result() as $divisi){ ?>
							 <option value="<?=$divisi->id;?>" <?=($divisi->id == $divisi_denda) ? 'selected':'';?> ><?=$divisi->nama;?></option>
							 <?php } ?>
						   </select>						   
						 </div>
					 </td>
					 <td style="width:  150px">
                      <div class="input-group">
                         <select class="form-control" id="tahun-denda" name="tahun-denda" style="width: 150px">
                          <?php
							  $tahun= $this->session->userdata('tahun-denda');
							  $now = new DateTime();
						      $year_now = $now->format("Y");							  
						   ?>
                          <?php for($i = 2014;$i <= $year_now;$i++){ ?>
                          <option value="<?=$i;?>" <?=($i == $tahun) ? 'selected':'';?>><?=$i;?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </td>

   					 <td style="width: 150px">
                      <div class="input-group">
                         <select class="form-control" id="bulan-denda" name="bulan-denda" style="width: 150px">                          
                          <?php $bulan= $this->session->userdata('bulan-denda');?>
                          <option value="1" <?=($bulan === "1") ? 'selected':'';?> >Januari</option>
                          <option value="2" <?=($bulan === "2") ? 'selected':'';?> >Februari</option>
                          <option value="3" <?=($bulan === "3") ? 'selected':'';?> >Maret</option>
                          <option value="4" <?=($bulan === "4") ? 'selected':'';?> >April</option>
                          <option value="5" <?=($bulan === "5") ? 'selected':'';?> >Mei</option>
                          <option value="6" <?=($bulan === "6") ? 'selected':'';?> >Juni</option>
                          <option value="7" <?=($bulan === "7") ? 'selected':'';?> >Juli</option>
                          <option value="8" <?=($bulan === "8") ? 'selected':'';?> >Agustus</option>
                          <option value="9" <?=($bulan === "9") ? 'selected':'';?> >September</option>
                          <option value="10" <?=($bulan === "10") ? 'selected':'';?> >Oktober</option>
                          <option value="11" <?=($bulan === "11") ? 'selected':'';?> >November</option>
                          <option value="12" <?=($bulan === "12") ? 'selected':'';?> >Desember</option>                          
                        </select>
                      </div>
                     </td>

					 <td style="width:  250px">
						<div class="input-group">
                          <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$this->session->userdata('denda-cari');?>" autocomplete="off">
                          <span class="input-group-btn">
                            <button id="btn-clear-search" class="btn btn-danger" ><i class="fa fa-trash-o "></i></button>   
                          </span>
						</div>
					 </td>					 
				  </tr>
			   </tbody>
			</table>

			<?php if($rs->num_rows() == 0){ ?>			
			<div class="alert alert-info">				
				<p style="text-align: center">Belum ada data / Data tidak ditemukan</p>								
			</div>
			<?php }else{ ?>
			
            <section id="no-more-tables">
               <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                     <tr>
                        <th style="width: 400px"></th>						
						<th style="width: 150px;text-align: center">Denda Telat</th>						
						<th style="width: 150px;text-align: center">Potongan Barang</th>
                        <th style="width: 150px;  text-align: center">Potongan Lainnya</th>
						<th style="text-align: center">Total</th>
                     </tr>
                  </thead>
                  <tbody>					 
				  <?php
				  
                  foreach ($rs->result() as $r) { ?>
					<tr style="background-color: #F1F1F1">                        
                        <td>
						   <?=$r->nama_lengkap;?><?=!empty($r->nik) ? ' (' . $r->nik . ')' : '';?><br>
						   <?=$r->divisi; ?> | <?=$r->jabatan; ?><br>
						</td>						
						<td><?=formatRupiah($r->denda_telat);?></td>
						<td><?=formatRupiah($r->potongan_barang);?></td>
                        <td><?=formatRupiah($r->potongan_lain);?></td>
						<td><?=formatRupiah($r->total);?></td>
                     </tr>
					<?php
                  } ?>
                     
                  </tbody>
               </table>			
            </section>
			<?php } ?>
			
         </div>
         <!-- /content-panel -->
      </div>
      <!-- /col-lg-12 -->
   </div>
   <!-- /row -->
</section>

<script>
   
    <?php
	  $a = _is_management();
	  if( $a !== 'TRUE' ){ ?>
      $('#divisi-denda-row').hide();          
	<?php } ?>
	
   $('#btn-export-excel').click(function(){	  
	  window.location = "<?php echo base_url(); ?>laporan/denda/export_to_xl";
	});
    
	function change_filter(str_param) {
		 $.ajax({
			  type: 'GET',
			  url:  '<?=base_url();?>laporan/denda/change-filter/' + str_param,
			  async: true,
			  success: function (data) {
				 $('#main-content').html(data);              
			  },
			  error:function(){
				
			  }
		 })
	}
	
    $('#tahun-denda,#bulan-denda,#divisi-denda').change(function(){
        
        var tahun = $('#tahun-denda').val();
		var bulan = $('#bulan-denda').val();        
		var divisi = $('#divisi-denda').val();
		
		var str_param = tahun + '-' + bulan + '-' + divisi;
		change_filter(str_param);        
        
    })
	
   //SEARCH ----------------------------------
   $('#btn-clear-search').on('click',function(e){
	  clear_search();
   });
   
   $('#pencarian').keypress(function(e) {
	  
	  //var tahun = <?=$this->session->userdata('tahun-gaji');?>;
	  //var bulan = <?=$this->session->userdata('bulan-gaji');?>;
	  go_find(e,'laporan/denda/search/');
	  
   });
   
</script>
