
  <?php
    class perfil_modulosModel extends Model{
        public $_tabela = "perfil_modulo";
        public $_conexao = "1";

        public function listaperfil_modulos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdperfil_modulo DESC' );
        }

        public function selperfil_modulos( $sql ){
            return $this->sel( $sql );
        }                

        public function atualizaperfil_modulos( $dados, $where ){
            return $this->update( $dados, 'cdperfil_modulo='.$where );
        }

        public function insereperfil_modulos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiperfil_modulos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaperfil_modulos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdperfil_modulo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'perfil_modulos', $op, $perfil );
        }

    }   