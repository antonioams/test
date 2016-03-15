
  <?php
    class gruposModel extends Model{
        public $_tabela = "grupo";
        public $_conexao = "2";

        public function listagrupos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupo DESC' );
        }

        public function atualizagrupos( $dados, $where ){
            return $this->update( $dados, 'cdgrupo='.$where );
        }

        public function inseregrupos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigrupos( $id ){
            return $this->delete( $id );
        }

        public function pesquisagrupos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'grupos', $op, $perfil );
        }

    }   