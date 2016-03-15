
  <?php
    class projeto_objetivoModel extends Model{
        public $_tabela = "projeto_objetivo";
        public $_conexao = "2";

        public function listaprojeto_objetivo( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto_objetivo DESC' );
        }

        public function atualizaprojeto_objetivo( $dados, $where ){
            return $this->update( $dados, 'cdprojeto_objetivo='.$where );
        }

        public function insereprojeto_objetivo( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprojeto_objetivo( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprojeto_objetivo( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto_objetivo DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'projeto_objetivo', $op, $perfil );
        }

    }   