function getModule(id){
	$.ajax({
	   url : '/api/modules/'+id, //API
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
	   url : '/api/items/'+item_id+'/checked', //API
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
	   url : '/api/items/'+item_id, //API
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
	   url : '/api/items/'+item_id, //API
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

function updateList(list_id){

	$.ajax({
	   url : '/api/tasklists/'+list_id, //API
	   type : 'PUT',
	   dataType : 'json', // On désire recevoir du HTML
	   data : {name : $("#list-"+list_id).val()},
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	location.reload();
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteList(list_id){
	$.ajax({
	   url : '/api/tasklists/'+list_id, //API
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