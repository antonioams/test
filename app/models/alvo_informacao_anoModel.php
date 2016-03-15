
  <?php
    class alvo_informacao_anoModel extends Model{
        public $_tabela = "alvo_informacao_ano";
        public $_conexao = "2";

        public function listaalvo_informacao_ano( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdalvo_informacao_ano DESC' );
        }

        public function atualizaalvo_informacao_ano( $dados, $where ){
            return $this->update( $dados, 'cdalvo_informacao_ano='.$where );
        }

        public function inserealvo_informacao_ano( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluialvo_informacao_ano( $id ){
            return $this->delete( $id );
        }

        public function pesquisaalvo_informacao_ano( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdalvo_informacao_ano DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'alvo_informacao_ano', $op, $perfil );
        }

    }   