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

	$('.deleteTypeGuestModal').on("show.bs.modal",function(e){
			var id = $(e.relatedTarget).data('id');
			var name = $(e.relatedTarget).data('name');
			$("#delete_confirm_typeguest").attr("onclick","deleteTypeGuest("+id+")");
			$("#myModalLabel_deleteTypeGuest").html("Etes-vous sur de vouloir supprimer le type \""+name+"\" et les invités qui lui sont associés ?");
		
	});

	$('.addGuestModal').on("show.bs.modal",function(e){
		var typeguest = $(e.relatedTarget).data('type');
		$("#form-post-guest").attr("action","/app_dev.php/api/guests/"+typeguest);
	});
}
function showModalUpdateType(id){
	$.ajax({
	   url : '/app_dev.php/api/typeguests/'+id, //app_dev.php/API
	   type : 'GET',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   		$("#updateTypeGuestModal input[name=typename]").attr('id', 'typename-'+id);
	   		$("#updateTypeGuestModal input[name=typename]").val(data.type.label);
	   		if(data.payable == '0'){
	   			$("#updateTypeGuestModal input[name=typeprice]").remove();
	   		}else{
	   			$("#updateTypeGuestModal input[name=typeprice]").attr('id', 'typeprice-'+id);
	   			$("#updateTypeGuestModal input[name=typeprice]").val(data.type.price);
	   		}

	   		if(data.module_type == '1'){
	   			$("#updateTypeGuestModal textarea[name=typemail]").remove();
	   		}else{
	   			$("#updateTypeGuestModal textarea[name=typemail]").attr('id', 'typemail-'+id);
	   			$("#updateTypeGuestModal textarea[name=typemail]").text(data.type.message);
	   		}
	   		$("#updateTypeGuestModal input[type=submit]").attr("onclick","updateTypeguest("+id+")");
	   		$('#updateTypeGuestModal').modal('show');

	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
	$("#form-update-typeguest input[type=submit]").attr("onclick","/app_dev.php/app_dev.php/api/typeguests/"+id+"/updates");
}

function showModalDeleteType(id, name){
	$('.deleteTypeGuestModal').modal('show');
	$("#delete_confirm_typeguest").attr("onclick","deleteTypeguest("+id+")");
	$("#myModalLabel_deleteTypeGuest").html("Etes-vous sur de vouloir supprimer le type \""+name+"\" et les invités qui lui sont associés ?");
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
	$('.accordion-head').find(".hidden-phone").click(function(e) {
	  return false;
	});
	$('.accordion-head').find(".delete_type").click(function(e) {
	  return false;
	});
	$('.accordion-head').find(".modify_type").click(function(e) {
	  return false;
	});
}
