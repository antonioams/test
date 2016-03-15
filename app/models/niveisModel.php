
  <?php
    class niveisModel extends Model{
        public $_tabela = "nivel";
        public $_conexao = "2";

        public function listaniveis( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdnivel DESC' );
        }

        public function atualizaniveis( $dados, $where ){
            return $this->update( $dados, 'cdnivel='.$where );
        }

        public function insereniveis( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiniveis( $id ){
            return $this->delete( $id );
        }

        public function pesquisaniveis( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdnivel DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'niveis', $op, $perfil );
        }

    }   