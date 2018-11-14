console.log('init.app')

var detailsNode = $('#comments')
detailsNode.hide()
var buttonSend = $('#buttonSend')
buttonSend.hide()



$('#buttonArea').on('click', function(){
    detailsNode.show('slow')
    if(detailsNode.is('hidden')){
        $('#buttonSend').hide()
    } else {
        $('#buttonSend').show()
    }
})


$('#buttonSend').click(function(e){
   e.preventDefault();
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
          url: '/ticketView/{{$ticket->number}}/post',
          method: 'POST',
          data: {
             comments: $('#comments').val(),
          },
          success: function(result){
             console.log(result);
   }});
});

