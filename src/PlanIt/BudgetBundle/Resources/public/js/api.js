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

		       	var list = module.types_expense;
		       	var balance;
		       	if(module.base){
		       		balance = module.base;
		       	}
		       	else {
		       		balance=0;
		       	}
		       	
		       	$.each(list, function(key, val) {
		            // récupération du prix total d'une catégorie
		            if (val['expenses'].length != 0){
		            	if(val['type']==1){
			              	$.each(val['expenses'],function(key,val){
								balance += (val['price']);
		              		});
		              	}
		              	else if (val['type']==0) {
		              		$.each(val['expenses'],function(key,val){
			              		balance -= val['price']*(val['quantity']-val['stock']);
			              	});
		              	}
		            }
		        });
	   			var content = Twig.render(tab_content,
	                            {
	                                module : module,
	                                max : module.max_budget,
	                                balance : balance
	                            });

	       		$('#tab_content').html(content);
	       		
	       /**/
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteExpense(expense_id){
	$.ajax({
	   url : '/app_dev.php/api/expenses/'+expense_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   		var menu = Twig.render(tab,
                            {
                                module : data.module,
                            });

	       	$('#tab').html(menu);

	       var list = data.module.types_expense;
	       	var balance;
	       	if(data.module.base){
	       		balance = data.module.base;
	       	}
	       	else {
	       		balance=0;
	       	}
	       	
	       	$.each(list, function(key, val) {
	            // récupération du prix total d'une catégorie
	            if (val['expenses'].length != 0){
	            	if(val['type']==1){
		              	$.each(val['expenses'],function(key,val){
							balance += (val['price']);
	              		});
	              	}
	              	else if (val['type']==0) {
	              		$.each(val['expenses'],function(key,val){
		              		balance -= val['price']*(val['quantity']-val['stock']);
		              	});
	              	}
	            }
	        });
   			var content = Twig.render(tab_content,
                            {
                                module : data.module,
                                max : data.module.max_budget,
                                balance : data.balance
                            });

       		$('#tab_content').html(content);

       		$(".tab").parent().removeClass('tab-current');
       		$("#tab-"+data.type_id).attr('class', 'tab-current');

			$(".section-topline").parent().removeClass('content-current');
			$("#section-topline-"+data.type_id).attr('class', 'content-current');
			getListExpense(module.id);
			getListInflow(module.id);
       		
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteInflow(inflow_id){
	$.ajax({
	   url : '/app_dev.php/api/inflows/'+inflow_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		var menu = Twig.render(tab,
                            {
                                module : module,
                            });

	       	$('#tab').html(menu);

	       var list = module.types_expense;
	       	var balance;
	       	if(module.base){
	       		balance = module.base;
	       	}
	       	else {
	       		balance=0;
	       	}
	       	
	       	$.each(list, function(key, val) {
	            // récupération du prix total d'une catégorie
	            if (val['expenses'].length != 0){
	            	if(val['type']==1){
		              	$.each(val['expenses'],function(key,val){
							balance += (val['price']);
	              		});
	              	}
	              	else if (val['type']==0) {
	              		$.each(val['expenses'],function(key,val){
		              		balance -= val['price']*(val['quantity']-val['stock']);
		              	});
	              	}
	            }
	        });
   			var content = Twig.render(tab_content,
                            {
                                module : module,
                                max : module.max_budget,
                                balance : balance
                            });

       		$('#tab_content').html(content);

       		$(".tab").parent().removeClass('tab-current');
       		$("#tab-apports").attr('class', 'tab-current');

			$(".section-topline").parent().removeClass('content-current');
			$("#section-topline-apports").attr('class', 'content-current');
			getListInflow(module.id);
			getListExpense(module.id);
       		
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function updateExpense(expense_id){
	var dataSend = {"expense_update":{
		"name" : $("#name-expense-"+expense_id).val(),
		"quantity" : $("#quantity-expense-"+expense_id).val(),
		"stock" : $("#stock-expense-"+expense_id).val(),
		"price" : $("#price-expense-"+expense_id).val(),
		"consummate" : $("#consummate-expense-"+expense_id).val(),
		"bought" : $("#bought-expense-"+expense_id).is(':checked')
	}}
	$.ajax({
	   url : '/app_dev.php/api/expenses/'+expense_id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(data){ // code_html contient le HTML renvoyé
	   		var menu = Twig.render(tab,
                            {
                                module : data.module,
                            });

	       	$('#tab').html(menu);

	       var list = data.module.types_expense;
	       	var balance;
	       	if(data.module.base){
	       		balance = data.module.base;
	       	}
	       	else {
	       		balance=0;
	       	}
	       	
	       	$.each(list, function(key, val) {
	            // récupération du prix total d'une catégorie
	            if (val['expenses'].length != 0){
	            	if(val['type']==1){
		              	$.each(val['expenses'],function(key,val){
							balance += (val['price']);
	              		});
	              	}
	              	else if (val['type']==0) {
	              		$.each(val['expenses'],function(key,val){
		              		balance -= val['price']*(val['quantity']-val['stock']);
		              	});
	              	}
	            }
	        });
   			var content = Twig.render(tab_content,
                            {
                                module : data.module,
                                max : data.module.max_budget,
                                balance : data.balance
                            });

       		$('#tab_content').html(content);

       		$(".tab").parent().removeClass('tab-current');
       		$("#tab-"+data.type_id).attr('class', 'tab-current');

			$(".section-topline").parent().removeClass('content-current');
			$("#section-topline-"+data.type_id).attr('class', 'content-current');
			getListExpense(data.module.id);
			getListInflow(data.module.id);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function updateInflow(inflow_id){
	var dataSend = {"planit_budgetbundle_inflow":{
		"name" : $("#name-inflow-"+inflow_id).val(),
		"amount" : $("#amount-inflow-"+inflow_id).val(),
	}}
	$.ajax({
	   url : '/app_dev.php/api/inflows/'+inflow_id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(module){ // code_html contient le HTML renvoyé
	   		var menu = Twig.render(tab,
                            {
                                module : module,
                            });

	       	$('#tab').html(menu);

	       var list = module.types_expense;
	       	var balance;
	       	if(module.base){
	       		balance = module.base;
	       	}
	       	else {
	       		balance=0;
	       	}
	       	
	       	$.each(list, function(key, val) {
	            // récupération du prix total d'une catégorie
	            if (val['expenses'].length != 0){
	            	if(val['type']==1){
		              	$.each(val['expenses'],function(key,val){
							balance += (val['price']);
	              		});
	              	}
	              	else if (val['type']==0) {
	              		$.each(val['expenses'],function(key,val){
		              		balance -= val['price']*(val['quantity']-val['stock']);
		              	});
	              	}
	            }
	        });
   			var content = Twig.render(tab_content,
                            {
                                module : module,
                                max : module.max_budget,
                                balance : balance
                            });

       		$('#tab_content').html(content);

       		$(".tab").parent().removeClass('tab-current');
       		$("#tab-apports").attr('class', 'tab-current');

			$(".section-topline").parent().removeClass('content-current');
			$("#section-topline-apports").attr('class', 'content-current');
			getListExpense(module.id);
			getListInflow(module.id);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function deleteTypeExpense(type_id){
	$.ajax({
	   url : '/app_dev.php/api/typeexpenses/'+type_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(module){ // code_html contient le HTML renvoyé
	   		var menu = Twig.render(tab,
                            {
                                module : module,
                            });

	       	$('#tab').html(menu);

	       var list = module.types_expense;
	       	var balance;
	       	if(module.base){
	       		balance = module.base;
	       	}
	       	else {
	       		balance=0;
	       	}
	       	
	       	$.each(list, function(key, val) {
	            // récupération du prix total d'une catégorie
	            if (val['expenses'].length != 0){
	            	if(val['type']==1){
		              	$.each(val['expenses'],function(key,val){
							balance += (val['price']);
	              		});
	              	}
	              	else if (val['type']==0) {
	              		$.each(val['expenses'],function(key,val){
		              		balance -= val['price']*(val['quantity']-val['stock']);
		              	});
	              	}
	            }
	        });
   			var content = Twig.render(tab_content,
                            {
                                module : module,
                                max : module.max_budget,
                                balance : balance
                            });

       		$('#tab_content').html(content);

       		$(".tab").parent().removeClass('tab-current');
       		$("#tab-general").parent().attr('class', 'tab-current');

			$(".section-topline").parent().removeClass('content-current');
			$("#section-topline-general").attr('class', 'content-current');
			getListInflow(module.id);
			getListExpense(module.id);
       		
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}