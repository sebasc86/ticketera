$( document ).ready(function() {
    console.log('init.app')


    var detailsNode = $('#comments')
    detailsNode.hide()
    var buttonSend = $('#buttonSend')
    buttonSend.hide()

    var date = new Date;
    var horario = date.toLocaleTimeString();
    var date = date.getFullYear().toString() + '-' + date.getMonth().toString() + '-' + date.getDay().toString() + ' ' + horario + 'hs';


    $('#buttonArea').on('click', function(){
        detailsNode.show('slow')
        if(detailsNode.is('hidden')){
            $('#buttonSend').hide()
        } else {
            $('#buttonSend').show()
        }
    })


    $('#close').click(function(e){
        console.log('prueba')
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                url: '/view/{{$ticket->number}}/close',
                method: 'POST',
                data: {
                    close: 0,
                },
                success: function(result){
                    console.log(result);
                    $('#status').text('Cerrado');
                
        }});
        
    });



    var success = ''
    var userName = ''
    $('#buttonSend').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
                url: '/view/{{$ticket->number}}/post',
                method: 'POST',
                data: {
                    comments: $('#comments').val(),
                },
                success: function(result){
                    console.log(result);
                    success = result.success;
                    userName = result.userName
                    insertComment(success)
                    $('#comments').val('')
        }});
        
    });

    var commentsNode = $('#commentsNode')

    function insertComment(success) {
        if(success === '1'){
            commentsNode.append(
                '<div class="row justify-content-between">' +
                '<div class="bg-light col-12 border rounded  mt-5 ">' +
                '<div class="row">' + 
                '<div class="col">' +
                '<h1 class="h5 mt-2 border-bottom border-dark text-left">Comentario:</h1>' +
                '</div></div>'+
                '<div class="row align-items-center">'+
                '<div class="col mt-2">' +
                '<p class="h6">' + detailsNode.val() + '</p>' +
                '</div></div>' +
                '<div class="row align-items-center">' +
                '<div class="col mt-2">' +
                '<p class="text-right" style="margin-bottom: 0px">Creado por: '+ 
                userName + 
                '</p>' +
                ' </div></div>' +
                '<div class="row align-items-center">' +
                '<div class="col">' +
                '<p class="small text-right"> A las:' + date + '</p>' +
                '</div></div></div></div>'
                
              )
        }

    }

});

