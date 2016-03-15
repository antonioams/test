
  <?php
    class clientesModel extends Model{
        public $_tabela = "cliente";
        public $_conexao = "1";

        public function listaclientes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcliente DESC' );
        }

        public function atualizaclientes( $dados, $where ){
            return $this->update( $dados, 'cdcliente='.$where );
        }

        public function insereclientes( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiclientes( $id ){
            return $this->delete( $id );
        }

        public function pesquisaclientes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcliente DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'clientes', $op, $perfil );
        }
        
        public function adicionarbanco( $banco, $conexao, $temp ){
            return $this->addb($banco, $conexao, $temp );
        }        

    }   
