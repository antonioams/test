
  <?php
    class objetivo_produtoModel extends Model{
        public $_tabela = "objetivo_produto";
        public $_conexao = "2";

        public function listaobjetivo_produto( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdobjetivo_produto DESC' );
        }

        public function atualizaobjetivo_produto( $dados, $where ){
            return $this->update( $dados, 'cdobjetivo_produto='.$where );
        }

        public function insereobjetivo_produto( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiobjetivo_produto( $id ){
            return $this->delete( $id );
        }

        public function pesquisaobjetivo_produto( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdobjetivo_produto DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'objetivo_produto', $op, $perfil );
        }

    }   