
  <?php
    class anosModel extends Model{
        public $_tabela = "ano";
        public $_conexao = "2";

        public function listaanos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'ano' );
        }

        public function atualizaanos( $dados, $where ){
            return $this->update( $dados, 'cdano='.$where );
        }

        public function insereanos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluianos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaanos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdano DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'anos', $op, $perfil );
        }

    }   