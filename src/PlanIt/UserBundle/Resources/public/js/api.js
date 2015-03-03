function deleteEvent(event_id){
	$.ajax({
	   url : '/app_dev.php/api/events/'+event_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		$('#event-'+event_id).remove();
	   		$('.deleteEventModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

