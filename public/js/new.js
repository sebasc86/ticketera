$( document ).ready(function() {
    console.log('init.newjs')

    $('#queue').on('blur', validateSelect)

    var inputClientNode = $('#clientN')
    inputClientNode.on('blur', validateInputNumber)

    var inputtitleNode = $('#title')
    inputtitleNode.on('blur', inputNode)



   
    function validateSelect() {
        var inputSelectNode = $( "#formTarget option:selected" )
        inputSelectNodeVal = inputSelectNode.val()
        inputSelectNodeVal = parseInt(inputSelectNodeVal) 
        var errorLabel = '' 
        if(isNaN(inputSelectNodeVal)){
            errorLabel = 'No es un numero'
            $('#queue').removeClass('is-valid')
			$('#queue').addClass('is-invalid')
        } else {
        	$('#queue').addClass('is-valid')
        	$('#queue').removeClass('is-invalid')
        }
        validateSubmitButton()
    }

    function validateInputNumber(event) {
        inputNode = $(this)
        var value = inputNode.val()
        value = $.trim(value)
		var errorLabel = ''
        if(!value){
        	inputNode.addClass('is-valid')
        	inputNode.removeClass('is-invalid')
        } else if(isNaN(value)){
            inputNode.removeClass('is-valid')
			inputNode.addClass('is-invalid')
        } else if(value.length > 10){
            inputNode.removeClass('is-valid')
            inputNode.addClass('is-invalid')
        } else {
        	inputNode.addClass('is-valid')
        	inputNode.removeClass('is-invalid')
        }
        
        validateSubmitButton()
    }
    
    function inputNode(event) {
        var inputNode = $(this)
	    var value = inputNode.val()
	    value = $.trim(value)
	    var errorLabel = ''
        if(!value){
            inputNode.removeClass('is-valid')
			inputNode.addClass('is-invalid')
        } else if(value.length > 25){
            inputNode.removeClass('is-valid')
			inputNode.addClass('is-invalid')
        } else {
        	inputNode.addClass('is-valid')
        	inputNode.removeClass('is-invalid')
        }
        validateSubmitButton()
    }

    function validateSubmitButton () {
	    if ($('.is-valid').length >= 2) {
	      $('#submitButton').removeAttr('disabled')
	    } else {
	      $('#submitButton').attr('disabled', true)
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

});



