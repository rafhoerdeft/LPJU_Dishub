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
                    <h3 class="text-themecolor">Jenis Ruas Jalan</h3>
                </div>
                <div class="col-md-6 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <label>Jenis Perlengkapan</label> -->
                        <li class="breadcrumb-item active">Jenis Ruas Jalan</li>
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
                        <button type="button" onclick="showModalAdd()" class="btn waves-effect waves-light btn-primary float-right"  title="Edit Data"><i class="fa fa-plus"></i> Tambah Jalan</button>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Status Jalan</td>
                                        <td>Warna</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($jenis_jalan as $key) {?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?=$key->status_jalan?></td>
                                            <td><hr style="border: 4px solid <?=$key->warna_jalan?>"></td>
                                            <td class="text-center">
                                                <button style="width: 30px" type="button" onclick="showModalEdit('<?= $key->id_status_jalan ?>')" class="btn btn-sm waves-effect waves-light btn-success m-b-5"  title="Edit Data"><i class="fa fa-pencil-square-o"></i></button>
                                                <button style="width: 30px" type="button" onclick="showConfirmMessage('<?= encode($key->id_status_jalan) ?>')" class="btn btn-sm waves-effect waves-light btn-danger m-b-5"  title="Hapus Data"><i class="fa fa-trash-o"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal edit -->
            <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?=base_url()?>Admin/updateStatusJalan" method="POST">
                            <input type="hidden" name="id_status_jalan" id="id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Status Jalan</label>
                                    <input type="text" class="form-control" name="status_jalan" id="status_jalan" required>
                                </div>   
                                <div class="form-group">
                                    <label>Warna Jalan</label><br>
                                    <input type="text" class="colorpicker form-control" required name="warna_jalan" id="warna_jalan" /> 
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Simpan</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal edit -->

            <!-- modal add -->
            <div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Tambah Status Jalan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form action="<?=base_url()?>Admin/saveStatusJalan" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Status Jalan</label>
                                    <input type="text" class="form-control" name="status_jalan" required>
                                </div>   
                                <div class="form-group">
                                    <label>Warna Jalan</label><br>
                                    <input type="text" class="colorpicker form-control" required name="warna_jalan" value="#32a852" /> 
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info waves-effect">Simpan</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        
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


        <!-- SIMPAN JALAN =========================================== -->
        <script type="text/javascript">
            function showModalAdd(argument) {
                // $('#modal-simpan #tambahDataUser').trigger("reset");
                $('#modal-add').modal('show');
            }
        </script>
        <!-- ======================================================= -->

        <!-- UPDATE JALAN =========================================== -->
        <script type="text/javascript">

            function showModalEdit(id) {
                // alert(id);
                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('Admin/getDataJenisJalan')?>",
                    dataType : "json",
                    data : {id:id},
                    success: function(data){
                        $("#loading-show").fadeIn("slow").delay(300).slideUp('slow');
                        // console.log(data);
                        $('#modal-edit #status_jalan').val(data[0].status_jalan);
                        $('#modal-edit #warna_jalan').asColorPicker('val', data[0].warna_jalan);
                        // $('#modal-edit .asColorPicker-trigger').html('<span style="background: '+data[0].warna_jalan+';"></span>'); //change color pallete
                        $('#modal-edit #id').val(id);
                        $('#modal-edit').modal('show');
                    }
                });
                return false;
            }

        </script>
        <!-- ======================================================= -->

        <!-- HAPUS JALAN ================================= -->
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
                    $("#loading-show").fadeIn("slow").delay(300).slideUp('slow');
                    // alert(id);
                    location = "<?=base_url('Admin/deleteStatusJalan/')?>"+id;
                    return false;
                });
            }
        </script>
            