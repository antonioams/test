
  <?php
    class chatModel extends Model{
        public $_tabela = "chat";
        public $_conexao = "2";

        public function listachat( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function atualizachat( $dados, $where ){
            return $this->update( $dados, '='.$where );
        }

        public function inserechat( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluichat( $id ){
            return $this->delete( $id );
        }

        public function pesquisachat( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'chat', $op, $perfil );
        }

    }   