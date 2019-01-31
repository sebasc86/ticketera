$( document ).ready(function() {

	console.log('init.app')

	$('#userInclude').on('change', function(e){

		var userIncludeNodeVal = $('#userInclude').val()

		if(userIncludeNodeVal == 1){
			$('#hasEmail').show('slow')
			$('#hasEmail').html('')
			console.log(userIncludeNodeVal)
			var hasEmail = $('#hasEmail').append('<div class="form-group row">' + 
              '<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>'+
              '<div class="col-md-6">' + 
              '<input id="email" class="form-control" type="email" name="email" required>' +
              '</div>'+
          		'</div>'
          )
			hasEmail.append('<div class="form-group row">' + 
              '<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>'+
              '<div class="col-md-6">' + 
              '<input id="password" class="form-control" type="password" name="password" required>' +
              '</div>'+
          		'</div>')

		} else {
			$('#hasEmail').hide('slow');
		}

	})


})