function postEvent(){
	var dataSend = {"event_form": {
			"name" : "valeur de nom",
			"description" : "valeur de la description",
			"begin_date" : "13/10/2003",
			"end_date" : "14/10/2003",
			"image" : "image.jpg"}}
	$.ajax({
	   url : 'http://www.planit.marion-lecorre.com/api/events/3', //API
	   type : 'POST',
	   dataType : 'json',
	   data : dataSend,
	   success : function(module){ // code_html contient le HTML renvoyé
	   		console.log(module)
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function deleteEvent(event_id){
	$.ajax({
	   url : '/app_dev.php/api/events/'+event_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		location.reload();
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

