<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 16-Oct-18
 * Time: 20:41
 */
?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h2><?php $this->flashSession->output() ?></h2>

            <div class="panel panel-info">
                <div class="panel-heading">

                </div>
                <div class="panel-body">
                    <table id="datatable" class="table table-bordered">

                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Instansi</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $no = 1;
                        foreach ($data as $d):
                            ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td> <?= $d->SipJud ?></td>
                            <td> <?= $d->SipTglKeg ?></td>
                            <td> <?= $d->SipLok ?></td>
                            <td> <?= $d->SipInsTuj ?></td>

                            <?php
                            $no++;
                            ?>
                        </tr>
                            <?php
                            endforeach;
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div> <!-- end card-box -->
    </div><!-- end col -->
</div>
<!-- end row -->


