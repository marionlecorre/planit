function getUser(id){
	$.ajax({
	   url : '/app_dev.php/api/users/'+id,
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(user, statut){ // code_html contient le HTML renvoyé
	       //$('.name').append(data.name+' '+data.surname);
	       var render = Twig.render(header,
	                            {
	                                user : user,
	                            });
	       //alert(render)
	       $('header').html(render);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}


