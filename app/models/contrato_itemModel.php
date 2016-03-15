
  <?php
    class contrato_itemModel extends Model{
        public $_tabela = "contrato_item";
        public $_conexao = "2";

        public function listacontrato_item( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato_item DESC' );
        }

        public function atualizacontrato_item( $dados, $where ){
            return $this->update( $dados, 'cdcontrato_item='.$where );
        }

        public function inserecontrato_item( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluicontrato_item( $id ){
            return $this->delete( $id );
        }

        public function pesquisacontrato_item( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato_item DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'contrato_item', $op, $perfil );
        }

    }   