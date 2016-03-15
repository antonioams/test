
  <?php
    class projetosmapaModel extends Modelmapa{
        public $_tabela = "projeto";
        public $_conexao = "2";

        public function listaprojetos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto DESC' );
        }

        public function atualizaprojetos( $dados, $where ){
            return $this->update( $dados, 'cdprojeto='.$where );
        }

        public function insereprojetos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprojetos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprojetos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'projetos', $op, $perfil );
        }

        public function rsql( $sql ){
            return $this->rssql( $sql );
        }
        
        public function rjs( $sql ){
            return $this->rsjs( $sql );
        }

    }