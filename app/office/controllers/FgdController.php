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
    }
}