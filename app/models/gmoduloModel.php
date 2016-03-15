
  <?php
    class gmoduloModel extends Model{
        public $_tabela = "modulo";
        public $_conexao = "1";

        public function listagmodulo( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmodulo DESC' );
        }

        public function atualizagmodulo( $dados, $where ){
            return $this->update( $dados, 'cdmodulo='.$where );
        }

        public function inseregmodulo( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigmodulo( $id ){
            return $this->delete( $id );
        }

        public function pesquisagmodulo( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmodulo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'gmodulo', $op, $perfil );
        }

    }   