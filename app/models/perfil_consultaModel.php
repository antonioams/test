
  <?php
    class perfil_consultaModel extends Model{
        public $_tabela = "perfil_consulta";
        public $_conexao = "1";

        public function listaperfil_consulta( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdperfil_consulta' );
        }

        public function atualizaperfil_consulta( $dados, $where ){
            return $this->update( $dados, 'cdpergunta='.$where );
        }

        public function insereperfil_consulta( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiperfil_consulta( $id ){
            return $this->delete( $id );
        }

        public function pesquisaperfil_consulta( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdperfil_consulta ' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'cdperfil_consulta', $op, $perfil );
        }

    }   