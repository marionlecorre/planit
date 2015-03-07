function events(){
	$('.deleteModuleModal').on("show.bs.modal",function(e){
		var module_id = $(e.relatedTarget).data('id');
		var name = $(e.relatedTarget).data('name');
		$("#delete_confirm_module").attr("onclick","deleteModule("+module_id+")");
		$("#myModalLabel_deleteModule").html("Etes-vous sur de vouloir supprimer le module \""+name+"\" et les données qui lui sont associés ?");
	});
}