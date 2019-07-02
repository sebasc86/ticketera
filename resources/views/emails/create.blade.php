

<table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
 
 <tr>
  <td  bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
	 <table border="0" cellpadding="0" cellspacing="0" width="100%">
	  <tr>
	   <td>
	    <h2>Ticket Nuevo Creado</h2>
	    <h2>Numero: {{ $ticket->number }}</h2>
	   </td>
	  </tr>
	  <tr>
	   <td style="padding: 20px 0 30px 0;">
	   	<h3>Creado por: {{ $user->email }}</h3>
	   	<h3>Nombre: {{ $user->name }}</h3>
	   	<h3>Para: {{ $userQueue->email }}</h3>
	   	<h3>Nombre: {{ $userQueue->name }}</h3>
	   </td>
	  </tr>
	  <tr>
	   <td>
	   Enviado automáticamente desde <a href={{ url('/') }} title="TicketCall">TicketCall</a>
	   </td>
	  </tr>
	 </table>
	</td>
 </tr>
 <tr>
  <td style="color: white; padding: 20px;" width="75%" bgcolor="#343a40">
   &reg; CallCenter
  </td>
 </tr>
</table>