<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 16-Oct-18
 * Time: 21:46
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
                                <label class="col-2 col-form-label">Nama Ketua Tim Peneliti/Pengabdi</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Dosen" class="form-control" name="SipKetNam" value="<?= $this->session->get('user')->nama?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">NIP/NIP (Ketua)</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Nama Dosen" class="form-control" name="SipKetNam" value="<?= $this->session->get('user')->nip?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-2 col-form-label">Pangkat/Golongan/Jabatan (Ketua)</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Pangkat/Golongan/Jabatan (Ketua)" class="form-control" name="SipKetNam">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Nama Anggota Pengabdi</label>
                                <div class="col-md-10">
                                    <table class="table table-bordered" id="dynamic_field3">
                                        <tr>
                                            <td><input type="text" placeholder="Nama Anggota" class="form-control" name="SipAngNam[]" value="">
                                                <input type="text" placeholder="NIP/NIK Anggota" class="form-control" name="SipAngNam[]" value="">
                                                <input type="text" placeholder="Pangkat/Golongan/Jabatan Anggota" class="form-control" name="SipAngNam[]" value="">
                                            </td>
                                            <td><button type="button" name="add3" id="add3" class="btn btn-success">Add More</button></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Judul Kegiatan Penelitian/Pengabdian Sesuai SK</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="SipJud" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Kluster Kegiatan Penelitian/Pengabdian Sesuai SK</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="Sesuai SK Rektor" class="form-control" name="SipJud" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Tanggal Berangkat</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="SipTglKeg"id="datepicker-autoclose">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Tanggal Pulang</label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="SipTglKeg"id="datepicker-autoclose">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="ti-calendar"></i></span>
                                        </div>
                                    </div><!-- input-group -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label">Lokasi Kegiatan Penelitian/Pengabdian</label>
                                <div class="col-md-10">
                                    <input type="text" placeholder="" class="form-control" name="SipLok" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Jenis Kegiatan</label>
                                <div class="col-md-10">
                                    <select class="form-control">
                                        <option value="penelitian">Penelitian</option>
                                        <option value="pengabdian">Pengabdian</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 control-label" >Nomor HP</label>
                                <div class="col-md-10">
                                    <input type="number" placeholder="Nomor HP" class="form-control" name="SipInsTuj" value="">
                                </div>
                            </div>


                            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

