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
          <th scope="col">Titulo</th>
          <th scope="col">Detalles</th>
          <th scope="col">Usuario Creador</th>
          <th scope="col">Sector</th>
          <th scope="col">Creado</th>
          <th scope="col">Estado</th>
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
						<th>Titulo</th>
						<th>Usuario Creador</th>
						<th>Sector</th>
						<th>Creado<th>
						<th>Estado</th>
						<th>Ver ticket</th>
						<th>#</th>               
				</tr>
      </tfoot>
      </table>
  </div>
@endsection

@push('scripts')


<link rel="stylesheet" type="text/css" href="{{ asset('Datatables/datatables.min.css') }}">
<script src="{{ asset('Datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>


<script>

 
$(document).ready(function() {
    
      
  var tickets = $('#tickets-table').DataTable({
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

				var ticket = $('.px200')[2].lastChild
				ticket.setAttribute('id', 'ticket')
				$('#ticket').css('display', 'none')

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
										method: 'POST',
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
        responsive: true,
        processing: true,
        serverSide: false,
        "order": [[ 9, 'asc' ], [ 8, 'desc' ]],
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
        ajax: '{!! route('dataTickets.get') !!}',
        columns: [
						
            { data: 'queue', name: 'queue' },
            { data: 'number', name: 'number' },
            { data: 'client', name: 'client' },
						{ data: 'title', name: 'title', visible: false,
						render: function(data){
                return "<p style='word-wrap: break-word; '>"+ data + "</>"
              }
						
						},
            { data: 'details', name: 'details', visible: false },
            { data: 'user_id', className:'user_id', name: 'user_id',  },
            { data: 'sector', name: 'sector' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at', visible: false  },
            { data: 'status',className: 'status', name: 'status' },
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
    });



});


 
</script>
@endpush

</body>
</html>  