@extends('layouts.master')

@section('content')

  <div class="container ticketOpen" style="padding: 20px; color: red">
    <p class="h6">Usted tiene sin cerrar: {{ count($ticketsOpen) }} Ticket</p>
  </div>
    
  <div class="container mt-2">
      <table class='table table-striped table-bordered' id='tickets-table'>
      <thead >
        <tr>
          <th scope="col">Estado</th>
          <th scope="col">Sector</th>
          <th scope="col">Nro ticket</th>
          <th scope="col">Cliente</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Detalles</th>
          <th scope="col">Usuario Creador</th>
          <th scope="col">Creado</th>
          <th scope="col">#</th>
          <th id='href' scope="col">Button</th>
          
          
        </tr>
      </thead>
      <tfoot>
            <tr>
                <th>Estado</th>
                <th>Sector</th>
                <th>Ticket</th>
                <th>Cliente</th>
                <th>Descripcion</th>
                <th>Usuario Creador</th>
                <th>Creado<th>
            </tr>
      </tfoot>
      </table>
  </div>
@endsection

@push('scripts')


<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.min.css')}}">
<script src="{{ asset('js/datatables.min.js') }}"></script>


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
        },
        processing: true,
        serverSide: true,
        "order": [[ 0, 'asc' ], [ 8, 'desc' ]],
        "language": {
            "emptyTable":     "My Custom Message On Empty Table",
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        ajax: '{!! route('datas.get') !!}',
        columns: [
            { data: 'status', name: 'status' }, 
            { data: 'sector', name: 'sector' },
            { data: 'number', name: 'number' },
            { data: 'client', name: 'client' },
            { data: 'title', name: 'title' },
            { data: 'details', name: 'details', visible: false },
            { data: 'user_id', name: 'user_id' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at', visible: false  },
            { data: 'number', 
              render: function(data){
                return "<a href='http://127.0.0.1:8000/view/"+ data + "' class='view btn btn-dark'>Ver Ticket</button>"
              }
            },
        ],
    });

    

});
 
</script>
@endpush

</body>
</html>  