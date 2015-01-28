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
	                                typeGuests : module.type_guest,
	                                moduleGuestType : module.guestmodule_type
	                            });
	       		$('#guests_list').html(guests);
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteGuest(id){
	$.ajax({
	   url : '/app_dev.php/api/guests/'+id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	       location.reload(true);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

