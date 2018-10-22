<?php

use Phalcon\Mvc\Router\Group as RouterGroup;

class Lppm extends RouterGroup
{
    public function initialize()
    {
        // Default paths
        $this->setPaths(
            [
                'module' => 'lppm',
                'namespace' => 'LPPMKP\Lppm\Controllers',
            ]
        );

        $this->setPrefix('');
        $this->add('/', 'index::index');


        //$this->addGet('/keluar', 'auth::logout');
        $this->add('/daftar', 'auth::daftar');


        $this->add('/lupa', 'auth::lupa');

        $this->add('/auth/loginproses', 'auth::loginproses');
        $this->add('/konfirmasi/{id}', 'auth::konfirmasi');
    }

}


class Office extends RouterGroup
{
    public function initialize()
    {
        // Default paths
        $this->setPaths(
            [
                'module' => 'office',
                'namespace' => 'LPPMKP\Office\Controllers',
            ]
        );

        // All the routes start with /blog
        $this->setPrefix('/office');

        $this->add('/', ['controller' => 'index', 'action' => 'index']);
//        $this->add('/errors/show404', 'error::show404');

        $this->add('/:params', [
                'controller' => 'index',
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:params', [
                'controller' => 1,
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:action/:params', [
                'controller' => 1,
                'action' => 2,
                'params' => 3,
            ]
        );

        $this->addGet('/masuk', 'auth::login');
        $this->addGet('/keluar', 'auth::logout');
        //$this->addGet('/daftarakun', 'auth::daftar');


        $this->add('/index-izinpengabdian','izin_pengabdian::index');

        $this->add('/pengajuan', 'pengajuan::pengajuan');
        $this->add('/profile', 'profile::profile');
        $this->add('/form-izinpengabdian', 'izin_pengabdian::form');
        $this->add('/form-tugasperjalanan', 'tugas_perjalanan::form');

        $this->add('/form-izinpenelitian', 'izin_penelitian::form');
        $this->add('/form-fgd', 'fgd::form');



       
    }
}

class Monitoring extends RouterGroup
{
    public function initialize($di)
    {
        // Default paths
        $this->setPaths(
            [
                'module' => 'monitoring',
                'namespace' => 'LPPMKP\Monitoring\Controllers',
            ]
        );

        // All the routes start with /blog
        $this->setPrefix('/monitoring');

        $this->add('/', ['controller' => 'index', 'action' => 'index']);

        $this->add('/:params', [
                'controller' => 'index',
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:params', [
                'controller' => 1,
                'action' => 'index',
                'params' => 3,
            ]
        );
        $this->add('/:controller/:action/:params', [
                'controller' => 1,
                'action' => 2,
                'params' => 3,
            ]
        );

        $this->addGet('/masuk', 'auth::login');
        $this->addGet('/keluar', 'auth::logout');

    }
}

$router = $di->getRouter();


$router->mount(
    new Lppm()
);
$router->mount(
    new Office()
);

$router->mount(
    new Monitoring()
);

// Define your routes here

$router->handle();
