
  <?php
    class projeto_fonteModel extends Model{
        public $_tabela = "projeto_fonte";
        public $_conexao = "2";

        public function listaprojeto_fonte( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto_fonte DESC' );
        }

        public function atualizaprojeto_fonte( $dados, $where ){
            return $this->update( $dados, 'cdprojeto_fonte='.$where );
        }

        public function insereprojeto_fonte( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprojeto_fonte( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprojeto_fonte( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdprojeto_fonte DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'projeto_fonte', $op, $perfil );
        }

    }   