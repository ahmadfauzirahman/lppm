<?php
/**
 * Created by PhpStorm.
 * User: ahmadfauzirahman
 * Date: 02/06/18
 * Time: 5:36
 */

?>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h2><?php $this->flashSession->output() ?></h2>
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-20">
                    <form class="form-horizontal" method="post" action="" role="form" name="add_name" id="add_name">
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nama Dosen" class="form-control" name="SitEml" value="<?= $this->session->get('user')->email?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-2 col-form-label">Nama Ketua Tim Penelitian</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nama Dosen" class="form-control" name="SitKetNam" value="<?= $this->session->get('user')->nama?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" >Nama Anggota Penelitian</label>
                            <div class="col-md-10">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <td><input type="text" placeholder="Nama Anggota" class="form-control" name="SitAngNam[]" value=""></td>
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" >Judul Kegiatan Penelitian</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="SitJud" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label" >Tanggal Kegiatan Penelitian</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="SitTglKeg"id="datepicker-autoclose">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ti-calendar"></i></span>
                                    </div>
                                </div><!-- input-group -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Lokasi Kegiatan Penelitian</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="" class="form-control" name="SitLok" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label" >Instansi/Unit surat yg dituju</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Kepala Sekolah MTsN/ Kepala Desa Belutu" class="form-control" name="SitInsTuj" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Kabupaten/Kota</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Kota Pekanbaru/Kabupaten Kampar" class="form-control" name="SitKabKot" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Nomor WhatsApp</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nomor WhatsApp" class="form-control" name="SitNom" value="">
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
