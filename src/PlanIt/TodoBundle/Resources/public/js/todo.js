function todo(){
	$('.addItemModal').on("show.bs.modal",function(e){
		var list_id = $(e.relatedTarget).data('list');
		$("#form-post-item").attr("action","/app_dev.php/api/items/"+list_id);
	});
}