<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo ucwords($title ?? '-'); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/_assets/css/custom.min.css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css" media="screen">
        th,
        td {
            text-align: center;
        }
    </style>
</head>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">Master Data</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="<?php echo base_url('C_users') ?>"><span class="fa fa-user"></span> Data Users</a>
                        <a class="dropdown-item" href="<?php echo base_url('C_mahasiswa') ?>"><span class="fa fa-user"></span> Data Mahasiswa</a>
                        <a class="dropdown-item" href="<?php echo base_url('c_combo') ?>"><span class="fa fa-user"></span> Combo test</a>
                        <a class="dropdown-item" href="<?php echo base_url('c_autocomplete') ?>"><span class="fa fa-user"></span> Auto Complete</a>


                    </div>
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">Laporan</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="<?php echo base_url('Report') ?>" target="_blank"><span class="fa fa-print"></span> Report Data Users</a>
                    </div>
                </div>
            </div>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">SMS Getaway</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="<?php echo base_url('pesan') ?>"><span class="fa fa-send"></span> Perorangan</a>
                        <a class="dropdown-item" href="#"><span class="fa fa-send"></span> Kebanyak</a>
                    </div>
                </div>
            </div>

            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-primary">Send Email</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item" href="#"><span class="fa fa-send"></span> Mahasiswa</a>
                    </div>
                </div>
            </div>

        </div>
        <ul class="nav nav-pills nav-stacked my-2 my-lg-0">
            <li class="nav-item dropdown" style="float: right;">
                <a class="nav-link active" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                    <?php
                    // $data = array('username', 'level', 'foto');
                    $level = $this->session->userdata('level'); ?>
                    <?php if (!empty($level)) : ?>
                        <img style="border-radius: 100%;height: 35px;width: 40px;" src="<?php echo base_url('uploads/' . $this->session->userdata('foto')) ?>" alt="">
                        <?php echo "Selamat Datang " . strtoupper($this->session->userdata('username')); ?>
                    <?php else : ?>

                    <?php endif ?>



                    <?php
                    if (!empty($authUrl)) {
                        echo '';
                    } else {
                    ?>
                        <img style="border-radius: 100%;height: 35px;width: 40px;" src="<?php echo $this->session->userdata('picture_url') ?>" alt="">
                    <?php
                        echo $this->session->userdata('email');
                    }


                    ?>

                    <span class="caret"></span></a>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profil</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Setting</a>
                    <a class="dropdown-item" onclick="return confirm('yakin Ingin Keluar??')" href="<?php echo base_url('c_tutorial/keluar') ?>"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </li>

        </ul>
    </nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#"><?php echo anchor($this->uri->segment(1), ucwords($title)); ?></a></li>
        <li class="breadcrumb-item active">Data</li>
    </ol>

    <div class="container">
        <h1 align="center">Kirim Pesan Kepada Pelanggan</h1><br>
        <div class="col-md-5" style="margin:0 auto;">
            <div class="well bs-component">
                <form action="<?php echo base_url('uadmin/pesan/sendmsg') ?>" method="post" class="form-horizontal">

                    <fieldset>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-3 control-label">No Telepon</label>
                            <div class="col-lg-12">
                                <input type="text" name="mobile" class="form-control" placeholder="Ex:Masukan No Tujuan">
                            </div>
                            <div class="col-md-12">
                                <?php echo form_error('mobile', '<span class="text-danger">', '</span>') ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-3 control-label">Pesan</label>
                            <div class="col-lg-12">
                                <textarea name="message" class="form-control" placeholder="Masukan Pesan Anda"></textarea>
                            </div>
                            <div class="col-md-12">
                                <?php echo form_error('message', '<span class="text-danger">', '</span>') ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="reset" class="btn btn-default">Batal</button>
                                <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> Kirim</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

    </div>

    <div id="AddModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                        <h1 style="margin-left: 150px;">Tambah Data</h1>
                    </div>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('c_mahasiswa/insertMahasiswa') ?>" method="post" />
                    <div class="form-group">
                        <label>Nim</label>
                        <input class="form-control" type="text" name="nim" placeholder="Masukkan nim anda" required="">
                    </div>
                    <div class="col-md-12">
                        <?php echo form_error('nim', '<span class="text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" type="text" name="nama" placeholder="Masukkan nama anda" required="">
                    </div>
                    <div class="col-md-12">
                        <?php echo form_error('nama', '<span class="text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" style="resize: none;"></textarea>
                    </div>
                    <div class="col-md-12">
                        <?php echo form_error('alamat', '<span class="text-danger">', '</span>') ?>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <?php echo form_error('status', '<span class="text-danger">', '</span>') ?>
                    </div>


                    <div class="form-group">
                        <input class="btn btn-default" type="button" value="Batal" data-dismiss="modal">
                        <input class="btn btn-primary" type="submit" name="" value="Simpan">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>