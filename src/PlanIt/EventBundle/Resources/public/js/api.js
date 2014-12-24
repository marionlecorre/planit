function getEvent(id){
	$.ajax({
	   url : '/app_dev.php/api/events/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(evnt, statut){ // code_html contient le HTML renvoyé
	       var content_general_event = Twig.render(content,
	                            {
	                                evnt : evnt,
	                            });
	       $('#content_general_event').html(content_general_event);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

