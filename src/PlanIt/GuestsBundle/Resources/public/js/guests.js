function guests(){
	$('select').selectize({
	    create: true,
	    sortField: 'text'
	});
	$('.sent-true').tooltip();
	$('.light').tooltip();
	accordeonGuest();
	
	$('.deleteGuestModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('type');
		$("#delete_confirm").attr("onclick","deleteGuest("+id+")");
	});
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
