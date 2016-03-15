
  <?php
    class fornecedoresModel extends Model{
        public $_tabela = "fornecedor";
        public $_conexao = "2";

        public function listafornecedores( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfornecedor DESC' );
        }

        public function atualizafornecedores( $dados, $where ){
            return $this->update( $dados, 'cdfornecedor='.$where );
        }

        public function inserefornecedores( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluifornecedores( $id ){
            return $this->delete( $id );
        }

        public function pesquisafornecedores( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfornecedor DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'fornecedores', $op, $perfil );
        }

    }   