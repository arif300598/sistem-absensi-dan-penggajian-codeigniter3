
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">			
		
         <div class="content-panel">
    		<div id="alert-msg" class="alert alert-success" style="display:none;">				
				<p style="text-align: center">Data Settings telah tersimpan</p>
			</div>

            <h4><i class="fa fa-angle-right"></i> Data Settings</h4>
			
            <section id="no-more-tables">
               <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Title</th>
						<th>Value</th>
                     </tr>
                  </thead>
                  <tbody>
					<?php foreach($rs->result() as $r){ ?>
					<tr style="background-color: #F1F1F1"> 
                        <td data-title="id"><?=$r->id;?></td>
                        <td data-title="name"><?=$r->name;?></td>
                        <td data-title="title"><?=$r->title;?></td>
                        <td data-title="value">
						   <?php
							  $hari 	=	array('Senin'	,'Selasa'	,'Rabu'		,'Kamis'	,'Jumat'	,'Sabtu'	,'Minggu');
							  $day 	= 	array('Monday'	,'Tuesday'	,'Wednesday','Thursday'	,'Friday'	,'Saturday'	,'Sunday');
		
							  $value 	= 	str_replace($day,$hari,$r->value);
						   ?>
						   <input class="form-control round-form" type="text" id="<?=$r->id;?>" name="setting_id_<?=$r->id;?>" value="<?=$value;?>">
						</td>
                     </tr>
					<?php } ?>
					 <tr>						
						<td colspan=4><button type="button" class="btn btn-info pull-right" id="btn-simpan">Simpan Data</button></td>
					 </tr>	          
                  </tbody>
				  
               </table>
				
            </section>
			
			
			
         </div>
		 
         <!-- /content-panel -->
      </div>
      <!-- /col-lg-12 -->
   </div>
   <!-- /row -->
</section>

<script>

   $('#btn-simpan').click(function(){
	  var answer =  confirm('Anda yakin ingin mengupdate data setting?');
	  
	  if (answer) {
		 $('input').each(function(i, obj) {
		 
			var id = this.id;
			var content_setting = this.value;
			//alert(id);
			$.ajax({
			   url: '<?=base_url();?>settings/change/' + id + '/' + jQuery.trim(content_setting),
			   type: 'GET',    
			   success: function (data) {			
				   
			   },
			   error: function () {
				   console.error('errrorrrrr');
			   }
	  
			});
		 });
		 
		 $('#alert-msg').fadeIn().delay(3000).fadeOut();
		 
	  }else{
		 
		  $.ajax({
			 type: "POST",
			 data: "ajax=1",
			 cache: false,
             async: false,
			 url: '<?=base_url()?>settings', 
			 success: function(msg) {
				$('#main-content').fadeOut(0,function(){
					$('#main-content').html(msg);					
				}).fadeIn(0);                       
			 }
		  });              
	  }
	  
	  return false;
	});
   
   
   /*
   $("input").change(function(){
	  var id = this.id;
	  var content_setting = this.value;
	  
      $.ajax({
		 url: '<?=base_url();?>settings/change/' + id + '/' + jQuery.trim(content_setting),
		 type: 'GET',    
		 success: function (data) {			
			 //$('#alert-msg').fadeIn().next().delay(500).fadeOut();
		 },
		 error: function () {
			 console.error('errrorrrrr');
		 }

	  });
   });
   */
	
</script>