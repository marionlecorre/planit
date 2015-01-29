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
	                                payment_means:module.payment_means,
	                                guests : module.guests,
	                                typeGuests : module.type_guest
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

function updateGuest(id, attr){
	var payed = $("#payed-"+id).attr('data-type');
	var confirmed = parseInt($("#confirmed-"+id).attr('data-type'));

	if(attr == "confirmed"){
		if(confirmed == 2) confirmed = 0; else confirmed += 1;

	}else if(attr == "payed"){
		if(payed == 1) payed = 0; else payed=1;
	}

	var sent = $("#sent-"+id).attr('data-type');
	var dataSend = {"guest_update":{
		"type_guest" : $("#type_guest-"+id).val(),
		"firstname" : $("#firstname-"+id).val(),
		"lastname" : $("#lastname-"+id).val(),
		"email" : $("#email-"+id).val(),
		"payed" : payed,
		"confirmed" : confirmed,
		"sent" : sent,
		"paymentmean" : $("#paymentmean-"+id).val(),
		"_token" : "Dys5DcUyXOhsryIkwADnyuxBh5Raa825ot6txg7pA7U"
	}}
	$.ajax({
	   url : '/app_dev.php/api/guests/'+id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(data){ // code_html contient le HTML renvoyé
	   	// console.log(data)
	       location.reload(true);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

