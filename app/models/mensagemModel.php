
  <?php
    class mensagemModel extends Model{
        public $_tabela = "chatmensagem";
        public $_conexao = "2";

        public function listamensagem( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function atualizamensagem( $dados, $where ){
            return $this->update( $dados, '='.$where );
        }

        public function inseremensagem( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluimensagem( $id ){
            return $this->delete( $id );
        }

        public function pesquisamensagem( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'mensagem', $op, $perfil );
        }

    }   