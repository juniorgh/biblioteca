<?php

class EmprestimoController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        try {
            $emprestimo = new Application_Model_Emprestimo();

            $dados = $emprestimo->emprestimoAluno();

            $this->view->assign('emprestimos', $dados);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function formAction() {
        $this->_helper->layout->disableLayout();
        try {

            $alunos = new Application_Model_Aluno();
            $livro = new Application_Model_Livro();

            $alunosAll = $alunos->find();
            $livrosAll = $livro->find();

            if ($this->_request->getParam('id')) {
                $id = $this->_request->getParam('id');
                $emprestimo = new Application_Model_Emprestimo();
                $emprestimoAlunoFiltrado = $emprestimo->find($id);

                $this->view->assign('emprestimosFiltrado', $emprestimoAlunoFiltrado);
            }
            $this->view->assign('alunosAll', $alunosAll);
            $this->view->assign('livrosAll', $livrosAll);
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function saveAction() {
        try {
            $emprestimo = new Application_Model_Emprestimo();
            $request = $this->getRequest();
            if ($request->isPost()) {
                $params = $request->getPost();

                if (!array_key_exists('emprestimoId', $params)) {
                    $emprestimo->save($params);
                } else {
                    $emprestimo->update($params);
                }
            }
            $this->_redirect('emprestimo');
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function dropAction() {
        $emprestimo = new Application_Model_Emprestimo();
        $id = $this->_request->getParam('id');
        $emprestimo->drop($id);
        $this->_redirect('emprestimo');
    }

}
