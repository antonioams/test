
  <?php
    class documentosModel extends Model{
        public $_tabela = "documento";
        public $_conexao = "2";

        public function listadocumentos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'ordem ' );
        }

        public function atualizadocumentos( $dados, $where ){
            return $this->update( $dados, 'cddocumento='.$where );
        }

        public function inseredocumentos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluidocumentos( $id ){
            return $this->delete( $id );
        }

        public function pesquisadocumentos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cddocumento ' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'documentos', $op, $perfil );
        }

    }   