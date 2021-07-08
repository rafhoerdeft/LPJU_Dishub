
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <?php  
                        $username = $this->session->userdata('username');
                        $namaUser = $this->session->userdata('nama_user');
                        $first = substr($namaUser, 0, 1);
                        $label = strtoupper($first);
                    ?>
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?= base_url() ?>assets/assets/images/icon-profil/<?=$label?>.jpg" alt="user" />
                        <!-- this is blinking heartbit-->
                        <!-- <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                    </div>
                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?= ucfirst($namaUser) ?></h5>
                        <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>
                        <!-- <a href="app-email.html" class="" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a> -->
                        <a href="<?= base_url() ?>Auth/logout" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                        <div class="dropdown-menu animated flipInY">
                            <!-- text-->
                            <!-- <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a> -->
                            <!-- text-->
                            <!-- <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> -->
                            <!-- text-->
                            <!-- <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a> -->
                            <!-- text-->
                            <!-- <div class="dropdown-divider"></div> -->
                            <!-- text-->
                            <!-- <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a> -->
                            <!-- text-->
                            <!-- <div class="dropdown-divider"></div> -->
                            <!-- text-->
                            <a href="<?= base_url() ?>Auth/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                            <!-- text-->
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">MENU</li>
                        <!-- <li class="<?//= ($menu == 'dashboard'?'active':'') ?>"> 
                            <a class="waves-effect <?//= ($menu == 'dashboard'?'active':'') ?>" href="<?//= base_url() ?>Admin" aria-expanded="false">
                                <i class="mdi mdi-gauge"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li> -->
                        <li class="<?= ($menu == 'map'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'map'?'active':'') ?>" href="<?= base_url() ?>Admin/index" aria-expanded="false">
                                <i class="mdi mdi-map-marker"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="<?= ($menu == 'jalan'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'jalan'?'active':'') ?>" href="<?= base_url() ?>Admin/ruasJalan" aria-expanded="false">
                                <i class="mdi mdi-road-variant"></i>
                                <span class="hide-menu">Ruas Jalan</span>
                            </a>
                        </li>
                        <li class="<?= ($menu == 'jenisruas'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'jenisruas'?'active':'') ?>" href="<?= base_url() ?>Admin/jenisRuasJalan" aria-expanded="false">
                                <i class="mdi mdi-road"></i>
                                <span class="hide-menu">Jenis Ruas Jalan</span>
                            </a>
                        </li>
                        <li class="<?= ($menu == 'jenislampu'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'jenislampu'?'active':'') ?>" href="<?= base_url() ?>Admin/jenisLampu" aria-expanded="false">
                                <i class="mdi mdi-lamp"></i>
                                <span class="hide-menu">Jenis Lampu</span>
                            </a>
                        </li>
                        <!-- <li class="<?= ($menu == 'perlengkapan'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'perlengkapan'?'active':'') ?>" href="<?= base_url() ?>Admin/perlengkapanJalan" aria-expanded="false">
                                <i class="mdi mdi-vlc"></i>
                                <span class="hide-menu">Perlengkapan Jalan</span>
                            </a>
                        </li> -->
                        <li class="<?= ($menu == 'perlengkapan'?'active':'') ?>"><a class="has-arrow waves-effect <?= ($menu == 'perlengkapan'?'active':'') ?>" href="#" aria-expanded="false"><i class="mdi mdi-vlc"></i><span class="hide-menu">Perlengkapan Jalan </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?= base_url() ?>Admin/perlengkapanJalan">Data PJ</a></li>
                                <li><a href="<?= base_url() ?>Admin/tambah_data_pj">Tambah Data</a></li>
                            </ul>
                        </li>
                        <li class="<?= ($menu == 'laporan'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'laporan'?'active':'') ?>" href="<?= base_url() ?>Admin/laporan" aria-expanded="false">
                                <i class="mdi mdi-file-document"></i>
                                <span class="hide-menu">Laporan</span>
                            </a>
                        </li>
                        <li class="<?= ($menu == 'user'?'active':'') ?>"> 
                            <a class="waves-effect <?= ($menu == 'user'?'active':'') ?>" href="<?= base_url() ?>Admin/dataUser" aria-expanded="false">
                                <i class="mdi mdi-account"></i>
                                <span class="hide-menu">Data User</span>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->