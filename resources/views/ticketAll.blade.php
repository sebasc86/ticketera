@extends('layouts.master')

@section('content')

	<div class="container-fluid px-5 justify-content-between d-flex p-2 ticketOpen">
		<p id="numberOpen" class="h6">Tickets en estado Abierto:  {{  count($ticketsOpen) }} </p>
		<img src="{{asset("img/logo.png") }}" alt="logo" class="img-logo">
	</div>




  <div id="container" class="container-fluid mt-2 px-5 mb-5">
	  <table class='table table-striped table-bordered' id='tickets-table'>
	  <thead >
		<tr>

		  <th scope="col">Para</th>
		  <th scope="col">Nro ticket</th>
		  <th scope="col">Cliente</th>
		  <th scope="col">Creador</th>
		  <th scope="col">Sector</th>
		  <th scope="col">Creado</th>
		  <th scope="col">Cerrado Por:</th>
					<th scope="col">Estado</th>
					<th id='href' scope="col">Ticket</th>
					<th id='delete' scope="col">Eliminar</th>
		</tr>
	  </thead>
	  </table>
  </div>
@endsection

@push('scripts')






<script>



$(document).ready(function() {


		var table =$('#tickets-table').DataTable({

		  responsive: false,
		processing: true,
		serverSide: false,
		"order": [[ 7, 'asc' ], [5, 'desc']],
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
				"ajax": {
				"url": "{!! route('ticketsAll.get') !!}",
				"type": "get",
				dataFilter: function(data){
				var json =  data ;
				json.recordsTotal = json.total;
				json.recordsFiltered = json.total;
				json.data = json.list;

				jsonParse = JSON.parse(json)

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
			{ data: 'number', name: 'number', className: 'number'},
			{ data: 'client', name: 'client' },
			{ data: 'user_name', className:'user_id', name: 'user_name'  },
			{ data: 'sector_name', name: 'sector_name' },
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
				return data == '1' ? 'Abierto' : 'Cerrado'
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
	});




  const currentURL = document.URL.toString();
  const promise = fetch(currentURL);
  promise.then(result => {
	$('#tickets-table').on('click', '.delete', function(e){
      ticketNumber = table.row( $(this).parents('tr') ).data().number;
      var tableRow = (table.row( $(this).parents('tr') ));
      var data = {ticket: ticketNumber};
            fetch('/ticket/delete', {
            headers: {
                "Content-Type" : "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'delete',
            body: JSON.stringify(data)

            }).then(data =>
                data.json().then(object => {
                    tableRow.remove().draw(false);
                })
            )
            .catch(error => console.log(error))
    })

  },
  e => console.log($(`Error capturado:  ${e}`)));




});



</script>
<link rel="stylesheet" type="text/css" href="{{ asset('Datatables/datatables.min.css') }}">

<script src="{{ asset('Datatables/datatables.min.js') }}"></script>
<script src="{{ asset('js/index.js') }}"></script>




@endpush

</body>
</html>
