
  <?php
    class regioesModel extends Model{
        public $_tabela = "regiao";
        public $_conexao = "2";

        public function listaregioes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdregiao DESC' );
        }

        public function atualizaregioes( $dados, $where ){
            return $this->update( $dados, 'cdregiao='.$where );
        }

        public function insereregioes( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiregioes( $id ){
            return $this->delete( $id );
        }

        public function pesquisaregioes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdregiao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'regioes', $op, $perfil );
        }

    }   