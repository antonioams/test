
  <?php
    class alvoModel extends Model{
        public $_tabela = "alvo";
        public $_conexao = "2";

        public function listaalvo( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdalvo DESC' );
        }

        public function atualizaalvo( $dados, $where ){
            return $this->update( $dados, 'cdalvo='.$where );
        }

        public function inserealvo( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluialvo( $id ){
            return $this->delete( $id );
        }

        public function pesquisaalvo( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdalvo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'alvo', $op, $perfil );
        }

    }   