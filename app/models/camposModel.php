
  <?php
    class camposModel extends Model{
        public $_tabela = "campo";
        public $_conexao = "2";

        public function listacampos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcampo DESC' );
        }

        public function atualizacampos( $dados, $where ){
            return $this->update( $dados, 'cdcampo='.$where );
        }

        public function inserecampos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluicampos( $id ){
            return $this->delete( $id );
        }

        public function pesquisacampos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcampo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'campos', $op, $perfil );
        }

    }   