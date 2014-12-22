function getUser(id){
	$.ajax({
	   url : '/app_dev.php/api/users/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(user, statut){ // code_html contient le HTML renvoyé
	       var header_render = Twig.render(header,
	                            {
	                                user : user,
	                            });
	       $('header').html(header_render);
	       var sidebar_render = Twig.render(sidebar,
	                            {
	                                user : user,
	                            });
	       $('#sidebar').html(sidebar_render);
	       $( "#accordion" ).accordion({
	       		active: 0,
				event:"click",
				header: "li.event",
				icons: { "header": "ui-icon-triangle-1-e", "activeHeader": "ui-icon-triangle-1-s" }
			});
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

