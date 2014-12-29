function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   			var title = Twig.render(guests_title,
	                            {
	                                name : module.name,
	                            });
	       		$('#title').html(title);

	       		var payable = Twig.render(guests_payable,
	                            {
	                                payable : module.payable,
	                            });
	       		$('#checkbox_payable').html(payable);

	   			var guests = Twig.render(guests_list,
	                            {
	                                guests : module.guests,
	                            });
	       		$('#guests_list').html(guests);
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

