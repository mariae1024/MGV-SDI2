
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(-36.848461, 174.763336),
  zoom:10,

};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

    
var marker = new google.maps.Marker({
    position: new google.maps.LatLng(-36.8496507,174.7609214),
    map: map,
    title:"MGV"
  });   
    

    
 var content = '<div id="iw-container" class="container-fluid">' +
                    '<div class="iw-title">MGV</div>' +
                    '<div class="iw-content container-fluid">' +
                      '<div class="iw-subTitle">History</div>' +
                        '<p>With its headquaters based in Auckland MGV was founded by Maria Medina, Gurinder Nanda and Veronika Koreiba in February 14, 2019. MGV believe in total food Hygiene, that is why we only work with those suppliers who have obtained Grade A food certificate from Auckland council, so that our customers get top quality food.</p>' +
                        
                      
                    '</div>' +
                  '</div>';
 
	
google.maps.event.addListener(marker, 'click', function() {
     map.setZoom(14);
  map.setCenter(marker.getPosition());
    infowindow.open(map,marker);
  });
    
var infowindow = new google.maps.InfoWindow({
    content: content,

    // Assign a maximum value for the width of the infowindow allows
    // greater control over the various content elements
    maxWidth: 350,
  });
    
google.maps.event.addListener(map, 'click', function() {
    infowindow.close();
  });

}

