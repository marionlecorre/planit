function getModule(id){
	$.ajax({
	   url : '/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   		console.log(module);
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

