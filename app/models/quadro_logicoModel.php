
  <?php
    class quadro_logicoModel extends Model{
        public $_tabela = "quadro_logico";
        public $_conexao = "2";

        public function listaquadro_logico( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro_logico DESC' );
        }

        public function atualizaquadro_logico( $dados, $where ){
            return $this->update( $dados, 'cdquadro_logico='.$where );
        }

        public function inserequadro_logico( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiquadro_logico( $id ){
            return $this->delete( $id );
        }

        public function pesquisaquadro_logico( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro_logico DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'quadro_logico', $op, $perfil );
        }

    }   