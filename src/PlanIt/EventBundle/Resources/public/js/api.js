function deleteModule(module_id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+module_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   		$('#module-'+module_id).remove();
	   		$('.deleteModuleModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}



