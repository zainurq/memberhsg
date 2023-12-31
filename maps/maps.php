<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.7.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Mapbox Directions Plugin -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        #mapbox-markers {
            height: 865px;
            margin: 15px;
        }

        .card-title {
            font-size: 1.5rem;
        }
        
        .mapbox-directions-route-path {
            stroke-width: 0.5px; 
        }

        .marker-label {
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            color: black;
            background-color: yellow;
            padding: 1px;
            padding-left:3px;
            padding-right:3px;
            border-radius: 4px;
            position: absolute;
            pointer-events: none;
            transform: translate(-50%, -100%);
        }

        @media (max-width: 767px) {
            #mapbox-markers {
                height: 730px;
                margin: 2px;
            }
        }

        /* Hide Mapbox Directions on mobile */
        @media (max-width: 767px) {
            .mapboxgl-ctrl-directions {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <center>
                                    <h2 class="card-title mb-0">Store Locations</h2>
                                </center>
                                <div class="card-body">
                                    <div id="mapbox-markers"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1Ijoia29jdTk3IiwiYSI6ImNscG54M2szcTA5MnYybW81ang4bGJoMWwifQ.emJ5XNotKM6PEgkJC01D8A';
        var map = new mapboxgl.Map({
            container: 'mapbox-markers',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [0, 0], // Center of the world initially
            zoom: 2, // Initial zoom level
        });

        // Add navigation controls
        var nav = new mapboxgl.NavigationControl();
        map.addControl(nav, 'top-right');

        // Add Mapbox Directions
        var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken,
            unit: 'metric',
            profile: 'mapbox/driving-traffic',
            controls: {
                instructions: true
            },
            language: 'en',
        });

        map.addControl(directions, 'top-left');

        // Add marker and label for user's location
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;

                map.setCenter([userLng, userLat]); // Set center to user's location
                map.setZoom(12); // Set the desired zoom level

                // Add marker and label for user's location
                var userMarker = document.createElement('div');
                userMarker.className = 'marker-label';
                userMarker.textContent = 'Your Location';

                new mapboxgl.Marker({
                                color: 'red',
                            })
                    .setLngLat([userLng, userLat])
                    .addTo(map)
                    .getElement()
                    .appendChild(userMarker);

            }, function (error) {
                console.error('Error getting user location:', error);
            });
        } else {
            console.error('Geolocation is not supported by this browser.');
        }

        // Add Mapbox tile layer
        map.on('load', function () {
            $.ajax({
                url: 'create.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log('Data from server:', data);

                    data.forEach(function (location) {
                        if (
                            !isNaN(location.latitude) &&
                            !isNaN(location.longitude) &&
                            location.latitude >= -90 &&
                            location.latitude <= 90 &&
                            location.longitude >= -180 &&
                            location.longitude <= 180
                        ) {
                            console.log('Adding marker:', location.storename, location.latitude, location.longitude);

                            // Add marker and label for store location
                            var storeMarker = document.createElement('div');
                            storeMarker.className = 'marker-label';
                            storeMarker.textContent = location.storename;

                            new mapboxgl.Marker({
                                color: 'blue',
                            })
                                .setLngLat([location.longitude, location.latitude])
                                .addTo(map)
                                .getElement()
                                .appendChild(storeMarker);

                        } else {
                            console.warn('Invalid location for:', location.storename);
                        }
                    });
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
</body>

</html>
