
  <?php
    class naturezasmapaModel extends Modelmapa{
        public $_tabela = "natureza";
        public $_conexao = "2";

        public function listanaturezas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdnatureza DESC' );
        }

        public function atualizanaturezas( $dados, $where ){
            return $this->update( $dados, 'cdnatureza='.$where );
        }

        public function inserenaturezas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluinaturezas( $id ){
            return $this->delete( $id );
        }

        public function pesquisanaturezas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdnatureza DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'naturezas', $op, $perfil );
        }

    }   