// function initializeMap(id, lat, lng) {
//   var mapOptions = {
//     zoom: 8,
//     center: new google.maps.LatLng(-34.397, 150.644)
//   };
//   var map = new google.maps.Map(document.getElementById("map_canvas_"+id),
//       mapOptions);
// }
// function initialize(id) {
//   var latlng = new google.maps.LatLng(-34.397, 150.644);
//   var mapOptions = {
//     zoom: 8,
//     center: latlng
//   }
//   map = new google.maps.Map(document.getElementById('map_canvas_'+id), mapOptions);
// }

// function codeAddress(id, address) {
//   var address = 'Paris';
//   geocoder = new google.maps.Geocoder();
//   geocoder.geocode( { 'address': address}, function(results, status) {
//     if (status == google.maps.GeocoderStatus.OK) {
//       map.setCenter(results[0].geometry.location);
//       var marker = new google.maps.Marker({
//           map: map,
//           position: results[0].geometry.location
//       });
//     } else {
//       alert('Geocode was not successful for the following reason: ' + status);
//     }
//   });
// }

function map(id, address) {
  // Une variable pour contenir notre future marker
  var myMarker = null;
 
  // Des coordonnées de départ
  var myLatlng = new google.maps.LatLng(-34.397, 150.644);
 
  // Les options de notre carte
  var myOptions = {
    zoom: 15,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
 
  // On créé la carte
  var myMap = new google.maps.Map(
    document.getElementById('map_canvas_'+id),
    myOptions
  );
 
  // L'adresse que nous allons rechercher
  var GeocoderOptions = {
      'address' : address,
      'region' : 'FR'
  }
 
  // Notre fonction qui traitera le resultat
  function GeocodingResult( results , status )
  {
    // Si la recher à fonctionné
    if( status == google.maps.GeocoderStatus.OK ) {
 
      // S'il existait déjà un marker sur la map,
      // on l'enlève
      if(myMarker != null) {
        myMarker.setMap(null);
      }
 
      // On créé donc un nouveau marker sur l'adresse géocodée
      myMarker = new google.maps.Marker({
        position: results[0].geometry.location,
        map: myMap,
      });
 
      // Et on centre la vue sur ce marker
      myMap.setCenter(results[0].geometry.location);
 
    } // Fin si status OK
 
  } // Fin de la fonction
 
  // Nous pouvons maintenant lancer la recherche de l'adresse
  var myGeocoder = new google.maps.Geocoder();
  myGeocoder.geocode( GeocoderOptions, GeocodingResult );
}


function getPlaces(module_id){
	$.ajax({
	   url : '/app_dev.php/api/places/'+module_id, //API
	   type : 'GET',
	   dataType : 'json',
	   success : function(places){ // code_html contient le HTML renvoyé
	   		for(var indice in places){
	   			//initialize(places[indice].id);
	   			map(places[indice].id, places[indice].address);
	   		}
	   },
	   error : function(resultat, statut, erreur){
	         alert(erreur);
	       },
	});
}