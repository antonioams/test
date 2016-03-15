
  <?php
    class areasModel extends Model{
        public $_tabela = "area";
        public $_conexao = "2";

        public function listaareas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdarea DESC' );
        }

        public function atualizaareas( $dados, $where ){
            return $this->update( $dados, 'cdarea='.$where );
        }

        public function insereareas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiareas( $id ){
            return $this->delete( $id );
        }

        public function pesquisaareas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdarea DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'areas', $op, $perfil );
        }

    }   