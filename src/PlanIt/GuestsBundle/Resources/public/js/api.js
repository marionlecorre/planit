function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   			$.ajax({
				   url : '/app_dev.php/api/guestsmodules/'+id+'/inscritpionlink', //API
				   type : 'GET',
				   dataType : 'json', // On désire recevoir du HTML
				   success : function(link, statut){ // code_html contient le HTML renvoyé
				   		$.ajax({
						   url : '/app_dev.php/api/guestsmodules/'+id+'/paymentmeans', //API
						   type : 'GET',
						   dataType : 'json', // On désire recevoir du HTML
						   success : function(paymentmeans, statut){ // code_html contient le HTML renvoyé
						   			console.log(paymentmeans);
						       		var payable = Twig.render(guests_payable,
						                            {
						                                payable : module.payable,
						                                module_id:module.id,
						                                moduleGuestType:module.guestmodule_type,
						                                link:link,
						                                paymentmeans:paymentmeans
						                            });
						       		$('#header_list').html(payable);
						       /**/
						   },
						   error : function(resultat, statut, erreur){
						         alert(erreur);
						       },
						});
				       /**/
				   },
				   error : function(resultat, statut, erreur){
				         alert(erreur);
				       },
				});
	   			var title = Twig.render(guests_title,
	                            {
	                                name : module.name,
	                            });
	       		$('#title').html(title);

	       		var payable = Twig.render(guests_payable,
	                            {
	                                payable : module.payable,
	                                module_id:module.id,
	                                moduleGuestType:module.guestmodule_type
	                            });
	       		$('#header_list').html(payable);

	   			var guests = Twig.render(guests_list,
	                            {
	                                payment_means:module.payment_means,
	                                guests : module.guests,
	                                typeGuests : module.type_guest,
	                                moduleGuestType : module.guestmodule_type,
	                                payable:module.payable
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
	   success : function(module){ // code_html contient le HTML renvoyé
	       //location.reload(true);
	       var guests = Twig.render(guests_list,
	                            {
	                                payment_means:module.payment_means,
	                                guests : module.guests,
	                                typeGuests : module.type_guest,
	                                moduleGuestType : module.guestmodule_type,
	                                payable:module.payable
	                            });
	       		$('#guests_list').html(guests);
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
		"paymentmean" : $("#paymentmean-"+id).val()
	}}
	$.ajax({
	   url : '/app_dev.php/api/guests/'+id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(data){ // code_html contient le HTML renvoyé
	   	if(attr == "confirmed"){
			$("#confirmed-"+id).attr('class', "light state-"+confirmed);
			$("#confirmed-"+id).attr('data-type', confirmed);

		}else if(attr == "payed"){
			$("#payed-"+id).attr('class', "light state-"+payed);
			$("#payed-"+id).attr('data-type', payed);
		}
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function updatePayable(module_id){
	var payable = $("#payable-"+module_id).is(':checked');
	if(payable == true){
		payable = 1;
	}else{
		payable = 0;
	}
	$.ajax({
	   url : '/app_dev.php/api/guestsmodules/'+module_id+'/payable', //API
	   type : 'PUT',
	   dataType : 'json',
	   data : {payable : payable},
	   success : function(data){ // code_html contient le HTML renvoyé
	   		var payable = Twig.render(guests_payable,
                            {
                                payable : data.module.payable,
                                module_id: data.module.id,
                                moduleGuestType: data.module.guestmodule_type,
                                link:data.link,
                                paymentmeans:data.paymentmeans
                            });
       		$('#header_list').html(payable);
       		var guests = Twig.render(guests_list,
	                        {
	                            payment_means: data.module.payment_means,
	                            guests : data.module.guests,
	                            typeGuests : data.module.type_guest,
	                            moduleGuestType : data.module.guestmodule_type,
	                            payable: data.module.payable
	                        });
	   		$('#guests_list').html(guests);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function sendMail(guest_id){
	$.ajax({
	   url : '/app_dev.php/api/guests/'+guest_id+'/mails', //API
	   type : 'POST',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		var guests = Twig.render(guests_list,
	                        {
	                            payment_means:module.payment_means,
	                            guests : module.guests,
	                            typeGuests : module.type_guest,
	                            moduleGuestType : module.guestmodule_type,
	                            payable:module.payable
	                        });
	   		$('#guests_list').html(guests);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function multipleAction(type){
	alert(type);
	$("input:checkbox[name='checkbox-action']:checked").each(function()
	{
	    if($("#actions").val() == "send"){
	    	var id = $(this).attr('id');
	    	$.ajax({
			   url : '/app_dev.php/api/guests/'+id+'/mails', //API
			   type : 'POST',
			   success : function(module){ // code_html contient le HTML renvoyé
			   		var guests = Twig.render(guests_list,
			                        {
			                            payment_means:module.payment_means,
			                            guests : module.guests,
			                            typeGuests : module.type_guest,
			                            moduleGuestType : module.guestmodule_type,
			                            payable:module.payable
			                        });
			   		$('#guests_list').html(guests);
			   },
			   error : function(resultat, statut, erreur){
			         console.log(resultat);
			       },
			});
	    }else if($("#actions").val() == "delete"){
	    	var id = $(this).attr('id');
	    	$.ajax({
			   url : '/app_dev.php/api/guests/'+id, //API
			   type : 'DELETE',
			   dataType : 'json',
			   success : function(module){ // code_html contient le HTML renvoyé
			       //location.reload(true);
			       var guests = Twig.render(guests_list,
			                            {
			                                payment_means:module.payment_means,
			                                guests : module.guests,
			                                typeGuests : module.type_guest,
			                                moduleGuestType : module.guestmodule_type,
			                                payable:module.payable
			                            });
			       		$('#guests_list').html(guests);
			   },
			   error : function(resultat, statut, erreur){
			         alert(erreur);
			       },
			});
	    }
	});
}

function checkAll(type){
	if(this.checked) {
         // do something when checked
     }
}

