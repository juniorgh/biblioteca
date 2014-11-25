<?php

class LivroController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        try {
            $livro = new Application_Model_Livro();
            $dadosLivro = $livro->find();
            $this->view->assign('livros', $dadosLivro);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function saveAction() {
        try {
            $livro = new Application_Model_Livro();
            $request = $this->getRequest();
            if ($request->isPost()) {
                $params = $request->getPost();
                
                if (!array_key_exists('livroId', $params)) {
                    
                    $livro->save($params);
                } else {
                    
                    $livro->update($params);
                }
            }
            $this->_redirect('livro');
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function formAction() {
        $this->_helper->layout->disableLayout();

        $livro = new Application_Model_DbTable_Livro();

        if ($this->_request->getParam('id')) {
            $id = $this->_request->getParam('id');

            $dadosLivroFiltrado = $livro->find($id);
            $this->view->assign('livroFiltrado', $dadosLivroFiltrado);
        }
    }

    public function dropAction() {
        $livro = new Application_Model_Livro();
        $id = $this->_request->getParam('id');
        $livro->drop($id);
        $this->_redirect('livro');
    }
}
