@extends('layouts.master')

@section('content')

  <div id="container" class="container-fluid mt-2 px-5 mb-5">
      <table class='table table-striped table-bordered' id='sectors-table'>
      <thead >
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Nombre</th>
          <th scope="col">User ID</th>
          <th scope="col">Es Admin</th>
          <th scope="col">Email</th>
          <th scope="col">Creado</th>
          <th scope="col">Actualizado</th>
          <th scope="col">Ver</th>
          <th id='href' scope="col">Eliminar</th>
        </tr>
      </thead>
      <tfoot>
				<tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>User ID</th>
						<th>Email</th>
						<th>Es Admin</th>
						<th>Creado</th>
            <th>Actualizado</th>
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


  var table = $('#sectors-table').DataTable({
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

        });

        },
        responsive: true,
        processing: true,
        serverSide: false,

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
        ajax: '{!! route('sectorsAll.get') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'user_id', name: 'user_id' },
            { data: 'isAdmin', name: 'isAdmin' },
            { data: 'email_boss', name: 'email_boss' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at', visible: false  },
            { data: 'id',
							className: 'px200',
							"orderable": false,
              render: function(data){
                return "<a href={{asset('sectors')}}"+ "/"+ data + " class='view btn btn-dark'>Ver</a>"
              }
						},


						{ data: 'user_id',
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

    $('#sectors-table').on('click', '.delete', function(e){
			let sectorId = table.row( $(this).parents('tr') ).data().id;
			let tableRow = (table.row( $(this).parents('tr') ));
			var data = {id: sectorId};

			fetch('/sectors/delete', {
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
@endpush

</body>
</html>
