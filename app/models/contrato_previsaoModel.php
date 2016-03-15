
  <?php
    class contrato_previsaoModel extends Model{
        public $_tabela = "contrato_previsao";
        public $_conexao = "2";

        public function listacontrato_previsao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato_previsao DESC' );
        }

        public function atualizacontrato_previsao( $dados, $where ){
            return $this->update( $dados, 'cdcontrato_previsao='.$where );
        }

        public function inserecontrato_previsao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluicontrato_previsao( $id ){
            return $this->delete( $id );
        }

        public function pesquisacontrato_previsao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato_previsao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'contrato_previsao', $op, $perfil );
        }

    }   