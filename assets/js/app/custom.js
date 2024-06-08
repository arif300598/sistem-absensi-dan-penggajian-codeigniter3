var $ = jQuery.noConflict();


function test_function(){
  alert('test_function');  
}

// SEARCH ----------------------------------------
function clear_search() {
  $('#pencarian').val("");
  $('#pencarian').trigger({type: 'keypress', which: 13, keyCode: 13});
}

function go_find(e,url_path) {
  if(e.which == 13) {
      var string_cari = $('#pencarian').val();
      $.ajax({
         type: 'GET',
         url:  rootWebService + url_path + string_cari,
         async: true,
         success: function (data) {
            $('#main-content').html(data);
            $('#pencarian').val(string_cari);
            
            var SearchInput = $('#pencarian');
            
            var strLength= SearchInput.val().length * 2;			   
            SearchInput.focus();
            SearchInput[0].setSelectionRange(strLength, strLength);
         },
         error:function(){
           
         }
      })
   }else if(e.which == 8 && ($('#pencarian').val().trim().length == 1)){
         $('#pencarian').val("");
         $('#pencarian').trigger({type: 'keypress', which: 13, keyCode: 13});
         
   }
}

//delete data

function delete_data(id,url_path){
  var answer =  confirm('Anda yakin ingin menghapus data ini?');
  if (answer) {
      $.ajax({
        type:'POST',
        async: false,
        cache: false,
        url: url_path + id,
        success: function(data){				 
           /*$('.content-panel').fadeOut(500,function(){
               $('#main-content').html(data);						
           }).fadeIn('slow');			  */
            var tr  = $('#row_' + id);
            tr.css("background-color","").css("background-color","#FF3700");
            tr.fadeOut(400, function(){
               tr.remove();
               $('#main-content').html(data);
            });
        }
      });
  }
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split(',');
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}

applyPagination();	  
function applyPagination() {
   $("#ajax_paging a").click(function() {                
      var url = $(this).attr("href");          
      $.ajax({
         type: "POST",
         data: "ajax=1",
         cache: false,
         async: false,
         url: url, 
         success: function(msg) {
            $('#main-content').fadeOut(0,function(){
                $('#main-content').html(msg);					  
                applyPagination();                    
            }).fadeIn(0);                       
         }
      });              
      return false;
   });
}
	
jQuery.fn.flash = function( color, duration )
{
    var current = this.css( 'color' );
    this.animate( { color: 'rgb(' + color + ')' }, duration / 2 );
    this.animate( { color: current }, duration / 2 );
}    
    
$(document).ready(function () {
	getPage();         
	function getPage() {
	   $("#sidebar a").click(function() {             
 
		  var url = $(this).attr("link");
		  //var push_state = $(this).attr("push_state");
		  //window.history.pushState('obj', 'newtitle', '/sawerigading/' + push_state);
		  var web_title = $(this).attr("web_title");
          
          var opts = {
              lines: 8, // The number of lines to draw
              length: 15, // The length of each line
              width: 10, // The line thickness
              radius: 15, // The radius of the inner circle
              corners: 1, // Corner roundness (0..1)
              rotate: 0, // The rotation offset
              direction: 1, // 1: clockwise, -1: counterclockwise
              color: '#000', // #rgb or #rrggbb or array of colors
              speed: 1, // Rounds per second
              trail: 60, // Afterglow percentage
              shadow: true, // Whether to render a shadow
              hwaccel: false, // Whether to use hardware acceleration
              className: 'spinner', // The CSS class to assign to the spinner
              zIndex: 2e9, // The z-index (defaults to 2000000000)
              top: '50%', // Top position relative to parent
              left: '50%' // Left position relative to parent
            };
          var target = document.getElementById('loader');
          var spinner = new Spinner(opts).spin();
          
          if (url !== 'javascript:;') {
              $.ajax({
                 type: "POST",
                 data: "ajax=1",
                 cache: false,
                 async: false,
                 url: url,
                 beforeSend: function() {
                      $('#loader').show();                      
                      target.appendChild(spinner.el);
                 },
                 success: function(msg) {  
                        
                    $('#main-content').fadeOut(250,function(){
                        $('#main-content').html(msg);                       
                        $('#loader').hide();
                        spinner.stop();
                       
                        document.title = web_title;                        
                    }).fadeIn(0);
                    
                    
                 },
                 error:function(){
                    if (web_title !== '-') {
                      var con_failed =
                                '<section class="wrapper">' +  
                                '    <div class="row mt">' +  
                                '       <div class="col-lg-12">' +  				
                                '         <div id="alert-connection-failed" class="alert alert-danger">' +  
                                '           <b>Peringatan!</b><br>Koneksi ke Server Terputus atau Bermasalah !<br>' +
                                '           Mohon Periksa Koneksi Internet Anda' +  
                                '         </div>' +  
                                '       </div>' +  
                                '    </div>' +  
                                ' </section>';
                      $('#main-content').html(con_failed); 
                      //$( '#main-content' ).flash( '255,0,0', 1000 );
                      //$('#main-content').html(con_failed);  
                    }
                    
                    
                 }
              });              
            
          }else{
            document.title = web_title;
          }
		  return false;
	   });
	}

})