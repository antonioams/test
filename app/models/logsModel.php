
  <?php
    class logsModel extends Model{
        public $_tabela = "log";
        public $_conexao = "1";

        public function listalogs( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdlog DESC' );
        }

        public function atualizalogs( $dados, $where ){
            return $this->update( $dados, 'cdlog='.$where );
        }

        public function inserelogs( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluilogs( $id ){
            return $this->delete( $id );
        }

        public function pesquisalogs( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdlog DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'logs', $op, $perfil );
        }

    }   