@extends('layouts.master')

@section('content')

    <div class="container justify-content-between d-flex p-2 ticketOpen">
        <p class="h6">Tickets en estado Abierto:  {{  count($ticketsOpen) }} </p>
        <img src="{{asset("img/$sector->name.png") }}" alt="{{ $sector->name }}" class="img-{{ $sector->name }}">
    </div>


        
    
  <div id="container" class="container mt-2">
      <table class='table table-striped table-bordered' id='tickets-table'>
      <thead >
        <tr>
          
          <th scope="col">Para</th>
          <th scope="col">Nro ticket</th>
          <th scope="col">Cliente</th>
          <th scope="col">Titulo</th>
          <th scope="col">Detalles</th>
          <th scope="col">Usuario Creador</th>
          <th scope="col">Sector Creador</th>
          <th scope="col">Creado</th>
          <th scope="col">Estado</th>
          <th scope="col">Estado</th>
          <th id='href' scope="col">Button</th>
          
          
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
                <th>#</th>                
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
           
            column.data().unique().sort().each(function (d, j) {

                select.append( '<option value="'+d+'">'+d+'</option>' )
            } );
        } );
        },
        responsive: true,
        processing: true,
        serverSide: false,
        "order": [[ 0, 'asc' ], [ 8, 'desc' ]],
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
            { data: 'title', name: 'title'  },
            { data: 'details', name: 'details', visible: false },
            { data: 'user_id', name: 'user_id' },
            { data: 'sector', name: 'sector' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at', visible: false  },
            { data: 'status', name: 'status' },
            { data: 'number', 
              render: function(data){
                return "<a href={{asset('view')}}"+ "/"+ data + " class='view btn btn-dark'>Ver Ticket</button>"
              }
            },
        ],
    });



});
 
// </script>
@endpush

</body>
</html>  