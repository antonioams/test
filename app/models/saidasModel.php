
  <?php
    class saidasModel extends Model{
        public $_tabela = "saida";
        public $_conexao = "1";

        public function listasaidas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdsaida' );
        }

        public function atualizasaidas( $dados, $where ){
            return $this->update( $dados, 'cdsaida='.$where );
        }

        public function inseresaidas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluisaidas( $id ){
            return $this->delete( $id );
        }

        public function pesquisasaidas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdsaida' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'saidas', $op, $perfil );
        }

    }   