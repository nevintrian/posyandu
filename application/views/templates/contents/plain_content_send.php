<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-dark"><?php echo $block_header ?></h5>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-12">
                                <?php
                                echo $alert;
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <h5>
                                        <?php echo strtoupper($header) ?>
                                        <p class="text-secondary"><small><?php echo $sub_header ?></small></p>
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-2"></div>
                                        <div class="col-10">
                                            <div class="float-right">
                                                <?php echo (isset($header_button)) ? $header_button : '';  ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container"><br>
                            <div class="col-md-5" style="margin:0 ">
                                <div class="well bs-component">
                                    <form action="<?php echo base_url('uadmin/pesan/sendmsg') ?>" method="post" class="form-horizontal">

                                        <fieldset>
                                            <div class="form-group">
                                                <label for="inputEmail" class="col-lg-3 control-label">No Telepon</label>
                                                <div class="col-lg-12">
                                                    <input type="text" name="mobile" class="form-control" placeholder="Masukan No Tujuan">
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
                                    <br>
                                    <br>
                                </div>
                            </div>

                        </div>


                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>