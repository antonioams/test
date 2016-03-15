
  <?php
    class perguntasModel extends Model{
        public $_tabela = "pergunta";
        public $_conexao = "2";

        public function listaperguntas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'ordem' );
        }

        public function atualizaperguntas( $dados, $where ){
            return $this->update( $dados, 'cdpergunta='.$where );
        }

        public function insereperguntas( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiperguntas( $id ){
            return $this->delete( $id );
        }

        public function pesquisaperguntas( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdpergunta ' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'perguntas', $op, $perfil );
        }

    }   