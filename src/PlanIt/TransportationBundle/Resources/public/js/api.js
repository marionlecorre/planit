function deleteTransportation(transportation_id){
	$.ajax({
	   url : '/app_dev.php/api/transportations/'+transportation_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		$('#transportation-'+transportation_id).remove();
	   		$('.deleteTransportationModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function choseTransportation(transportation_id){

	if($("#check-"+transportation_id).prop('checked') == true){
		var check = 1;
	}else{
		var check = 0;
	}
	$.ajax({
	   url : '/app_dev.php/api/transportations/'+transportation_id+'/chose', //API
	   type : 'PUT',
	   dataType : 'json',
	   data : {check:check},
	   success : function(states){ // code_html contient le HTML renvoyé
	   		console.log(states);
	   		for(var id in states){
	   			$("#state-transportation-"+id).val(states[id]);
	   		}
	   		$(".accordion-head").each(function(){
	   			$(this).attr('class', 'head-list accordion-head nochecked');
	   		});
	   		$(".check").each(function(){
	   			$(this).prop('checked', false);
	   		});
	   		if(parseInt(states[transportation_id]) == 1){
	   			$('#transportation-'+transportation_id+' .head-list').attr('class', 'head-list accordion-head checked');
	   			$('#transportation-'+transportation_id+' .div-checkbox .check').prop('checked', true);
	   		}
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function updateTransportation(id){
	var dataSend = {"transportation_form":{
		"name" : $("#name-transportation-"+id).val(),
		"price" : $("#price-transportation-"+id).val(),
		"capacity" : $("#capacity-transportation-"+id).val(),
		"tel" : $("#tel-transportation-"+id).val(),
		"website" : $("#website-transportation-"+id).val(),
		"remark" : $("#remark-transportation-"+id).val(),
		"state" : $("#state-transportation-"+id).val(),
	}}
	$.ajax({
	   url : '/app_dev.php/api/transportations/'+id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(module){ // code_html contient le HTML renvoyé
	   		$('.deletePlaceModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}