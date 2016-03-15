
  <?php
    class layoutsModel extends Model{
        public $_tabela = "layout";
        public $_conexao = "1";

        public function listalayouts( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdlayout DESC' );
        }

        public function atualizalayouts( $dados, $where ){
            return $this->update( $dados, 'cdlayout='.$where );
        }

        public function inserelayouts( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluilayouts( $id ){
            return $this->delete( $id );
        }

        public function pesquisalayouts( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdlayout DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'layouts', $op, $perfil );
        }

    }   