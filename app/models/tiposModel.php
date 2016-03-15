
  <?php
    class tiposModel extends Model{
        public $_tabela = "tipo";
        public $_conexao = "2";

        public function listatipos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdtipo DESC' );
        }

        public function atualizatipos( $dados, $where ){
            return $this->update( $dados, 'cdtipo='.$where );
        }

        public function inseretipos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluitipos( $id ){
            return $this->delete( $id );
        }

        public function pesquisatipos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdtipo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'tipos', $op, $perfil );
        }

    }   