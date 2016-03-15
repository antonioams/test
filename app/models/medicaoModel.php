
  <?php
    class medicaoModel extends Model{
        public $_tabela = "medicao";
        public $_conexao = "2";

        public function listamedicao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmedicao DESC' );
        }

        public function atualizamedicao( $dados, $where ){
            return $this->update( $dados, 'cdmedicao='.$where );
        }

        public function inseremedicao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluimedicao( $id ){
            return $this->delete( $id );
        }

        public function pesquisamedicao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmedicao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'medicao', $op, $perfil );
        }

    }   