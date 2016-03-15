
  <?php
    class fontesModel extends Model{
        public $_tabela = "fonte";
        public $_conexao = "2";

        public function listafontes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfonte DESC' );
        }

        public function atualizafontes( $dados, $where ){
            return $this->update( $dados, 'cdfonte='.$where );
        }

        public function inserefontes( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluifontes( $id ){
            return $this->delete( $id );
        }

        public function pesquisafontes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfonte DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'fontes', $op, $perfil );
        }

    }   