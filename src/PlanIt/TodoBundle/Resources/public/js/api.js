function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   		console.log(module.items);
	   			var items = Twig.render(list,
	                            {
	                                module : module,
	                            });

		       	$('#todo-list').html(items);
	       		
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
	   			var items = Twig.render(list,
	                            {
	                                module : module,
	                            });

		       	$('#todo-list').html(items);
	       		
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}