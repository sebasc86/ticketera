
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
                console.log(d)
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
                return "<a href='http://127.0.0.1:8000/view/"+ data + "' class='view btn btn-primary'>Ver Ticket</button>"
              }
            },
        ],
    });



