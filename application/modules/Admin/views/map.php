        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-6 align-self-center">
                    <h3 class="text-themecolor">Peta Titik Lokasi</h3>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <!-- <label>Jenis Perlengkapan</label> -->
                        <select id="jenisJl" class="selectpicker" data-style="form-control btn-secondary" onchange="changeJenisJl();">
                            <option value='all'>Semua Jalan</option>
                            <?php foreach ($statusJl as $jl) { ?>
                                <option value="<?= $jl->id_status_jalan ?>"><?= $jl->status_jalan ?></option>
                            <?php } ?>
                        </select>
                        &nbsp;
                        <select id="jenisPj" class="selectpicker" data-style="form-control btn-secondary" onchange="changeJenisPj();">
                            <!-- <option disabled=''>Pilih Jenis Perlengkapan</option> -->
                            <?php foreach ($jenisPj as $pj) { ?>
                                <option value="<?= $pj->id_jenis ?>" <?= ($pj->id_jenis == 1?'selected':'') ?>><?= $pj->nama_jenis ?></option>
                            <?php } ?>
                        </select>
                    </ol>
                </div>
                <div>
                    <!-- <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button> -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="card-group">
                    <div class="card card-inverse card-info m-1">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="m-r-20 align-self-center">
                                    <h1 class="text-white"><i class="mdi mdi-vlc text-white"></i></h1></div>
                                <div>
                                    <h3 class="card-title">
                                        <span id="totalFilter"></span> / <span id="totalPJ"></span>
                                    </h3>
                                    <h5 class="card-subtitle">Jumlah Perlengkapan Jalan</h5></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-inverse card-success m-1">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="m-r-20 align-self-center">
                                    <h1 class="text-white"><i class="mdi mdi-verified text-white"></i></h1></div>
                                <div>
                                    <h3 class="card-title">
                                        <span id="totalFilterBaik"></span> / <span id="totalPJBaik"></span>
                                    </h3>
                                    <h5 class="card-subtitle">Jumlah Kondisi Baik</h5></div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-inverse card-danger m-1">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="m-r-20 align-self-center">
                                    <h1 class="text-white"><i class="mdi mdi-alert-octagon text-white"></i></h1></div>
                                <div>
                                    <h3 class="card-title">
                                        <span id="totalFilterRusak"></span> / <span id="totalPJRusak"></span>
                                    </h3>
                                    <h5 class="card-subtitle">Jumlah Kondisi Rusak</h5></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-group">
                    <?php foreach ($statusJl as $key) {?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h6 class="card-subtitle"><?=$key->status_jalan?></h6>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 100%; height: 6px; background-color: <?=$key->warna_jalan?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h6 class="card-subtitle">Batas Kabupaten Magelang</h6>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 100%; height: 6px; background-color: black" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div id="loading" class="col-md-12" style="margin-bottom: -25px; margin-top: -50px; text-align: center; display:none;">
                        <img src="<?= base_url().'assets/loading/loading1.gif' ?>" width="100" >
                    </div>
                </div>

                <style type="text/css">
                    a[href^="http://maps.google.com/maps"]{display:none !important}
                    a[href^="https://maps.google.com/maps"]{display:none !important}

                    /*Google Credit*/
                    .gmnoprint a, .gmnoprint span, .gm-style-cc {
                        display:none;
                    }

                    /*Style InfoWindow*/
                    .gm-style-iw {
                      min-width: 150px; 
                      max-width: 300px;
                    }
                    /*.gmnoprint div {
                        background:none !important;
                    }*/
                </style>

                <div style="z-index: 2; position: absolute; margin-top: 420px; margin-left: 12px;">
                    <img src="<?= base_url().'assets/assets/images/logo/dishub-logo-sm.png' ?>" width='35'>
                    <!-- <label>DISHUB</label> -->
                </div>
                
                <div id="map-canvas" style="height:470px;"></div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <script type="text/javascript">
                var countPic = 0;
                var poly;
                var draw = false;
                var markerCluster;
                var map;
                var markers = [];
                var coordLine = [];
                var mapClick;
                function initMap(argument) {
                   var mapOptions = {
                      center: {
                        lat: -7.5011538,
                        lng: 110.2676056
                      },
                      zoom: 11,
                      // maxZoom: 18,
                      mapTypeId: google.maps.MapTypeId.ROADMAP,
                      mapTypeControl: false,
                      streetViewControl: true,
                      fullscreenControl: true
                    };

                    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);    

                    showLines();
                    linesArea();
                }


                function makeMarker(pos, icon, name, pic, kondisi) {
                    // var icon = { // car icon
                    //     // path: 'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
                    //     url: "<?//= base_url().'assets/icon/marker/' ?>"+icon+'.svg',
                    //     scale: 0.4,
                    //     fillColor: "#427af4", //<-- Car Color, you can change it 
                    //     fillOpacity: 1,
                    //     strokeWeight: 1,
                    //     anchor: new google.maps.Point(0, 5),
                    //     rotation: data.val().angle //<-- Car angle
                    // };

                    var marker = new google.maps.Marker({
                      // position: pos,
                      position: pos,
                      map: map,
                      animation: google.maps.Animation.DROP,
                      icon: "<?= base_url().'assets/icon/marker/' ?>"+icon+'.png',
                      title: "I'm Here."
                    });                    

                    markers.push(marker);

                    var sts = '';
                    if (kondisi == 'Rusak') {
                        sts = 'red';
                    } else {
                        sts = 'green';
                    }
                    var contentInfo = "<label style='font-size: 12pt; font-weight: bold'>"+name+"</label><br><label>Kondisi: <span style='color:"+sts+"; font-weight: bold'>"+kondisi+"</span></label><div id='picMarker'></div>";

                    var photo = pic.split(';');
                    
                    countPic++;
                    for(i=0; i < photo.length; i++){
                        var no = i + 1;
                        contentInfo += "<a href='<?= base_url().'assets/path_foto/' ?>"+photo[i]+"' data-lightbox='data"+countPic+"' data-toggle='lightbox' data-gallery='gallery'><button style='width: 100%;' type='button' class='btn btn-sm waves-effect waves-light btn-primary m-b-5' data-toggle='tooltip' data-placement='top' title='Foto 1'><i class='fa fa-picture-o'></i> Pic "+no+"</button></a><br>";
                    }

                    var infoWindow = new google.maps.InfoWindow({
                      content: contentInfo
                      // maxWidth: 300
                    });
                    // infoWindow.setPosition(pos);
                    // infoWindow.setContent('Location here.');

                    marker.addListener('click', function(){
                      infoWindow.open(map, marker);
                    });
                }

                function addMarker(lat, lng, name, icon, pic, kondisi) {
                    var pos = new google.maps.LatLng(lat, lng);
                    makeMarker(pos, icon, name, pic, kondisi);
                }

                // SHOW LINE ========================================
                function makeLines(coords, name, pjg, color) {
                    // var coords = [
                    //   {lat: 37.772, lng: -122.214},
                    //   {lat: 21.291, lng: -157.821},
                    //   {lat: -18.142, lng: 178.431},
                    //   {lat: -27.467, lng: 153.027}
                    // ];

                    var lines = new google.maps.Polyline({
                      path: coords,
                      geodesic: true,
                      strokeColor: color,
                      strokeOpacity: 1.0,
                      strokeWeight: 4
                    });

                    lines.setMap(map);

                    var contentInfo = name+'<br>Panjang Jalan: '+pjg+' Km';
                    var infoWindow = new google.maps.InfoWindow({
                      content: contentInfo,
                      maxWidth: 300
                    });
                    // infoWindow.setContent('Location here.');

                    lines.addListener('click', function(evt){
                        infoWindow.setPosition(evt.latLng);
                        infoWindow.open(map);
                    });
                }

                function makeLinesArea(coords, color) {
                    // var coords = [
                    //   {lat: 37.772, lng: -122.214},
                    //   {lat: 21.291, lng: -157.821},
                    //   {lat: -18.142, lng: 178.431},
                    //   {lat: -27.467, lng: 153.027}
                    // ];

                    var lines2 = new google.maps.Polyline({
                      path: coords,
                      geodesic: true,
                      strokeColor: color,
                      strokeOpacity: 1.0,
                      strokeWeight: 3
                    });

                    lines2.setMap(map);

                }

                function showLines() {

                    $('#loading').slideDown('slow');

                    $.get("<?= base_url().'Admin/getLines' ?>", function(result){
                        // $('#loading').slideDown('slow').delay(300).slideUp('slow');
                        showMarker();

                        // console.log(result);
                        var dt = JSON.parse(result);    
                        // console.log(JSON.stringify(dt.data));
                        if(dt.response){

                            for (var i = 0; i < dt.data.length ; i++) {
                                var coords = dt.data[i].koordinat;
                                var name = dt.data[i].nama_jln;
                                var pjg = dt.data[i].pjg_jln;
                                var color = dt.data[i].warna_jln;

                                if (coords != null) {
                                    var coordsArr = JSON.parse(coords);
                                    // console.log('Koordinat ',coordsArr);
                                    makeLines(coordsArr, name, pjg, color);
                                }
                            }                            

                        } else {
                            // showFailedMessage('Pesan gagal disampaikan.');
                            alert('Data ruas jalan kosong!');
                        }   
                    });

                    // return false;
                }

                function linesArea(argument) {
                    $.getJSON("<?= base_url().'assets/line_area/line_kab_mgl.json' ?>", function(data) {
                        // console.log(json); // this will show the info it in firebug console
                        for (var i = 0; i < data.length ; i++) {

                            var koords = data[i];
                            var colors = '#000';

                            makeLinesArea(koords, colors);
                        }   
                    });
                }
                // ===================================================
            </script>


            <script type="text/javascript">
                function changeJenisPj(argument) {
                   if (markerCluster != null) {
                        markerCluster.clearMarkers();
                    }
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }

                    markers.length = 0;
                    console.log('jml_marker :', markers.length);

                    showMarker();
                }

                function changeJenisJl(argument) {
                   if (markerCluster != null) {
                        markerCluster.clearMarkers();
                    }
                    for (var i = 0; i < markers.length; i++) {
                        markers[i].setMap(null);
                    }

                    markers.length = 0;
                    console.log('jml_marker :', markers.length);

                    showMarker();
                }

                function showMarker() {

                    $('#loading').slideDown('slow');

                    var id = $('#jenisPj option:selected').attr('value');
                    var jln = $('#jenisJl option:selected').attr('value');

                    $.post("<?= base_url().'Admin/getLocation' ?>", {id: id, jln:jln}, function(result){
                        $('#loading').slideDown('slow').delay(300).slideUp('slow');
                        // console.log(result);
                        var dt = JSON.parse(result);    
                        // console.log(JSON.stringify(dt.data));
                        if(dt.response){

                            for (var i = 0; i < dt.data.length ; i++) {
                                var icon = dt.data[i].icon;
                                var name = dt.data[i].nama_pj;
                                var lat  = dt.data[i].lat;
                                var lng  = dt.data[i].lng;
                                var pic  = dt.data[i].pic;
                                var kondisi = dt.data[i].kondisi_pj;

                                addMarker(lat, lng, name, icon, pic, kondisi);
                            }

                            markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

                            $('#totalFilter').html(dt.totalFilter);
                            $('#totalFilterBaik').html(dt.totalFilterBaik);
                            $('#totalFilterRusak').html(dt.totalFilterRusak);
                            $('#totalPJ').html(dt.totalPJ);
                            $('#totalPJBaik').html(dt.totalPJBaik);
                            $('#totalPJRusak').html(dt.totalPJRusak);

                        } else {
                            // showFailedMessage('Pesan gagal disampaikan.');
                            alert('Data lokasi kosong!');
                            $('#totalFilter').html('0');
                            $('#totalFilterBaik').html('0');
                            $('#totalFilterRusak').html('0');
                            $('#totalPJ').html(dt.totalPJ);
                            $('#totalPJBaik').html(dt.totalPJBaik);
                            $('#totalPJRusak').html(dt.totalPJRusak);
                        }   
                    });

                    // return false;
                }
            </script>

        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcBM8hFljWAtmwZC82_bMjtiI169z_n7k&callback=initMap" type="text/javascript"></script>
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>

            