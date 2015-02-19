function accordeon(){
	$('#accordion ul.modules').hide();
	$('#accordion li.event').click(function(){
		$(this).toggleClass("open").next().slideToggle()
		.siblings('ul.modules').slideUp();
		//$(this).siblings('li.event').removeClass("open");
		return false;
	});
}



$('#basicModal').on("hover",function(){
    $('#basicModal').modal({"backdrop" : true});
});
$('#basicModal').on("show.bs.modal",function(e){
    $('select').selectize({
        create: true,
        sortField: 'text'
    });
});

$("form input.date").datepicker({
    dateFormat: 'dd/mm/yy', 
    firstDay:1
}).attr("readonly","readonly");

$('input[type="file"]').on("change",function(){
	$(this).closest('.browse-wrap');
	var path = this.value.replace("C:\\fakepath\\", "");
	var shortpath = jQuery.trim(path).substring(0, 20)
                          .trim(this) + "...";
	$(this).prev().text(shortpath);
});
