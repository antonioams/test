
  <?php
    class cssModel extends Model{
        public $_tabela = "css";

        public function listacss( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcss DESC' );
        }

        public function atualizacss( $dados, $where ){
            return $this->update( $dados, 'cdcss='.$where );
        }

        public function inserecss( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluicss( $id ){
            return $this->delete( $id );
        }

        public function pesquisacss( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcss DESC' );
        }

    }   