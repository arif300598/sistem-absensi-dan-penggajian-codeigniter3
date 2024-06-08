var $ = jQuery.noConflict();

$(function() {

    var loginPage = $('#login-page');
    
    loginPage.find('form').submit(function(e) {
        // Preventing form submissions. If you implement
        // a backend, you might want to remove this code
        e.preventDefault();       
        //$('#alert-msg').hide();
        
        $.ajax({
            url: rootWebService + 'sign_in',
            type: 'POST',            
            cache: false,
            async: false,
            data: $('#login-form').serialize(),
            success: function(response) {
                
                var msg = response.msg;
                var css_class = response.css_class;
                
                if (msg === 'OK') {
                  window.location = rootWebService;  
                }else{
                  $('#alert-msg').removeClass().addClass(css_class);  
                  $('#alert-msg').show();
                  $('#alert-msg').html(msg);  
                }
            }, //success
            error: function(xhr, ajaxOption, thrownError) {

              $('#alert-msg').show();                    
              $('#alert-msg').html(thrownError);
            } //error
        }); //ajax

    });


});