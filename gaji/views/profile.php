
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		 <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
			<li class="active"><a href="#profile" data-toggle="tab">PROFILE</a></li>
			<li><a href="#ganti-password" data-toggle="tab">GANTI PASSWORD</a></li>			
		 </ul>
		 <div id="my-tab-content" class="tab-content">
			<div class="tab-pane active" id="profile">
			   <div class="form-panel" style="margin-top: 0px; margin-left: 1px; margin-right: 0px;">
				   <div id="alert-msg" class="alert alert-danger" style="display: none">
					   <b>Warning!</b><br>msg
				   </div>
				   <h4 class="mb"><i class="fa fa-angle-right"></i> Form Profile User</h4>
				   <form class="form-horizontal style-form" id="user-form" method="POST" action="<?php echo base_url() . 'profile/update' ?>">
					   
					   <input type="hidden" name="ajax" value="1">
						 
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">NIK</label>
						   <div class="col-sm-4">						
							   <input class="form-control round-form" type="text" id="txt_nik" name="nik" autocomplete="off">
							   <span class="help-block">Masukkan Nomor Induk Karyawan</span>	
						   </div>
					   </div>
					   
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
						   <div class="col-sm-4">					
							   <input class="form-control round-form" type="text" id="txt_nama_lengkap" name="nama_lengkap" autocomplete="off">
							   <!--<span class="help-block">Masukkan Nomor Induk Karyawan</span>	-->
						   </div>
					   </div>
					   
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">User Name</label>
						   <div class="col-sm-4">					
							   <input class="form-control round-form" type="text" id="txt_username" name="username" autocomplete="off" readonly>						
						   </div>
					   </div>
					   
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">Email</label>
						   <div class="col-sm-4">					
							   <input class="form-control round-form" type="text" id="txt_email" name="email" autocomplete="off">
							   <!--<span class="help-block">Password secara default, sama dengan User Name</span>-->
						   </div>
					   </div>
					   <!--
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">Password Lama</label>
						   <div class="col-sm-10">					
							   <input class="form-control round-form" type="text" id="txt_email" name="email" autocomplete="off">
							   <span class="help-block">Masukkan Password Lama unt</span>
						   </div>
					   </div>
					   -->
	   
					   
					   <div class="form-group">
							<label for="exampleInputFile" class="col-sm-2 control-label">Foto</label>
							<div class="col-md-9"><input type="file" id="img_badan" name="img_badan">
								<p class="help-block">Extensi yang diperbolehkan *.jpeg, *.png,*.jpg</p>
								<p class="help-block">Dimensi gambar maksimal (pixel) : 200 x 200</p>
								<img id="img_badan_box" src="" style="margin-top: 10px;display: none" width="150">
								
							</div>
						</div>
	   
					   
					   <div class="form-group">
						   <div class="col-sm-offset-2 col-sm-10">						
							   <button class="btn btn-theme" type="submit">Submit</button>						
						   </div>
					   </div>
					   
				   </form>
			   </div>

			</div>
			<div class="tab-pane" id="ganti-password">
			   <div class="form-panel" style="margin-top: 0px; margin-left: 1px; margin-right: 0px;">
				   <div id="password-alert-msg" class="alert alert-danger" style="display: none">
					   <b>Warning!</b><br>msg
				   </div>
				   <h4 class="mb"><i class="fa fa-angle-right"></i> Form Ganti Password</h4>
				   <form class="form-horizontal style-form" id="password-form" method="POST" action="<?php echo base_url() . 'profile/password' ?>">
					   
					   <input type="hidden" name="ajax" value="1">
						 
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">Password Lama</label>
						   <div class="col-sm-4">						
							   <input class="form-control round-form" type="password" name="old_pass" id="old_pass" autocomplete="off">
							   <span class="help-block">Masukkan Password Lama Anda</span>	
						   </div>
					   </div>
					   
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">Password Baru</label>
						   <div class="col-sm-4">						
							   <input class="form-control round-form" type="password" name="new_pass" id="new_pass" autocomplete="off">
							   <span class="help-block">Masukkan Password Baru Anda</span>	
						   </div>
					   </div>
					   
					   <div class="form-group">
						   <label class="col-sm-2 col-sm-2 control-label">Ulangi Password Baru</label>
						   <div class="col-sm-4">						
							   <input class="form-control round-form" type="password" name="repeat_pass" id="repeat_pass" autocomplete="off">
							   <span class="help-block">Ulangi Password Baru Anda</span>	
						   </div>
					   </div>
					   
					   <div class="form-group">
						   <div class="col-sm-offset-2 col-sm-10">						
							   <button class="btn btn-theme" type="submit">Submit</button>						
						   </div>
					   </div>
					   
				   </form>
			   </div>

			</div>
		 </div>

		
		
         <!-- /content-panel -->
      </div>
      <!-- /col-lg-12 -->
   </div>
   <!-- /row -->
</section>

<script>
  
  $(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
	  //console.log(e.target) // activated tab
	  //alert(e.target);
	  $('#alert-msg').hide();
	  $('#password-alert-msg').hide();	
   })
  
  function loaddata(){
	  $.ajax({
		 type: 'GET',
		 url:  '<?php echo base_url() ?>profile/loaddata',
		 async: true,
		 success: function (data) {
			 
			 $('#user-form').attr('action', '<?php echo base_url() ?>profile/update');
			 
			 $('#txt_nik').attr('value',data.nik);
			 $('#txt_nama_lengkap').attr('value',data.nama_lengkap);
			 $('#txt_username').attr('value',data.username);                  
			 $('#txt_email').attr('value',data.email);
			 
			 if (data.img_badan !='') {
				 $('#img_badan_box').attr('src','<?=base_url() . 'uploaded_files/';?>' + data.img_badan );
				  $('#foto_profile').attr('src','<?=base_url() . 'uploaded_files/';?>' + data.img_badan );
				 $('#img_badan_box').show();
			  }
			 
		 },
		 error: function () {
 
		 }
 
	 });	
  }
  
  $(document).ready(function () {
      
	  $('#alert-msg').hide();
	  $('#password-alert-msg').hide();	  
      loaddata();      
      return false;
  });

   $('#password-form').submit(function(){
	  
	  var page_url = $(this).attr("action");
	  $.ajax({
		 url: page_url,
		 type: 'POST',		 
		 data: $('#password-form').serialize(),		 
		 success: function (data) {				
			 var status = data.status;
			 var msg = data.msg;
			 
			 $("html, body").animate({ scrollTop: 0 }, "slow");
			 
			 if (status === 'ERROR') {                                   
			   $('#password-alert-msg').html(msg);
			   $('#password-alert-msg').removeClass().addClass('alert alert-danger');
			   $('#password-alert-msg').show();
			 }else{
			   loaddata();
			   $('#password-alert-msg').html(msg);
			   $('#password-alert-msg').removeClass().addClass('alert alert-success');
			   $('#password-alert-msg').fadeIn().delay(2000).fadeOut();
			 }
			
			$('#old_pass').val("");
			$('#new_pass').val("");
			$('#repeat_pass').val("");
 
		 },
		 error: function () {	
			 console.error('errrorrrrr');	
		 }
 
	 });	
	  return false;
   })
   
   $("#user-form").submit(function(){
		
		 var page_url = $(this).attr("action");
		 var user_form = new FormData(document.getElementById('user-form'));
		 var img_badan = document.getElementById('img_badan').files[0];
		 if (img_badan) {   
			user_form.append('img_badan', img_badan);
		 }
		
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: user_form,
			contentType: false, 
			processData: false, 
			success: function (data) {				
				var status = data.status;
				var msg = data.msg;
                
                $("html, body").animate({ scrollTop: 0 }, "slow");
                
				if (status === 'ERROR') {                                   
                  $('#alert-msg').html(msg);
                  $('#alert-msg').removeClass().addClass('alert alert-danger');
                  $('#alert-msg').show();
                }else{
                  loaddata();
				  $('#alert-msg').html(msg);
                  $('#alert-msg').removeClass().addClass('alert alert-success');
                  $('#alert-msg').fadeIn().delay(2000).fadeOut();
				  $('#foto_profile').attr('src',$('#img_badan_box').prop('src'));
				  
                }
                
	
			},
			error: function () {	
				console.error('errrorrrrr');	
			}
	
		});		
		return false;
	});
</script>
