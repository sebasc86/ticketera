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
            $('#buttonArea').hide()
        }
    })


    $('#close').click(function(e){
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
                    console.log(result.success);
                    if(result.success == 0) {
                        $('#close').hide()
                        $('#newComment').hide()
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                                url: '/view/{{$ticket->number}}/mail',
                                method: 'POST',
                                });
                    }
                    $('#status').text('Cerrado');
                
        }});
        
    });



    var success = ''
    var userName = ''
    $('#buttonSend').click(function(e){
        e.preventDefault();
        var commentsNode = $('#comments').val()

        if(!commentsNode){
          console.log(!!commentsNode)
            $("#comments").addClass('is-invalid')
        } else {
          $("#comments").removeClass('is-invalid')
            $("#comments").addClass('is-valid')
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
            var files_upload = new FormData();
            var TotalFiles = $('#file')[0].files.length;  //Total Images
            var files = $('#file')[0];  
            for (var i = 0; i < TotalFiles; i++) {
            files_upload.append('imgfiles' + i, files.files[i]);
            }
            files_upload.append('TotalFiles', TotalFiles);
            files_upload.append('commentsNode', commentsNode);

            $.ajax({
                    url: '/view/post',
                    method: 'POST',
                    contentType:false,
                    processData: false,
                    data: files_upload,
                    success: function(result){
                        console.log(result);

                        success = result.success;
                        userName = result.userName
                        ticketNumber = result.ticketNumber
                        filename = result.filename
                        insertComment(success)
                        $('#comments').val('')
                        $("#comments").removeClass('is-valid')
            }});
        }
        
        
    });

  

    

    function insertComment(success) {
            //sin comentarios desde 0
            var commentsNew = $('#commentsNew')
            //con comentarios
            var commentsNode = $('#commentsNode')

        if(success === '1' && typeof filename != "undefined" && commentsNode.length != 0){
               commentsNode.append(
                '<div class="row align-items-center bg-light mt-2 info">' +
                '<div class="col mt-4">' +
                '<p class="">' + detailsNode.val() + '</p>'+
                '</div>' +
                '<div class="col-12 mt-2">' +
                '<p class="text-right text-muted" style="margin-bottom: 0px">Creado por: '+ 
                userName + 
                '</p></div>' +
                '<div class="col-12 mt-2"">' +
                '<p class="small text-right text-muted"> A las:' + date + '</p>' +
                '</div>'+
                '<div class="col-12 mb-3">' +
                '<a class="small" href="/view/' + 
                ticketNumber +
                '/download/' +
                filename + 
                '" download>' +
                filename +
                '</div></div>'
              )              
        } else if (success === '1' && typeof filename === "undefined" && commentsNode.length != 0){
                commentsNode.append(
                    '<div class="row align-items-center bg-light mt-2 info">' +
                    '<div class="col mt-4">' +
                    '<p class="">' + detailsNode.val() + '</p>'+
                    '</div>' +
                    '<div class="col-12 mt-2">' +
                    '<p class="text-right text-muted" style="margin-bottom: 0px">Creado por: '+ 
                    userName + 
                    '</p></div>' +
                    '<div class="col-12 mt-2"">' +
                    '<p class="small text-right text-muted"> A las:' + date + '</p>' +
                    '</div></div>'
                )
            
           
        } else if (success === '1' && filename === 'null' && commentsNode.length === 0) {
                commentsNew.append(
                    '<div class="card bg-white mb-3 info">' +
                    '<div class="card-header h6 bg-secondary text-white">Comentarios</div>' +
                    '<div class="card-body">' +
                    '<div class="row align-items-center bg-light mt-2">' +
                    '<div class="col mt-4">' +
                    '<p class="">' + detailsNode.val() + '</p>'+
                    '</div>' +
                    '<div class="col-12 mt-2">' +
                    '<p class="text-right text-muted" style="margin-bottom: 0px">Creado por: '+ 
                    userName + 
                    '</p></div>' +
                    '<div class="col-12 mt-2"">' +
                    '<p class="small text-right text-muted"> A las:' + date + '</p>' +
                    '</div>' + 
                    '</div></div></div></div>'
                )
                
                $("#commentsNew").attr("id","commentsNode")

        } else if (success === '1' && filename != "null" && commentsNode.length === 0){

            commentsNew.append(
                '<div class="card bg-white mb-3 info">' +
                '<div class="card-header h6 bg-secondary text-white">Comentarios</div>' +
                '<div class="card-body">' +
                '<div class="row align-items-center bg-light mt-2">' +
                '<div class="col mt-4">' +
                '<p class="">' + detailsNode.val() + '</p>'+
                '</div>' +
                '<div class="col-12 mt-2">' +
                '<p class="text-right text-muted" style="margin-bottom: 0px">Creado por: '+ 
                userName + 
                '</p></div>' +
                '<div class="col-12 mt-2"">' +
                '<p class="small text-right text-muted"> A las:' + date + '</p>' +
                '</div>' + 
                '<div class="col-12 mb-3">' +
                '<a class="small" href="/view/' + 
                ticketNumber +
                '/download/' +
                filename + 
                '" download>' +
                filename +
                '</div></div></div></div></div>'
            )
             $("#commentsNew").attr("id","commentsNode")
        }

    }




});



