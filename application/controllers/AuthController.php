<?php

class AuthController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {

        /*
         * Desabilita o layout principal, para que, a view Index, dessa controladora,
         * não seja reenderizada no template principal 
         */

        $this->_helper->layout->disableLayout();
    }

    public function loginAction() {
        try {
            /* metodo de autenticação padrão do Zend Framework */

            $this->_helper->viewRenderer->setNoRender(true);

            /*
             * Objeto da classe Zend_Auth_Adapter_DbTable
             */
            $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
                
            /*
             * Seta o nome da tabela que está os dados à serem autenticados, por nome da tabela, e nome das colunas
             */
            
            
            
            $authAdapter->setTableName('usuario')
                    ->setIdentityColumn('usuarioLogin')
                    ->setCredentialColumn('usuarioSenha');
            
            
            
            /*
             * recupera os parametros de autenticidade do formulario
             */
            $authAdapter->setIdentity($this->_getParam('usuarioLogin'))
                    ->setCredential($this->_getParam('usuarioSenha'))
                    ->setCredentialTreatment('MD5(?)');

            /*
             * Compara os dados, autentica, valida e manda pra sessão
             */

            $result = $authAdapter->authenticate();
            if ($result->isValid()) {
                $usuario = $authAdapter->getResultRowObject();
                $storage = Zend_Auth::getInstance()->getStorage();
                $storage->write($usuario);
                $this->_redirect('home');
            } else {
                $this->_redirect('index');
            }
        } catch (Exception $e) {
            $this->_redirect('index');
        }
    }

    public function logoutAction() {
        //Limpa dados da Sessão
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('index');
    }

}
