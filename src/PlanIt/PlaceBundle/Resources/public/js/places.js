function accordeonPlace(){

	autosize($('textarea'));
	$('.accordion-body:not(:first)').hide();
	$('.accordion-head:first').addClass("open");
	$('.accordion-head').click(function(e){
		if(e.pageX>325) {
			$(this).toggleClass("open").next().slideToggle()
			.siblings('.accordion-body').slideUp();
			$(this).siblings('.accordion-head').removeClass("open");
			return false;
		}
	}).children().click(function(e) {
	  return false;
	});
}
function places(){
	$('.updateContractModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		$("#form-post-contract").attr("action","/app_dev.php/api/places/"+id+"/contracts");
	});
	$('.updateImageModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		$("#form-post-image").attr("action","/app_dev.php/api/places/"+id+"/images");
	});

	$('.deletePlaceModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		var name = $(e.relatedTarget).data('name');
		$("#delete_confirm_place").attr("onclick","deleteGuest("+id+")");
		$("#myModalLabel_deletePlace").html("Etes-vous sur de vouloir supprimer le lieu \""+name+"\" ?");
		
	});


	// var previous;
 //    $(".selectize-input").click(function () {
 //        previous = $(this).children(".item").attr("data-value");
 //    }).change(function() {
 //        console.log(previous);
 //        if (previous==1){
 //        	console.log("couocu");
 //        	$(this).parent("#head_list").css("background-color","blue");
 //        	console.log($(this).parent("#head_list"));
 //        }
 //    });

}

function showModalDeletePlace(id, name){
	$('.deletePlaceModal').modal('show');
	$("#delete_confirm_place").attr("onclick","deletePlace("+id+")");
	$("#myModalLabel_deletePlace").html("Etes-vous sur de vouloir supprimer le lieu \""+name+"\" ?");
}

//input file
// ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');
 
// initialisation des variables
var fileInput  = document.querySelector( ".input-file" ),  
    button     = document.querySelector( ".input-file-trigger" ),
    the_return = document.querySelector(".file-return");
 
// action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});
 
// action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});
 
// affiche un retour visuel dès que input:file change
fileInput.addEventListener( "change", function( event ) {  
    the_return.innerHTML = this.value;  
});