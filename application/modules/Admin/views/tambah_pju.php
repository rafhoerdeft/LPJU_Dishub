	<style type="text/css">
		.bigdrop {
		    width: 300px !important;
		}
	</style>

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
                    <h3 class="text-themecolor">Tambah Data PJU</h3>
                </div>
                <div class="col-md-6 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <label>Jenis Perlengkapan</label> -->
                        <!-- <li class="breadcrumb-item active">Tambah Data PJU</li> -->
                    </ol>
                </div>
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
                        <div class="col-md-4 offset-md-8">
                            <select id="jenisPj" class="form-control" onchange="changeJenisPj();">
                                <?php foreach ($jenisPj as $pj) { ?>
                                    <option value="<?= encode($pj->id_jenis) ?>" <?= ($pj->id_jenis == $idSelectPj?'selected':'') ?>><?= $pj->nama_jenis ?></option>
                                <?php } ?> 
                            </select>
                        </div>                        
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?=base_url()?>Admin/addPJ" enctype="multipart/form-data">
                            <input type="hidden" name="id_jenis" value="<?=encode($idSelectPj)?>">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama_pj" required>
                            </div>
                            <?php if ($idSelectPj == '1') { ?>
                                <div class="form-group">
                                    <label class="control-label">Jaringan Listrik</label>
                                    <select class="form-control select2" name="id_listrik" required style="width: 100%">
                                        <option selected disabled="">Pilih Jaringan Listrik</option>
                                        <?php foreach ($listrik as $row) { 
                                            if ($row->nama_pj=='Abonemen') {?>
                                                <option value="<?=$row->id_pj?>"><?= $row->nama_pj?></option>
                                            <?php } else {?>
                                                <option value="<?=$row->id_pj?>"><?= $row->nama_pj.' ['.$row->no_id_pel.'] ['.$row->nama_jalan ?>]</option>
                                        <?php } }?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Jenis Lampu</label>
                                            <select class="form-control select2" name="id_jenis_lampu" required style="width: 100%">
                                                <option selected="" disabled="">Pilih Jenis Lampu</option>
                                                <?php foreach ($jenis_lampu as $row) { ?>
                                                    <option value="<?=$row->id_jenis_lampu?>"><?= $row->jenis_lampu?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Abonemen</label>
                                            <input type="text" class="form-control" name="abonemen" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Sumber Dana</label>
                                            <select class="form-control select2" name="sumber_dana" required style="width: 100%">
                                                <option selected="" disabled="">Pilih Sumber Dana</option>
                                                <?php foreach ($jenis_sumber_dana as $row) { ?>
                                                    <option value="<?=$row->id_sumber_dana?>"><?= $row->nama_sumber_dana?></option>
                                                <?php }?>
	                                        </select>
	                                    </div>
                                        <div class="col-md-4">
                                            <label>Aset</label>
                                            <select class="form-control select2" name="id_aset" required style="width: 100%">
                                                <option selected="" disabled="">Pilih Aset</option>
                                                <?php foreach ($jenis_aset as $row) { ?>
                                                    <option value="<?=$row->id_aset?>"><?= $row->nama_aset?></option>
                                                <?php }?>
                                            </select>
	                                    </div>
                                        <div class="col-md-4">
                                            <label>Jenis Tiang</label>
                                            <select class="form-control select2" name="id_jenis_tiang" required style="width: 100%">
                                                <option selected="" disabled="">Pilih Jenis Tiang</option>
                                                <?php foreach ($jenis_tiang as $row) { ?>
                                                    <option value="<?=$row->id_jenis_tiang?>"><?= $row->nama_jenis_tiang?></option>
                                                <?php }?>
                                            </select>
	                                    </div>
                                    </div>
                                </div>
                                
                            <?php } else if ($idSelectPj == '3') {?>
                                <div class="form-group">
                                    <label>Jenis Rambu</label>
                                    <select class="form-control select2" name="id_jenis_rambu" required style="width: 100%">
                                        <option selected="" disabled="">Pilih Jenis Rambu</option>
                                        <?php foreach ($jenis_rambu as $row) { ?>
                                            <option value="<?=$row->id_jenis_rambu?>"><?= $row->jenis_rambu?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            <?php } else if ($idSelectPj == '4') {?>
                                <div class="form-group">
                                    <label>Panjang (M)</label>
                                    <input type="text" class="form-control" name="pjg_guardrail" onkeypress="return isNumber(event)" required>
                                </div>
                            <?php } else if ($idSelectPj == '5') {?>
                                <div class="form-group">
                                    <label>Lebar Jalan (M)</label>
                                    <input type="text" class="form-control" name="lebar_jalan" onkeypress="return isNumber(event)" required>
                                </div>
                            <?php } else if ($idSelectPj == '7') {?>
                                <div class="form-group">
                                    <label>Nomor ID Pelanggan</label>
                                    <input type="text" class="form-control" name="no_id_pel" required>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>KWh Meter</label>
                                            <input type="text" class="form-control" name="kwh_meter" onkeypress="return isNumber(event)" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Panjang Tarikan Meterisasi</label>
                                            <input type="text" class="form-control" name="panjang_tarikan_meterisasi" onkeypress="return isNumber(event)" required>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Kecamatan</label>
                                        <select class="form-control select2" name="kode_kecamatan" required style="width: 100%">
                                            <option selected="" disabled="">Pilih Kecamatan</option>
                                            <?php foreach ($dataKec as $row) { ?>
                                                <option value="<?=$row->kode_kecamatan?>"><?= $row->nama_kecamatan?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <label>Ruas Jalan</label>
                                        <select class="form-control select2" name="id_jalan" required style="width: 100%">
                                            <option selected="" disabled="">Pilih Ruas Jalan</option>
                                            <?php foreach ($dataRuasJln as $row) { ?>
                                                <option value="<?=$row->id_jalan?>"><?= $row->nama_jalan.' - <b>'.$row->status_jalan?></b></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12 mb-1">
                                        <div id="map" style="height: 300px; width: 100%">
                                            <div style="z-index: 2; position: absolute; margin-top: 420px; margin-left: 12px;">
                                                <img src="<?= base_url().'assets/assets/images/logo/dishub-logo-sm.png' ?>" width='35'>
                                                <!-- <label>DISHUB</label> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude" required placeholder="Ex : -7.121232312">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude" required placeholder="Ex : 100.121232312">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Tahun</label>
                                        <input type="text" class="form-control" name="thn_pj" onkeypress="return isNumber(event)" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Kondisi</label>
                                        <select class="form-control" name="kondisi_pj" required>
                                            <option value="Baik">Baik</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Foto</label><br>
                                <div id="upload_file"></div>
                                <button type="button" onclick="addfoto()" class="btn btn-sm waves-effect waves-light btn-info"><i class="fa fa-plus"></i> Tambah Foto</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn waves-effect waves-light btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->

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

        <script type="text/javascript">
            function changeJenisPj() {
                var id = $('#jenisPj option:selected').attr('value');
                window.location = "<?= base_url().'Admin/tambah_data_pj/' ?>" + id;
            }
        </script>

        <script type="text/javascript">
            function addfoto(){
                var file =  '<div class="form-group">'+
                                '<a href="javascript:void(0)" onclick="removeUpload(this)" style="float: right;"><span class="badge badge-danger">X</span></a>'+
                                '<div class="controls">'+
                                    '<input type="file" data-validation-required-message="Foto harus diisi" required name="file_pic_new[]" id="file_pic_new[]" class="dropify" data-height="100" data-max-file-size="500K" accept="image/*" />'+
                                '</div>'+
                            '</div>';
                $('#upload_file').append(file);

                $('.dropify').dropify({
                     messages: {
                        default: '<center>Upload foto/gambar disini.</center>',
                        error: '<center>Maksimal ukuran file 500 KB.</center>',
                    }
                });
            }

            function removeUpload(data) {
                $(data).parent().remove();
            }
        </script>

        <!-- number only -->
        <script type="text/javascript">
            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
        </script>
        <!-- ./number only -->

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
            