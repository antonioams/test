
  <?php
    class respostasModel extends Model{
        public $_tabela = "resposta";
        public $_conexao = "2";

        public function listarespostas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdresposta' );
        }

        public function atualizarespostas( $dados, $where ){
            return $this->update( $dados, 'cdresposta='.$where );
        }

        public function insererespostas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluirespostas( $id ){
            return $this->delete( $id );
        }

        public function pesquisarespostas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdresposta DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'respostas', $op, $perfil );
        }

    }   