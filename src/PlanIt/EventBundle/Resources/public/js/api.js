function getEvent(id){
	$.ajax({
	   url : '/app_dev.php/api/events/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(evnt, statut){ // code_html contient le HTML renvoyé
	   		var title_rend = Twig.render(title,
	                            {
	                                title : evnt.name,
	                            });
	       $('#title').html(title_rend);	       
	       var description_rend = Twig.render(desc,
	                            {
	                                description : evnt.description,
	                                image : evnt.image,
	                            });
	       $('#description').html(description_rend);	       
	       var modules_rend = Twig.render(modules,
	                            {
	                                evnt : evnt,
	                            });
	       $('#modules').html(modules_rend);
	       var modules_tab = [];
	       modules_tab["guests"] = "Gestion des invités";
	       modules_tab["budget"] = "Gestion du budget";
	       modules_tab["place"] = "Gestion du lieu";
	       modules_tab["transportation"] = "Gestion du transport";
	       modules_tab["todo"] = "Todo liste";

	       for(var type in modules_tab){
		       	for(var i=0;i<evnt.modules.length;i++){
		       		if(type == evnt.modules[i].type){
		       			delete(modules_tab[type]);
		       		}
		       }
	       }
	       var notUse_modules = [];
	       for(var type in modules_tab){
	       		notUse_modules.push({
	       			type:type,
	       			name:modules_tab[type],
	       		});
	       }
	       //alert(notUse_modules);
	       
	       var form_rend = Twig.render(form,
	                            {
	                                notUse_modules : notUse_modules,
	                            });
	       $('#form_container').html(form_rend);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

