$(document).ready(function () {


    
    $('input').focus(function () {

        $(this).siblings('label').addClass('active');
    });

 
    $('input').blur(function () {
        // Email
        if ($(this).hasClass('email') || $(this).hasClass('loginPassword') || $(this).hasClass('loginemail')) {
            if ($(this).val().length == '') {
                $(this).siblings('span.error').text('*veuillez remplir ce champ').fadeIn().parent('.form-group').addClass('hasError');
            } else {
                $(this).siblings('.error').text('').fadeOut().parent('.form-group').removeClass('hasError');
            }
        }
        
      
        if ($(this).val().length > 0) {
            $(this).siblings('label').addClass('active');
        } else {
            $(this).siblings('label').removeClass('active');
        }
    });

    
  
    $('a.switch').click(function (e) {
        $(this).toggleClass('active');
        e.preventDefault();

        if ($('a.switch').hasClass('active')) {
            $(this).parents('.form-peice').addClass('switched').siblings('.form-peice').removeClass('switched');
        } else {
            $(this).parents('.form-peice').removeClass('switched').siblings('.form-peice').addClass('switched');
        }
    });

 
   

    $('a.profile').on('click', function () {
        location.reload(true);
    });
  
    

});