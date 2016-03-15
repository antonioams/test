
  <?php
    class unidadesModel extends Model{
        public $_tabela = "unidade";
        public $_conexao = "2";

        public function listaunidades( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdunidade DESC' );
        }

        public function atualizaunidades( $dados, $where ){
            return $this->update( $dados, 'cdunidade='.$where );
        }

        public function insereunidades( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiunidades( $id ){
            return $this->delete( $id );
        }

        public function pesquisaunidades( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdunidade DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'unidades', $op, $perfil );
        }

    }   