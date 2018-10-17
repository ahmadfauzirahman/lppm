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
                    "izinpengabdian" => [
                        "SipId"=> 1,
                        "SipKetNam"=> $this->request->getPost('SipKetNam'),
                        "SipAngNam"=> $this->request->getPost('SipAngNam'),
                        "SipJud"=> $this->request->getPost('SipJud'),
                        "SipTglKeg"=> $this->request->getPost('SipTglKeg'),
                        "SipLok"=> $this->request->getPost('SipLok'),
                        "SipInsTuj"=> $this->request->getPost('SipInsTuj'),
                        "SipKabKot"=> $this->request->getPost('SipKabKot'),
                        "SipTglSratKel" => "",
                        "SipTglAcc"=> "",
                    ],
                    "izinpenelitian"=>[],
                    "FGD"=>[],
                    "surattugas"=>[],
                ];
                $pengajuan = new Pengajuansurat();
                $pengajuan->nip_pengaju=$this->session->get('user')->nip;
                $pengajuan->tahun=date('y');
                $pengajuan->isi_surat=json_encode($isi);
                $pengajuan->save();
                if ($pengajuan) {
                    $this->flashSession->success('Berhasil Menyimpan Data');

                    $this->response->redirect('office/form-izinpengabdian');
                } else {

                    $this->flashSession->error('Gagal Menyimpan Data');

                    $this->response->redirect('office/form-izinpengabdian');

                }


            }
            //id baru
            $id_pengajuan= $cek[0]->id_pengaju;

            $isilama = json_decode($cek[0]->isi_surat);
            $idakhir = end($isilama->izinpengabdian);
            $idlama = $idakhir->SipId;
            $idbaru= $idlama+1;
            $isi = [
                "SipId"=> $idbaru,
                "SipKetNam"=> $this->request->getPost('SipKetNam'),
                "SipAngNam"=> $this->request->getPost('SipAngNam'),
                "SipJud"=> $this->request->getPost('SipJud'),
                "SipTglKeg"=> $this->request->getPost('SipTglKeg'),
                "SipLok"=> $this->request->getPost('SipLok'),
                "SipInsTuj"=> $this->request->getPost('SipInsTuj'),
                "SipKabKot"=> $this->request->getPost('SipKabKot'),
                "SipTglSratKel" => "",
                "SipTglAcc"=> "",

            ];
            //id baru
            $isilama = json_decode($cek[0]->isi_surat);
            $idakhir = end($isilama->izinpengabdian);
            $idlama = $idakhir->SipId;
            $idbaru= $idlama+1;
            $isi = [
                "SipId"=> $idbaru,
                "SipKetNam"=> $this->request->getPost('SipKetNam'),
                "SipAngNam"=> $this->request->getPost('SipAngNam'),
                "SipJud"=> $this->request->getPost('SipJud'),
                "SipTglKeg"=> $this->request->getPost('SipTglKeg'),
                "SipLok"=> $this->request->getPost('SipLok'),
                "SipInsTuj"=> $this->request->getPost('SipInsTuj'),
                "SipKabKot"=> $this->request->getPost('SipKabKot'),
                "SipTglSratKel" => "",
                "SipTglAcc"=> "",

            ];
            array_push($isilama->izinpengabdian,$isi);


            $simpan = Pengajuansurat::findFirst($id_pengajuan);
            $simpan->isi_surat=json_encode($isilama);
            $simpan->save();
            if ($simpan) {
                $this->flashSession->success('Berhasil Menyimpan Data');

                $this->response->redirect('office/form-izinpengabdian');
            } else {

                $this->flashSession->error('Gagal Menyimpan Data');

                $this->response->redirect('office/form-izinpengabdian');

            }

        }
    }
}