// function initializeMap(id, lat, lng) {
//   var mapOptions = {
//     zoom: 8,
//     center: new google.maps.LatLng(-34.397, 150.644)
//   };
//   var map = new google.maps.Map(document.getElementById("map_canvas_"+id),
//       mapOptions);
// }
function initialize(id) {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 8,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('map_canvas_'+id), mapOptions);
}

function codeAddress(id, address) {
  var address = 'Paris';
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}


function getPlaces(module_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+module_id, //API
	   type : 'GET',
	   dataType : 'json',
	   success : function(places){ // code_html contient le HTML renvoyé
	   		for(var indice in places){
	   			//initialize(places[indice].id);
	   			codeAddress(places[indice].id, places[indice].address);
	   		}
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}