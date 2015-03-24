function budget(){
	$('.addExpenseModal').on("show.bs.modal",function(e){
		var type = $(e.relatedTarget).data('type');
		$("#form-post-expense").attr("action","/api/expenses/"+type);
	});

	$('.deleteTypeExpenseModal').on("show.bs.modal",function(e){
		var type_id = $(e.relatedTarget).data('id');
		var name = $(e.relatedTarget).data('name');
		$("#delete_confirm_typeexpense").attr("onclick","deleteTypeExpense("+type_id+")");
		$("#myModalLabel_deleteTypeExpense").html("Etes-vous sur de vouloir supprimer le type \""+name+"\" et les articles qui lui sont associés ?");
	});

	$('.deleteExpenseModal').on("show.bs.modal",function(e){
		var expense_id = $(e.relatedTarget).data('id');
		var name = $(e.relatedTarget).data('name');
		$("#delete_confirm_expense").attr("onclick","deleteExpense("+expense_id+")");
		$("#myModalLabel_deleteExpense").html("Etes-vous sur de vouloir supprimer l'article \""+name+"\" ?");
	});

	$('.deleteInflowModal').on("show.bs.modal",function(e){
		var inflow_id = $(e.relatedTarget).data('id');
		var name = $(e.relatedTarget).data('name');
		$("#delete_confirm_inflow").attr("onclick","deleteInflow("+inflow_id+")");
		$("#myModalLabel_deleteInflow").html("Etes-vous sur de vouloir supprimer l'apport \""+name+"\" ?");
	});

	if( parseInt($("#balance span").text()) > 0 ){
		$("#balance").addClass("positif");
	}
	else if ( parseInt($("#balance span").text()) < 0 ){
		$("#balance").addClass("negatif");
	}

	$('.benef').tooltip();
}