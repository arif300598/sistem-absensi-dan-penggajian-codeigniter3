<style>
   input{
		
	  padding: 2px;
	  border-width: medium medium 2px;
	  border-style: none none solid;
	  border-color: -moz-use-text-color -moz-use-text-color #C9C9C9;
	  -moz-border-top-colors: none;
	  -moz-border-right-colors: none;
	  -moz-border-bottom-colors: none;
	  -moz-border-left-colors: none;
	  border-image: none;
	  transition: border 0.3s ease 0s;

   }
   
   input:focus{

       border: 1px solid #707070;
       box-shadow: 0px 0px 2px 1px #969696;

   }
</style>
<section class="wrapper">  
   
   <!-- /row -->
   <div class="row mt">
      <div class="col-lg-12">	
		
		 <div class="form-panel" style="display:none">
			<div id="alert-msg" class="alert alert-danger" style="display:none;">
				<b>Peringatan!</b><br>msg
			</div>
			<h4 class="mb"><i class="fa fa-angle-right"></i> Form Generate Gaji</h4>
			<form class="form-horizontal style-form" id="gaji-form" method="POST" action="<?=base_url() . 'penggajian/generate'?>">
				<input type="hidden" name="ajax" value="1">
				<div class="form-group" id="divisi-gaji-generate-row">
					<label class="col-sm-2 col-sm-2 control-label">Nama Divisi</label>
					<div class="col-sm-4">					   
					   <select class="form-control" id="divisi-gaji-generate" name="id_divisi">
						   <?php $divisi_gaji= $this->session->userdata('divisi-gaji');?>						   
						   <?php foreach($rs_divisi->result() as $divisi){ ?>
						   <option value="<?=$divisi->id;?>" <?=($divisi->id == $divisi_gaji) ? 'selected':'';?> ><?=$divisi->nama;?></option>
						   <?php } ?>
					   </select>		
					</div>
				</div>
			   <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Tahun</label>
					<div class="col-sm-4">					   
                         <select class="form-control" id="tahun-gaji-generate" name="tahun" style="width:  150px">
                          <?php
							  $tahun_gaji= $this->session->userdata('tahun-gaji');
							  $now = new DateTime();
						      $year_now = $now->format("Y");							  
						   ?>
                          <?php for($i = 2014;$i <= $year_now;$i++){ ?>
                          <option value="<?=$i;?>" <?=($i == $tahun_gaji) ? 'selected':'';?>  ><?=$i;?></option>
                          <?php } ?>
                        </select>
					</div>
				</div>
			   
   			   <div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Bulan</label>
					<div class="col-sm-4">					   
                         <select class="form-control" id="bulan-gaji-generate" name="bulan" style="width:  150px">                          
                          <?php $bulan_gaji= $this->session->userdata('bulan-gaji');?>
                          <option value="1" <?=($bulan_gaji == "1") ? 'selected':'';?> >Januari</option>
                          <option value="2" <?=($bulan_gaji == "2") ? 'selected':'';?> >Februari</option>
                          <option value="3" <?=($bulan_gaji == "3") ? 'selected':'';?> >Maret</option>
                          <option value="4" <?=($bulan_gaji == "4") ? 'selected':'';?> >April</option>
                          <option value="5" <?=($bulan_gaji == "5") ? 'selected':'';?> >Mei</option>
                          <option value="6" <?=($bulan_gaji == "6") ? 'selected':'';?> >Juni</option>
                          <option value="7" <?=($bulan_gaji == "7") ? 'selected':'';?> >Juli</option>
                          <option value="8" <?=($bulan_gaji == "8") ? 'selected':'';?> >Agustus</option>
                          <option value="9" <?=($bulan_gaji == "9") ? 'selected':'';?> >September</option>
                          <option value="10" <?=($bulan_gaji == "10") ? 'selected':'';?> >Oktober</option>
                          <option value="11" <?=($bulan_gaji == "11") ? 'selected':'';?> >November</option>
                          <option value="12" <?=($bulan_gaji == "12") ? 'selected':'';?> >Desember</option>                          
                        </select>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button class="btn btn-default " type="button" id="btn-cancel">Batal</button>
						<button class="btn btn-theme" type="submit">Generate</button>						
					</div>
				</div>
		        
			</form>
		</div>

         <div class="content-panel">
			
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-generate">Generate Data</button>
            <button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-export-excel">Export Table ke Excel</button>
			<button type="button" style="margin-right: 10px" class="btn btn-info pull-right" id="btn-slip-gaji">Buat Slip Gaji</button>
            <h4><i class="fa fa-angle-right"></i> Data Penggajian</h4>
			
			<table class="table table-bordered table-striped table-condensed cf">
			   <tbody>
				  <tr>
					 <td style="text-align: right;vertical-align: middle">
						<strong>Filter Pencarian</strong>
					 </td>

					 <td style="width:  150px" id="divisi-gaji-row">
						<div class="input-group">						   	
						   <select class="form-control" id="divisi-gaji" name="divisi-gaji">
							 <?php $divisi_gaji= $this->session->userdata('divisi-gaji');?>
							 <option value="all">Semua Divisi</option>
							 <?php foreach($rs_divisi->result() as $divisi){ ?>
							 <option value="<?=$divisi->id;?>" <?=($divisi->id === $divisi_gaji) ? 'selected':'';?> ><?=$divisi->nama;?></option>
							 <?php } ?>
						   </select>						   
						 </div>
					 </td>
					 <td style="width:  150px">
                      <div class="input-group">
                         <select class="form-control" id="tahun-gaji" name="tahun-gaji" style="width:  150px">
                          <?php
							  $tahun_gaji= $this->session->userdata('tahun-gaji');
							  $now = new DateTime();
						      $year_now = $now->format("Y");							  
						   ?>
                          <?php for($i = 2014;$i <= $year_now;$i++){ ?>
                          <option value="<?=$i;?>" <?=($i == $tahun_gaji) ? 'selected':'';?>  ><?=$i;?></option>
                          <?php } ?>
                        </select>
                      </div>
                     </td>

   					 <td style="width: 150px">
                      <div class="input-group">
                         <select class="form-control" id="bulan-gaji" name="bulan-gaji" style="width:  150px">                          
                          <?php $bulan_gaji= $this->session->userdata('bulan-gaji');?>
                          <option value="1" <?=($bulan_gaji == "1") ? 'selected':'';?> >Januari</option>
                          <option value="2" <?=($bulan_gaji == "2") ? 'selected':'';?> >Februari</option>
                          <option value="3" <?=($bulan_gaji == "3") ? 'selected':'';?> >Maret</option>
                          <option value="4" <?=($bulan_gaji == "4") ? 'selected':'';?> >April</option>
                          <option value="5" <?=($bulan_gaji == "5") ? 'selected':'';?> >Mei</option>
                          <option value="6" <?=($bulan_gaji == "6") ? 'selected':'';?> >Juni</option>
                          <option value="7" <?=($bulan_gaji == "7") ? 'selected':'';?> >Juli</option>
                          <option value="8" <?=($bulan_gaji == "8") ? 'selected':'';?> >Agustus</option>
                          <option value="9" <?=($bulan_gaji == "9") ? 'selected':'';?> >September</option>
                          <option value="10" <?=($bulan_gaji == "10") ? 'selected':'';?> >Oktober</option>
                          <option value="11" <?=($bulan_gaji == "11") ? 'selected':'';?> >November</option>
                          <option value="12" <?=($bulan_gaji == "12") ? 'selected':'';?> >Desember</option>                          
                        </select>
                      </div>
                     </td>

					 <td style="width:  250px">
						<div class="input-group">
                          <input id="pencarian" class="clearable form-control round-form" type="text" value="<?=$this->session->userdata('gaji-cari');?>" autocomplete="off">
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
				<?php if(!$this->session->userdata('gaji-cari')){ ?>
				<!--<p style="text-align: center"><button type="button" style="margin-right: 10px" class="btn btn-info" id="btn-generate">Generate Data</button></p>-->
				<?php } ?>
			</div>
			<?php }else{ ?>
			
            <section id="no-more-tables">
               <table class="table table-bordered table-striped table-condensed cf">
                  <thead class="cf">
                     <tr>                                              
                        <!--<th>Divisi</th>
                        <th>Jabatan</th>-->
                        <th style="width: 300px"></th>
						<th style="width: 100px;text-align: center">Gaji Pokok</th>
						<th style="width: 50px;text-align: center">Kerja</th>				
						<th style="text-align: center">KPI</th>
						<th style="width: 150px;text-align: center">Telat</th>
						<th style="text-align: center">Tunjangan</th>						
						<th style="width: 90px;text-align: center">Bonus</th>						
						<th style="text-align: center">Potongan</th>
						<th style="text-align: center">Gaji Diterima</th>
                     </tr>
                  </thead>
                  <tbody>					 
				  <?php
				  
                  foreach ($rs->result() as $r) { ?>

					<tr style="background-color: #F1F1F1" id="row_<?php echo $r->id;?>">                        
                        <td>
						   <?=$r->nama_lengkap;?><?=!empty($r->nik) ? ' (' . $r->nik . ')' : '';?><br>
						   <?=$r->divisi; ?> | <?=$r->jabatan; ?><br>
						   <?php
							  $today = date_create(date('Y-m-d'));
							  //$tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja . '-1 days')));
							  $tgl_masuk = date_create(date('Y-m-d', strtotime($r->tgl_masuk_kerja)));
							  $diff = date_diff($today, $tgl_masuk);
							  echo 'Masa Kerja: '.date_interval_format($diff, "%y tahun %m bulan dan %d hari");
						   ?><br>
						   
						   <?php if($r->sisa_hutang != 0 && ($r->show_hutang == 1)){ ?>
						   <span class="label label-warning">Sisa Hutang : <?=formatRupiah($r->sisa_hutang);?></span>
						   <?php } ?>
						   
						</td>
						<td><?=formatRupiah($r->gaji_pokok);?></td>
						<td style="text-align: center">
						   <input id="txt_jmlkerja_<?php echo $r->id;?>" style="width: 50px" type="text" value="<?=$r->jml_hr_kerja;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off">						   
						</td>
						<td>
						   <input id="txt_kpi_<?php echo $r->id;?>" style="width: 50px" type="text" value="<?=$r->kpi;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						</td>
						
						<td style="text-align: left">
						   Hari Biasa: <input id="txt_telatbiasa_<?php echo $r->id;?>" style="width: 50px" type="text" value="<?=$r->jml_telat_hr_biasa;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						   Hari Besar: <input id="txt_telatbesar_<?php echo $r->id;?>" style="width: 50px" type="text" value="<?=$r->jml_telat_hr_besar;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						   <div id="denda_telat_<?php echo $r->id;?>">Denda : <?=formatRupiah($r->denda_telat);?></div>
						</td>
						<td>
						   <?=formatRupiah($r->tunjangan);?>
						</td>
						<td>
						   Rp<input id="txt_bonus_<?php echo $r->id;?>" style="width: 60px" type="text" value="<?=$r->bonus;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						</td>
						
						<td style="text-align: right">
						   Barang:&nbsp;&nbsp;Rp<input id="txt_potbarang_<?php echo $r->id;?>" style="width: 60px" type="text" value="<?=$r->potongan_barang;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						   Hutang:&nbsp;&nbsp;Rp<input id="txt_pothutang_<?php echo $r->id;?>" style="width: 60px" type="text" value="<?=$r->potongan_hutang;?>" <?php echo ($r->show_hutang == 0) ? 'readonly':'';?>  onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						   Lainnya:&nbsp;&nbsp;&nbsp;Rp<input id="txt_potlain_<?php echo $r->id;?>" style="width: 60px" type="text" value="<?=$r->potongan_lain;?>" onkeyup="update('<?php echo $r->id;?>');" autocomplete="off"><br>
						</td>
						<td>
						   <input type="hidden" id="jml_hari_<?php echo $r->id;?>" value="<?php echo $r->jml_hari;?>">
						   <input type="hidden" id="gaji_pokok_<?php echo $r->id;?>" value="<?php echo $r->gaji_pokok;?>">
						   <input type="hidden" id="gaji_kotor_<?php echo $r->id;?>" value="<?php echo $r->gaji_kotor;?>">
						   <input type="hidden" id="tunjangan_<?php echo $r->id;?>" value="<?php echo $r->tunjangan;?>">
						   <input type="hidden" id="denda_telat_hr_biasa_<?php echo $r->id;?>" value="<?php echo $r->denda_telat_hr_biasa;?>">
						   <input type="hidden" id="denda_telat_hr_besar_<?php echo $r->id;?>" value="<?php echo $r->denda_telat_hr_besar;?>">						   
						   <input type="hidden" id="denda_telat_<?php echo $r->id;?>" value="<?php echo $r->denda_telat;?>">
						   
							  
						   <?php $gaji_kotor = $r->gaji_kotor;?>
						   <?php $gaji_kpi = (($r->kpi >= 100) ? $gaji_kotor: $gaji_kotor * ($r->kpi/100));?>
						   <?php $gaji_bersih = ($gaji_kpi + $r->bonus + $r->tunjangan) - ($r->denda_telat + $r->potongan_barang + $r->potongan_hutang + $r->potongan_lain);?>
						   <div id="gaji_bersih_<?php echo $r->id;?>">
							  <b><?=formatRupiah((ROUND($gaji_bersih/1000,0) * 1000));?></b>
						   </div><br>						   
						</td>						
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
		 $('#divisi-gaji-row').hide();
		 $('select[name="id_divisi"]').find('option[value="' + <?php echo $a;?> + '"]').attr("selected", true);
		 $('#divisi-gaji-generate-row').hide();
	<?php } ?>

   function update(id) {
	  /*
		 row_
		 txt_jmlkerja_
		 txt_telatbiasa_
		 txt_telatbesar_
		 txt_bonus_
		 txt_kpi_
		 txt_potbarang_
		 txt_pothutang_
		 txt_potlain_
		 gaji_kotor_
		 denda_telat_
	  */
	  
	  //alert(id);
	  
	  var tr 				= $('#row_' + id);	  
	  var txt_jmlkerja 		= $('#txt_jmlkerja_' + id).val();	  
	  var txt_telatbiasa	= $('#txt_telatbiasa_' + id).val();
	  var txt_telatbesar	= $('#txt_telatbesar_' + id).val();
	  var txt_bonus			= $('#txt_bonus_' + id).val();
	  var txt_kpi		   	= $('#txt_kpi_' + id).val();
	  var txt_potbarang		= $('#txt_potbarang_' + id).val();
	  var txt_pothutang		= $('#txt_pothutang_' + id).val();
	  var txt_potlain		= $('#txt_potlain_' + id).val();
	  var gaji_kotor		= $('#gaji_kotor_' + id).val();
	  var gaji_pokok		= $('#gaji_pokok_' + id).val();
	  var tunjangan			= $('#tunjangan_' + id).val();
	  var denda_telat		= $('#denda_telat_' + id).val();
	  var jml_hari			= $('#jml_hari_' + id).val();
	  
	  var denda_telat_hr_biasa		= $('#denda_telat_hr_biasa_' + id).val();
	  var denda_telat_hr_besar		= $('#denda_telat_hr_besar_' + id).val();
	  
	  /*start check here...*/
	  
	  /* end check here...*/
	  var values = {
			'id_gaji'				: id,
			'jml_hr_kerja' 			: txt_jmlkerja,
			'jml_telat_hr_biasa' 	: txt_telatbiasa,
			'jml_telat_hr_besar' 	: txt_telatbesar,
			'bonus'					: txt_bonus,
			'kpi'					: txt_kpi,
			'potongan_barang'		: txt_potbarang,
			'potongan_hutang'		: txt_pothutang,
			'potongan_lain'			: txt_potlain,
			'gaji_kotor'			: gaji_kotor,
			'gaji_pokok'			: gaji_pokok,
			'tunjangan'				: tunjangan,
			'jml_hari'				: jml_hari,
			'denda_telat_hr_biasa'	: denda_telat_hr_biasa,
			'denda_telat_hr_besar'	: denda_telat_hr_besar
	  };
	  
	  $.ajax({
		 url: "<?php echo base_url() . 'penggajian/update'?>",
		 type: "POST",
		 data: values,
		 success: function (data) {
			var gaji_bersih  = data.gaji_bersih;
			var denda_telat = data.denda_telat;
			
			$('#gaji_bersih_' + id).html('<b>' + gaji_bersih + '</b>');
			$('#denda_telat_' + id).html(denda_telat);
		 },
		 error: function () {	
				
		 }
	  });
   }
   
   $('#btn-export-excel').click(function(){	  
	  window.location = "<?php echo base_url(); ?>penggajian/index/export_to_xl";
	});
   
   $('#btn-slip-gaji').click(function(){	  
	  window.location = "<?php echo base_url(); ?>penggajian/index/slip_gaji";
	});
   
    
	function change_filter(str_param) {
		 $.ajax({
			  type: 'GET',
			  url:  '<?=base_url();?>penggajian/index/change-filter/' + str_param,
			  async: true,
			  success: function (data) {
				 $('#main-content').html(data);              
			  },
			  error:function(){
				
			  }
		 })
	}
	
    $('#tahun-gaji,#bulan-gaji,#divisi-gaji').change(function(){
        
        var tahun = $('#tahun-gaji').val();
		var bulan = $('#bulan-gaji').val();        
		var divisi = $('#divisi-gaji').val();
		
		var str_param = tahun + '-' + bulan + '-' + divisi;
		change_filter(str_param);        
        
    })
	
   $('#btn-generate').click(function(){
		$('#alert-msg').hide();
		$('.content-panel').fadeOut(500,function(){
			$('.form-panel').show();			
		});
		return false;
	});
   
   	$('#btn-cancel').click(function(){
		$('.form-panel').fadeOut(500,function(){
			var tahun = $('#tahun-gaji').val();
			var bulan = $('#bulan-gaji').val();        
			var divisi = $('#divisi-gaji').val();
			
			var str_param = tahun + '-' + bulan + '-' + divisi;
			change_filter(str_param);
			
			$('.content-panel').show();						
		});
		return false;
	});
	
	function cek_gaji_list() {
	  
	  //var status = 'DATA-ABSENSI-NOT-FOUND';
	  var status = 'OK';
	  var tahun = $('#tahun-gaji-generate').val();
	  var bulan = $('#bulan-gaji-generate').val();        
	  var divisi = $('#divisi-gaji-generate').val();
	  
	  var str_param = "?th=" + tahun + "&bln=" + bulan + "&div=" + divisi;
	  
	  $.ajax({
         url:'<?php echo base_url() . 'penggajian/cek_gaji_list/'?>' + str_param,                  
         async: false,
		 success: function(data) {
            status  = data.status;
			//alert(status);
         },
	  });  
	  

	  return status;
	  
	}
	
	function go_generate() {
		 
		 var page_url = $('#gaji-form').attr("action");
		 
	  	 $.ajax({
			url: page_url,
			type: 'POST',
			cache: false,
			async: false,
			data: $('#gaji-form').serialize(),
			success: function (data) {				
				var status = data.status;
				var msg = data.msg;
				
				if (status === 'ERROR') {
					$('#alert-msg').show();
					$('#alert-msg').html(msg);
					
				}else{
					$('.form-panel').fadeOut(500,function(){
						var tahun = $('#tahun-gaji').val();
						var bulan = $('#bulan-gaji').val();        
						var divisi = $('#divisi-gaji').val();
						
						var str_param = tahun + '-' + bulan + '-' + divisi;
						change_filter(str_param);
						$('.content-panel').show();						
					});	
				}			
	
			},
			error: function () {	
				
			}
	
		});	
	}
	
   	$("#gaji-form").submit(function(){
		
		//var answer =  confirm('Data ');
		var status = cek_gaji_list();
		//alert(status);
		
		if(status === 'OK'){
			go_generate();
		}else if(status ==='SUDAH-ADA'){
			var answer =  confirm('PERINGATAN!!!\nData penggajian periode diminta sudah ada\n' +
								  'Apakah anda ingin melanjutkan? \n' +
								  'NB: Perubahan manual yang sudah dilakukan akan hilang');
			if (answer) {
			   go_generate();
			}		 
		}else if (status ==='DATA-ABSENSI-NOT-FOUND') {
			alert('PERINGATAN!!!\nData absensi untuk periode diminta, tidak ditemukan!\n' +
				  'Proses tidak dapat dilanjutkan');
		}
		
		return false;
	});

   
   //SEARCH ----------------------------------
   $('#btn-clear-search').on('click',function(e){
	  clear_search();
   });
   
   $('#pencarian').keypress(function(e) {
	  
	  //var tahun = <?=$this->session->userdata('tahun-gaji');?>;
	  //var bulan = <?=$this->session->userdata('bulan-gaji');?>;
	  go_find(e,'penggajian/index/search/');
	  
   });
   
</script>
