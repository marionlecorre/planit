function getEvents(user_id){
	$.ajax({
	   url : '/app_dev.php/api/users/'+user_id+'/events', //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(user_events, statut){ // code_html contient le HTML renvoyé
	       var events_template = Twig.render(events,
	                            {
	                                user_events : user_events,
	                            });
	       $('#events').html(events_template);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

