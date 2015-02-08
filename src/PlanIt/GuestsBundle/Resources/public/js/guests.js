function guests(){
	$('select').selectize({
	    create: true,
	    sortField: 'text'
	});
	$('.sent-true').tooltip();
	$('.light').tooltip();
	accordeonGuest();
	

	$('.deleteGuestModal').on("show.bs.modal",function(e){
			var id = $(e.relatedTarget).data('id');
			var name = $(e.relatedTarget).data('name');
			$("#delete_confirm_guest").attr("onclick","deleteGuest("+id+")");
			$("#myModalLabel_deleteGuest").html("Etes-vous sur de vouloir supprimer l'invité \""+name+"\" ?");
		
	});

	$('.addGuestModal').on("show.bs.modal",function(e){
		var typeguest = $(e.relatedTarget).data('type');
		$("#form-post-guest").attr("action","/app_dev.php/api/guests/"+typeguest);
	});
}

function showModalMultiple(type_id){
	$('.deleteGuestModal').modal('show');
	var action = $('#actions-'+type_id).val();
	$("#delete_confirm_guest").attr("onclick","multipleAction("+type_id+",'"+action+"')");
	if(action=="delete"){
		$("#myModalLabel_deleteGuest").html("Etes-vous sur de vouloir supprimer "+$("input:checkbox[class='checkbox-action-"+type_id+"']:checked").length+" invité(s) ?");
	}else if(action == "send"){
	 $("#myModalLabel_deleteGuest").html("Etes-vous sur de vouloir envoyer une invitation à ces "+$("input:checkbox[class='checkbox-action-"+type_id+"']:checked").length+" invité(s) ?");
	}
}

function accordeonGuest(){
	$('.accordion-body:not(:first)').hide();
	$('.accordion-head:first').addClass("open");
	$('.accordion-head').click(function(e){
		if(e.pageX>325) {
			$(this).toggleClass("open").next().slideToggle()
			.siblings('.accordion-body').slideUp();
			$(this).siblings('.accordion-head').removeClass("open");
			return false;
		}
	});
}
