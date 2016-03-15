
  <?php
    class situacaoModel extends Model{
        public $_tabela = "situacao";
        public $_conexao = "2";

        public function listasituacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdsituacao DESC' );
        }

        public function atualizasituacao( $dados, $where ){
            return $this->update( $dados, 'cdsituacao='.$where );
        }

        public function inseresituacao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluisituacao( $id ){
            return $this->delete( $id );
        }

        public function pesquisasituacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdsituacao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'situacao', $op, $perfil );
        }

    }   