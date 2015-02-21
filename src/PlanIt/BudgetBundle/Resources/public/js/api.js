function deleteExpense(expense_id){
	$.ajax({
	   url : '/app_dev.php/api/expenses/'+expense_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   		console.log(data);
       		
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
	   	location.reload();
       		
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function updateExpense(expense_id){
	if($("#bought-expense-"+expense_id).is(':checked') == true){
		var bought = 1;
	}else{
		var bought = 0;
	}
	var dataSend = {"expenseupdate_form":{
		"name" : $("#name-expense-"+expense_id).val(),
		"quantity" : $("#quantity-expense-"+expense_id).val(),
		"stock" : $("#stock-expense-"+expense_id).val(),
		"price" : $("#price-expense-"+expense_id).val(),
		"consummate" : $("#consummate-expense-"+expense_id).val(),
		"bought" : bought
	}}
	$.ajax({
	   url : '/app_dev.php/api/expenses/'+expense_id, //API
	   type : 'PUT',
	   dataType : 'json',
	   data : dataSend,
	   success : function(data){ // code_html contient le HTML renvoyé
	   	location.reload();
	  //  		var menu = Twig.render(tab,
   //                          {
   //                              module : data.module,
   //                          });

	  //      	$('#tab').html(menu);

	  //      var list = data.module.types_expense;
	  //      	var balance;
	  //      	if(data.module.base){
	  //      		balance = data.module.base;
	  //      	}
	  //      	else {
	  //      		balance=0;
	  //      	}
	       	
	  //      	$.each(list, function(key, val) {
	  //           // récupération du prix total d'une catégorie
	  //           if (val['expenses'].length != 0){
	  //           	if(val['type']==1){
		 //              	$.each(val['expenses'],function(key,val){
			// 				balance += (val['price']);
	  //             		});
	  //             	}
	  //             	else if (val['type']==0) {
	  //             		$.each(val['expenses'],function(key,val){
		 //              		balance -= val['price']*(val['quantity']-val['stock']);
		 //              	});
	  //             	}
	  //           }
	  //       });
   // 			var content = Twig.render(tab_content,
   //                          {
   //                              module : data.module,
   //                              max : data.module.max_budget,
   //                              balance : data.balance
   //                          });

   //     		$('#tab_content').html(content);

   //     		$(".tab").parent().removeClass('tab-current');
   //     		$("#tab-"+data.type_id).attr('class', 'tab-current');

			// $(".section-topline").parent().removeClass('content-current');
			// $("#section-topline-"+data.type_id).attr('class', 'content-current');
			// getListExpense(data.module.id);
			// getListInflow(data.module.id);
	   },
	   error : function(resultat, statut, erreur){
	         console.log(resultat);
	       },
	});
}

function updateInflow(inflow_id){
	var dataSend = {"inflow_form":{
		"name" : $("#name-inflow-"+inflow_id).val(),
		"amount" : $("#amount-inflow-"+inflow_id).val(),
	}}
	$.ajax({
	   url : '/app_dev.php/api/inflows/'+inflow_id, //API
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

function deleteTypeExpense(type_id){
	$.ajax({
	   url : '/app_dev.php/api/typeexpenses/'+type_id, //API
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