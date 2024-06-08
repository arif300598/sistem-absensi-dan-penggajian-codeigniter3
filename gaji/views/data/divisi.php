
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	

		<div class="form-panel" style="display:none">
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Divisi</h4>
			<form class="form-horizontal style-form" id="divisi-form" method="POST" action="<?=base_url() . 'data/divisi/simpan'?>">
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Nama Divisi</label>
					<div class="col-sm-4">
						<input type="hidden" name="ajax" value="1">
						<input class="form-control round-form" type="text" id="txt_nama" name="nama" autocomplete="off">
						<!--<span class="help-block">A block of help text that breaks onto a new line and may extend beyond one line.</span>	-->
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
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-tambah-divisi">Tambah Data</button>
            <h4><i class="fa fa-angle-right"></i> Data Divisi</h4>
			
			<?php if($rs->num_rows() == 0){ ?>
			<div class="alert alert-info">				
				<p style="text-align: center">Belum ada data</p>
			</div>			
			<?php }else{ ?>
			
            <section id="no-more-tables">
               <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                     <tr>
                        <th style="text-align: center;width: 100px">ID Divisi</th>
                        <th>Nama</th>
						<th style="width: 70px"></th>
                     </tr>
                  </thead>
                  <tbody>
					<?php foreach($rs->result() as $r){ ?>
					<tr id="row_<?=$r->id;?>" style="background-color: #F1F1F1"> 
                        <td style="text-align: center" data-title="id"><?=str_pad($r->id,2,'0',STR_PAD_LEFT);?></td>
                        <td data-title="nama"><?=$r->nama;?></td>
						<td style="text-align: center">							
							<button class="btn btn-primary btn-xs" onclick="edit(<?=$r->id;?>)"><i class="fa fa-pencil"></i></button>
							<button class="btn btn-danger btn-xs" onclick="del(<?=$r->id;?>)"><i class="fa fa-trash-o "></i></button>
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
	applyPagination();
	
	function edit(id) {		
		$('.alert-msg').hide();
		$('.content-panel').fadeOut(500,function(){
			
			$.ajax({
				type: 'GET',
				url: rootWebService + 'data/divisi/get/' + id,
				async: true,
				success: function (data) {
					var nama = data.nama;
					
					$('#divisi-form').attr('action', rootWebService + 'data/divisi/update/' + id);
					$('#txt_nama').attr('value',nama);
					$('.form-panel').show();
				},
				error: function () {
					$('#alert-msg').show();
				}
		
			});		
		});
		
		return false;
	}
	
	function del(id) {
		delete_data(id,'<?=base_url() . 'data/divisi/delete/';?>');		
	}
	
	
	$('#btn-cancel').click(function(){
		$('.form-panel').fadeOut(500,function(){
			$('.content-panel').show();						
		});
		return false;
	});
	
	$('#btn-tambah-divisi').click(function(){
		$('.alert-msg').hide();
		$('.content-panel').fadeOut(500,function(){
			$('.form-panel').show();			
		});
		return false;
	});
	
	$("#divisi-form").submit(function(){
		
		var page_url = $(this).attr("action");  
		
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#divisi-form').serialize(),
			success: function (data) {				
				var status = data.status;
				var msg = data.msg;
				
				if (status === 'ERROR') {
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
				
			}
	
		});		
		return false;
	});
</script>