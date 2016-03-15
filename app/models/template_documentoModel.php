
  <?php
    class template_documentoModel extends Model{
        public $_tabela = "template_documento";
        public $_conexao = "2";

        public function listatemplate_documento( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdtemplate DESC' );
        }

        public function atualizatemplate_documento( $dados, $where ){
            return $this->update( $dados, 'cdtemplate='.$where );
        }

        public function inseretemplate_documento( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluitemplate_documento( $id ){
            return $this->delete( $id );
        }

        public function pesquisatemplate_documento( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdtemplate DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'template_documento', $op, $perfil );
        }

    }   