<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">	  
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="Dashboard">
      <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
      <title><?=$page_title;?></title>
      <!-- Bootstrap core CSS -->
      <link href="<?=base_url();?>assets/css/bootstrap.css" rel="stylesheet">
      <!--external css-->
      <link href="<?=base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
      <!--<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/js/gritter/css/jquery.gritter.css" />-->
      <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/lineicons/style.css">
	  <!-- Custom styles for this template -->
      <link href="<?=base_url();?>assets/css/style.css" rel="stylesheet">
      <link href="<?=base_url();?>assets/css/style-responsive.css" rel="stylesheet">
      <link rel="stylesheet" href="<?=base_url();?>assets/css/jquery-ui.css">
	  <link type="text/css" rel="stylesheet" href="<?=base_url();?>assets/css/chosen.css">
	  <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/jquery.tree.min.css"/>
	  
      <script src="<?=base_url();?>assets/js/chart-master/Chart.js"></script>
	  
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->  
      <script>
         var rootWebService = '<?=base_url();?>';	            
      </script>
	  
      <script src="<?=base_url();?>assets/js/jquery.js"></script>      
	  <script src="<?=base_url();?>assets/js/jquery-ui-1.11.1.js"></script>	  
	  <script type="text/javascript" src="<?=base_url();?>assets/js/jquery.tree.min.js"></script>	  
      <script src="<?=base_url();?>assets/js/app/custom.js"></script>
	  <style>
		.table > tbody > tr > td {vertical-align: middle;}
	  </style>
   </head>
   <body>
      <section id="container" >
         <!-- **********************************************************************************************************************************************************
            TOP BAR CONTENT & NOTIFICATIONS
            *********************************************************************************************************************************************************** -->
         <!--header start-->
         <header class="header black-bg">
            <div class="sidebar-toggle-box">
               <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="<?=base_url();?>" class="logo"><b>WEB APPLICATION</b></a>
            <!--logo end-->
            <div class="top-menu">
               <ul class="nav pull-right top-menu">
                  <li><a class="logout" href="<?=base_url() . 'sign_out';?>">Sign Out</a></li>
               </ul>
            </div>
         </header>
         <!--header end-->
         <!-- **********************************************************************************************************************************************************
            MAIN SIDEBAR MENU
            *********************************************************************************************************************************************************** -->
         <!--sidebar start-->
         <aside>           
            <div id="sidebar"  class="nav-collapse">
               <!-- sidebar menu start-->
               <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered">
                     <a href="" link="<?=base_url() . 'profile';?>" web_title="Profile">
                     <img src="<?=base_url() . 'uploaded_files/';?><?=$this->session->userdata('img_badan');?>" id="foto_profile" class="img-circle" width="70">
                     </a>
                  </p>
                  <a href="#" link="<?=base_url() . 'profile';?>" web_title="Profile">
					<h5 class="centered"><?=$username;?></h5>
				  </a>
				  
                  <li class="mt">
                     <a class="active" web_title="Dashboard" href="#" link="<?=base_url() . 'dashboard'?>">
                     <i class="fa fa-dashboard"></i>
                     <span>Dashboard</span>
                     </a>
                  </li>				  
				  <?php echo build_menu();?>
               </ul>
               <!-- sidebar menu end-->
            </div>
         </aside>
         <!--sidebar end-->
         <!-- **********************************************************************************************************************************************************
            MAIN CONTENT
            *********************************************************************************************************************************************************** -->
         <!--main content start-->
		 <section id="loader" style="display: none">
			
		 </section>
         <section id="main-content">
            <?php
               $page_name .= ".php";
               include $page_name;
                ?>
         </section>
         <!--main content end-->
      </section>
	  
      <script src="<?=base_url();?>assets/js/chosen.jquery.min.js"></script>      
      <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
      <script class="include" type="text/javascript" src="<?=base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
      <script src="<?=base_url();?>assets/js/jquery.scrollTo.min.js"></script>
      <script src="<?=base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
      <script src="<?=base_url();?>assets/js/jquery.sparkline.js"></script>
      <!--common script for all pages-->
      <script src="<?=base_url();?>assets/js/common-scripts.js"></script>
      <!--<script type="text/javascript" src="<?=base_url();?>assets/js/gritter/js/jquery.gritter.js"></script>-->
      <!--<script type="text/javascript" src="<?=base_url();?>assets/js/gritter-conf.js"></script>-->
      <!--script for this page-->
      <script src="<?=base_url();?>assets/js/sparkline-chart.js"></script>    
      <!--<script src="<?=base_url();?>assets/js/zabuto_calendar.js"></script>-->
	  <script src="<?=base_url();?>assets/js/spin.min.js"></script>
	  <!--<script src="<?=base_url();?>assets/js/jquery.battatech.excelexport.js"></script>-->
	  
	  <script type="application/javascript">
		$(document).ready(function () {
		/*	
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
		*/
			//$('#tree div').tree({});
			//$("#date-popover").popover({html: true, trigger: "manual"});
			//$("#date-popover").hide();
			//$("#date-popover").click(function (e) {
			//	$(this).hide();
			//});
		
			//$("#my-calendar").zabuto_calendar({
			//	action: function () {
			//		return myDateFunction(this.id, false);
			//	},
			//	action_nav: function () {
			//		return myNavFunction(this.id);
			//	},
			//	ajax: {
			//		url: "show_data.php?action=1",
			//		modal: true
			//	},
			//	legend: [
			//		{type: "text", label: "Special event", badge: "00"},
			//		{type: "block", label: "Regular event", }
			//	]
			//});
		});
		
		
		//function myNavFunction(id) {
		//	$("#date-popover").hide();
		//	var nav = $("#" + id).data("navigation");
		//	var to = $("#" + id).data("to");
		//	console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
		//}
	 </script>
	  
   </body>
</html>