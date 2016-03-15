
  <?php
    class quadroModel extends Model{
        public $_tabela = "quadro";
        public $_conexao = "2";

        public function listaquadro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro DESC' );
        }

        public function atualizaquadro( $dados, $where ){
            return $this->update( $dados, 'cdquadro='.$where );
        }

        public function inserequadro( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiquadro( $id ){
            return $this->delete( $id );
        }

        public function pesquisaquadro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'quadro', $op, $perfil );
        }

    }   