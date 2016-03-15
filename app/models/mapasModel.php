
  <?php
    class mapasModel extends Model{
        public $_tabela = "projeto";

        public function listamapas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto DESC' );
        }

        public function atualizamapas( $dados, $where ){
            return $this->update( $dados, '='.$where );
        }

        public function inseremapas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluimapas( $id ){
            return $this->delete( $id );
        }

        public function pesquisamapas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto DESC' );
        }

    }   