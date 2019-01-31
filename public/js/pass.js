$( document ).ready(function() {
  console.log('init.passjs')

  var password = $('#password')

  password.one('blur', validateInputPassword)

  var confirmPass = $('#password-confirm')

  confirmPass.one('blur', validateInputConfirmPass)

 
  $("input").prop('disabled', true);

  $(document).on('click', '.col-md-6', function(e) {
    $(this).children().removeAttr('disabled');
    $(this).children('.pencil').last().remove()
  });




  $('#submitButton').on('click', function(e){
      e.preventDefault()
      passValue = $('#password').val()
      $('#errorPass').remove()
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
              url: '/password/update',
              method: 'patch',
              data: { "data" : {	
                  pass: passValue,
                  }
              },
              success: function(result){

                  if(result.success === "1"){
                    $('#exampleModal').modal({
                      show: true
                    })

                  }else {

                    if(result.errorPass != null){
                      $("#email").after('<span id="errorEmail" style="color:red">*'+  result.errorPass  +'</span>');
                      confirmPass.removeClass('is-valid')
                      confirmPass.addClass('is-invalid')

                    }
                  };
              
      }});
      })




  

  function validateInputPassword (event) {
    var inputNodePass = $(this)
    var value = inputNodePass.val()
    value = $.trim(value)
    var errorLabel = ''
    inputNodePass.next().remove()

    if (value.length < 6) {
      inputNodePass.removeClass('is-valid')
      inputNodePass.addClass('is-invalid')
      errorLabel = '*Minimo 6 Caracteres'
      inputNodePass.parent().append('<div style="color:red">' + errorLabel + '</div>')
    }else if (confirmPass.val() != value) {
      inputNodePass.removeClass('is-valid')
      inputNodePass.addClass('is-invalid')
      errorLabel = '*Las contraseñas son diferentes'
      inputNodePass.parent().append('<div style="color:red">' + errorLabel + '</div>')
    } else {
      inputNodePass.removeClass('is-invalid')
      inputNodePass.addClass('is-valid')
    }

    if (event.type === 'blur') {
      inputNodePass.on('input', validateInputPassword)
    }

    validateSubmitButton ()

  }

  function validateInputConfirmPass (event) {
    var inputNodePass = $(this)
    var value = inputNodePass.val()
    value = $.trim(value)
    var errorLabel = ''
    var passwordValue = password.val();

    inputNodePass.next().remove()

    if (value.length < 6) {
      inputNodePass.removeClass('is-valid')
      inputNodePass.addClass('is-invalid')
      errorLabel = '*Minimo 6 Caracteres'
      inputNodePass.parent().append('<div style="color:red">' + errorLabel + '</div>')
    } else if (passwordValue != value) {
      inputNodePass.removeClass('is-valid')
      inputNodePass.addClass('is-invalid')
      errorLabel = '*Las contraseñas son diferentes'
      inputNodePass.parent().append('<div style="color:red">' + errorLabel + '</div>')
    }else {
      inputNodePass.removeClass('is-invalid')
      inputNodePass.addClass('is-valid')
      password.addClass('is-valid')
      password.removeClass('is-invalid')
      password.next().html('')
    }

    if (event.type === 'blur') {
      inputNodePass.on('input', validateInputConfirmPass)
    }

    validateSubmitButton ()

  }


  function validateSubmitButton () {
    if ($('.is-invalid').length >= 1) {
      $('#submitButton').attr('disabled', true)
    } else {
      $('#submitButton').removeAttr('disabled')
    }
  }
  


    //drop menu navbar
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');
    
    
      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
      });
    
    
      return false;
    });





})