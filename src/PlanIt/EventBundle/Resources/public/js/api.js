function deleteModule(module_id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+module_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   		location.reload();	
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}



