
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		<div class="form-panel" style="display:none">
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Jabatan</h4>
			<form class="form-horizontal style-form" id="jabatan-form" method="POST" action="<?php echo base_url() . 'data/jabatan/simpan' ?>">
				
                <input type="hidden" name="ajax" value="1">
                
                <div class="form-group" id="select_id_divisi_row">
                  <label class="col-sm-2 col-sm-2 control-label">Divisi</label>
                  <div class="col-sm-2">	
                    <select class="form-control" id="select_id_divisi" name="id_divisi">
                      <?php foreach($rs_divisi->result() as $divisi){ ?>
                      <option value="<?=$divisi->id;?>"><?=$divisi->nama;?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Nama</label>
					<div class="col-sm-4">						
						<input class="form-control round-form" type="text" id="txt_nama" name="nama" autocomplete="off">
						<!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Gaji Pokok</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_gaji_pokok" name="gaji_pokok" autocomplete="off">
						<!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Sewa Motor</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_sewa_motor" name="sewa_motor" autocomplete="off">
						<!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Bensin</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_bensin" name="bensin" autocomplete="off">
						<!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
					</div>
				</div>  
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Service</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_service" name="service" autocomplete="off">
						<!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
					</div>
				</div>
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Voucher</label>
					<div class="col-sm-4">					
						<input class="form-control round-form" type="text" id="txt_voucher" name="voucher" autocomplete="off">
						<!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
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
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-tambah-jabatan">Tambah Data</button>
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>
            <h4><i class="fa fa-angle-right"></i> Data Jabatan</h4>
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>
					 <td style="width:  150px" id="divisi-jabatan-row">
						<div class="input-group">						   	
						   <select class="form-control" id="divisi-jabatan" name="divisi-jabatan">
							 <?php $divisi_jabatan= $this->session->userdata('divisi-jabatan');?>
							 <option value="all">Semua Divisi</option>
							 <?php foreach($rs_divisi->result() as $divisi){ ?>
							 <option value="<?=$divisi->id;?>" <?=($divisi->id == $divisi_jabatan) ? 'selected':'';?> ><?=$divisi->nama;?></option>
							 <?php } ?>
						   </select>						   
						 </div>
					 </td>

					 <td style="width:  250px">
						<div class="input-group">
						<input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$this->session->userdata('data-cari-jabatan');?>" autocomplete="off">
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
                        <th>Divisi</th>
                        <th>Nama</th>
                        <th>Gaji Pokok</th>
                        <th>Sewa Motor</th>
						<th>Bensin</th>
                        <th>Service</th>
                        <th>Voucher</th>
						<th style="width: 70px"></th>
                     </tr>
                  </thead>
                  <tbody>
					<?php
				  
                  foreach ($rs->result() as $r) { ?>
					<tr id="row_<?=$r->id;?>" style="background-color: #F1F1F1">                        
                        <td data-title="divisi"><?php echo $r->divisi; ?></td>
                        <td data-title="nama"><?php echo $r->nama; ?></td>
                        <td data-title="gaji_pokok"><?php echo formatRupiah($r->gaji_pokok); ?></td>
                        <td data-title="sewa_motor"><?php echo formatRupiah($r->sewa_motor); ?></td>
						<td data-title="bensin"><?php echo formatRupiah($r->bensin); ?></td>
                        <td data-title="service"><?php echo formatRupiah($r->service); ?></td>
                        <td data-title="voucher"><?php echo formatRupiah($r->voucher); ?></td>
                        
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
			
			<?php }?>
			
         </div>
         <!-- /content-panel -->
      </div>
      <!-- /col-lg-12 -->
   </div>
   <!-- /row -->
</section>

<script>
	applyPagination();
	
	<?php
	  $a = _is_management();
	  
	  if( $a !== 'TRUE' ){ ?>
      $('#divisi-jabatan-row').hide();
	  $('select[name="id_divisi"]').find('option[value="' + <?php echo $a;?> + '"]').attr("selected", true);
	  $('#select_id_divisi_row').hide();
	<?php } ?>
	
	function edit(id) {		
		$('.alert-msg').hide();
		$('.content-panel').fadeOut(500,function(){
			
			$.ajax({
				type: 'GET',
				url:  '<?php echo base_url() ?>data/jabatan/get/' + id,
				async: true,
				success: function (data) {
					
					$('#jabatan-form').attr('action', '<?php echo base_url() ?>data/jabatan/update/' + id);
                    
                    $('select[name="id_divisi"]').find('option[value="' + data.id_divisi + '"]').attr("selected", true);
                    
                    $('#txt_nama').attr('value',data.nama);
					$('#txt_gaji_pokok').attr('value',data.gaji_pokok);
                    $('#txt_sewa_motor').attr('value',data.sewa_motor);
					$('#txt_bensin').attr('value',data.bensin);
                    $('#txt_service').attr('value',data.service);
                    $('#txt_voucher').attr('value',data.voucher);                    
                    
					$('.form-panel').show();
				},
				error: function () {
		
				}
		
			});		
		});
		
		return false;
	}
	
   function del(id) {
		delete_data(id,'<?=base_url() . 'data/jabatan/delete/';?>');		
   }
   
	$('#btn-export-excel').click(function(){	  
	  window.location = "<?php echo base_url(); ?>data/jabatan/export_to_xl";
	});
	
	
	$('#btn-cancel').click(function(){
		$('.form-panel').fadeOut(500,function(){
			$('.content-panel').show();						
		});
		return false;
	});
	
	$('#btn-tambah-jabatan').click(function(){
		$('.alert-msg').hide();
		$('.content-panel').fadeOut(500,function(){
			$('.form-panel').show();			
		});
		return false;
	});
	
	$('#divisi-jabatan').change(function(){
	  
		var divisi = $('#divisi-jabatan').val();
		
		var str_param = divisi;
		 $.ajax({
			  type: 'GET',
			  url:  '<?=base_url();?>data/jabatan/change-filter/' + str_param,
			  async: true,
			  success: function (data) {
				 $('#main-content').html(data);              
			  },
			  error:function(){
				
			  }
		 })   
        
    })
	
	$("#jabatan-form").submit(function(){
		
		var page_url = $(this).attr("action");  
		
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#jabatan-form').serialize(),
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
	  
	  go_find(e,'data/jabatan/search/');
	  
   });
</script>
