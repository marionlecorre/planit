function accordeon(){
	$('#accordion ul.modules').hide();
	$('#accordion li.event').click(function(){
		$(this).toggleClass("open").next().slideToggle()
		.siblings('ul.modules').slideUp();
		$(this).siblings('li.event').removeClass("open");
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