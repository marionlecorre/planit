function accordeon(){
	$('#accordion ul.modules').hide();
	$('#accordion li.event').click(function(){
		$(this).toggleClass("open").next().slideToggle()
		.siblings('ul.modules').slideUp();
		$(this).siblings('li.event').removeClass("open");
		return false;
	});
}

function coucou (){
	console.log("coucou");
}