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
	// var payed = $("#payed-"+id).attr('data-type');
	// var confirmed = parseInt($("#confirmed-"+id).attr('data-type'));

	// if(attr == "confirmed"){
	// 	if(confirmed == 2) confirmed = 0; else confirmed += 1;

	// }else if(attr == "payed"){
	// 	if(payed == 1) payed = 0; else payed=1;
	// }

	// var sent = $("#sent-"+id).attr('data-type');
	// var dataSend = {"guest_update":{
	// 	"type_guest" : $("#type_guest-"+id).val(),
	// 	"firstname" : $("#firstname-"+id).val(),
	// 	"lastname" : $("#lastname-"+id).val(),
	// 	"email" : $("#email-"+id).val(),
	// 	"payed" : payed,
	// 	"confirmed" : confirmed,
	// 	"sent" : sent,
	// 	"paymentmean" : $("#paymentmean-"+id).val()
	// }}
	// $.ajax({
	//    url : '/app_dev.php/api/guests/'+id, //API
	//    type : 'PUT',
	//    dataType : 'json',
	//    data : dataSend,
	//    success : function(module){ // code_html contient le HTML renvoyé
	//    	if(attr == "confirmed"){
	// 		$("#confirmed-"+id).attr('class', "light state-"+confirmed);
	// 		$("#confirmed-"+id).attr('data-type', confirmed);
	// 		$.ajax({
	// 		   url : '/app_dev.php/api/events/'+module.event.id+'/nbguests', //API
	// 		   type : 'GET',
	// 		   dataType : 'json', // On désire recevoir du HTML
	// 		   success : function(nbGuests, statut){ // code_html contient le HTML renvoyé
	// 		   			var title = Twig.render(guests_title,
	// 		                            {
	// 		                                name : module.name,
	// 		                                nb_guests:nbGuests,
	// 		                                nb_max:module.max_guests
	// 		                            });
	// 		       		$('#title').html(title);
	// 		       /**/
	// 		   },
	// 		   error : function(resultat, statut, erreur){
	// 		         alert(erreur);
	// 		       },
	// 		});

	// 	}else if(attr == "payed"){
	// 		$("#payed-"+id).attr('class', "light state-"+payed);
	// 		$("#payed-"+id).attr('data-type', payed);
	// 	}
	//    },
	//    error : function(resultat, statut, erreur){
	//          console.log(resultat);
	//        },
	// });
}