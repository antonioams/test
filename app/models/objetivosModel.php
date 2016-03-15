
  <?php
    class objetivosModel extends Model{
        public $_tabela = "objetivo";
        public $_conexao = "2";

        public function listaobjetivos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdobjetivo DESC' );
        }

        public function atualizaobjetivos( $dados, $where ){
            return $this->update( $dados, 'cdobjetivo='.$where );
        }

        public function insereobjetivos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiobjetivos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaobjetivos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdobjetivo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'objetivos', $op, $perfil );
        }

    }   