function deletePlace(place_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+place_id, //API
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

function chosePlace(place_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+place_id+'/chose', //API
	   type : 'PUT',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		location.reload();
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function updatePlace(id){
	var dataSend = {"place_form":{
		"name" : $("#name-place-"+id).val(),
		"address" : $("#address-place-"+id).val(),
		"price" : $("#price-place-"+id).val(),
		"capacity" : $("#capacity-place-"+id).val(),
		"distance" : $("#distance-place-"+id).val(),
		"tel" : $("#tel-place-"+id).val(),
		"website" : $("#website-place-"+id).val(),
		"remark" : $("#remark-place-"+id).val(),
		"state" : $("#state-place-"+id).val(),
	}}
	$.ajax({
	   url : '/app_dev.php/api/places/'+id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(module){ // code_html contient le HTML renvoyé
	   	location.reload();
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}