
  <?php
    class contratosModel extends Model{
        public $_tabela = "contrato";
        public $_conexao = "2";

        public function listacontratos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato DESC' );
        }

        public function atualizacontratos( $dados, $where ){
            return $this->update( $dados, 'cdcontrato='.$where );
        }

        public function inserecontratos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluicontratos( $id ){
            return $this->delete( $id );
        }

        public function pesquisacontratos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcontrato DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'contratos', $op, $perfil );
        }

    }   