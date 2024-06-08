
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		<div class="form-panel">
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Upload File Absensi</h4>
			<form class="form-horizontal style-form" id="absensi-form" method="POST" action="<?php echo base_url() . 'absensi/upload' ?>" enctype="multipart/form-data">
				
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
					 <label for="exampleInputFile" class="col-sm-2 control-label">File Absensi</label>
					 <div class="col-md-9"><input type="file" id="file_absensi" name="file_absensi">
						 <p class="help-block">Extensi yang diperbolehkan *.xls</p>
					 </div>
				 </div>
                
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">						
						<button class="btn btn-theme" type="submit">Upload</button>						
					</div>
				</div>
		        
			</form>
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
	  $('select[name="id_divisi"]').find('option[value="' + <?php echo $a;?> + '"]').attr("selected", true);
	  $('#select_id_divisi_row').hide();
	<?php } ?>
	  
	$("#absensi-form").submit(function(){
		
		 var page_url = $(this).attr("action");
		 var absensi_form = new FormData(document.getElementById('absensi-form'));
		 var file_absensi = document.getElementById('file_absensi').files[0];
		 if (file_absensi) {   
		    absensi_form.append('file_absensi', file_absensi);
		 }
		
		var answer =  confirm('Apakah divisi yang anda pilih untuk data ini sudah benar?');
		
		if (answer) {
			$.ajax({
			   url: page_url,
			   type: 'POST',
			   cache: false,
			   async: false,
			   data: absensi_form,
			   contentType: false, 
			   processData: false, 
			   success: function (data) {				
				   var status = data.status;
				   var msg = data.msg;
				   
				   if (status === 'ERROR') {
						$("html, body").animate({ scrollTop: 0 }, "slow");
						$('#alert-msg').removeClass().addClass('alert alert-danger').html(msg).show();
						//$('#alert-msg').html(msg);
						//$('#alert-msg').show();
					   
				   }else{
					   //$("html, body").animate({ scrollTop: 0 }, "slow");
					   //$('#alert-msg').show();
					   //$('#alert-msg').html(msg);
					   $('#alert-msg').removeClass().addClass('alert alert-success').html(msg).fadeIn().delay(3000).fadeOut();
					   //$('#alert-msg').
				   }			
	   
			   },
			   error: function () {	
				   console.error('errrorrrrr');	
			   }
	   
		   });		
		}
		
		return false;
	});
   
</script>
