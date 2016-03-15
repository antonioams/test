
  <?php
    class instituicoesModel extends Model{
        public $_tabela = "instituicao";
        public $_conexao = "2";

        public function listainstituicoes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdinstituicao DESC' );
        }

        public function atualizainstituicoes( $dados, $where ){
            return $this->update( $dados, 'cdinstituicao='.$where );
        }

        public function insereinstituicoes( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiinstituicoes( $id ){
            return $this->delete( $id );
        }

        public function pesquisainstituicoes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdinstituicao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'instituicoes', $op, $perfil );
        }

    }   