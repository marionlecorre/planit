function changeChecked(item_id, content){
	var checked = $("#checkbox-"+item_id).is(':checked');
	if(checked == true){
		checked = 1;
	}else{
		checked = 0;
	}
	$.ajax({
	   url : '/app_dev.php/api/items/'+item_id+'/checked', //app_dev.php/API
	   type : 'PUT',
	   dataType : 'json', // On désire recevoir du HTML
	   data : {checked : checked},
	   success : function(list_id){ // code_html contient le HTML renvoyé
	       	$('#blockitem-'+item_id).remove();
	       	if(checked == 1){
	       		$("#blocklist-"+list_id+" .todo-list").append('<li><div class="row"><div class="col-md-12 todo checked">'+content+' <input type="checkbox" id="checkbox-'+item_id+'" checked name="todo1" onClick="changeChecked('+item_id+', \''+content+'\')"></div></div></li>')
	       	}else{
				$("#blocklist-"+list_id+" .todo-list").prepend('<li id="blockitem-'+item_id+'"><div class="row"><div class="col-md-12 todo"><input type="checkbox" id="checkbox-'+item_id+'" name="todo1" onClick="changeChecked('+item_id+', \''+content+'\')"><input type="text" class="updatable-input" id="item-'+item_id+'" onblur="updateItem('+item_id+')" value="'+content+'"><div class="pull-right" ><div class="delete" data-toggle="modal" data-target=".deleteItemModal" data-content="'+content+'" data-id="'+item_id+'"></div></div></div></div></li>');
	       	}
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteItem(item_id){
	$.ajax({
	   url : '/app_dev.php/api/items/'+item_id, //app_dev.php/API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	$('#blockitem-'+item_id).remove();
	   		$('.deleteItemModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function updateItem(item_id){

	$.ajax({
	   url : '/app_dev.php/api/items/'+item_id, //app_dev.php/API
	   type : 'PUT',
	   dataType : 'json', // On désire recevoir du HTML
	   data : {content : $("#item-"+item_id).val()},
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function updateList(list_id){

	$.ajax({
	   url : '/app_dev.php/api/tasklists/'+list_id, //app_dev.php/API
	   type : 'PUT',
	   dataType : 'json', // On désire recevoir du HTML
	   data : {name : $("#list-"+list_id).val()},
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteList(list_id){
	$.ajax({
	   url : '/app_dev.php/api/tasklists/'+list_id, //app_dev.php/API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	       	$('#blocklist-'+list_id).remove();
	   		$('.deleteListModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}