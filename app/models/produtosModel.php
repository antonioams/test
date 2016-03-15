
  <?php
    class produtosModel extends Model{
        public $_tabela = "produto";
        public $_conexao = "2";

        public function listaprodutos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdproduto DESC' );
        }

        public function atualizaprodutos( $dados, $where ){
            return $this->update( $dados, 'cdproduto='.$where );
        }

        public function insereprodutos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprodutos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprodutos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdproduto DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'produtos', $op, $perfil );
        }

    }   