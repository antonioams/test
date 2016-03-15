
  <?php
    class aditivosModel extends Model{
        public $_tabela = "aditivo";
        public $_conexao = "2";

        public function listaaditivos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdaditivo DESC' );
        }

        public function atualizaaditivos( $dados, $where ){
            return $this->update( $dados, 'cdaditivo='.$where );
        }

        public function insereaditivos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiaditivos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaaditivos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdaditivo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'aditivos', $op, $perfil );
        }

    }   