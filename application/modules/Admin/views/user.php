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
                        <button type="button" onclick="showModalAdd()" class="btn waves-effect waves-light btn-primary float-right"  title="Edit Data"><i class="fa fa-plus"></i> Tambah User</button>

                        <div class="table-responsive">
                            <table id="myTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Username</th>
                                        <th>No. HP</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 0;
                                        foreach ($data_user as $usr) { 
                                            $no++;
                                    ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $usr->nama_user ?></td>
                                                <td><?= $usr->jk_user ?></td>
                                                <td><?= $usr->username ?></td>
                                                <td><?= $usr->no_hp ?></td>
                                                <td><?= $usr->role ?></td>
                                                <td>
                                                    <button type="button" data-id="<?= $usr->id_user ?>" data-nama="<?= $usr->nama_user ?>" data-jk="<?= $usr->jk_user ?>" data-username="<?= $usr->username ?>" data-role="<?= $usr->id_role ?>" data-noHp="<?= $usr->no_hp ?>" onclick="showModalEdit(this)" class="btn waves-effect waves-light btn-info" style="width: 40px"  title="Edit Data"><i class="fa fa-pencil-square-o"></i></button>
                                                    <button type="button" onclick="showConfirmMessage('<?= $usr->id_user ?>')" class="btn waves-effect waves-light btn-danger" style="width: 40px"  title="Hapus Data"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Modal Simpan -->
            <div id="modal-simpan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form id="tambahDataUser" method="POST" action="<?= base_url().'Admin/tambahDataUser' ?>" novalidate>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="nama_user" class="control-label">Nama User :</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nama user harus diisi" type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Isi nama user">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jk_user" class="control-label">Jenis Kelamin :</label>
                                    <div class="controls">
                                        <select id="jk_user" name="jk_user" class="form-control">
                                            <option id="Laki-Laki" value="Laki-Laki">Laki-Laki</option>
                                            <option id="Perempuan" value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="control-label">Username :</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Username harus diisi" type="text" class="form-control" name="username" id="username" placeholder="Isi username untuk login">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="control-label">Password :</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nama user harus diisi" type="text" class="form-control" name="password" id="password" placeholder="Isi password untuk login">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp" class="control-label">Nomor HP :</label><br>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nomor HP harus diisi" type="text"  onkeypress="return inputAngka(event);" class="form-control" name="no_hp" id="no_hp">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role" class="control-label">Role :</label>
                                    <div class="controls">
                                        <select id="role" name="id_role" class="form-control">
                                            <?php foreach ($data_role as $role) { ?>
                                                <option id="<?= $role->id_role ?>" value="<?=$role->id_role ?>"><?=$role->role ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light" id="simpan_jalan">Save</button>
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
                            <h4 class="modal-title">Update Data User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form id="updateDataUser" method="POST" action="<?= base_url().'Admin/updateDataUser' ?>" novalidate>
                            <div class="modal-body">

                                <input type="hidden" name="id_user" id="id_user">

                                <div class="form-group">
                                    <label for="nama_user" class="control-label">Nama User :</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nama user harus diisi" type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Isi nama user">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jk_user" class="control-label">Jenis Kelamin :</label>
                                    <div class="controls">
                                        <select id="jk_user" name="jk_user" class="form-control">
                                            <option id="Laki-Laki" value="Laki-Laki">Laki-Laki</option>
                                            <option id="Perempuan" value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="control-label">Username :</label>
                                    <div class="controls">
                                        <input required data-validation-required-message="Username harus diisi" type="text" class="form-control" name="username" id="username" placeholder="Isi username untuk login">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password" class="control-label">Password :</label>
                                    <div class="controls">
                                        <input type="text" class="form-control" name="password" id="password" placeholder="Isi password jika ingin rubah password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp" class="control-label">Nomor HP :</label><br>
                                    <div class="controls">
                                        <input required data-validation-required-message="Nomor HP harus diisi" type="text"  onkeypress="return inputAngka(event);" class="form-control" name="no_hp" id="no_hp">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role" class="control-label">Role :</label>
                                    <div class="controls">
                                        <select id="role" name="id_role" class="form-control">
                                            <?php foreach ($data_role as $role) { ?>
                                                <option id="<?= $role->id_role ?>" value="<?=$role->id_role ?>"><?=$role->role ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label for="message-text" class="control-label">Message:</label>
                                    <textarea class="form-control" id="message-text"></textarea>
                                </div> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info waves-effect waves-light" id="simpan_jalan">Save</button>
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


        <!-- SIMPAN USER =========================================== -->
        <script type="text/javascript">
            function showModalAdd(argument) {
                $('#modal-simpan #tambahDataUser').trigger("reset");
                $('#modal-simpan').modal('show');
            }
        </script>
        <!-- ======================================================= -->

        <!-- UPDATE USER =========================================== -->
        <script type="text/javascript">

            function showModalEdit(data) {
                var id_user = $(data).attr('data-id');
                var nama_user = $(data).attr('data-nama');
                var jk_user = $(data).attr('data-jk');
                var username = $(data).attr('data-username');
                var no_hp = $(data).attr('data-noHp');
                var role = $(data).attr('data-role');

                $('#modal-edit #id_user').val(id_user);
                $('#modal-edit #nama_user').val(nama_user);
                $('#modal-edit #jk_user').val(jk_user).prop('selected',true);
                $('#modal-edit #username').val(username);
                $('#modal-edit #no_hp').val(no_hp);
                $('#modal-edit #role').val(role).prop('selected',true);
                $('#modal-edit').modal('show');
            }

        </script>
        <!-- ======================================================= -->

        <!-- HAPUS USER ================================= -->
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
                        url  : "<?php echo base_url('Admin/deleteDataUser')?>",
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
            