<?php

class Application_Model_Aluno
{
    public function find($id = null, $pager = false, array $where = null, array $order = null) {
        $aluno = new Application_Model_DbTable_Aluno();
        if (!is_null($id)) {
            return $aluno->find($id)->current()->toArray();
        } else {
            $query = $aluno->select();
            if (!is_null($where)) {
                foreach ($where as $cond) {
                    $query->where($cond);
                }
            }

            if (!is_null($order)) {
                $query->order($order);
            } else {
                $query->order('alunoNome');
            }

            if ($pager == false) {
                return $aluno->fetchAll($query)->toArray();
            } else {
                return $query;
            }
        }
    }

    /*
     * Método Delete da tabela curso
     */

    public function drop($id) {
        $aluno = new Application_Model_DbTable_Aluno();
        $where = $aluno->getAdapter()->quoteInto("alunoId = ?", $id);
        return $aluno->delete($where);
    }

    /*
     * Método Insert da tabela cursos
     */

    public function save($data = array()) {
        $aluno = new Application_Model_DbTable_Aluno();
        return $aluno->insert($data);
    }

    /*
     * Método Update da tabela cursos
     */

    public static function update(array $data) {
        $aluno = new Application_Model_DbTable_Aluno();
        $where = $aluno->getAdapter()->quoteInto('alunoId = ?', $data['alunoId']);
        unset($data['cursoId']);
        return $aluno->update($data, $where);
    }
}

