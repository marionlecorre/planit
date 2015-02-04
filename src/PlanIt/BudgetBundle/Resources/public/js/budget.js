function budget(){
	$('.addTypeItemModal').on("show.bs.modal",function(e){
		var type = $(e.relatedTarget).data('type');
		var module_id = $(e.relatedTarget).data('id');
		$("#form-post-typeitem").attr("action","/app_dev.php/api/types/"+type+"/items/"+module_id);
	});

	if( parseInt($("#balance span").text()) > 0 ){
		$("#balance").addClass("positif");
	}
	else if ( parseInt($("#balance span").text()) < 0 ){
		$("#balance").addClass("negatif");
	}
}