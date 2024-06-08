<section class="wrapper">
   <div class="row">
      <div class="col-lg-9 main-chart">
         <!-- /row mt -->	
         
         <!-- 
            rata-rata
            rata-rata
            current_bulan
         -->
         
         <div class="row mt">
            <!-- /col-md-4 -->
            <?php if($all_divisi_all_all->num_rows() > 0){ ?>
            <div class="col-md-4 mb">
               <!-- WHITE PANEL - TOP USER -->
               <div class="white-panel pn">
                  <div class="white-header">
                     <h5>TOP KPI</h5>
                  </div>
                  <?php $r = $this->basecrud_m->get_where('karyawan',array('id'=>$all_divisi_all_all->row()->id_karyawan))->row();?>
                  <p><img src="<?php echo base_url() . 'uploaded_files/' . $r->img_badan;?>" class="img-circle" width="80"></p>                  
                  <p><b><?php echo $r->nama_lengkap; ?></b></p>
                  <div class="row">
                     <div class="col-md-6">
                        <p class="small mt">Mulai Kerja</p>
                        <p><?php echo $r->tgl_masuk_kerja;?></p>
                     </div>
                     <div class="col-md-6">
                        <p class="small mt">Rata-rata</p>
                        <p><?php echo $all_divisi_all_all->row()->rata_rata;?></p>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>
            
            <?php if($all_divisi_curryear_all->num_rows() > 0){ ?>
            <div class="col-md-4 mb">
               <!-- WHITE PANEL - TOP USER -->
               <div class="white-panel pn">
                  <div class="white-header">
                     <h5>TOP KPI TAHUN INI</h5>
                  </div>
                  <?php $r = $this->basecrud_m->get_where('karyawan',array('id'=>$all_divisi_curryear_all->row()->id_karyawan))->row();?>
                  <p><img src="<?php echo base_url() . 'uploaded_files/' . $r->img_badan;?>" class="img-circle" width="80"></p>                  
                  <p><b><?php echo $r->nama_lengkap; ?></b></p>
                  <div class="row">
                     <div class="col-md-6">
                        <p class="small mt">Mulai Kerja</p>
                        <p><?php echo $r->tgl_masuk_kerja;?></p>
                     </div>
                     <div class="col-md-6">
                        <p class="small mt">Rata-rata</p>
                        <p><?php echo $all_divisi_curryear_all->row()->rata_rata;?></p>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>

            <?php if($all_divisi_curryear_currmonth->num_rows() > 0){ ?>
            <div class="col-md-4 mb">
               <!-- WHITE PANEL - TOP USER -->
               <div class="white-panel pn">
                  <div class="white-header">
                     <h5>TOP KPI BULAN INI</h5>
                  </div>
                  <?php $r = $this->basecrud_m->get_where('karyawan',array('id'=>$all_divisi_curryear_currmonth->row()->id_karyawan))->row();?>
                  <p><img src="<?php echo base_url() . 'uploaded_files/' . $r->img_badan;?>" class="img-circle" width="80"></p>                  
                  <p><b><?php echo $r->nama_lengkap; ?></b></p>
                  <div class="row">
                     <div class="col-md-6">
                        <p class="small mt">Mulai Kerja</p>
                        <p><?php echo $r->tgl_masuk_kerja;?></p>
                     </div>
                     <div class="col-md-6">
                        <p class="small mt">Nilai</p>
                        <p><?php echo $all_divisi_curryear_currmonth->row()->current_bulan;?></p>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>

            <!-- /col-md-4 -->
         <?php if($curr_divisi !== 'TRUE'){ ?>
            
            <?php if($curr_divisi_all_all->num_rows() > 0){ ?>
            <div class="col-md-4 mb">
               <!-- WHITE PANEL - TOP USER -->
               <div class="white-panel pn">
                  <div class="white-header">
                     <h5>TOP KPI (DIVISI)</h5>
                  </div>
                  <?php $r = $this->basecrud_m->get_where('karyawan',array('id'=>$curr_divisi_all_all->row()->id_karyawan))->row();?>
                  <p><img src="<?php echo base_url() . 'uploaded_files/' . $r->img_badan;?>" class="img-circle" width="80"></p>                  
                  <p><b><?php echo $r->nama_lengkap; ?></b></p>
                  <div class="row">
                     <div class="col-md-6">
                        <p class="small mt">Mulai Kerja</p>
                        <p><?php echo $r->tgl_masuk_kerja;?></p>
                     </div>
                     <div class="col-md-6">
                        <p class="small mt">Rata-rata</p>
                        <p><?php echo $curr_divisi_all_all->row()->rata_rata;?></p>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>
            <!-- /col-md-4 -->
            <!-- /col-md-4 -->
            <?php if($curr_divisi_curryear_all->num_rows() > 0){ ?>
            <div class="col-md-4 mb">
               <!-- WHITE PANEL - TOP USER -->
               <div class="white-panel pn">
                  <div class="white-header">
                     <h5>TOP KPI TAHUN INI (DIVISI)</h5>
                  </div>
                  <?php $r = $this->basecrud_m->get_where('karyawan',array('id'=>$curr_divisi_curryear_all->row()->id_karyawan))->row();?>
                  <p><img src="<?php echo base_url() . 'uploaded_files/' . $r->img_badan;?>" class="img-circle" width="80"></p>                  
                  <p><b><?php echo $r->nama_lengkap; ?></b></p>
                  <div class="row">
                     <div class="col-md-6">
                        <p class="small mt">Mulai Kerja</p>
                        <p><?php echo $r->tgl_masuk_kerja;?></p>
                     </div>
                     <div class="col-md-6">
                        <p class="small mt">TOTAL SPEND</p>
                        <p><?php echo $curr_divisi_curryear_all->row()->rata_rata;?></p>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>
            <!-- /col-md-4 -->
            <?php if($curr_divisi_curryear_currmonth->num_rows() > 0){ ?>
            <div class="col-md-4 mb">
               <!-- WHITE PANEL - TOP USER -->
               <div class="white-panel pn">
                  <div class="white-header">
                     <h5>TOP KPI BULAN INI (DIVISI)</h5>
                  </div>
                  <?php $r = $this->basecrud_m->get_where('karyawan',array('id'=>$curr_divisi_curryear_currmonth->row()->id_karyawan))->row();?>
                  <p><img src="<?php echo base_url() . 'uploaded_files/' . $r->img_badan;?>" class="img-circle" width="80"></p>                  
                  <p><b><?php echo $r->nama_lengkap; ?></b></p>
                  <div class="row">
                     <div class="col-md-6">
                        <p class="small mt">Mulai Kerja</p>
                        <p><?php echo $r->tgl_masuk_kerja;?></p>
                     </div>
                     <div class="col-md-6">
                        <p class="small mt">Nilai</p>
                        <p><?php echo $curr_divisi_curryear_currmonth->row()->current_bulan;?></p>
                     </div>
                  </div>
               </div>
            </div>
            <?php } ?>
         <?php } ?>

         </div>
         <!-- /row -->
         
      </div>
      <!-- /col-lg-9 END SECTION MIDDLE -->
      
   </div>
   <!--/row -->
</section>
<script type="application/javascript">
   $(document).ready(function () {
       
   });
   
</script>