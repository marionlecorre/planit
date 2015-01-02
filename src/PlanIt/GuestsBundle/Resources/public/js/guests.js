function guests(){
	$('select').selectize({
	    create: true,
	    sortField: 'text'
	});
	$('.sent-true').tooltip();
}
// $(function () {
// 	guests();

// });

// $("#idOfElement").on('click', function(){

//     $.ajax({
//        url: 'pathToPhpFile.php',
//        dataType: 'json',
//        success: function(data){
//             //data returned from php
//        }
//     });
// )};