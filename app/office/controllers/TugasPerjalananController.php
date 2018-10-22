<?php
/**
 * Created by PhpStorm.
 * User: jbenastey
 * Date: 16-Oct-18
 * Time: 21:45
 */


namespace LPPMKP\Office\Controllers;


use LPPMKP\Office\Models\Pengajuansurat;

class TugasPerjalananController extends ControllerBase
{
    public function formAction()
    {
        $this->view->halaman = 'Form Surat Tugas Perjalanan';

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
                    "fgd" => [],
                    "surattugas" => [
                        [
                            "StpId" => 1,
                            "StpKetNam" => $this->request->getPost('StpKetNam'),
                            "StpNipNik" => $this->request->getPost('StpNipNik'),
                            "StpPanGol" => $this->request->getPost('StpPanGol'),
                            "StpAngNam" => $this->request->getPost('StpAngNam'),
                            "StpJud" => $this->request->getPost('StpJud'),
                            "StpKlu" => $this->request->getPost('StpKlu'),
                            "StpTglBer" => $this->request->getPost('StpTglBer'),
                            "StpTglPul" => $this->request->getPost('StpTglPul'),
                            "StpLok" => $this->request->getPost('StpLok'),
                            "StpJen" => $this->request->getPost('StpJen'),
                            "StpNom" => $this->request->getPost('StpNom'),
                            "StpTglSratKel" => "",
                            "StpTglAcc" => "",
                        ]
                    ],
                ];
                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju = $this->session->get('user')->nip;
                $pengajuan->tahun = date('y');
                $pengajuan->isi_surat = json_encode($isi);
                $pengajuan->save();
                if ($pengajuan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');

                }

            } else {

                $cek1 = Pengajuansurat::find([
                    'conditions' => 'nip_pengaju like ' . $this->session->get('user')->nip,
                    'conditions' => 'tahun like ' . $tahunini['year'],

                ]);

                $id_pengajuan = $cek1[0]->id_pengaju;


                //id baru


                $isilama = json_decode($cek1[0]->isi_surat);
                $idakhir = end($isilama->surattugas);
                $idlama = $idakhir->StpId;
                $idbaru = $idlama + 1;
                $isi = [
                    "StpId" => $idbaru,
                    "StpKetNam" => $this->request->getPost('StpKetNam'),
                    "StpNipNik" => $this->request->getPost('StpNipNik'),
                    "StpPanGol" => $this->request->getPost('StpPanGol'),
                    "StpAngNam" => $this->request->getPost('StpAngNam'),
                    "StpJud" => $this->request->getPost('StpJud'),
                    "StpKlu" => $this->request->getPost('StpKlu'),
                    "StpTglBer" => $this->request->getPost('StpTglBer'),
                    "StpTglPul" => $this->request->getPost('StpTglPul'),
                    "StpLok" => $this->request->getPost('StpLok'),
                    "StpJen" => $this->request->getPost('StpJen'),
                    "StpNom" => $this->request->getPost('StpNom'),
                    "StpTglSratKel" => "",
                    "StpTglAcc" => "",

                ];

                array_push($isilama->surattugas, $isi);


                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat = json_encode($isilama);
                $simpan->save();
                if ($simpan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-tugasperjalanan');

                }

            }
        }
    }
}
