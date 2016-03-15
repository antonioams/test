
  <?php
    class layoutmapaModel extends Model{
        public $_tabela = "layoutmapa";
        public $_conexao = "1";

        public function listalayoutmapa( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdlayoutmapa DESC' );
        }

        public function atualizalayoutmapa( $dados, $where ){
            return $this->update( $dados, 'cdlayoutmapa='.$where );
        }

        public function inserelayoutmapa( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluilayoutmapa( $id ){
            return $this->delete( $id );
        }

        public function pesquisalayoutmapa( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdlayoutmapa DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'layoutmapa', $op, $perfil );
        }

    }   