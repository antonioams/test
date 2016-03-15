
  <?php
    class grupochatModel extends Model{
        public $_tabela = "chatgrupo";
        public $_conexao = "1";

        public function listagrupochat( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function atualizagrupochat( $dados, $where ){
            return $this->update( $dados, '='.$where );
        }

        public function inseregrupochat( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigrupochat( $id ){
            return $this->delete( $id );
        }

        public function pesquisagrupochat( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'grupochat', $op, $perfil );
        }

    }   