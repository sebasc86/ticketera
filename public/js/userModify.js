$( document ).ready(function() {
  console.log('init.userModify')


  var name = $('#name')

  name.one('blur', validateInput)

  var inputEmailNode = $('#email')

  inputEmailNode.on('blur', isValidEmailAddress)

  var password = $('#password')

  password.one('blur', validateInputPassword)

  var confirmPass = $('#password-confirm')

  confirmPass.one('blur', validateInputConfirmPass)


  var sectorId = $("#sector_id option:selected").attr('value');
  var isAdmin = $("#isAdmin option:selected").attr('value');

  $(document).on('change', '#sector_id', function(event) {
    sectorId = $("#sector_id option:selected").attr('value');
  });

  $(document).on('change', '#isAdmin', function(event) {
    isAdmin = $("#isAdmin option:selected").attr('value');
  });


 
  $("input").prop('disabled', true);

  $(document).on('click', '.col-md-6', function(e) {
    $(this).children().removeAttr('disabled');
    $(this).children('.pencil').last().remove()
  });




  $('#submitButton').on('click', function(e){
      e.preventDefault()
      nameValue = $.trim($('#name').val())
      emailValue = $.trim($('#email').val())
      passValue = $.trim($('#password').val())
      $('#errorEmail').html('')
      $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      $.ajax({
              url: '/users/id/update',
              method: 'patch',
              data: { "data" : {	
                  sector: sectorId,
                  admin: isAdmin,
                  name: nameValue,
                  email: emailValue,
                  pass: passValue,
                  }
              },
              success: function(result){
                  if(result.success === "1"){
                  console.log(result.success)

                  }else {
                    console.log(result.success)
                    if(result.errorEmail != null){
                      $("#email").after('<span id="errorEmail" style="color:red">*'+  result.errorEmail  +'</span>');
                      inputEmailNode.removeClass('is-valid')
                      inputEmailNode.addClass('is-invalid')

                    }
                  };
              
      }});
      })




  function isValidEmailAddress(event) {
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    var inputEmailNode = $(this)
    var value = inputEmailNode.val()
    var trueOrFalse = pattern.test(value);
    inputEmailNode.next().remove()
    console.log(trueOrFalse);

    if (!value) {
      inputEmailNode.removeClass('is-valid')
      inputEmailNode.addClass('is-invalid')
      var errorLabel = '*El campo es requerido'
      inputEmailNode.parent().append('<div style="color:red">' + errorLabel + '</div>')
    } else if(trueOrFalse === false) {
      inputEmailNode.removeClass('is-valid')
      inputEmailNode.addClass('is-invalid')
      var errorLabel = '*El email no es válido'
      inputEmailNode.parent().append('<div style="color:red">' + errorLabel + '</div>')
    } else {
      inputEmailNode.removeClass('is-invalid')
      inputEmailNode.addClass('is-valid')
    }

    if (event.type === 'blur') {
      inputEmailNode.on('input', isValidEmailAddress)
    }

    validateSubmitButton ()
}

  function validateInput (event) {
    var inputNode = $(this)
    var value = inputNode.val()
    value = $.trim(value)
    var errorLabel = ''

    inputNode.next().remove()

    if (!value) {
      inputNode.removeClass('is-valid')
      inputNode.addClass('is-invalid')
      errorLabel = '*El campo es requerido'
      inputNode.parent().append('<div style="color:red">' + errorLabel + '</div>')
    } else if (value.length <5) {
      inputNode.removeClass('is-valid')
      inputNode.addClass('is-invalid')
      errorLabel = '*Minimo 10 Caracteres'
      inputNode.parent().append('<div style="color:red">' + errorLabel + '</div>')
    } else {
      inputNode.removeClass('is-invalid')
      inputNode.addClass('is-valid')
    }

    if (event.type === 'blur') {
      inputNode.on('input', validateInput)
    }

    validateSubmitButton ()

  }

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
  







})