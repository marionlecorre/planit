function deleteGuest(id){
	$.ajax({
	   url : '/app_dev.php/api/guests/'+id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		location.reload();
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
	   url : '/app_dev.php/api/guests/'+id, //API
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
		}else{
			location.reload();
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
	   		location.reload();
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
	   		location.reload();
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

