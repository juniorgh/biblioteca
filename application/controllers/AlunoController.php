<?php

class AlunoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        try {
            $aluno = new Application_Model_Aluno();

            $dadosAluno = $aluno->find();

            $this->view->assign('alunos', $dadosAluno);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function formAction() {
        $this->_helper->layout->disableLayout();
        
        $aluno = new Application_Model_DbTable_Aluno();

        if ($this->_request->getParam('id')) {
            $id = $this->_request->getParam('id');

            $dadosAlunoFiltrado = $aluno->find($id);
            $this->view->assign('alunoFiltrado', $dadosAlunoFiltrado);
        }
    }

    public function saveAction() {
        try {
            $aluno = new Application_Model_Aluno();
            $request = $this->getRequest();
            if ($request->isPost()) {
                $params = $request->getPost();

                if (!array_key_exists('alunoId', $params)) {
                    $aluno->save($params);
                } else {
                    $aluno->update($params);
                }
            }
            $this->_redirect('aluno');
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    function dropAction() {
        $aluno = new Application_Model_Aluno();
        $id = $this->_request->getParam('id');
        $aluno->drop($id);
        $this->_redirect('aluno');
    }

}
