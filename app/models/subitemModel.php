
  <?php
    class subitemModel extends Model{
        public $_tabela = "contrato_item";
        public $_conexao = "2";

        public function listasubitem( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato_item DESC' );
        }

        public function atualizasubitem( $dados, $where ){
            return $this->update( $dados, 'cdcontrato_item='.$where );
        }

        public function inseresubitem( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluisubitem( $id ){
            return $this->delete( $id );
        }

        public function pesquisasubitem( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato_item DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'subitem', $op, $perfil );
        }

    }   