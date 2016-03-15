
  <?php
    class objetivo_informacaoModel extends Model{
        public $_tabela = "objetivo_informacao";
        public $_conexao = "2";

        public function listaobjetivo_informacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdobjetivo_informacao DESC' );
        }

        public function atualizaobjetivo_informacao( $dados, $where ){
            return $this->update( $dados, 'cdobjetivo_informacao='.$where );
        }

        public function insereobjetivo_informacao( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiobjetivo_informacao( $id ){
            return $this->delete( $id );
        }

        public function pesquisaobjetivo_informacao( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdobjetivo_informacao DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'objetivo_informacao', $op, $perfil );
        }

    }   