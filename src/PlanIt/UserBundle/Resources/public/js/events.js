function events(){
	$('.deleteEventModal').on("show.bs.modal",function(e){
			var id = $(e.relatedTarget).data('id');
			var name = $(e.relatedTarget).data('name');
			$("#delete_confirm_event").attr("onclick","deleteEvent("+id+")");
			$("#myModalLabel_deleteGuest").html("Etes-vous sur de vouloir supprimer l'événement \""+name+"\" ?");
		
	});
}
