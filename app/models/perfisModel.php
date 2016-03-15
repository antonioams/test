
  <?php
    class perfisModel extends Model{
        public $_tabela = "perfil";
        public $_conexao = "1";

        public function listaperfis( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdperfil DESC' );
        }

        public function atualizaperfis( $dados, $where ){
            return $this->update( $dados, 'cdperfil='.$where );
        }

        public function insereperfis( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiperfis( $id ){
            return $this->delete( $id );
        }

        public function pesquisaperfis( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdperfil DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'perfis', $op, $perfil );
        }

    }   