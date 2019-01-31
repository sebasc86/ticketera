@extends('layouts.master')

@section('content')

  <div class="container-fluid ticketOpen" style="padding: 20px; color: red">
    <p class="h6">Tickets en estado Abierto:  {{  count($ticketsOpen) }} </p>
    
    @if($user->sector->name == 'Telecentro')
        <img src="{{asset("img/". $user->sector->name .".png") }}" alt="{{ $user->sector->name }}" class="img-{{ $user->sector->name }}" style="
        padding: 5px;">
    
    @else 

    <img src="{{asset("img/". $user->sector->name .".png") }}" alt="{{ $user->sector->name }}" class="img-{{ $user->sector->name }}">
    
    @endif
    
  </div>
    
  <div id="container" class="container-fluid mt-2 px-5 mb-5">
      <table class='table table-striped table-bordered' id='tickets-table'>
      <thead >
        <tr>
          
          <th scope="col">Usuario Creador</th>
          <th scope="col">Sector</th>
          <th scope="col">Nro ticket</th>
          <th scope="col">Cliente</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Detalles</th>
          <th scope="col">Para</th>
          <th scope="col">Creado</th>
          <th scope="col">Estado</th>
          <th scope="col">Estado</th>
          <th id='href' scope="col">Button</th>
          
          
        </tr>
      </thead>
      <tfoot>
            <tr>
                
                <th>Usuario Creador</th>
                <th>Sector</th>
                <th>Ticket</th>
                <th>Cliente</th>
                <th>Descripcion</th>
                <th>Para</th>
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
        });
        },
        responsive: true,
        processing: true,
        serverSide: false,
        "order": [[ 8, 'asc' ], [ 7, 'desc' ]],
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
        ajax: '{!! route('dataSector.get') !!}',
        columns: [
            
            { data: 'user_id', name: 'user_id' },
            { data: 'sector', name: 'sector' },
            { data: 'number', name: 'number' },
            { data: 'client', name: 'client' },
            { data: 'title', name: 'title',  visible: false  },
            { data: 'details', name: 'details', visible: false },
            { data: 'queue', name: 'queue' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'status'}, 
            { data: 'updated_at', name: 'updated_at', visible: false  },
            { data: 'number', 
              render: function(data){
                return "<a href={{asset('view')}}"+ "/"+ data + " class='view btn btn-dark'>Ver Ticket</button>"
              },
            },
        ],
    });



});
 
</script>
@endpush

</body>
</html>  