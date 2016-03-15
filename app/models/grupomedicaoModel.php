
  <?php
    class grupomedicaoModel extends Model{
        public $_tabela = "grupomedicao";
        public $_conexao = "2";

        public function listagrupomedicao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupomedicao DESC' );
        }

        public function atualizagrupomedicao( $dados, $where ){
            return $this->update( $dados, 'cdgrupomedicao='.$where );
        }

        public function inseregrupomedicao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigrupomedicao( $id ){
            return $this->delete( $id );
        }

        public function pesquisagrupomedicao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupomedicao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'grupomedicao', $op, $perfil );
        }

    }   