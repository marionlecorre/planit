function accordeonPlace(){
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
function places(){
	$('.updateContractModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		$("#form-post-contract").attr("action","/app_dev.php/api/places/"+id+"/contracts");
	});
	$('.updateImageModal').on("show.bs.modal",function(e){
		var id = $(e.relatedTarget).data('id');
		$("#form-post-image").attr("action","/app_dev.php/api/places/"+id+"/images");
	});
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