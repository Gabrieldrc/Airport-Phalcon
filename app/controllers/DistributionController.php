<?php

use Phalcon\Mvc\Controller;

class DistributionController extends Controller
{
    public function principalAction()
    {
        $this->view->render('page','principal');
        $this->view->finish();
        echo $this->view->getContent();
    }
}
