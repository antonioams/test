
  <?php
    class historicoModel extends Model{
        public $_tabela = "historico";
        public $_conexao = "2";

        public function listahistorico( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdhistorico DESC' );
        }

        public function atualizahistorico( $dados, $where ){
            return $this->update( $dados, 'cdhistorico='.$where );
        }

        public function inserehistorico( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluihistorico( $id ){
            return $this->delete( $id );
        }

        public function pesquisahistorico( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdhistorico DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'historico', $op, $perfil );
        }

    }   