
  <?php
    class programasModel extends Model{
        public $_tabela = "programa";
        public $_conexao = "2";

        public function listaprogramas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprograma DESC' );
        }

        public function atualizaprogramas( $dados, $where ){
            return $this->update( $dados, 'cdprograma='.$where );
        }

        public function insereprogramas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprogramas( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprogramas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprograma DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'programas', $op, $perfil );
        }

    }   