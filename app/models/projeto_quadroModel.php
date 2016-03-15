
  <?php
    class projeto_quadroModel extends Model{
        public $_tabela = "projeto_quadro";
        public $_conexao = "2";

        public function listaprojeto_quadro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro_valor DESC' );
        }

        public function atualizaprojeto_quadro( $dados, $where ){
            return $this->update( $dados, 'cdquadro_valor='.$where );
        }

        public function insereprojeto_quadro( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiprojeto_quadro( $id ){
            return $this->delete( $id );
        }

        public function pesquisaprojeto_quadro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdquadro_valor DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'projeto_quadro', $op, $perfil );
        }

    }   