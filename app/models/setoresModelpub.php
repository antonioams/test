
  <?php
    class setoresModelpub extends Modelpub{
        public $_tabela = "unidade";
        public $_conexao = "1";

        public function listasetores( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdunidade DESC' );
        }

        public function atualizasetores( $dados, $where ){
            return $this->update( $dados, 'cdunidade='.$where );
        }

        public function inseresetores( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluisetores( $id ){
            return $this->delete( $id );
        }

        public function pesquisasetores( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdunidade DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'setores', $op, $perfil );
        }

    }   