<?php

class Application_Model_Emprestimo {
    
    public function find($id = null, $pager = false, array $where = null, array $order = null) {
        $emprestimo = new Application_Model_DbTable_Emprestimo();
        if (!is_null($id)) {
            return $emprestimo->find($id)->current()->toArray();
        } else {
            $query = $emprestimo->select();
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
   
    public function emprestimoAluno($id = null) {
        $emprestimoAluno = new Application_Model_DbTable_Emprestimo($id);
        $query = $emprestimoAluno->select()
                ->setIntegrityCheck(false)
                ->from(array('e' => 'emprestimo'))
                ->join(array('a' => 'aluno'), 'e.emprestimoAlunoId = a.alunoId')
                ->join(array('l' => 'livro'), 'l.livroId = e.emprestimoLivroId');
        return $emprestimoAluno->fetchAll($query);
    }
    
    public function drop($id) {
        $emprestimo = new Application_Model_DbTable_Emprestimo();
        $where = $emprestimo->getAdapter()->quoteInto("emprestimoId = ?", $id);
        return $emprestimo->delete($where);
    }

    public function save($data = array()) {
        $emprestimo = new Application_Model_DbTable_Emprestimo();
        return $emprestimo->insert($data);
    }


    public static function update(array $data) {
        $emprestimo = new Application_Model_DbTable_Emprestimo();
        $where = $emprestimo->getAdapter()->quoteInto('emprestimoId = ?', $data['emprestimoId']);
        unset($data['livroId']);
        unset($data['emprestimoId']);
        return $emprestimo->update($data, $where);
    }

}
