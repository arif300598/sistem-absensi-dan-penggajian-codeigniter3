
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		<div class="form-panel" id="panel-dayoff" >
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Hari Besar / Libur</h4>
			<form class="form-horizontal style-form" id="dayoff-form" method="POST" action="<?php echo base_url() . 'absensi/day_off/insert' ?>">
				
                <input type="hidden" name="ajax" value="1">
                
                <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tanggal</label>
					<div class="col-sm-10">						
						<input type="text" class="form-control round-form" style="width: 150px" id="tanggal" name="tanggal" readonly="">
					</div>
				</div>
                
                
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Jenis</label>
                  <div class="col-sm-2">	
                    <select class="form-control" id="jenis" name="jenis">
                      <option value="kerja">Hari Kerja</option>
                      <option value="libur-besar">Hari Libur</option>
                      <option value="besar">Hari Besar</option>
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
            <h4><i class="fa fa-angle-right"></i> Data Tanggal Istimewa</h4>
			
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>

					 <td style="width:  150px">
                      <div class="input-group">
                         <select class="form-control" id="tahun-dayoff" name="tahun-dayoff" style="width:  150px">
                          <?php
							  $tahun_dayoff= $this->session->userdata('tahun-day-off');
						      $now = new DateTime();
						      $year_now = $now->format("Y");
						   ?>
                          <?php for($i = 2014;$i <= $year_now;$i++){ ?>
                          <option value="<?=$i;?>" <?=($i == $tahun_dayoff) ? 'selected':'';?>  ><?=$i;?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </td>

   					 <td style="width: 150px">
                      <div class="input-group">
                         <select class="form-control" id="bulan-dayoff" name="bulan-dayoff" style="width:  150px">                          
                          <?php $bulan_dayoff= $this->session->userdata('bulan-day-off');?>
                          <option value="1" <?=($bulan_dayoff == "1") ? 'selected':'';?> >Januari</option>
                          <option value="2" <?=($bulan_dayoff == "2") ? 'selected':'';?> >Februari</option>
                          <option value="3" <?=($bulan_dayoff == "3") ? 'selected':'';?> >Maret</option>
                          <option value="4" <?=($bulan_dayoff == "4") ? 'selected':'';?> >April</option>
                          <option value="5" <?=($bulan_dayoff == "5") ? 'selected':'';?> >Mei</option>
                          <option value="6" <?=($bulan_dayoff == "6") ? 'selected':'';?> >Juni</option>
                          <option value="7" <?=($bulan_dayoff == "7") ? 'selected':'';?> >Juli</option>
                          <option value="8" <?=($bulan_dayoff == "8") ? 'selected':'';?> >Agustus</option>
                          <option value="9" <?=($bulan_dayoff == "9") ? 'selected':'';?> >September</option>
                          <option value="10" <?=($bulan_dayoff == "10") ? 'selected':'';?> >Oktober</option>
                          <option value="11" <?=($bulan_dayoff == "11") ? 'selected':'';?> >November</option>
                          <option value="12" <?=($bulan_dayoff == "12") ? 'selected':'';?> >Desember</option>                          
                        </select>
                      </div>
                     </td>

					 <td style="width:  250px">
						<div class="input-group">
                          <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$this->session->userdata('cari-dayoff');?>" autocomplete="off">
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
                        <th>Jenis</th>                        
                        <th>Keterangan</th>                        
						<th style="width: 70px"></th>
                     </tr>
                  </thead>
                  <tbody>					 
				  <?php
				  
                  foreach ($rs->result() as $r) { ?>
					<tr id="row_<?=$r->id;?>" style="background-color: #F1F1F1"> 
                        <td><?=tanggal_format_indonesia($r->tanggal); ?></td>
                        <td>Hari <?=ucfirst($r->jenis);?></td>
                        <td><?=ucwords($r->keterangan); ?></td>
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
    $('#panel-dayoff').hide();
    $("#tanggal").datepicker({dateFormat:'yy-mm-dd'});
    
	
	function del(id) {
		delete_data(id,'<?=base_url() . 'absensi/day_off/delete/';?>');		
	}
	
    $('#tahun-dayoff,#bulan-dayoff').change(function(){
        
        var bulan = $('#bulan-dayoff').val();
        var tahun = $('#tahun-dayoff').val();
		
		var strparam = bulan + '-' + tahun;
        
        $.ajax({
           type: 'GET',
           url:  '<?=base_url();?>absensi/day_off/change-filter/' + strparam,
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

		$('.content-panel').fadeOut(500,function(){            
            $('#panel-dayoff').show();		
		});
		return false;
	});
	
	$("#dayoff-form").submit(function(){
		
		var page_url = $(this).attr("action");
        
		$.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#dayoff-form').serialize(),		
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
	  
	  go_find(e,'absensi/day_off/search/');
	  
   });
   
</script>
