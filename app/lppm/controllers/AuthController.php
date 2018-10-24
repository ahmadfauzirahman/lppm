<?php
/**
 * Created by PhpStorm.
 * User: SarliZona
 * Date: 9/27/2018
 * Time: 15:20
 */

namespace LPPMKP\Lppm\Controllers;

use LPPMKP\Lppm\Models\Pengguna;
use LPPMKP\Forms\Registrasi;

class AuthController extends ControllerBase
{

    public function initialize()
    {
        $ses_nip_nik= $this->session->get('nip');
        if (!empty($ses_nip_nik)) {
            $this->response->redirect('');
        }
    }

    public function loginAction()
    {

    }

    public function loginprosesAction()
    {

        $nip_nik = $this->request->getPost('nipNik');
        $password = $this->request->getPost('password');
        $password = md5($password);
        $pengguna = Pengguna::findFirstByNip($nip_nik);


        if ($pengguna) {

            if ($pengguna->konfirmasi_email == 'N') {
                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $this->flashSession->error('Harap konfirmasi email terlebih dahulu');
                    $this->response->redirect('monitoring');
                } else{
                    $this->flashSession->error('Harap konfirmasi email terlebih dahulu');
                    $this->response->redirect('office');
                }
            }
            elseif ($nip_nik == $pengguna->nip && $password == $pengguna->password) {
                $this->session->set('id_pengguna', $pengguna->id_pengguna);
                $this->session->set('nip', $pengguna->nip);
                $this->session->set('hak_akses', $pengguna->hak_akses);
                $this->session->set('foto', $pengguna->foto);
                $this->session->set('nama', $pengguna->nama);
                $this->session->set('email', $pengguna->email);
                //TODO tambahan redirect sesuai asal login dan tambahan simpan session login

                $this->session->set('user', $pengguna);

                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $this->response->redirect('monitoring');
                } else{
                    $this->response->redirect('office');
                }
            }
            elseif ($nip_nik != $pengguna->nip || $password != $pengguna->password) {
                if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                    $this->flashSession->error('Username Password Tidak Benar');
                    $this->response->redirect('monitoring');
                } else{
                    $this->flashSession->error('Username Password Tidak Benar');
                    $this->response->redirect('office');
                }
            }
        }

        else {
            if (!empty($this->request->getPost('from_monitoring')) == 'from_monitoring') {
                $this->flashSession->error('Username Atau Password Tidak Ada');
                $this->response->redirect('monitoring');
            } else{
                $this->flashSession->error('Username Atau Password Tidak Ada');
                $this->response->redirect('office');
            }
        }

    }

    public function konfirmasiAction($id)
    {
        $pengguna = Pengguna::findFirstByNip($id);
        $pengguna->konfirmasi_email = 'Y';
        $pengguna->save();
        $this->flashSession->success('Selamat Email Anda Sudah Dikonfirmasi Silahkan Lakukan Login');
        $this->response->redirect('');

    }

    /**
     *
     */
    public function daftarAction()
    {
        $form = new Registrasi(null);
  //  $this->view->title = 'Daftar';
        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {

               // $user = new Pengguna();
                $body = $this->config->web . "konfirmasi/" . $this->request->getPost('nip_nim');
                $email = $this->request->getPost('email');
                $user = new Pengguna(
                    [
                        'nama'=> $this->request->getPost('nama'),
                        'nip' => $this->request->getPost('nip'),
                        'password' => md5($this->request->getPost('password')),
                        'email' => $this->request->getPost('email'),
                        'hak_akses' => 'dosen',
                        'foto' => 'no-image.jpg',
                        'konfirmasi_email' => 'N',
                        ]);

                    if (!$user->save()) {
                        $this->view->disable();
                        $this->flashSession->error('Gagal Menyimpan Data');
                        $this->response->redirect('/daftar');
                    } else {

                        $this->view->disable();
                        $this->flashSession->success('Berhasil Menyimpan Data');
                        $this->response->redirect('');
                    }

                    $this->flashSession->error($user->getMessages());
                }
        }

        $this->view->form = $form;
    }

    public function lupaAction()
    {
        if ($this->request->isPost()) {
        $body = $this->config->web . "reset/" . $this->request->getPost('nip');
        $email = $this->request->getPost('email');
        $pengguna = Pengguna::findFirstByEmail($email);
        $mail = new Mail();
        $mail->send(
            $this->config->smtp,
            $this->config->user,
            $message = [
                'to' => $email,
                'subject' => 'Konfirmasi Email',
                'body' => '
                            <p>Assalamu\'alaikum</p>
                             <br>
                             <a href="' . $body . '">Reset Email Anda Berhasil,</a>
                             
                            <p>Reset Password Berhasil Dilakukan, Password Adalah Default dengan nim 
                            anda </p>
                            '
            ]
        );

        $this->flashSession->success("Cek Email Anda Untuk Melakukan Reset Password");
        $this->response->redirect('');

        \Phalcon\Tag::resetInput();
    }
    }


}