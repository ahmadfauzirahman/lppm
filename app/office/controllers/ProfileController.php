<?php
namespace LPPMKP\Office\Controllers;
use LPPMKP\Lppm\Models\Pengguna;

class ProfileController extends ControllerBase
{

    public function profileAction()
    {
        $halaman = 'Profile';
        $this->view->halaman = $halaman;
        if ($this->request->isPost()) {
            $id = $this->request->getPost('nip');
            $user = Pengguna::findFirstByNip($id);
            $foto = $this->request->getUploadedFiles()[0];
            $name = $foto->getName();
            $pindahkan = $foto->moveTo('img/foto_user/' . $name);
            if (empty($this->request->getPost('password'))) {
                $user->nama = $this->request->getPost('nama');
                $user->email = $this->request->getPost('email');
                $user->id_telegram = $this->request->getPost('id_telegram');
                $user->foto = $name;
                echo 'hai';
            } else {
                $user->nama = $this->request->getPost('nama');
                $user->email = $this->request->getPost('email');
                $user->id_telegram = $this->request->getPost('id_telegram');
                $user->password = md5($this->request->getPost('password'));
                $user->foto = $name;
                echo 'halo';
            }
            if ($pindahkan == true && $user->save()) {
                $this->flashSession->success('Berhasil Mengubah Data');
            } else {
                $this->flashSession->error('Gagal');
            }
            $this->response->redirect('office/profile');
        }
    }

}

