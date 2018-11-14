console.log('init.app')

var detailsNode = $('#details')
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


