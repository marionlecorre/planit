function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   			var places = Twig.render(list,
	                            {
	                                module : module,
	                            });

		       	$('#list').html(places);
	       		
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deletePlace(place_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+place_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		var places = Twig.render(list,
	                            {
	                                module : module,
	                            });

		       	$('#list').html(places);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function chosePlace(place_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+place_id+'/chose', //API
	   type : 'PUT',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		var places = Twig.render(list,
	                            {
	                                module : module,
	                            });

		       	$('#list').html(places);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}