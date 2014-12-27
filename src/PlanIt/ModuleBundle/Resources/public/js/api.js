function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   		if(module.type == 'guests'){
	   			var guests = Twig.render(guests_template,
	                            {
	                                module : module,
	                            });
	       		$('#module_content').html(guests);
	   		}
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

