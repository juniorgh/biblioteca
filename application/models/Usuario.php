<?php

class Application_Model_Usuario {

    public function find($id = null, $pager = false, array $where = null, array $order = null) {
        $usuario = new Application_Model_DbTable_Usuario();
        if (!is_null($id)) {
            return $usuario->fechAll->current()->toArray();
        } else {
            $query = $usuario->select();
            if (!is_null($where)) {
                foreach ($where as $cond) {
                    $query->where($cond);
                }
            }

            if (!is_null($order)) {
                $query->order($order);
            } else {
                $query->order('usuarioLogin');
            }

            if ($pager == false) {
                return $usuario->fetchAll($query)->toArray();
            } else {
                return $query;
            }
        }
    }

    /*
     * Método Delete da tabela curso
     */

    public function drop($id) {
        $usuario = new Application_Model_DbTable_Usuario();
        $where = $usuario->getAdapter()->quoteInto("usuarioId = ?", $id);
        return $usuario->delete($where);
    }

    /*
     * Método Insert da tabela cursos
     */

    public function save($data = array()) {
        $usuario = new Application_Model_DbTable_Usuario();
        return $usuario->insert($data);
    }

    /*
     * Método Update da tabela cursos
     */

    public static function update(array $data) {
        
        $usuario = new Application_Model_DbTable_Usuario();
        $where = $usuario->getAdapter()->quoteInto('usuarioId = ?', $data['usuarioId']);
        unset($data['usuarioId']);
        return $usuario->update($data, $where);
    }
    
    public static function md5($senha) {
        $usuario = new Application_Model_DbTable_Usuario();
        return new Zend_Db_Expr($usuario->getAdapter()->quoteInto('MD5(?)', $senha));
    }

}
