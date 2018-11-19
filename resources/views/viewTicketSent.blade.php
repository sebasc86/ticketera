<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	 <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TicketCall</title>
	<head>
   		 <!-- Required meta tags -->
   		 <meta charset="utf-8">
   		 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  		  <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        {{-- agregado el datatables --}}
        <script type="text/javascript" src='https://code.jquery.com/jquery-3.3.1.js'></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        
	
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-colvis-1.5.4/b-flash-1.5.4/b-html5-1.5.4/b-print-1.5.4/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
        
  	</head>
<body>

  @include('header')
  <!-- <table class="tabla">
      
        <tr>
          
          <th>Estado</th>
          <th>Sector</th>
          <th>Nro ticket</th>
          <th>Cliente</th>
          <th>Descripcion</th>
          <th>Detalles</th>
          <th>User</th>
          <th>Creado</th>
          
        </tr>
  
  </table> -->
<div class="container">
  <table class='table' id='tickets-table'>
  <thead >
    <tr>
      <th scope="col">Estado</th>
      <th scope="col">Sector</th>
      <th scope="col">Nro ticket</th>
      <th scope="col">Cliente</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Detalles</th>
      <th scope="col">User</th>
      <th scope="col">Creado</th>
      <th scope="col">#</th>
      <th id='href' scope="col">Button</th>
      
      
    </tr>
  </thead>
  <tbody>
</div>




  <script type="text/javascript">
    $(function() {
      var tickets = $('#tickets-table').DataTable({
            processing: true,
            serverSide: true,
            
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
            },
            ajax: '{!! route('get.data') !!}',
            columns: [
                { data: 'status', render: function( data, type, full, meta ) {
                    if(data == 0){
                      return '<td>Cerrado</td>'
                    } else {
                      return '<td>Abierto</td>'
                    }
                } },
                { data: 'sector', name: 'sector' },
                { data: 'number', name: 'number' },
                { data: 'client', name: 'client' },
                { data: 'title', name: 'title' },
                { data: 'details', name: 'details' },
                { data: 'user_id', name: 'user_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                {"data": null, 
                "defaultContent": "<button class='ticketView btn btn-primary'>Ver Ticket</button>"},   ],
              
        });
        
        setTimeout(function(){
          console.log($('tr').children())
          $('.ticketView').on('click', function(e){
             var tableRow = $(this).parent().parent()
             var numberTicket = tableRow.children('td:nth-child(3)').text()
             var url = "http://127.0.0.1:8000/ticketView/" + numberTicket;
             $(location).attr("href", url);
          });
        }, 500)
    });

    

</script>
    

 

  

</body>
</html>  