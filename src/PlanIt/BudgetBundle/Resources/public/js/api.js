function getModule(id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(module, statut){ // code_html contient le HTML renvoyé
	   			var menu = Twig.render(tab,
	                            {
	                                module : module,
	                            });

		       	$('#tab').html(menu);

		       	var list = module.type_item;
		       	var balance;
		       	if(module.base){
		       		balance = module.base;
		       	}
		       	else {
		       		balance=0;
		       	}
		       	
		       	$.each(list, function(key, val) {
		            // récupération du prix total d'une catégorie
		            if (val['items'].length != 0){
		            	if(val['type']==1){
			              	$.each(val['items'],function(key,val){
								balance += (val['price']);
		              		});
		              	}
		              	else if (val['type']==0) {
		              		$.each(val['items'],function(key,val){
			              		balance -= val['price']*(val['quantity']-val['stock']);
			              	});
		              	}
		            }
		        });

	   			var type_item = Twig.render(typeitem_template,
	                            {
	                                module : module,
	                                max : module.max_budget,
	                                balance : balance
	                            });

	       		$('#type_item').html(type_item);
	       		
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}