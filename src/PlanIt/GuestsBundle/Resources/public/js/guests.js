function guests(){
	$('select').selectize({
	    create: true,
	    sortField: 'text'
	});
	$('.sent-true').tooltip();
	$('.light').tooltip();
}


	$('#basicModal').on("hover",function(){
		console.log("clicked");
		$('#basicModal').modal({"backdrop" : true});
	});
	$('#basicModal').on("show.bs.modal",function(e){
    		var id_type = $(e.relatedTarget).data('type');
    		$("#type_added_guest").attr("value",id_type);
	});

