
  <?php
    class resposta_projetoModel extends Model{
        public $_tabela = "resposta_projeto";
        public $_conexao = "2";

        public function listaresposta_projeto( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdresposta_projeto ' );
        }

        public function atualizaresposta_projeto( $dados, $where ){
            return $this->update( $dados, 'cdresposta_projeto='.$where );
        }

        public function insereresposta_projeto( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiresposta_projeto( $id ){
            return $this->delete( $id );
        }

        public function pesquisaresposta_projeto( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdresposta_projeto ' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'resposta_projeto', $op, $perfil );
        }

    }   