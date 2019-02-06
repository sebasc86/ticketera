@extends('layouts.master')

@section('content')

    <div class="container-fluid px-5 justify-content-between d-flex p-2 ticketOpen">
        <p id="numberOpen" class="h6">Tickets en estado Abierto:  {{  count($ticketsOpen) }} </p>
        <img src="{{asset("img/$user->name.png") }}" alt="{{ $user->name }}" class="img-{{ $user->name }}">
    </div>


        
    
  <div id="container" class="container-fluid mt-2 px-5 mb-5">

      <table class='table table-striped table-bordered' id='tickets-table'>
      <thead >
        <tr>
          
          <th scope="col">Para</th>
          <th scope="col">Nro ticket</th>
          <th scope="col">Cliente</th>
          <th scope="col">Creador</th>
          {{-- <th scope="col">Sector</th> --}}
          <th scope="col">Creado</th>
          <th scope="col">Cerrado Por:</th>
					<th scope="col">Estado</th>
					<th id='href' scope="col">Ticket</th>
					<th id='delete' scope="col">Eliminar</th>       
        </tr>
      </thead>
      <tfoot>
				<tr>
						<th>Para</th>
						<th>Ticket</th>
						<th>Cliente</th>
            <th>Usuario Creador</th>
            <th>Cerrado Por:</th>
						{{-- <th>Sector</th> --}}
						<th>Creado<th>
						<th>Estado</th>
						
						         
				</tr>
      </tfoot>
      </table>

      <button id="toExcel" type="button" class="btn btn-success">
        <i class="fa fa-file-excel-o" style="font-size:24px"></i> Exportar a Excel</button>
  </div>
@endsection

@push('scripts')


<link rel="stylesheet" type="text/css" href="{{ asset('Datatables/datatables.min.css') }}">
<script src="{{ asset('Datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>

<script>

 
$(document).ready(function() {


      
  var tickets = $('#tickets-table').DataTable({

        responsive: false,
        processing: true,
        serverSide: false,
					
					
        
        initComplete: function () {
        this.api().columns().every( function () {
            var column = this;
            var select = $('<select><option value=""></option></select>')
                .appendTo( $(column.footer()).empty() )
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );
           
            column.data().unique().sort().each(function (d, j) {

                select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
						
				} );
				

				// var ticket = $('.px200')[2].lastChild
				// ticket.setAttribute('id', 'ticket')
			
				if($('#users_create').length === 0) {
					$('.delete').parent().remove()
					$('#delete').remove()
				}

				
				$('.delete').on('click', function(e){
					var buttonNode = $(this)
					
						var ticketNumber = $(this).parent().parent().children('td').eq(1).html()

						$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
						});
						$.ajax({
										url: '/ticket/delete',
										method: 'delete',
										data: {	
												ticket: ticketNumber,
										},
										success: function(result){
												if(result.success === "1"){
													
												  	buttonNode.parent().parent().hide('slow', function(){ 
														buttonNode.parent().parent().remove()
														var ticketsOpen = $('tbody').children().length
														$('#numberOpen').html('<p id="numberOpen" class="h6">Tickets en estado Abierto: ' + ticketsOpen + '</p>')
													})
													
													
										};
										
						}});
						})
				},	

        
        "ajax": {
                "url": "{!! route('dataTickets.get') !!}",
                "type": "get",
                dataFilter: function(data){
                var json =  data ;
                json.recordsTotal = json.total;
                json.recordsFiltered = json.total;
                json.data = json.list;
                
                jsonParse = JSON.parse(json)
                var users = jsonParse.users

            //     for (let index = 0; index < jsonParse.data.length; index++) {
                
            //     for (let x = 0; x < users.length; x++) {
            //       if(users[x].id == jsonParse.data[index].queue){
            //         jsonParse.data[index].queue = users[x].name
            //       }
            //       if(users[x].id == jsonParse.data[index].user_id){
            //         jsonParse.data[index].user_id = users[x].name
            //       }

            //       if(users[x].id == jsonParse.data[index].close_user_id){
            //         jsonParse.data[index].close_user_id = users[x].name
            //       }

            //       if(jsonParse.data[index].status == 1){
            //         jsonParse.data[index].status = 'Abierto'
            //       } else if(jsonParse.data[index].status == 0) {
            //         jsonParse.data[index].status = 'Cerrado'
            //       }
            //     }
                
              
              
            // }

                return JSON.stringify(jsonParse)  // return JSON string
              },
          },
        columns: [
						
            { data: 'queue',
              render: function(data){
                if(jsonParse.users[data]){
                  return(jsonParse.users[data].name)
                }
              }
						},
            { data: 'number', name: 'number' },
            { data: 'client', name: 'client' },
            { data: 'user_name', name: 'user_name',  },
            { data: 'created_at', name: 'created_at' },
            { data: 'close_user_id',
              render: function(data){
                if(jsonParse.users[data]){
                  return(jsonParse.users[data].name)
                } else {
                  return data
                }
              }
						},            
            { data: 'status',
              render: function(data){
                console.log(data)
                if(data == 1){
                  return 'Abierto'
                } else {
                  return 'Cerrado'
                }
              }
						},
						{ data: 'number',
							className: 'px200',
              "orderable": false,
              render: function(data){             
                return "<a href={{asset('view')}}"+ "/"+ data + " class='view btn btn-dark'>Ver</a>"
              }
						},

						{ data: 'number',
							className: 'px200',
							"orderable": false,
              render: function(data){
                return '<button class="delete view btn btn-danger btn-del" style="margin:auto">X</a>'
              }
            },
				],
        "order": [[ 6, 'asc' ], [ 4, 'desc' ]],
        "language": {
            "emptyTable":     "Sin Registros",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "informacion no disponible",
            "infoFiltered": "(filtrado de _MAX_ registros)",
            "search":         "Buscar:",
            "processing":     "Cargando...",
            "paginate": {
                "first":      "Primero",
                "last":       "Ultimo",
                "next":       "Proxima",
                "previous":   "Anterior"
            },
        },
		});
    

});



 
</script>
@endpush

</body>
</html>  