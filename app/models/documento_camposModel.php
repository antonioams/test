
  <?php
    class documento_camposModel extends Model{
        public $_tabela = "documento_campo";
        public $_conexao = "2";

        public function listadocumento_campos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcampo DESC' );
        }

        public function atualizadocumento_campos( $dados, $where ){
            return $this->update( $dados, 'cdcampo='.$where );
        }

        public function inseredocumento_campos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluidocumento_campos( $id ){
            return $this->delete( $id );
        }

        public function pesquisadocumento_campos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcampo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'documento_campos', $op, $perfil );
        }

    }   