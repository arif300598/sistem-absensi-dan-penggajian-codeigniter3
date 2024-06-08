
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		<div class="form-panel" style="display:none">
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Karyawan</h4>
			<form class="form-horizontal style-form" id="karyawan-form" method="POST" action="<?php echo base_url() . 'data/karyawan/simpan' ?>" enctype="multipart/form-data">
				
                <input type="hidden" name="ajax" value="1">
                  
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jabatan</label>
                  <div class="col-sm-3">	
                  <?=$select_jabatan;?>
                  </div>
                </div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Kode Fingerprint</label>
					<div class="col-sm-4">						
						<input class="form-control round-form" type="text" id="txt_id_fingerprint" name="id_fingerprint" autocomplete="off">						
					</div>
				</div>
                
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">NIK</label>
					<div class="col-sm-4">						
						<input class="form-control round-form" type="text" id="txt_nik" name="nik" autocomplete="off">						
					</div>
				</div>

				
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
					<div class="col-sm-4">						
						<input class="form-control round-form" type="text" id="txt_nama_lengkap" name="nama_lengkap" autocomplete="off">						
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal Masuk Kerja</label>
					<div class="col-sm-4">						
						<input type="text" class="form-control round-form" style="width: 150px" id="tgl_masuk_kerja" name="tgl_masuk_kerja" readonly="">
						<!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
					</div>
				</div>
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Status</label>
                  <div class="col-sm-2">	
                    <select class="form-control" id="select_status" name="status">
                      <option value="aktif">Aktif</option>
                      <option value="resign">Resign</option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal Resign</label>
					<div class="col-sm-4">						
						<input type="text" class="form-control round-form" style="width: 150px" id="tgl_resign" name="tgl_resign" readonly="">
						<!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
					</div>
				</div>

                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">No Telepon</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_no_telp" name="no_telp" autocomplete="off">
						<!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Alamat</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_alamat" name="alamat" autocomplete="off">
						<!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
					</div>
				</div>                               
                
				<div class="form-group">
					 <label for="exampleInputFile" class="col-sm-2 control-label">Foto</label>
					 <div class="col-md-9"><input type="file" id="img_badan" name="img_badan">
						 <p class="help-block">Extensi yang diperbolehkan *.jpeg, *.png,*.jpg</p>
						 <img id="img_badan_box" src="" style="margin-top: 10px;display: none" width="150">
						 
					 </div>
				 </div>
				
   				<div class="form-group">
					 <label for="exampleInputFile" class="col-sm-2 control-label">Foto KTP</label>
					 <div class="col-md-9"><input type="file" id="img_ktp" name="img_ktp">
						 <p class="help-block">Extensi yang diperbolehkan *.jpeg, *.png,*.jpg</p>
						 <img id="img_ktp_box" src="" style="margin-top: 10px;display: none" width="150">
					 </div>
				 </div>

				 
                <!--<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Nama Bank</label>
					<div class="col-sm-10">					
						<input class="form-control round-form" type="text" id="txt_bank_nama" name="bank_nama" autocomplete="off">
						<span class="help-block">* Untuk keperluan transfer gaji</span>
					</div>
				</div>-->
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Bank & Nomor Rekening</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_bank_rekening" name="bank_rekening" autocomplete="off">
						<span class="help-block">* Untuk keperluan transfer gaji</span>
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
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-tambah-karyawan">Tambah Data</button>
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>
            <h4><i class="fa fa-angle-right"></i> Data Karyawan</h4>
			
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>
					 <td style="width:  150px" id="divisi-karyawan-row">
						<div class="input-group">						   	
						   <select class="form-control" id="divisi-karyawan" name="divisi-karyawan">
							 <?php $divisi_karyawan= $this->session->userdata('divisi-karyawan');?>
							 <option value="all">Semua Divisi</option>
							 <?php foreach($rs_divisi->result() as $divisi){ ?>
							 <option value="<?=$divisi->id;?>" <?=($divisi->id == $divisi_karyawan) ? 'selected':'';?> ><?=$divisi->nama;?></option>
							 <?php } ?>
						   </select>						   
						 </div>
					 </td>
					 <td style="width:  250px">
						<div class="input-group">
						   <?php
							  $str_cari = str_replace("%20"," ",$this->session->userdata('data-cari-karyawan'));
						   ?>
						   <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$str_cari;?>" autocomplete="off">
						   <span class="input-group-btn">
							  <button id="btn-clear-search" class="btn btn-danger" ><i class="fa fa-trash-o "></i></button>   
						   </span>
						</div>
						<div class="input-group">
						   <label>
							  <input id="checkbox-karyawan-show-all" type="checkbox" value=""
							  <?php
								 $karyawan_show_all = $this->session->userdata('karyawan-show-all');
								 if($karyawan_show_all === "true"){
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
			<div class="alert alert-info">				
				<p style="text-align: center">Belum ada data / Data tidak ditemukan</p>
			</div>
			<?php }else{ ?>
			
            <section id="no-more-tables">
               <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                     <tr>                        
                        <!--<th style="width: 150px">Divisi</th>-->
                        <!--<th>Jabatan</th>-->
                        <th>Nama Lengkap</th>
                        <th>NIK</th>
                        <th>Status</th>
                        <!--<th>Tgl. Resign</th>-->
                        <th>No. Telephon</th>
                        <th>Alamat</th>
						<th style="width: 70px"></th>
                     </tr>
                  </thead>
                  <tbody>
					 
				  <?php
				  
                  foreach ($rs->result() as $r) { ?>
					<tr id="row_<?=$r->id;?>" style="background-color: #F1F1F1">
                        
                        <td data-title="nama_lengkap">
						   <?=$r->nama_lengkap;?>
						   <?php if($r->status === 'aktif'): ?>
						   <span class="label label-info">Aktif</span>
						   <?php else:?>
						   <span class="label label-default">Resign</span>
						    <?php endif;?>
						   <br>
						   <?=$r->divisi;?> | <?=$r->jabatan;?>
						</td>
                        <td><?=$r->nik; ?></td>
                        <td data-title="status">						   
						   <?php if($r->status === 'aktif'): ?>
							  <!--<span class="label label-info">Aktif</span><br>-->
							  Masuk: <?=tanggal_format_indonesia($r->tgl_masuk_kerja); ?><br>
							  
							  <?php
							  $today = date_create(date('Y-m-d'));
							  //$tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja . '-1 days')));
							  $tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja)));
							  $diff = date_diff($today, $tgl_masuk);
							  echo 'Masa Kerja: '.date_interval_format($diff, "%y tahun %m bulan dan %d hari");
							  ?>
						   <?php else:?>
							  <!--<span class="label label-default">Resign</span><br>-->
							  Masuk: <?=tanggal_format_indonesia($r->tgl_masuk_kerja); ?><br>
							  Resign: <?=tanggal_format_indonesia($r->tgl_resign); ?><br>
							  <?php
							  $tgl_resign= date_create($r->tgl_resign);
							  //$tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja . '-1 days')));
							  $tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja)));
							  $diff = date_diff($tgl_resign, $tgl_masuk);
							  echo 'Masa Kerja: '.date_interval_format($diff, "%y tahun %m bulan dan %d hari");
						   ?>
						   <?php endif;?>
						</td>
                        <!--<td data-title="tgl_resign"><?=$r->tgl_resign; ?></td>-->
                        <td data-title="no_telp"><?=$r->no_telp; ?></td>
                        <td data-title="alamat"><?=$r->alamat; ?></td>
                        
						<td style="text-align: center">							
							<button class="btn btn-primary btn-xs" onclick="edit(<?php echo $r->id; ?>)"><i class="fa fa-pencil"></i></button>
							<button class="btn btn-danger btn-xs" onclick="del(<?php echo $r->id; ?>)"><i class="fa fa-trash-o "></i></button>
						</td>
                     </tr>
					<?php
                  } ?>
                     
                  </tbody>
               </table>			
				<ul class="pagination" id="ajax_paging" style="padding-left: 15px">               
					<?php echo $this->pagination->create_links(); ?>               
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
      $('#divisi-karyawan-row').hide();          
	<?php } ?>
	
    $("#tgl_masuk_kerja").datepicker({dateFormat:'yy-mm-dd'});
    $("#tgl_resign").datepicker({dateFormat:'yy-mm-dd'});
	//$('#tree').checkboxTree();

	applyPagination();
	
	function edit(id) {
	  
	    var granted_menu;
		$('.alert-msg').hide();
		
		$('.content-panel').fadeOut(500,function(){
			
			$.ajax({
				type: 'GET',
				url:  '<?php echo base_url() ?>data/karyawan/get/' + id,
				async: true,
				success: function (data) {
					
					 $('#karyawan-form').attr('action', '<?php echo base_url() ?>data/karyawan/update/' + id);
                    
					 $('select[name="id_jabatan"]').find('option[value="' + data.id_jabatan + '"]').attr("selected", true);
					 $('#txt_id_fingerprint').attr('value',data.id_fingerprint);
					 $('#txt_nik').attr('value',data.nik);
					 $('#txt_nama_lengkap').attr('value',data.nama_lengkap);
					 $('#tgl_masuk_kerja').attr('value',data.tgl_masuk_kerja);
					 $('select[name="status"]').find('option[value="' + data.status + '"]').attr("selected", true);
					 $('#tgl_resign').attr('value',data.tgl_resign);
					 $('#txt_no_telp').attr('value',data.no_telp);
					 $('#txt_alamat').attr('value',data.alamat);
					 
					 if (data.img_badan !='') {
						$('#img_badan_box').attr('src','<?=base_url() . 'uploaded_files/';?>' + data.img_badan );
						$('#img_badan_box').show();
					 }
					 
					 if (data.img_ktp !='') {
						$('#img_ktp_box').attr('src','<?=base_url() . 'uploaded_files/';?>' + data.img_ktp);
						$('#img_ktp_box').show();
					 }
					 
					 //$('#txt_bank_nama').attr('value',data.bank_nama);
					 $('#txt_bank_rekening').attr('value',data.bank_rekening);
					 
					 $('.form-panel').show();
				},
				error: function () {
		
				}
		
			});		
		});
		
		return false;
	}
	
	function del(id) {
		delete_data(id,'<?=base_url() . 'data/karyawan/delete/';?>');
		
	}
	
	$('#btn-export-excel').click(function(){	  
	  window.location = "<?php echo base_url(); ?>data/karyawan/export_to_xl";
	});
	
	
	$('#btn-cancel').click(function(){
		$('.form-panel').fadeOut(500,function(){
			$('.content-panel').show();						
		});
		return false;
	});
	
	$('#btn-tambah-karyawan').click(function(){
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
			$('#id_jabatan_chosen').css("width","350px");
			$('.form-panel').show();			
		 });
		return false;
	});
	
	$("#karyawan-form").submit(function(){
		
		 var page_url = $(this).attr("action");
		 var karyawan_form = new FormData(document.getElementById('karyawan-form'));
		 var img_badan = document.getElementById('img_badan').files[0];
		 if (img_badan) {   
		    karyawan_form.append('img_badan', img_badan);
		 }
		 
		 var img_ktp = document.getElementById('img_ktp').files[0];
		 if (img_ktp) {   
		    karyawan_form.append('img_ktp', img_ktp);
		 }
		 
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: karyawan_form,
			contentType: false, 
			processData: false, 
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
	
   $('#divisi-karyawan').change(function(){
	  
		var divisi = $('#divisi-karyawan').val();
		
		var str_param = divisi;
		 $.ajax({
			  type: 'GET',
			  url:  '<?=base_url();?>data/karyawan/change-filter/' + str_param,
			  async: true,
			  success: function (data) {
				 $('#main-content').html(data);              
			  },
			  error:function(){
				
			  }
		 })   
        
    })
	   
	$('#checkbox-karyawan-show-all').on('click',function(e){
	  
	  $.ajax({
		 type: 'GET',
		 url:  '<?php echo base_url() ?>data/karyawan/show_all/' + this.checked,
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
	  
	  go_find(e,'data/karyawan/search/');
	  
   });
   
</script>
