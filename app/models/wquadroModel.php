
  <?php
    class wquadroModel extends Model{
        public $_tabela = "quadro";
        public $_conexao = "2";

        public function listawquadro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro DESC' );
        }

        public function atualizawquadro( $dados, $where ){
            return $this->update( $dados, 'cdquadro='.$where );
        }

        public function inserewquadro( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiwquadro( $id ){
            return $this->delete( $id );
        }

        public function pesquisawquadro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'wquadro', $op, $perfil );
        }

    }   