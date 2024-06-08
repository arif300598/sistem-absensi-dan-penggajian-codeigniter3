<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
         <div class="content-panel">
            <button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>
            <h4><i class="fa fa-angle-right"></i> Data KPI</h4>
			
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>

					 <td style="width:  150px" id="divisi-kpi-row">
						<div class="input-group">						   	
						   <select class="form-control" id="divisi-kpi" name="divisi-kpi">
							 <?php $divisi_kpi= $this->session->userdata('divisi-kpi');?>
							 <option value="all">Semua Divisi</option>
							 <?php foreach($rs_divisi->result() as $divisi){ ?>
							 <option value="<?=$divisi->id;?>" <?=($divisi->id == $divisi_kpi) ? 'selected':'';?> ><?=$divisi->nama;?></option>
							 <?php } ?>
						   </select>						   
						 </div>
					 </td>
                     
					 <td style="width:  150px">
                      <div class="input-group">
                         <select class="form-control" id="tahun-kpi" name="tahun-kpi" style="width:  150px">
                          <?php
							  $tahun_kpi= $this->session->userdata('tahun-kpi');
							  $now = new DateTime();
						      $year_now = $now->format("Y");							  
						   ?>
                          <?php for($i = 2014;$i <= $year_now;$i++){ ?>
                          <option value="<?=$i;?>" <?=($i == $tahun_kpi) ? 'selected':'';?>  ><?=$i;?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </td>

					 <td style="width:  250px">
						<div class="input-group">
                          <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$this->session->userdata('kpi-cari');?>" autocomplete="off">
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
					<tr style="background-color: #F1F1F1"> 
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
                  <?php } ?>
                     
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
      $('#divisi-kpi-row').hide();          
	<?php } ?>
	
	$('#btn-export-excel').click(function(){	  
	  window.location = "<?php echo base_url(); ?>laporan/kpi/export_to_xl";
	});
	
	function change_filter(str_param) {
        $.ajax({
             type: 'GET',
             url:  '<?=base_url();?>laporan/kpi/change-filter/' + str_param,
             async: true,
             success: function (data) {
                $('#main-content').html(data);              
             },
             error:function(){
               
             }
        })
	}
	
    $('#tahun-kpi,#divisi-kpi').change(function(){
        
        var tahun = $('#tahun-kpi').val();		
		var divisi = $('#divisi-kpi').val();
		
		var str_param = tahun + '-' + divisi;
		change_filter(str_param); 
    })
   
   //SEARCH ----------------------------------
   $('#btn-clear-search').on('click',function(e){
	  clear_search();
   });
   
   $('#pencarian').keypress(function(e) {	  
	  go_find(e,'laporan/kpi/search/');
	  
   });
   
</script>
