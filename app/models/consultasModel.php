
  <?php
    class consultasModel extends Model{
        public $_tabela = "consulta";
        public $_conexao = "1";

        public function listaconsultas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdconsulta DESC' );
        }

        public function atualizaconsultas( $dados, $where ){
            return $this->update( $dados, 'cdconsulta='.$where );
        }

        public function insereconsultas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiconsultas( $id ){
            return $this->delete( $id );
        }

        public function pesquisaconsultas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdconsulta DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'consultas', $op, $perfil );
        }

        public function rsql( $sql ){
            return $this->rssql( $sql, '1' );
        }

    }