
  <?php
    class cronogramaModel extends Model{
        public $_tabela = "cronograma";
        public $_conexao = "2";

        public function listacronograma( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcronograma DESC' );
        }

        public function atualizacronograma( $dados, $where ){
            return $this->update( $dados, 'cdcronograma='.$where );
        }

        public function inserecronograma( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluicronograma( $id ){
            return $this->delete( $id );
        }

        public function pesquisacronograma( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcronograma DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'cronograma', $op, $perfil );
        }

    }   