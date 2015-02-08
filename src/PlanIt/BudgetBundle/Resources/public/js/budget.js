function budget(){
	$('.addExpenseModal').on("show.bs.modal",function(e){
		var type = $(e.relatedTarget).data('type');
		$("#form-post-expense").attr("action","/app_dev.php/api/expenses/"+type);
	});

	$('.deleteTypeExpenseModal').on("show.bs.modal",function(e){
		var type_id = $(e.relatedTarget).data('type');
		$("#delete_confirm_typeexpense").attr("onclick","deleteTypeExpense("+type_id+")");
	});

	if( parseInt($("#balance span").text()) > 0 ){
		$("#balance").addClass("positif");
	}
	else if ( parseInt($("#balance span").text()) < 0 ){
		$("#balance").addClass("negatif");
	}
}