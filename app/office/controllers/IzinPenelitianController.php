<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 10/15/2018
 * Time: 16:57
 */

namespace LPPMKP\Office\Controllers;


use LPPMKP\Office\Models\Pengajuansurat;

class IzinPenelitianController extends ControllerBase
{

    public function formAction(){
        $this->view->halaman = 'Form Surat Izin Penelitian';

        if ($this->request->isPost()) {
            $isi =null;
            $tahunini = getdate();

            $cek = Pengajuansurat::find([
                'conditions' =>  'nip_pengaju like '.$this->session->get('user')->nip,
                'conditions' =>  'tahun like '.$tahunini['year'],

            ]);

            if(count($cek)==null){
                $isi = [
                    "izinpengabdian" => [],
                    "izinpenelitian"=>[
                        [
                            "SitId"=> 1,
                            "SitEml"=> $this->request->getPost('SitEml'),
                            "SitKetNam"=> $this->request->getPost('SitKetNam'),
                            "SitAngNam"=> $this->request->getPost('SitAngNam'),
                            "SitJud"=> $this->request->getPost('SitJud'),
                            "SitTglKeg"=> $this->request->getPost('SitTglKeg'),
                            "SitLok"=> $this->request->getPost('SitLok'),
                            "SitInsTuj"=> $this->request->getPost('SitInsTuj'),
                            "SitKabKot"=> $this->request->getPost('SitKabKot'),
                            "SitNom" => $this->request->getPost('SitNom'),
                            "SitTglSratKel" => "",
                            "SitTglAcc"=> "",
                        ]
                    ],
                    "fgd"=>[],
                    "surattugas"=>[],
                ];
                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju=$this->session->get('user')->nip;
                $pengajuan->tahun=date('y');
                $pengajuan->isi_surat=json_encode($isi);
                $pengajuan->save();
                if ($pengajuan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');

                }


            }
            else {

                $cek1 = Pengajuansurat::find([
                    'conditions' =>  'nip_pengaju like '.$this->session->get('user')->nip,
                    'conditions' =>  'tahun like '.$tahunini['year'],

                ]);

                $id_pengajuan= $cek1[0]->id_pengaju;


                //id baru


                $isilama = json_decode($cek1[0]->isi_surat);
                $idakhir = end($isilama->izinpenelitian);
                $idlama = $idakhir->SitId;
                $idbaru = $idlama + 1;
                $isi = [
                    "SitId" => $idbaru,
                    "SitEml" => $this->request->getPost('SitEml'),
                    "SitKetNam" => $this->request->getPost('SitKetNam'),
                    "SitAngNam" => $this->request->getPost('SitAngNam'),
                    "SitJud" => $this->request->getPost('SitJud'),
                    "SitTglKeg" => $this->request->getPost('SitTglKeg'),
                    "SitLok" => $this->request->getPost('SitLok'),
                    "SitInsTuj" => $this->request->getPost('SitInsTuj'),
                    "SitKabKot" => $this->request->getPost('SitKabKot'),
                    "SitNom" => $this->request->getPost('SitNom'),
                    "SitTglSratKel" => "",
                    "SitTglAcc" => "",

                ];

                array_push($isilama->izinpenelitian, $isi);


                $simpan = Pengajuansurat::findFirst($id_pengajuan);
                $simpan->isi_surat = json_encode($isilama);
                $simpan->save();
                if ($simpan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-izinpenelitian');

                }

            }
        }
    }
}
