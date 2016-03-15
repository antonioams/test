
  <?php
    class faseModel extends Model{
        public $_tabela = "fase";
        public $_conexao = "2";

        public function listafase( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfase DESC' );
        }

        public function atualizafase( $dados, $where ){
            return $this->update( $dados, 'cdfase='.$where );
        }

        public function inserefase( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluifase( $id ){
            return $this->delete( $id );
        }

        public function pesquisafase( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfase DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'fase', $op, $perfil );
        }

    }   