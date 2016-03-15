
  <?php
    class acaoModel extends Model{
        public $_tabela = "acao";
        public $_conexao = "2";

        public function listaacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdacao DESC' );
        }

        public function atualizaacao( $dados, $where ){
            return $this->update( $dados, 'cdacao='.$where );
        }

        public function insereacao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiacao( $id ){
            return $this->delete( $id );
        }

        public function pesquisaacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdacao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'acao', $op, $perfil );
        }

    }   