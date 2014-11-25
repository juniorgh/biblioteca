<?php

class Application_Model_Livro
{
    public function find($id = null, $pager = false, array $where = null, array $order = null) {
        $livro = new Application_Model_DbTable_Livro();
        if (!is_null($id)) {
            return $livro->find($id)->current()->toArray();
        } else {
            $query = $livro->select();
            if (!is_null($where)) {
                foreach ($where as $cond) {
                    $query->where($cond);
                }
            }

            if (!is_null($order)) {
                $query->order($order);
            } else {
                $query->order('LivroTitulo');
            }

            if ($pager == false) {
                return $livro->fetchAll($query)->toArray();
            } else {
                return $query;
            }
        }
    }

    public function drop($id) {
        $livro = new Application_Model_DbTable_Livro();
        $where = $livro->getAdapter()->quoteInto("livroId = ?", $id);
        return $livro->delete($where);
    }

    public function save($data = array()) {
        $livro = new Application_Model_DbTable_Livro();
        return $livro->insert($data);
    }


    public static function update(array $data) {
        $livro = new Application_Model_DbTable_Livro();
        $where = $livro->getAdapter()->quoteInto('livroId = ?', $data['livroId']);
        unset($data['livroId']);
        return $livro->update($data, $where);
    }
}



