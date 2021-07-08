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
                    <h3 class="text-themecolor">Jenis Lampu</h3>
                </div>
                <div class="col-md-6 align-self-center">
                    <ol class="breadcrumb">
                        <!-- <label>Jenis Perlengkapan</label> -->
                        <li class="breadcrumb-item active">Jenis Lampu</li>
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
                        <button type="button" onclick="showModalAdd()" class="btn waves-effect waves-light btn-primary float-right"  title="Edit Data"><i class="fa fa-plus"></i> Tambah Lampu</button>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Status Jalan</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach ($jenis_lampu as $key) {?>
                                        <tr>
                                            <td><?=$no++?></td>
                                            <td><?=$key->jenis_lampu?></td>
                                            <td class="text-center">
                                                <button style="width: 30px" type="button" onclick="showModalEdit('<?= encode($key->id_jenis_lampu) ?>')" class="btn btn-sm waves-effect waves-light btn-success m-b-5"  title="Edit Data"><i class="fa fa-pencil-square-o"></i></button>
                                                <button style="width: 30px" type="button" onclick="showConfirmMessage('<?= encode($key->id_jenis_lampu) ?>')" class="btn btn-sm waves-effect waves-light btn-danger m-b-5"  title="Hapus Data"><i class="fa fa-trash-o"></i></button>
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
                        <form action="<?=base_url()?>Admin/updateJenisLampu" method="POST">
                            <input type="hidden" name="id_jenis_lampu" id="id">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Jenis</label>
                                    <input type="text" class="form-control" name="jenis_lampu" id="jenis_lampu" required>
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
                        <form action="<?=base_url()?>Admin/saveJenisLampu" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nama Jenis</label>
                                    <input type="text" class="form-control" name="jenis_lampu" required>
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
                    url  : "<?php echo base_url('Admin/getDataJenisLampu')?>",
                    dataType : "json",
                    data : {id:id},
                    success: function(data){
                        $("#loading-show").fadeIn("slow").delay(300).slideUp('slow');
                        // console.log(data);
                        $('#modal-edit #jenis_lampu').val(data[0].jenis_lampu);
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
                    location = "<?=base_url('Admin/deleteJenisLampu/')?>"+id;
                    return false;
                });
            }
        </script>
            