@extends('backend.system.layouts.master')
@section('content_header')

@endsection
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <style>
        #map {
            height: 400px;
        }
    </style>
    <div class="container">
        @include('backend.system.partials.errors')
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row g-6">
                <!-- Sales last year -->
                <div class="col-xxl-3 col-md-3 col-sm-6 mt-2">
                    <div class="card">
                        <div class="card-header pb-3">
                            <h5 class="card-title mb-1">Total Campaign</h5>
                            <p class="card-subtitle">{{ $total_campaign ?? 0 }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-3 col-sm-6 mt-2">
                    <div class="card">
                        <div class="card-header pb-3">
                            <h5 class="card-title mb-1">Total Donation Received</h5>
                            <p class="card-subtitle">{{ priceToNprFormat($total_collection ?? 0) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-3 col-sm-6 mt-2">
                    <div class="card">
                        <div class="card-header pb-3">
                            <h5 class="card-title mb-1">Withdrawable Amount</h5>
                            <p class="card-subtitle">{{ priceToNprFormat($net_collection ?? 0) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-md-3 col-sm-6 mt-2">
                    <div class="card">
                        <div class="card-header pb-3">
                            <h5 class="card-title mb-1">Total Donation Given</h5>
                            <p class="card-subtitle">{{ priceToNprFormat($total_donation_made ?? 0) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Earning Reports Tabs-->
                <div class="col-xl-12 col-12 mt-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title m-0">
                                <h5 class="mb-1">Visitors Location</h5>
                            </div>

                        </div>
                        <div class="card-body">
                            <div id="map" height="240"></div>
                        </div>
                    </div>
                </div>

                <!--/ Activity Timeline -->
            </div>

        </div>
    </div>
@endsection

@section('scripts')

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        /* print current */

        /*end  print current */
        // Function to initialize the map
        function initMap() {

            let allLocations=<?php echo $locationArray??[]; ?>;
            // Latitude and Longitude for the initial map center
            var latitude = 27.7172;
            var longitude = 85.3240;

            // Create a map object and set the initial view
            var map = L.map('map').setView([latitude, longitude], 6);

            // Add the OpenStreetMap tiles layer to the map
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Optionally, you can add markers or other elements to the map here
            allLocations.forEach(function(innerArray) {
                L.marker([innerArray.latitude, innerArray.longitude]).addTo(map);
            });

        }

        // Call the initMap function to initialize the map when the page loads
        window.onload = initMap;
    </script>

@endsection
