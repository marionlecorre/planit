function deleteGuest(id){
	$.ajax({
	   url : '/api/guests/'+id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(nb_guests){ // code_html contient le HTML renvoyé
	   		$('#guest-'+id).remove();
	   		$('#nb_guests').html(nb_guests);
	   		$('.deleteGuestModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
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
	var dataSend = {"guestupdate_form":{
		"typeguest" : $("#type_guest-"+id).val(),
		"firstname" : $("#firstname-"+id).val(),
		"lastname" : $("#lastname-"+id).val(),
		"email" : $("#email-"+id).val(),
		"payed" : payed,
		"confirmed" : confirmed,
		"sent" : sent,
		"paymentmean" : $("#paymentmean-"+id).val()
	}}
	$.ajax({
	   url : '/api/guests/'+id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(module){ // code_html contient le HTML renvoyé
		   	if(attr == "confirmed"){
				$("#confirmed-"+id).attr('class', "light state-"+confirmed);
				$("#confirmed-"+id).attr('data-type', confirmed);

			}else if(attr == "payed"){
				$("#payed-"+id).attr('class', "light state-"+payed);
				$("#payed-"+id).attr('data-type', payed);
			}
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
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
	   url : '/api/guestsmodules/'+module_id+'/payable', //API
	   type : 'PUT',
	   dataType : 'json',
	   data : {payable : payable},
	   success : function(data){ // code_html contient le HTML renvoyé
	   		location.reload();
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function sendMail(guest_id){
	$.ajax({
	   url : '/api/guests/'+guest_id+'/mails', //API
	   type : 'POST',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		$("#sent-"+guest_id).attr('class', 'send sent-1 col-md-1 col-sm-1 col-xs-1')
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function multipleAction(type, action){
	$("input:checkbox[class='checkbox-action-"+type+"']:checked").each(function()
	{
	    if($("#actions-"+type).val() == "send"){
	    	var id = $(this).attr('id');
	    	sendMail(id);
	    }else if($("#actions-"+type).val() == "delete"){
	    	var id = $(this).attr('id');
	    	deleteGuest(id);
	    }
	});
}

function checkAll(type){
	if($("#checkall-"+type).is(':checked')) {
         $('.checkbox-action-'+type).prop('checked', true);
     }else{
     	$('.checkbox-action-'+type).prop('checked', false);
     }
}

function deleteTypeguest(type_id){
	$.ajax({
	   url : '/api/typeguests/'+type_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(nb_guests){ // code_html contient le HTML renvoyé
	   		$('#typeguest-'+type_id).remove();
	   		$('#nb_guests').html(nb_guests);
	   		$('.deleteTypeGuestModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function updateTypeguest(typeguest_id){
	var price = $("#typeprice-"+typeguest_id).val();
	if(price == undefined){
		var dataSend = {
			"type" : "notpayable",
			"name" : $("#typename-"+typeguest_id).val(),
		}
	}else{
		var dataSend = {
			"type" : "payable",
			"name" : $("#typename-"+typeguest_id).val(),
			"price" : price
		}
	}
	
	$.ajax({
	   url : '/api/typeguests/'+typeguest_id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(data){ // code_html contient le HTML renvoyé
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

