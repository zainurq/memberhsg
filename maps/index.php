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
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        #header {
            background-color: #f8f9fa;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #header div {
            flex: 1;
            margin-right: 10px;
        }

        #mapbox-markers {
            height: 825px;
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
            padding-left: 3px;
            padding-right: 3px;
            border-radius: 4px;
            position: absolute;
            pointer-events: none;
            transform: translate(-35%, -295%);
            z-index: 1;
        }

        .current-location-label {
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            color: red;
            background-color: white;
            padding: 1px;
            padding-left: 3px;
            padding-right: 3px;
            border-radius: 4px;
            position: absolute;
            pointer-events: none;
            transform: translate(-35%, -295%);
            z-index: 1;
        }
        
            .search-input {
                position: relative;
                width: 50%;
                height:10px;
            }
            
            .search-container {
                position: relative;
                display: flex;
                align-items: center;
            }
            
            .search-container i {
                position: absolute;
                left: 10px;
                color: #555; 
            }
            
            .search-container input {
                width: calc(100% - 30px); 
                padding-left: 30px;
                padding-bottom: 5px;
                padding-top: 5px;                   
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                background: rgba(255, 255, 255, 0.8); 
            }

        @media (max-width: 767px) {
            
            #header {
                flex-direction: column;
                align-items: center;
                text-align: center;
                margin:-20px;
            }

            #header div {
                flex: 1 0 100%;
                margin:-5px;
            }

            #mapbox-markers {
                height: 730px;
                margin: 5px;
            }
            
            .mapboxgl-ctrl-directions {
                display: none;
            
            }
    
            .search-input {
                position: relative;
                width: 75%;
                height:100%;
                margin:-10px, 0;
                margin-top:-2px;
            }
            
            .search-container {
                position: relative;
                display: flex;
                align-items: center;
                
            }
            
            .search-container i {
                position: absolute;
                left: 10px;
                color: #555; /* Warna ikon */
            }
            
            .search-container input {
                width: calc(100% - 30px); /* Sesuaikan lebar input */
                padding-left: 30px;
                padding-bottom: 5px;
                padding-top: 5px;                
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 14px;
                background: rgba(255, 255, 255, 0.8); /* Latar belakang transparan */
            }


        }
    </style>
</head>

<body>
    <div id="header">
        <div>
            <h2 class="card-title mb-0">Store Location</h2>
        </div>
        
        <div class="mb-4 search-input">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" class="form-control" id="storeSearch" oninput="searchStores()" placeholder="Search...">
            </div>
        </div>


        <!-- Tampilkan total jumlah toko -->
        <div class="mb-4" style="text-align:right;">
            <b><p><span id="totalStores">0</span> Store </p></b>
        </div>
    </div>

    <div id="layout-wrapper">
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
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
            center: [0, 0], // Pusat dunia pada awalnya
            zoom: 2, // Tingkat zoom awal
        });

        // Tambahkan kontrol navigasi
        var nav = new mapboxgl.NavigationControl();
        map.addControl(nav, 'top-right');

        // Tambahkan Mapbox Directions
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

        // Tambahkan marker dan label lokasi pengguna
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var userLat = position.coords.latitude;
                var userLng = position.coords.longitude;

                map.setCenter([userLng, userLat]); // Atur pusat ke lokasi pengguna
                map.setZoom(12); // Atur tingkat zoom yang diinginkan

                // Tambahkan marker dan label untuk lokasi pengguna
                var userMarker = document.createElement('div');
                userMarker.className = 'current-location-label';
                userMarker.textContent = 'Lokasi Anda';

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

        // Tambahkan lapisan tile Mapbox
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

                            // Tambahkan marker dan label untuk lokasi toko
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

                    // Perbarui total jumlah toko
                    updateTotalStores(data);
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        // Fungsi untuk mencari toko
        function searchStores() {
            var searchTerm = document.getElementById('storeSearch').value.toLowerCase();

            // Filter marker berdasarkan kata kunci pencarian
            var markers = document.querySelectorAll('.marker-label');
            markers.forEach(function (marker) {
                var storeName = marker.textContent.toLowerCase();
                var markerElement = marker.parentElement;

                if (storeName.includes(searchTerm)) {
                    markerElement.style.display = 'block';
                } else {
                    markerElement.style.display = 'none';
                }
            });

            // Perbarui total jumlah toko
            updateTotalStores(data);
        }

        // Fungsi untuk memperbarui total jumlah toko
        function updateTotalStores(data) {
            var totalStores = data.length;
            document.getElementById('totalStores').textContent = totalStores;
        }
    </script>
</body>

</html>
