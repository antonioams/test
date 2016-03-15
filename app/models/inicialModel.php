
  <?php
    class inicialModel extends Model{
        public $_tabela = "inicio";
        public $_conexao = "1";

        public function listainicial( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdinicio DESC' );
        }

        public function atualizainicial( $dados, $where ){
            return $this->update( $dados, 'cdinicio='.$where );
        }

        public function insereinicial( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiinicial( $id ){
            return $this->delete( $id );
        }

        public function pesquisainicial( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdinicio DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'inicial', $op, $perfil );
        }

    }   