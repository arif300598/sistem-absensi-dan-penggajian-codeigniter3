<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	

		<div class="form-panel" id="panel-hutang" >
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Warning!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Hutang</h4>
			<form class="form-horizontal style-form" id="hutang-form" method="POST" action="<?=base_url() . 'hutang/index/simpan-hutang'?>">
				
                <input type="hidden" name="ajax" value="1">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Karyawan</label>
                  <div class="col-sm-3">	  
                    <?=$karyawan_select;?>
                  </div>
                </div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal Hutang</label>
					<div class="col-sm-10">						
						<input type="text" class="form-control round-form" style="width: 150px" id="tgl_hutang" name="tanggal" readonly="">						
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Nominal</label>
					<div class="col-sm-4">						
						<input class="form-control round-form" type="text" id="txt_besar" name="besar" autocomplete="off">						
					</div>
				</div>
                
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-default " type="button" id="btn-cancel">Cancel</button>
						<button class="btn btn-theme" type="submit">Submit</button>						
					</div>
				</div>
		        
			</form>
		</div>
		
		 <div class="form-panel" id="panel-bayar-hutang" style="display:none">
			<div id="alert-msg-bayar" class="alert alert-danger" style="display:none;">
				<b>Warning!</b><br>msg
			</div>
			
			<h4 class="mb" id="nama-bayar"><i class="fa fa-angle-right"></i> Form Bayar</h4>
			<form class="form-horizontal style-form" id="bayar-hutang-form" method="POST" action="<?=base_url() . 'hutang/index/simpan-hutang-bayar'?>">
				
                <input type="hidden" name="ajax" value="1">
			    <input type="hidden" id="sisa_hutang" name="sisa" value="">
			    <input type="hidden" id="status_hutang" name="status_hutang" value="aktif">
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal Bayar</label>
					<div class="col-sm-10">						
						<input type="text" class="form-control round-form" style="width: 150px" id="tgl_hutang_bayar" name="tanggal" readonly="">						
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Nominal</label>
					<div class="col-sm-4">						
						<input class="form-control round-form" type="text" id="txt_besar_bayar" name="besar" autocomplete="off">
						<span class="help-block" id="label-sisa-hutang"></span>
					</div>
				</div>
                
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-default " type="button" id="btn-cancel-bayar">Cancel</button>
						<button class="btn btn-theme" type="submit">Submit</button>						
					</div>
				</div>
		        
			</form>
		</div>

		
         <div class="content-panel">
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-tambah-hutang">Tambah Data</button>
            <button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>
			<h4><i class="fa fa-angle-right"></i> Data Hutang Karyawan</h4>
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>
 					 <td style="width:  150px" id="divisi-hutang-row">
						<div class="input-group">						   	
						   <select class="form-control" id="divisi-hutang" name="divisi-hutang">
							 <?php $divisi_hutang= $this->session->userdata('divisi-hutang');?>
							 <option value="all">Semua Divisi</option>
							 <?php foreach($rs_divisi->result() as $divisi){ ?>
							 <option value="<?=$divisi->id;?>" <?=($divisi->id == $divisi_hutang) ? 'selected':'';?> ><?=$divisi->nama;?></option>
							 <?php } ?>
						   </select>						   
						 </div>
					 </td>

					 <td style="width:  250px">
						<div class="input-group">
						   <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=str_replace("%20"," ",$this->session->userdata('hutang-cari'));?>" autocomplete="off">
						   <span class="input-group-btn">
						      <button id="btn-clear-search" class="btn btn-danger" ><i class="fa fa-trash-o "></i></button>   
						   </span>
						</div>
						<div class="input-group">
						   <label>
							  <input id="checkbox-hutang-show-all" type="checkbox" value=""
							  <?php
								 $hutang_show_all = $this->session->userdata('hutang-show-all');
								 if($hutang_show_all === "true"){
									echo 'checked';
								 }else{
									echo '';
								 }
							  ?>
							  />
							  Tampilkan semua jenis status
						   </label>
						</div>
						
					 </td>					 
				  </tr>

			   </tbody>
			</table>

			<?php if($rs->num_rows() == 0){ ?>
			
			<?php if(!$this->session->userdata('hutang-show-all') || $this->session->userdata('hutang-show-all') === "false"){ ?>
			<div class="alert alert-info">				
				<p style="text-align: center">Belum ada data / Data tidak ditemukan</p>
			</div>
			<?php }else{ ?>
			<div class="alert alert-info">				
				<p style="text-align: center">belum ada data / Data tidak ditemukan</p>
			</div>
			<?php } ?>
			
			<?php }else{ ?>
			
            <section id="no-more-tables">
               <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                     <tr>
                        <th>Tanggal</th> 
						<!--<th>ID</th>                                               -->
                        <th>Nama</th>
                        <th>Besar</th>
                        <th>Sisa</th>
						<th>Status</th>
						<th style="width: 85px"></th>
                     </tr>
                  </thead>
                  <tbody>
					<?php foreach($rs->result() as $r){ ?>
					<tr id="row_<?=$r->id_hutang;?>">
                        <!--<td><?=$r->id_hutang;?></td>-->
                        <td><?=tanggal_format_indonesia($r->tgl_hutang);?></td>
                        <td>
                          <?=$r->nama_lengkap;?><br>
                          <?=$r->divisi;?> | <?=$r->jabatan;?>
                        </td>
                        <td><?=formatRupiah($r->besar_hutang);?></td>
                        <td><?=formatRupiah($r->sisa_hutang);?></td>
						<td>
						   <span class="label label-<?=$r->label_css;?> label-mini">
						   <?=$r->status_hutang;?>
						   </span>
						   <?php if($r->status_hutang === 'lunas'){ ?>
						   <br>
						   Tanggal : <?=$r->tgl_lunas;?>
						   <?php } ?>
						</td>
						<td style="text-align: center">
							<button class="btn btn-danger btn-xs" onclick="del(<?=$r->id_hutang;?>)"><i class="fa fa-trash-o "></i></button>
							<button class="btn btn-danger btn-xs" onclick=""><i class="fa fa-search-plus"></i></button>
							<button class="btn btn-danger btn-xs" onclick="bayar(<?=$r->id_hutang;?>,'<?=$r->nama_lengkap;?>','<?=$r->sisa_hutang;?>')"><i class="fa fa-plus "></i></button>
							
						</td>
                     </tr>
					<?php } ?>
                     
                  </tbody>
               </table>
			   
				
				<ul class="pagination" id="ajax_paging" style="padding-left: 15px">               
					<?php echo $this->pagination->create_links();?>               
				</ul>			
				
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
      $('#divisi-hutang-row').hide();          
	<?php } ?>
	
   $('#panel-hutang').hide();	 
   $("#tgl_hutang").datepicker({dateFormat:'yy-mm-dd'});
   $("#tgl_hutang_bayar").datepicker({dateFormat:'yy-mm-dd'});
   
	applyPagination();	
	
	function bayar(id,nama,sisa_hutang){	  
	  $('#nama-bayar').html('Form Bayar Hutang ' + nama);
	  $('#sisa_hutang').val(sisa_hutang);
	  $('#label-sisa-hutang').html('Sisa hutang Rp ' + addCommas(sisa_hutang));
	  
	  $('.content-panel').fadeOut(500,function(){			
			$('#bayar-hutang-form').attr('action', '<?=base_url() . 'hutang/index/simpan-hutang-bayar/'?>' + id);
			$('#panel-bayar-hutang').show();						
		});	
	}
	
	function del(id) {
		delete_data(id,'<?=base_url() . 'hutang/index/delete-hutang/';?>');		
	}
	
	
	$('#btn-cancel-bayar').click(function(){
		$('#panel-bayar-hutang').fadeOut(500,function(){
			$('.content-panel').show();						
		});
		return false;
	});
	
	$('#btn-cancel').click(function(){		
		$('#panel-hutang').fadeOut(500,function(){
			$('.content-panel').show();						
		});
		
		return false;
	});
	
	$('#btn-tambah-hutang').click(function(){
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
			$('#panel-hutang').show();
			
		});
		return false;
	});
	
	$("#bayar-hutang-form").submit(function(){
		
		var page_url = $(this).attr("action");
		var besar_bayar = $('#txt_besar_bayar').val();
		var sisa_hutang = $('#sisa_hutang').val();
		
		if (parseInt(besar_bayar) >= parseInt(sisa_hutang)) {
			$('#status_hutang').val('lunas');
		}else{
			$('#status_hutang').val('aktif');
		}
		
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#bayar-hutang-form').serialize(),
			success: function (data) {				
				var status = data.status;
				var msg = data.msg;
				
				if (status === 'ERROR') {
					 $("html, body").animate({ scrollTop: 0 }, "slow");
					 $('#alert-msg-bayar').show();
					 $('#alert-msg-bayar').html(msg);
					
				}else{
					 $('#panel-bayar-hutang').fadeOut(500,function(){
						$('#main-content').html(data);	
						$('.content-panel').show();						
					});	
				}			
	
			},
			error: function () {	
				
			}
	
		});		
		return false;
	});
	
	$("#hutang-form").submit(function(){
		
		var page_url = $(this).attr("action");  
		
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#hutang-form').serialize(),
			success: function (data) {				
				var status = data.status;
				var msg = data.msg;
				
				if (status === 'ERROR') {
					 $("html, body").animate({ scrollTop: 0 }, "slow");
					 $('#alert-msg').show();
					 $('#alert-msg').html(msg);
					
				}else{
					 $('#panel-hutang').fadeOut(500,function(){
						$('#main-content').html(data);	
						$('.content-panel').show();						
					});	
				}			
	
			},
			error: function () {	
				
			}
	
		});		
		return false;
	});
	
   $('#divisi-hutang').change(function(){
	  
		var divisi = $('#divisi-hutang').val();
		
		var str_param = divisi;
		 $.ajax({
			  type: 'GET',
			  url:  '<?=base_url();?>hutang/index/change-filter/' + str_param,
			  async: true,
			  success: function (data) {
				 $('#main-content').html(data);              
			  },
			  error:function(){
				
			  }
		 })   
        
    })
   
   	$('#btn-export-excel').click(function(){	  
	  window.location = "<?php echo base_url(); ?>hutang/index/export_to_xl";
	});
   
   $('#checkbox-hutang-show-all').on('click',function(e){
	  
	  $.ajax({
		 type: 'GET',
		 url:  '<?php echo base_url() ?>hutang/index/show_all/' + this.checked,
		 async: true,
		 success: function (data) {
			
			$('#main-content').html(data);
			
		 },
		 error:function(){
		   
		 }
	  })
   })
   
   //SEARCH ----------------------------------
   $('#btn-clear-search').on('click',function(e){
	  clear_search();
   });
   
   $('#pencarian').keypress(function(e) {
	  
	  go_find(e,'hutang/index/search/');
	  
   });
   
</script>