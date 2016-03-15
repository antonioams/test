
  <?php
    class wconsultaModel extends Model{
        public $_tabela = "consulta";
        public $_conexao = "1";

        public function listawconsulta( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdconsulta DESC' );
        }

        public function atualizawconsulta( $dados, $where ){
            return $this->update( $dados, 'cdconsulta='.$where );
        }

        public function inserewconsulta( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiwconsulta( $id ){
            return $this->delete( $id );
        }

        public function pesquisawconsulta( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdconsulta DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'wconsulta', $op, $perfil );
        }

    }   