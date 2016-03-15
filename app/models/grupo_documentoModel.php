
  <?php
    class grupo_documentoModel extends Model{
        public $_tabela = "grupo_documento";
        public $_conexao = "2";

        public function listagrupo_documento( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupo_documento DESC' );
        }

        public function atualizagrupo_documento( $dados, $where ){
            return $this->update( $dados, 'cdgrupo_documento='.$where );
        }

        public function inseregrupo_documento( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluigrupo_documento( $id ){
            return $this->delete( $id );
        }

        public function pesquisagrupo_documento( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdgrupo_documento DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'grupo_documento', $op, $perfil );
        }

    }   