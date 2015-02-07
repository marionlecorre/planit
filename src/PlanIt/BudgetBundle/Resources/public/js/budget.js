function budget(){
	$('.addExpenseModal').on("show.bs.modal",function(e){
		var type = $(e.relatedTarget).data('type');
		$("#form-post-expense").attr("action","/app_dev.php/api/expenses/"+type);
	});

	if( parseInt($("#balance span").text()) > 0 ){
		$("#balance").addClass("positif");
	}
	else if ( parseInt($("#balance span").text()) < 0 ){
		$("#balance").addClass("negatif");
	}
}