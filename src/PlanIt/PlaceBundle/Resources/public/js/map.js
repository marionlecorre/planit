// function initializeMap(id, lat, lng) {
//   map = new google.maps.Map(document.getElementById("map_canvas_"+id), {
//         zoom: 8,
//         center: new google.maps.LatLng(lat, lng),
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//       });   
// } 

function initializeMap(id, lat, lng) {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };
  var map = new google.maps.Map(document.getElementById("map_canvas_"+id),
      mapOptions);
}

function getPlaces(module_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+module_id, //API
	   type : 'GET',
	   dataType : 'json',
	   success : function(places){ // code_html contient le HTML renvoyé
	   		for(var indice in places){
	   			initializeMap(places[indice].id, places[indice].latitude, places[indice].longitude);
	   		}
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}