
  <?php
    class usuariosModelpub extends Modelpub{
        public $_tabela = "usuario";
        public $_conexao = "1";

        public function listausuarios( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdusuario DESC' );
        }

        public function atualizausuarios( $dados, $where ){
            return $this->update( $dados, 'cdusuario='.$where );
        }

        public function insereusuarios( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiusuarios( $id ){
            return $this->delete( $id );
        }

        public function pesquisausuarios( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdusuario DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'usuarios', $op, $perfil );
        }

    }   