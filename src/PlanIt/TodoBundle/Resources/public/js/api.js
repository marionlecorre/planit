function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   		location.reload();
	       		
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function changeChecked(item_id){
	var checked = $("#checkbox-"+item_id).is(':checked');
	if(checked == true){
		checked = 1;
	}else{
		checked = 0;
	}
	$.ajax({
	   url : '/app_dev.php/api/items/'+item_id+'/checked', //API
	   type : 'PUT',
	   dataType : 'json', // On désire recevoir du HTML
	   data : {checked : checked},
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	location.reload();
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteItem(item_id){
	$.ajax({
	   url : '/app_dev.php/api/items/'+item_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	location.reload();
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function updateItem(item_id){

	$.ajax({
	   url : '/app_dev.php/api/items/'+item_id, //API
	   type : 'PUT',
	   dataType : 'json', // On désire recevoir du HTML
	   data : {content : $("#item-"+item_id).val()},
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	location.reload();
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}