<?php

class HomeController extends Zend_Controller_Action {

    public function init() {

        if (Zend_Auth::getInstance()->getIdentity()) {
            $usuario = Zend_Auth::getInstance()->getIdentity();

            $this->view->assign('usuarioLogado', $usuario);
        }
    }

    public function indexAction() {
        
    }

}
