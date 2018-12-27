@extends('layouts.master')

@section('content')

	<div class="container-fluid ticketOpen" style="padding: 20px; color: red">
		<p class="h6">Tickets en estado Abierto:  {{  count($ticketsOpen) }} </p>
	</div>
    
  <div id="container" class="container-fluid mt-2 px-5">
      <table class='table' id='tickets-table'>
      <thead >
        <tr>
          
          <th scope="col">Nro ticket</th>
          <th scope="col">Cliente</th>
          <th scope="col">Titulo</th>
          <th scope="col">Detalles</th>
          <th scope="col">Enviado a:</th>
          <th scope="col">Sector</th>
          <th scope="col">Creado</th>
          <th scope="col">Estado</th>
          <th scope="col">#</th>
          <th id='href' scope="col">#</th>
          
          
        </tr>
      </thead>
      <tfoot>
            <tr>
                
                <th>Ticket</th>
                <th>Cliente</th>
                <th>Detalles</th>
                <th>Enviado a:</th>
                <th>Sector</th>
                <th>Creado<th>
                <th>Estado</th>
            </tr>
      </tfoot>
      </table>
  </div>
@endsection

@push('scripts')

<link rel="stylesheet" type="text/css" href="{{ asset('Datatables/datatables.min.css') }}">
<script src="{{ asset('Datatables/datatables.min.js') }}"></script>
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

            column.cells('', column[0]).render('display').sort().unique().each( function ( d, j ) {
                
                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
				} );
				
				$('tfoot').children().children()[2].setAttribute('id', 'selectTitle')
				$('#selectTitle').empty()
        },
        responsive: true,
        processing: true,
        serverSide: false,
        "order": [[ 0, 'asc' ], [ 8, 'desc' ]],
        "language": {
            "emptyTable":     "My Custom Message On Empty Table",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "Nothing found - sorry",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Informacion no disponible",
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
        ajax: '{!! route('sent.data') !!}',
        columns: [
             
            { data: 'number', name: 'number' },
            { data: 'client', name: 'client' },
            { data: 'title', name: 'title', visible: true,
							render: function(data){
                return "<p style='word-wrap: break-word; max-width: 140px'>"+ data + "</>"
              }
						},
            { data: 'details', name: 'details', visible: false },
            { data: 'queue', name: 'queue'},
            { data: 'sector', name: 'sector' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status' },
            { data: 'updated_at', name: 'updated_at', visible: false  },
            { data: 'number', 
              render: function(data){
                return "<a href={{asset('view')}}"+ "/"+ data + " class='view btn btn-dark'>Ver Ticket</button>"
              }
            },
        ],
    });
});
 
</script>
@endpush

</body>
</html>  