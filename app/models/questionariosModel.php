
  <?php
    class questionariosModel extends Model{
        public $_tabela = "questionario";
        public $_conexao = "2";

        public function listaquestionarios( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquestionario DESC' );
        }

        public function atualizaquestionarios( $dados, $where ){
            return $this->update( $dados, 'cdquestionario='.$where );
        }

        public function inserequestionarios( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiquestionarios( $id ){
            return $this->delete( $id );
        }

        public function pesquisaquestionarios( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquestionario DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'questionarios', $op, $perfil );
        }

    }   