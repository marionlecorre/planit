function initializeMap(id, latitude, longitude) {
  map = new google.maps.Map(document.getElementById("map_canvas_"+id), {
        zoom: 19,
        center: new google.maps.LatLng(48.858565, 2.347198),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });   
} 

