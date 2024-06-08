
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		<div class="form-panel" id="panel-ijin" >
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Ijin Karyawan</h4>
			<form class="form-horizontal style-form" id="ijin-form" method="POST" action="<?php echo base_url() . 'absensi/ijin_karyawan/insert' ?>" enctype="multipart/form-data">
				
                <input type="hidden" name="ajax" value="1">
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Karyawan</label>
                  <div class="col-sm-3">	  
                    <?=$karyawan_select;?>
                  </div>
                </div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal Mulai Ijin</label>
					<div class="col-sm-10">						
						<input type="text" id="tgl_mulai_ijin" name="tgl_mulai_ijin" readonly="">
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal Selesai Ijin</label>
					<div class="col-sm-10">						
						<input type="text" id="tgl_selesai_ijin" name="tgl_selesai_ijin" readonly="">						
					</div>
				</div>
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-2">	
                    <select class="form-control" id="select_status" name="status">
                      <option value="sakit">Sakit</option>                      
                      <option value="ijin-lain">Lainnya</option>
                    </select>
                  </div>
                </div>               

                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
					<div class="col-sm-10">					
						<input class="form-control round-form" type="text" id="txt_keterangan" name="keterangan" autocomplete="off">						
					</div>
				</div>
                
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-default " type="button" id="btn-cancel">Batal</button>
						<button class="btn btn-theme" type="submit">Simpan</button>						
					</div>
				</div>
		        
			</form>
		</div>
		
         <div class="content-panel">
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-tambah">Tambah Data</button>
            <!--<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>-->
            <h4><i class="fa fa-angle-right"></i> Data Ijin Karyawan</h4>
			
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>

					 <td style="width:  150px">
                      <div class="input-group">
                         <select class="form-control" id="tahun-ijin" name="tahun-ijin" style="width:  150px">
                          <?php
							  $tahun_ijin= $this->session->userdata('tahun-ijin');
							  $now = new DateTime();
						      $year_now = $now->format("Y");							  
						   ?>
                          <?php for($i = 2014;$i <= $year_now;$i++){ ?>
                          <option value="<?=$i;?>" <?=($i == $tahun_ijin) ? 'selected':'';?>  ><?=$i;?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </td>

   					 <td style="width: 150px">
                      <div class="input-group">
                         <select class="form-control" id="bulan-ijin" name="bulan-ijin" style="width:  150px">                          
                          <?php $bulan_ijin= $this->session->userdata('bulan-ijin');?>
                          <option value="1" <?=($bulan_ijin == "1") ? 'selected':'';?> >Januari</option>
                          <option value="2" <?=($bulan_ijin == "2") ? 'selected':'';?> >Februari</option>
                          <option value="3" <?=($bulan_ijin == "3") ? 'selected':'';?> >Maret</option>
                          <option value="4" <?=($bulan_ijin == "4") ? 'selected':'';?> >April</option>
                          <option value="5" <?=($bulan_ijin == "5") ? 'selected':'';?> >Mei</option>
                          <option value="6" <?=($bulan_ijin == "6") ? 'selected':'';?> >Juni</option>
                          <option value="7" <?=($bulan_ijin == "7") ? 'selected':'';?> >Juli</option>
                          <option value="8" <?=($bulan_ijin == "8") ? 'selected':'';?> >Agustus</option>
                          <option value="9" <?=($bulan_ijin == "9") ? 'selected':'';?> >September</option>
                          <option value="10" <?=($bulan_ijin == "10") ? 'selected':'';?> >Oktober</option>
                          <option value="11" <?=($bulan_ijin == "11") ? 'selected':'';?> >November</option>
                          <option value="12" <?=($bulan_ijin == "12") ? 'selected':'';?> >Desember</option>                          
                        </select>
                      </div>
                     </td>

					 <td style="width:  250px">
						<div class="input-group">
                          <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$this->session->userdata('absensi-cari-ijin');?>" autocomplete="off">
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
                        <th style="width: 150px">Tanggal</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Nama Lengkap</th>                        
                        <th>Jenis Ijin</th>                        
                        <th>Keterangan</th>                        
						<th style="width: 70px"></th>
                     </tr>
                  </thead>
                  <tbody>					 
				  <?php
				  
                  foreach ($rs->result() as $r) { ?>
					<tr id="row_<?=$r->id;?>" style="background-color: #F1F1F1"> 
                        <td><?=tanggal_format_indonesia($r->tanggal); ?></td>
                        <td><?=$r->divisi; ?></td>
                        <td><?=$r->jabatan; ?></td>
                        <td><?=$r->nama_lengkap;?></td>
                        <td><?=$r->status;?></td>
                        <td><?=$r->keterangan; ?></td>
						<td style="text-align: center">														
							<button class="btn btn-danger btn-xs" onclick="del(<?php echo $r->id; ?>)"><i class="fa fa-trash-o "></i></button>
						</td>
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
    $('#panel-ijin').hide();
    $("#tgl_mulai_ijin").datepicker({dateFormat:'yy-mm-dd'});
    $("#tgl_selesai_ijin").datepicker({dateFormat:'yy-mm-dd'});    
	
	function del(id) {
		delete_data(id,'<?=base_url() . 'absensi/ijin_karyawan/delete/';?>');		
	}
	
    $('#tahun-ijin,#bulan-ijin').change(function(){
        
        var bulan = $('#bulan-ijin').val();
        var tahun = $('#tahun-ijin').val();
        
        $.ajax({
           type: 'GET',
           url:  '<?=base_url();?>absensi/ijin_karyawan/change-bulan-tahun-ijin/' + bulan + '/' + tahun,
           async: true,
           success: function (data) {
              $('#main-content').html(data);              
           },
           error:function(){
             
           }
        })
    })


    
	$('#btn-cancel').click(function(){
		$('.form-panel').fadeOut(500,function(){
			$('.content-panel').show();						
		});
		return false;
	});

	$('#btn-tambah').click(function(){
		$('.alert-msg').hide();
        var config = {
          '.chosen-select'           : {},
          '.chosen-select-deselect'  : {allow_single_deselect:true},
          '.chosen-select-no-single' : {disable_search_threshold:10},
          '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
          '.chosen-select-width'     : {width:"95%"}
        }
        
        for (var selector in config) {
          $(selector).chosen(config[selector]);
        }
        
		$('.content-panel').fadeOut(500,function(){
            $('#id_karyawan_chosen').css("width","350px");
            $('#panel-ijin').show();		
		});
		return false;
	});
	
	$("#ijin-form").submit(function(){
		
		var page_url = $(this).attr("action");
        
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#ijin-form').serialize(),		
			success: function (data) {				
				var status = data.status;
				var msg = data.msg;
				
				if (status === 'ERROR') {
					 $("html, body").animate({ scrollTop: 0 }, "slow");
					 $('#alert-msg').show();
					 $('#alert-msg').html(msg);
					
				}else{
					$('.form-panel').fadeOut(500,function(){
						$('#main-content').html(data);	
						$('.content-panel').show();						
					});	
				}			
	
			},
			error: function () {	
				console.error('errrorrrrr');	
			}
	
		});		
		return false;
	});
   
   //SEARCH ----------------------------------
   $('#btn-clear-search').on('click',function(e){
	  clear_search();
   });
   
   $('#pencarian').keypress(function(e) {
	  
	  var tahun = <?=$this->session->userdata('tahun-ijin');?>;
	  var bulan = <?=$this->session->userdata('bulan-ijin');?>;
	  go_find(e,'absensi/ijin_karyawan/search/' + tahun + '/' + bulan + '/');
	  
   });
   
</script>
