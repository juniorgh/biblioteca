<?php

class UsuarioController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $usuario = new Application_Model_Usuario();
        $dadosUsuario = $usuario->find();
        $this->view->assign('usuarios', $dadosUsuario);
    }

    public function formAction() {
        try {
            $usuario = new Application_Model_DbTable_Usuario();

            $this->_helper->layout->disableLayout();

            if ($this->_request->getParam('id')) {
                $id = $this->_request->getParam('id');

                $dadosUsuarioFiltrado = $usuario->find($id);

                $this->view->assign('id', $id);
                $this->view->assign('usuarioFiltrado', $dadosUsuarioFiltrado);
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function saveAction() {

        $usuario = new Application_Model_Usuario();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $params = $request->getPost();

            if (!array_key_exists('usuarioId', $params)) {
                $usuario->save($params);
            } else {
                
                if (empty($params['usuarioSenha'])) {
                    unset($params['usuarioSenha']);
                } else {

                    $senha = $params['usuarioSenha'];

                    $cripto = $usuario->md5($senha);
                    unset($params['usuarioSenha']);

                    $params['usuarioSenha'] = $cripto;

                    if (empty($params['usuarioLogin'])) {
                        unset($params['usuarioLogin']);
                    }
                    if (empty($params['usuarioNome'])) {
                        unset($params['usuarioNome']);
                    }
                    
                    $usuario->update($params);
                }
            }
        }
        $this->_redirect('usuario');
    }

    public function dropAction() {
        $usuario = new Application_Model_Usuario();
        $id = $this->_request->getParam('id');
        $usuario->drop($id);

        $this->_redirect('usuario');
    }

}
