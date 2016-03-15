
  <?php
    class alvo_informacaoModel extends Model{
        public $_tabela = "alvo_informacao";
        public $_conexao = "2";

        public function listaalvo_informacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdalvo_informacao DESC' );
        }

        public function atualizaalvo_informacao( $dados, $where ){
            return $this->update( $dados, 'cdalvo_informacao='.$where );
        }

        public function inserealvo_informacao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluialvo_informacao( $id ){
            return $this->delete( $id );
        }

        public function pesquisaalvo_informacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdalvo_informacao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'alvo_informacao', $op, $perfil );
        }

    }   