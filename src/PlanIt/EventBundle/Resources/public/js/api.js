function getEvent(id){
	$.ajax({
	   url : '/app_dev.php/api/events/'+id, //API
	   type : 'GET',
	   dataType : 'json', // On désire recevoir du HTML
	   success : function(data, statut){ // code_html contient le HTML renvoyé
	   		var title_rend = Twig.render(title,
	                            {
	                                title : data.event.name,
	                            });
	       $('#title').html(title_rend);	       
	       var description_rend = Twig.render(desc,
	                            {
	                                description : data.event.description,
	                                image : data.event.image,
	                            });
	       $('#description').html(description_rend);
			

	       	// DODOS
			dodos = dateDiff(new Date(data.event.begin_date),new Date());
			if(dodos > 0){
				dodos = "C'est fini!";
			}
			else {
				dodos = -1 * dodos;
			}
	       var infos_rend = Twig.render(infos,
	                            {
	                                days : dodos,
	                                nb_guests : data.nbGuests,
	                                balance : data.balance
	                            });
	       $('#infos').html(infos_rend);	       
	       var modules_rend = Twig.render(modules,
	                            {
	                                evnt : data.event,
	                            });
	       $('#modules').html(modules_rend);
	       var modules_tab = [];
	       modules_tab["guests"] = "Gestion des invités";
	       modules_tab["budget"] = "Gestion du budget";
	       modules_tab["place"] = "Gestion du lieu";
	       modules_tab["transportation"] = "Gestion du transport";
	       modules_tab["todo"] = "Todo liste";

	       for(var type in modules_tab){
		       	for(var i=0;i<data.event.modules.length;i++){
		       		if(type == data.event.modules[i].type){
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
	       
	       var form_rend = Twig.render(form,
	                            {
	                                notUse_modules : notUse_modules,
	                                event_id: data.event.id,
	                            });
	       $('#form_container').html(form_rend);
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function deleteModule(module_id){
	$.ajax({
	   url : '/app_dev.php/api/modules/'+module_id, //API
	   type : 'DELETE',
	   dataType : 'json',
	   success : function(data){ // code_html contient le HTML renvoyé
	   	console.log(data);
       	var modules_rend = Twig.render(modules,
	                            {
	                                evnt : data.event,
	                            });
	       $('#modules').html(modules_rend);	
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}

function dateDiff(date1, date2){
    var diff = {}                           // Initialisation du retour
    var tmp = date2 - date1;
 
    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
 
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
 
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures
     
    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
    diff.day = tmp;
     
    return tmp;
}

