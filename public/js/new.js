$( document ).ready(function() {
    console.log('init.app')

    $('#submit').on('click', validateSelect)

    var errorLabel = ''

   
    function validateSelect() {
        var inputSelectNode = $( "#formTarget option:selected" )
        inputSelectNodeVal = inputSelectNode.val()
        inputSelectNodeVal = parseInt(inputSelectNodeVal)    
        if((inputSelectNodeVal) != NaN){
            errorLabel = 'No es un numero'
            console.log(errorLabel)
        }
    }
    
    console.log(errorLabel)

    // $('#submit').on('click', function(e){
    //     $('.fondo_modal').css('display', 'flex');       
    // })
});



