
  <?php
    class grupoperguntaModel extends Model{
        public $_tabela = "grupopergunta";
        public $_conexao = "2";

        public function listagrupopergunta( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupopergunta' );
        }

        public function atualizagrupopergunta( $dados, $where ){
            return $this->update( $dados, 'cdgrupopergunta='.$where );
        }

        public function inseregrupopergunta( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigrupopergunta( $id ){
            return $this->delete( $id );
        }

        public function pesquisagrupopergunta( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupopergunta' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'grupopergunta', $op, $perfil );
        }

    }   