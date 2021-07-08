        <div style="z-index: 20; top: 40%; left: 47%; position: fixed; display:none;" id="loading-show">
            <img src="<?= base_url().'assets/loading/loading3.gif' ?>" width="100">
        </div>  

        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-6 align-self-center">
                    <h3 class="text-themecolor">Data User</h3>
                </div>

                <!-- <div>
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div> -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

                <?= $this->session->flashdata('alert') ?>

                <div class="row">
                    <div id="loading" class="col-md-12" style="margin-bottom: -25px; margin-top: -50px; text-align: center; display:none;">
                        <img src="<?= base_url().'assets/loading/loading1.gif' ?>" width="100" >
                    </div>
                </div>


                <div class="card">
                    <div class="card-body p-b-20">
                        <!-- <button type="button" onclick="showModalAdd()" class="btn waves-effect waves-light btn-primary float-right"  title="Edit Data"><i class="fa fa-plus"></i> Tambah User</button> -->

                        <div id="map" style="height: 400px;"></div>
                        <input type="text" name="" id="latitude" readonly>
                        <input type="text" name="" id="longitude" readonly>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <script>
                // Initialize and add the map
                function initMap() {
                  // The location of Magelang
                  var magelang = {lat: -7.592588, lng: 110.219461};

                  var mapOptions = {
                    center: magelang,
                    zoom : 16,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  }
                  // The map, centered at magelang
                  var map = new google.maps.Map(
                      document.getElementById('map'), mapOptions);
                  // The marker, positioned at magelang
                  var markerOptions = {
                    draggable: true,
                    position: magelang, 
                    map: map
                  }
                  var marker = new google.maps.Marker(markerOptions);

                  google.maps.event.addListener(marker, 'dragend', function(event) {
                    var lat = event.latLng.lat();
                    var long = event.latLng.lng();
                    $('#latitude').val(lat);
                    $('#longitude').val(long);
                  });

                }
            </script>

            <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcBM8hFljWAtmwZC82_bMjtiI169z_n7k&callback=initMap" type="text/javascript"></script>
            <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>