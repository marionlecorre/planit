function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   			var menu = Twig.render(tab,
	                            {
	                                module : module,
	                            });

	       		$('#tab').html(menu);

	   			var type_item = Twig.render(typeitem_template,
	                            {
	                                module : module,
	                            });

	       		$('#type_item').html(type_item);
	       		
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}