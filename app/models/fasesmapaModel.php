
  <?php
    class fasesmapaModel extends Modelmapa{
        public $_tabela = "fase";
        public $_conexao = "2";

        public function listafases( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfase DESC' );
        }

        public function atualizafases( $dados, $where ){
            return $this->update( $dados, 'cdfase='.$where );
        }

        public function inserefases( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluifases( $id ){
            return $this->delete( $id );
        }

        public function pesquisafases( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdfase DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'fases', $op, $perfil );
        }

    }   