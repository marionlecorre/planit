function deleteExpense(expense_id){
	$.ajax({
	   url : '/app_dev.php/api/expenses/'+expense_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   		$('#expense-'+expense_id).remove();
	   		$('#balance p span').html(data.balance);
	   		getListExpense(data.module_id);
	   		$('.deleteExpenseModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
       		
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
	   success : function(data){ // code_html contient le HTML renvoyé
	   		$('#inflow-'+inflow_id).remove();
	   		$('#balance p span').html(data.balance);
	   		getListInflow(data.module_id);
	   		$('.deleteInflowModal').modal('hide');
	   		$('#okModal').modal('show');
	   		setTimeout( "$('#okModal').modal('hide');",1200 );
       		
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
	   	$('#balance p span').html(data.balance);
	   	$("#expense-"+expense_id+" input[name=name-expense-"+expense_id+"]").val(data.expense.name);
	   	$("#expense-"+expense_id+" input[name=quantity-expense-"+expense_id+"]").val(data.expense.quantity);
	   	$("#expense-"+expense_id+" input[name=stock-expense-"+expense_id+"]").val(data.expense.stock);
	   	$("#expense-"+expense_id+" input[name=price-expense-"+expense_id+"]").val(data.expense.price);
	   	$("#expense-"+expense_id+" input[name=consummate-expense-"+expense_id+"]").val(data.expense.consummate);
	   	$("#tobuy-"+expense_id).html(data.expense.quantity - data.expense.stock);
	   	$("#total-price-"+expense_id).html(data.expense.price*(data.expense.quantity-data.expense.stock));
	  	getListExpense(data.module_id);
	  	$('#okModal').modal('show');
	   	setTimeout( "$('#okModal').modal('hide');",1200 );
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
	   success : function(data){ // code_html contient le HTML renvoyé
	   		$('#balance p span').html(data.balance);
	   		getListInflow(data.module_id);
		  	$('#okModal').modal('show');
		   	setTimeout( "$('#okModal').modal('hide');",1200 );
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
	   success : function(data){ // code_html contient le HTML renvoyé
	   		location.reload();
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}