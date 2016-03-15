
  <?php
    class projeto_produtoModel extends Model{
        public $_tabela = "projeto_produto";
        public $_conexao = "2";

        public function listaprojeto_produto( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto_produto DESC' );
        }

        public function atualizaprojeto_produto( $dados, $where ){
            return $this->update( $dados, 'cdprojeto_produto='.$where );
        }

        public function insereprojeto_produto( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprojeto_produto( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprojeto_produto( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto_produto DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'projeto_produto', $op, $perfil );
        }

    }   