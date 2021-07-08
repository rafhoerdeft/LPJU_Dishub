        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-6 align-self-center">
                    <h3 class="text-themecolor">Ruas Jalan</h3>
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

                <style type="text/css">
                    a[href^="http://maps.google.com/maps"]{display:none !important}
                    a[href^="https://maps.google.com/maps"]{display:none !important}

                    .gmnoprint a, .gmnoprint span, .gm-style-cc {
                        display:none;
                    }
                    /*.gmnoprint div {
                        background:none !important;
                    }*/
                </style>

                <div class="card">
                    <div class="card-body p-b-0">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#map" role="tab"><span class="hidden-sm-up"><i class="ti-map-alt"></i></span> <span class="hidden-xs-down">Peta</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#table" role="tab"><span class="hidden-sm-up"><i class="mdi mdi-table"></i></span> <span class="hidden-xs-down">Tabel</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-b-20 p-t-20" id="map" role="tabpanel">
                                <div class="row m-b-20">
                                    <div class="col-md-4"> </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4" id="selectWarna">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-8">
                                                        <!-- <label>Jenis Perlengkapan</label> -->
                                                        <select id="selectColor" class="selectpicker" data-style="form-control btn-secondary" onchange="selectColor();">
                                                            <?php foreach ($status_jalan as $jln) { ?>
                                                                <option value="<?= $jln->id_status_jalan ?>" data="<?= $jln->warna_jalan ?>" <?= ($jln->id_status_jalan == 1?'selected':'') ?>><?= $jln->status_jalan ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-8 d-none d-sm-none d-md-none d-lg-block" id="btnOpt">
                                                <div style="float: right;">
                                                    <button id="btn-clear" onclick="clearPolyline()" disabled class="btn waves-effect waves-light btn-default" style="font-size: 12pt;"><i class="fa fa-eraser"></i> Erase</button>
                                                    <button id="btn-undo" onclick="undoDrawLine()" disabled class="btn waves-effect waves-light btn-default" style="font-size: 12pt;"><i class="fa fa-undo"></i> Undo</button>
                                                    <button id="btn-draw" onclick="startDrawPolyline()" class="btn waves-effect waves-light btn-info" style="font-size: 12pt;"><i class="fa fa-pencil"></i> Draw</button>
                                                    <button id="btn-save" data-toggle="modal" onclick="showModalSimpan()" disabled class="btn waves-effect waves-light btn-default" style="font-size: 12pt;"><i class="mdi mdi-content-save-all"> </i> Save</button>
                                                </div>                    
                                            </div>

                                            <div class="col-md-8 d-block d-sm-block d-md-block d-lg-none" id="btnOpt" style="margin-top: 10px">
                                                <button id="btn-clear-m" onclick="clearPolyline()" disabled class="btn waves-effect waves-light btn-default" style="font-size: 12pt"><i class="fa fa-eraser"></i></button>
                                                <button id="btn-undo-m" onclick="undoDrawLine()" disabled class="btn waves-effect waves-light btn-default" style="font-size: 12pt;"><i class="fa fa-undo"></i></button>
                                                <button id="btn-draw-m" onclick="startDrawPolyline()" class="btn waves-effect waves-light btn-info" style="font-size: 12pt"><i class="fa fa-pencil"></i></button>
                                                <button id="btn-save-m" data-toggle="modal" onclick="showModalSimpan()" disabled class="btn waves-effect waves-light btn-default" style="font-size: 12pt"><i class="mdi mdi-content-save-all"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div style="z-index: 2; position: absolute; margin-top: 420px; margin-left: 12px;">
                                    <img src="<?= base_url().'assets/assets/images/logo/dishub-logo-sm.png' ?>" width='35'>
                                    <!-- <label>DISHUB</label> -->
                                </div>
                                
                                <div id="map-canvas" style="height:470px;"></div>
                                
                            </div>
                            <div class="tab-pane  p-20" id="table" role="tabpanel">

                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Ruas Jalan</th>
                                                <th>Status Jalan</th>
                                                <th>Panjang Jalan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 0;
                                                foreach ($ruas_jalan as $jln) { 
                                                    $no++;
                                            ?>
                                                    <tr>
                                                        <td><?= $no ?></td>
                                                        <td><?= $jln->nama_jalan ?></td>
                                                        <td><?= $jln->status_jalan ?></td>
                                                        <td align="right"><?= $jln->panjang_jalan ?> Km</td>
                                                        <td>
                                                            <button type="button" onclick="showModalEdit('<?= $jln->id_jalan ?>', '<?= $jln->id_status_jalan ?>', '<?= $jln->nama_jalan ?>', '<?= $jln->panjang_jalan ?>')" class="btn waves-effect waves-light btn-info" style="width: 40px"  title="Edit Data"><i class="fa fa-pencil-square-o"></i></button>
                                                            <button type="button" onclick="showConfirmMessage('<?= $jln->id_jalan ?>')" class="btn waves-effect waves-light btn-danger" style="width: 40px"  title="Hapus Data"><i class="fa fa-trash-o"></i></button>
                                                        </td>
                                                    </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Modal Simpan -->
            <div id="modal-simpan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Simpan Ruas Jalan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form id="simpanRuasJalan" method="POST" action="<?= base_url().'Admin/simpanRuasJalan' ?>" novalidate>
                            <div class="modal-body">

                                <input type="hidden" name="id_status_jalan" id="id_status_jalan">
                                <input type="hidden" name="koordinat" id="koordinat">

                                <div class="form-group">
                                    <label for="nama_jln" class="control-label">Nama Ruas Jalan:</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nama ruas jalan harus diisi" type="text" class="form-control" name="nama_jln" id="nama_jln">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pjg_jln" class="control-label">Panjang Jalan:</label><br>
                                    <div class="controls">
                                        <input required data-validation-required-message="Panjang jalan harus diisi" type="text"  onkeypress="return inputAngka(event);" class="form-control" name="pjg_jln" id="pjg_jln" style="width: 150px"> Km
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light" id="simpan_jalan">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabels" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Ruas Jalan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form id="updateRuasJalan" method="POST" action="<?= base_url().'Admin/updateRuasJalan' ?>" novalidate>
                            <div class="modal-body">

                                <input type="hidden" name="id_jalan" id="id_jalan">
                                <!-- <input type="hidden" name="id_status_jalan" id="id_status_jalan"> -->
                                <!-- <input type="hidden" name="koordinat" id="koordinat"> -->

                                <div class="form-group">
                                    <label for="nama_jln" class="control-label">Nama Ruas Jalan:</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nama ruas jalan harus diisi" type="text" class="form-control" name="nama_jln" id="nama_jln">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pjg_jln" class="control-label">Panjang Jalan:</label><br>
                                    <div class="controls">
                                        <input required data-validation-required-message="Panjang jalan harus diisi" type="text"  onkeypress="return inputAngka(event);" class="form-control" name="pjg_jln" id="pjg_jln" style="width: 150px"> Km
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jenis Jalan :</label>
                                    <div class="controls">
                                        <select class="form-control" name="id_status_jalan" id="id_status_jalan">
                                            <?php foreach ($status_jalan as $key) {?>
                                                <option value="<?=$key->id_status_jalan?>"><?=$key->status_jalan?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light" id="update_jalan">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

            <script type="text/javascript">
                var color;
                var poly;
                var lengthLine;
                var draw = false;
                var markerCluster;
                var map;
                var markers = [];
                var coordLine = [];
                var mapClick;
                var path;
                function initMap(argument) {
                   var mapOptions = {
                      center: {
                        lat: -7.5011538,
                        lng: 110.2676056
                      },
                      zoom: 11,
                      maxZoom: 18,
                      mapTypeId: google.maps.MapTypeId.ROADMAP,
                      mapTypeControl: false,
                      streetViewControl: true,
                      fullscreenControl: true,
                      // draggableCursor: 'crosshair'
                    };

                    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);    

                    selectColor();
                    showLines();
                    linesArea();
                }

                function selectColor(argument) {
                    color = $('#selectColor option:selected').attr('data');
                }

                //SHOW MARKER ======================================

                function showMarker() {

                    // $('#loading').slideDown('slow');

                    var id = $('#jenisPj option:selected').attr('value');
                    var jln = $('#jenisJl option:selected').attr('value');

                    $.post("<?= base_url().'Admin/getTitikRuasJalan' ?>", {id: id, jln:jln}, function(result){
                        $('#loading').slideDown('slow').delay(300).slideUp('slow');
                        // console.log(result);
                        var dt = JSON.parse(result);    
                        // console.log(JSON.stringify(dt.data));
                        if(dt.response){

                            for (var i = 0; i < dt.data.length ; i++) {
                                var koor_awal = dt.data[i].koordinat_awal;
                                var split_koor_awal = koor_awal.split(',');

                                var koor_akhir = dt.data[i].koordinat_akhir;
                                var split_koor_akhir = koor_akhir.split(',');

                                var id = dt.data[i].id_temp;
                                var name = dt.data[i].nama_temp;
                                var lat_awal  = split_koor_awal[0];
                                var lng_awal  = split_koor_awal[1];
                                var id_awal = 1;

                                var lat_akhir  = split_koor_akhir[0];
                                var lng_akhir  = split_koor_akhir[1];
                                var id_akhir = 2;

                                addMarker(lat_awal, lng_awal, id, id_awal, name);
                                addMarker(lat_akhir, lng_akhir, id, id_akhir, name);
                            }

                            // markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

                        }  
                    });

                    // return false;
                }

                function makeMarker(pos, id, ids, name) {

                    var marker = new google.maps.Marker({
                      position: pos,
                      map: map,
                      animation: google.maps.Animation.DROP,
                      id: id,
                      ids: ids,
                      // icon: "<?//= base_url().'assets/icon/marker/' ?>"+icon+'.png',
                      title: name
                    });                    

                    markers.push(marker);
                    
                    var infoWindow = new google.maps.InfoWindow({
                      // content: contentInfo
                      maxWidth: 300
                    });
                    // infoWindow.setPosition(pos);
                    // infoWindow.setContent('Location here.');

                    marker.addListener('click', function(){
                        var name = marker.getTitle();
                        var id_temp = marker.id;
                        var ids = marker.ids;

                        infoWindow.setContent("<label style='font-size: 12pt; font-weight: bold'>"+name+"</label><button style='width: 100%;' type='button' class='btn btn-sm waves-effect waves-light btn-primary m-b-5' title='Hapus' onclick='hapusMarker("+id_temp+")'><i class='fa fa-trash'></i> Hapus</button>");
                        infoWindow.open(map, marker);

                        for (var i=0; i < markers.length; i++) {
                            var infoWindows = new google.maps.InfoWindow({
                              maxWidth: 300
                            });
                            var titik = markers[i];
                            var title_name = titik.getTitle();
                            if (id_temp == titik.id) {
                                if (ids != titik.ids) {
                                    infoWindows.setContent("<label style='font-size: 12pt; font-weight: bold'>"+title_name+"</label><button style='width: 100%;' type='button' class='btn btn-sm waves-effect waves-light btn-primary m-b-5' title='Hapus' onclick='hapusMarker("+id_temp+")'><i class='fa fa-trash'></i> Hapus</button>");
                                    infoWindows.open(map, titik);
                                }
                            }
                        }
                        
                    });
                }

                function addMarker(lat, lng, id, ids, name) {
                    var pos = new google.maps.LatLng(lat, lng);
                    makeMarker(pos, id, ids, name);
                }

                function hapusMarker(id) {
                    // alert(id);
                    $('#loading').slideDown('slow');
                    $.post("<?= base_url().'Admin/hapusTitikRuasJalan' ?>", {id: id}, function(result){
                        
                         var dt = JSON.parse(result);  

                         if (dt.response) {
                            for (var i = 0; i < markers.length; i++) {
                                markers[i].setMap(null);
                            }
                            showMarker();
                         } else {
                            $('#loading').slideDown('slow').delay(300).slideUp('slow');
                         }

                    });
                }

                // =================================================

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
                        // console.log(result);
                        showMarker();

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


                // DRAW LINE =================================================
                function drawPolyline() {
                    poly = new google.maps.Polyline({
                      strokeColor: color,
                      strokeOpacity: 1.0,
                      strokeWeight: 4
                    });

                    // Add a listener for the click event
                    if (draw) {
                        poly.setMap(map);
                        mapClick = map.addListener('click', addLatLng);
                    }
                }

                function addLatLng(event) {
                    // console.log('Event :', event);
                    path = poly.getPath();
                    coordLine.push(event.latLng);

                    // console.log('Coord: ', JSON.stringify(event.latLng));
                    // console.log('Koordinat: ', JSON.stringify(coordLine));
                    // Because path is an MVCArray, we can simply append a new coordinate
                    // and it will automatically appear.
                    path.push(event.latLng);

                    // console.log('Data Array: ', JSON.stringify(path.getArray()));

                    lengthLine = calculateDistances(path.getArray());

                    console.log('Panjang Line: ', lengthLine.km);

                    if (path.length == 1) {
                        $('#btn-undo').removeAttr('disabled');
                        $('#btn-undo-m').removeAttr('disabled');
                        $('#btn-undo').toggleClass('btn-warning btn-default');
                        $('#btn-undo-m').toggleClass('btn-warning btn-default');
                    }

                    // Add a new marker at the new plotted point on the polyline.
                    // var marker = new google.maps.Marker({
                    //   position: event.latLng,
                    //   title: '#' + path.getLength(),
                    //   map: map
                    // });
                }

                function undoDrawLine() {
                    path.pop(); 
                    coordLine.pop();
                    if (path.length == 1) {
                        path.pop();
                        coordLine.pop();
                    } 
                    if (path.length == 0) {
                        $('#btn-undo').attr('disabled','');
                        $('#btn-undo-m').attr('disabled','');
                        $('#btn-undo').toggleClass('btn-warning btn-default');
                        $('#btn-undo-m').toggleClass('btn-warning btn-default');
                    }
                }

                function startDrawPolyline(){
                    draw = true;
                    lengthLine = 0;
                    map.setOptions({draggableCursor: 'crosshair'});

                    $('#selectColor').removeAttr('data-style');
                    $('#selectColor').attr('disabled','');
                    $('#selectColor').selectpicker('refresh');

                    $('#btn-draw').attr('disabled','');
                    $('#btn-clear').removeAttr('disabled');
                    $('#btn-save').removeAttr('disabled');
                    // $('#btn-undo').removeAttr('disabled');

                    $('#btn-draw-m').attr('disabled','');
                    $('#btn-clear-m').removeAttr('disabled');
                    $('#btn-save-m').removeAttr('disabled');
                    // $('#btn-undo-m').removeAttr('disabled');

                    $('#btn-draw').toggleClass('btn-info btn-default');
                    $('#btn-clear').toggleClass('btn-danger btn-default');
                    $('#btn-save').toggleClass('btn-success btn-default');
                    // $('#btn-undo').toggleClass('btn-warning btn-default');

                    $('#btn-draw-m').toggleClass('btn-info btn-default');
                    $('#btn-clear-m').toggleClass('btn-danger btn-default');
                    $('#btn-save-m').toggleClass('btn-success btn-default');
                    // $('#btn-undo-m').toggleClass('btn-warning btn-default');

                    drawPolyline();
                }

                function clearPolyline(){
                    lengthLine = 0;
                    map.setOptions({draggableCursor: ''});

                    $('#selectColor').attr('data-style', 'form-control btn-secondary');
                    $('#selectColor').removeAttr('disabled');
                    $('#selectColor').selectpicker('refresh');

                    $('#btn-draw').removeAttr('disabled');
                    $('#btn-clear').attr('disabled','');
                    $('#btn-save').attr('disabled','');
                    $('#btn-undo').attr('disabled','');

                    $('#btn-draw-m').removeAttr('disabled');
                    $('#btn-clear-m').attr('disabled','');
                    $('#btn-save-m').attr('disabled','');
                    $('#btn-undo-m').attr('disabled','');

                    $('#btn-draw').toggleClass('btn-info btn-default');
                    $('#btn-clear').toggleClass('btn-danger btn-default');
                    $('#btn-save').toggleClass('btn-success btn-default');

                    $('#btn-draw-m').toggleClass('btn-info btn-default');
                    $('#btn-clear-m').toggleClass('btn-danger btn-default');
                    $('#btn-save-m').toggleClass('btn-success btn-default');

                    if (path.length > 0) {
                        $('#btn-undo').toggleClass('btn-warning btn-default');
                        $('#btn-undo-m').toggleClass('btn-warning btn-default');
                    }


                    if (poly != null) {
                        poly.setMap(null);
                        mapClick.remove();
                    }
                    coordLine.length = 0;
                    draw = false;
                }

                function calculateDistances(dataArray) {
                    var stuDistances = {};
                    
                    stuDistances.metres = google.maps.geometry.spherical.computeLength(dataArray);    // distance in metres
                    stuDistances.km = Math.round(stuDistances.metres / 1000 *10)/10;                            // distance in km rounded to 1dp
                    stuDistances.miles = Math.round(stuDistances.metres / 1000 * 0.6214 *10)/10;                // distance in miles rounded to 1dp
                    
                    return stuDistances;
                }
                // =======================================================

            </script>


        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcBM8hFljWAtmwZC82_bMjtiI169z_n7k&callback=initMap&libraries=geometry&sensor=false" type="text/javascript"></script>
        <!-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script> -->
        <!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=geometry&sensor=false"></script> -->

        <!-- Fungsi Dialog -->
        <script type="text/javascript">
            //These codes takes from http://t4t5.github.io/sweetalert/
            function showBasicMessage() {
                swal("Here's a message!");
            }

            function showWithTitleMessage() {
                swal("Here's a message!", "It's pretty, isn't it?");
            }

            function validasiMessage(text){
                swal({
                    title: "Dilarang!",
                    text: text,
                    type: "error",
                    timer: 1000,
                    showConfirmButton: false
                });
            }

            function showSuccessMessage(input) {
                swal({
                    title: input+"!",
                    text: "Data Berhasil "+input+"!",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                });
            }

            function showFailedMessage(input) {
                swal({
                    title: "Gagal!",
                    text: input,
                    type: "error",
                    timer: 1000,
                    showConfirmButton: false
                });
            }

            function showCancelMessage() {
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        swal("Deleted!", "Your imaginary file has been deleted.", "success");
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            }
        </script>


        <!-- SIMPAN RUAS JALAN =========================================== -->
        <script type="text/javascript">

            function showModalSimpan(argument) {
                if (coordLine.length <= 1) {
                    validasiMessage("Buat line ruas jalan dahulu!");
                } else {
                    var koordinat = JSON.stringify(coordLine);
                    var id_status_jalan = $('#selectColor option:selected').attr('value');

                    $('#modal-simpan #koordinat').val(koordinat);
                    $('#modal-simpan #id_status_jalan').val(id_status_jalan);
                    $('#modal-simpan #nama_jln').val('');
                    $('#modal-simpan #pjg_jln').val(lengthLine.km);
                    $('#modal-simpan').modal('show');
                }
            }

            // $('#simpanRuasJalan').submit(function(e){

            //     var koordinat = JSON.stringify(coordLine);
            //     var id_status_jalan = $('#selectColor option:selected').attr('value');
            //     var nama_jalan = $('#modal-simpan #nama_jln').val();
            //     var pjg_jln = $('#modal-simpan #pjg_jln').val();

            //     console.log('id_status_jalan :', id_status_jalan);
            //     console.log('nama_jalan :', nama_jalan);
            //     console.log('pjg_jln :', pjg_jln);
                
            //     $.post("<?//= base_url().'Admin/simpanRuasJalan' ?>", {id_status_jalan: id_status_jalan}, function(result){
            //         // alert(result);
            //     });

            //     return false;
            // });
        </script>
        <!-- ======================================================= -->

        <!-- UPDATE RUAS JALAN =========================================== -->
        <script type="text/javascript">

            function showModalEdit(id_jalan='', id_status_jalan='', nama_jln='', pjg_jln='') {
                $('#modal-edit #id_jalan').val(id_jalan);
                $('#modal-edit #id_status_jalan').val(id_status_jalan);
                $('#modal-edit #nama_jln').val(nama_jln);
                $('#modal-edit #pjg_jln').val(pjg_jln);
                $('#modal-edit').modal('show');
            }

        </script>
        <!-- ======================================================= -->

        <!-- HAPUS RUAS JALAN ================================= -->
        <script type="text/javascript">
            function showConfirmMessage(id) {
                swal({
                    title: "Anda yakin data akan dihapus?",
                    text: "Data tidak akan dapat di kembalikan lagi!!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Hapus!",
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        type : "POST",
                        url  : "<?php echo base_url('Admin/deleteRuasJalan')?>",
                        dataType : "html",
                        data : {id:id},
                        success: function(data){
                            // alert(data);
                            // $('#myTable').DataTable().destroy();
                            // $('#myTable').DataTable().draw();

                            if(data=='Success'){
                                location.reload();
                            }else{
                                location.reload();
                            } 
                        }
                    });
                    return false;
                    // swal("Hapus!", "Data telah berhasil dihapus.", "success");
                });
            }
        </script>
            