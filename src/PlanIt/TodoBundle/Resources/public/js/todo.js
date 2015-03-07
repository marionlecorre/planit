function todo(){
	$('.addItemModal').on("show.bs.modal",function(e){
		var list_id = $(e.relatedTarget).data('list');
		$("#form-post-item").attr("action","/api/items/"+list_id);
	});

	$('.deleteItemModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		var content = $(e.relatedTarget).data('content');
		$("#delete_confirm_item").attr("onclick","deleteItem("+id+")");
		$("#myModalLabel_deleteItem").html("Etes-vous sur de vouloir supprimer la tâche \""+content+"\" ?");
		
	});

	$('.deleteListModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		var content = $(e.relatedTarget).data('content');
		$("#delete_confirm_list").attr("onclick","deleteList("+id+")");
		$("#myModalLabel_deleteList").html("Etes-vous sur de vouloir supprimer la liste \""+content+"\" et les tâches qui lui sont associées ?");
		
	});

	// $(".updatable-input").each(function(){
	// 	width = $( this ).val().length*6.5;
	// 	$( this ).css({width: width});
	// });
}