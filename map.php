
<div id="map"></div>

<script>
      function initMap() { 
        var uluru = {lat: 1.486891, lng: 102.132135};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4KjiTxIl52t3pwfsyxLL9tlRT2p3mcOE&callback=initMap">
    </script>
	
	