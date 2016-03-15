
  <?php
    class movimentacaoModel extends Model{
        public $_tabela = "movimentacao";
        public $_conexao = "2";

        public function listamovimentacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmovimentacao DESC' );
        }

        public function atualizamovimentacao( $dados, $where ){
            return $this->update( $dados, 'cdmovimentacao='.$where );
        }

        public function inseremovimentacao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluimovimentacao( $id ){
            return $this->delete( $id );
        }

        public function pesquisamovimentacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmovimentacao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'movimentacao', $op, $perfil );
        }

    }   