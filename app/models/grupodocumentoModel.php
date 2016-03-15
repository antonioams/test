
  <?php
    class grupodocumentoModel extends Model{
        public $_tabela = "grupodocumento";
        public $_conexao = "2";

        public function listagrupodocumento( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupodocumento' );
        }

        public function atualizagrupodocumento( $dados, $where ){
            return $this->update( $dados, 'cdgrupodocumento='.$where );
        }

        public function inseregrupodocumento( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigrupodocumento( $id ){
            return $this->delete( $id );
        }

        public function pesquisagrupodocumento( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupodocumento' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'grupodocumento', $op, $perfil );
        }

    }   