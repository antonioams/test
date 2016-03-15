
  <?php
    class documento_valorModel extends Model{
        public $_tabela = "documento_valor";
        public $_conexao = "2";

        public function listadocumento_valor( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cddocumento_valor' );
        }

        public function atualizadocumento_valor( $dados, $where ){
            return $this->update( $dados, 'cddocumento_valor='.$where );
        }

        public function inseredocumento_valor( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluidocumento_valor( $id ){
            return $this->delete( $id );
        }

        public function pesquisadocumento_valor( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cddocumento_valor ' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'documento_valor', $op, $perfil );
        }

    }   