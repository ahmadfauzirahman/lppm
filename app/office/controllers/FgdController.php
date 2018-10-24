<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 16-Oct-18
 * Time: 21:45
 */


namespace LPPMKP\Office\Controllers;


use LPPMKP\Office\Models\Pengajuansurat;

class FgdController extends ControllerBase
{
    public function formAction(){
        $this->view->halaman = 'Form Surat FGD';

        $tahunini = getdate();

        if ($this->request->isPost()) {

            $isi = null;

            $cek = Pengajuansurat::find([
                'conditions' => 'nip_pengaju like ' . $this->session->get('user')->nip,
                'conditions' => 'tahun like ' . $tahunini['year'],
            ]);

            if (count($cek) == null) {

                $isi = [
                       "izinpengabdian" => [],
                    "izinpenelitian" => [],
                    "fgd" => [
                        [
                            "FgdId" => 1,
                            "FgdNarNam" => $this->request->getPost('FgdNarNam'),
                            "FgdModNam" => $this->request->getPost('FgdModNam'),
                            "FgdJud" => $this->request->getPost('FgdJud'),
                            "FgdJen" => $this->request->getPost('FgdJen'),
                            "FgdLok" => $this->request->getPost('FgdLok'),
                            "FgdPesNam" => $this->request->getPost('FgdPesNam'),
                            "FgdTglPel" => $this->request->getPost('FgdTglPel'),
                            "FgdTglSratKel" => "",
                            "FgdTglAcc" => "",
                        ]
                        ],
                    "surattugas" => [],
                ];

                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju = $this->session->get('user')->nip;
                $pengajuan->tahun = date('y');
                $pengajuan->isi_surat = json_encode($isi);
                $pengajuan->save();
                if ($pengajuan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-fgd');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-fgd');

                }

            } else {

                $cek1 = Pengajuansurat::find([
                    'conditions' => 'nip_pengaju like ' . $this->session->get('user')->nip,
                    'conditions' => 'tahun like ' . $tahunini['year'],

                ]);

                $id_pengajuan = $cek1[0]->id_pengaju;

                //id baru


                $isilama = json_decode($cek1[0]->isi_surat);
                $idakhir = end($isilama->fgd);
                $idlama = $idakhir->FgdId;
                $idbaru = $idlama + 1;
                $isi = [
                    "FgdId" => $idbaru,
                    "FgdNarNam" => $this->request->getPost('FgdNarNam'),
                    "FgdModNam" => $this->request->getPost('FgdModNam'),
                    "FgdJud" => $this->request->getPost('FgdJud'),
                    "FgdJen" => $this->request->getPost('FgdJen'),
                    "FgdLok" => $this->request->getPost('FgdLok'),
                    "FgdPesNam" => $this->request->getPost('FgdPesNam'),
                    "FgdTglPel" => $this->request->getPost('FgdTglPel'),
                    "FgdTglSratKel" => "",
                    "FgdTglAcc" => "",
                ];


                array_push($isilama->fgd, $isi);


                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat = json_encode($isilama);
                $simpan->save();
                if ($simpan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-fgd');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-fgd');

                }

            }
        }

    }
}