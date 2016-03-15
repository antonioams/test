
  <?php
    class inicial_detalhesModel extends Model{
        public $_tabela = "inicio_detalhe";
        public $_conexao = "";

        public function listainicial_detalhes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdinicio_detalhe' );
        }

        public function atualizainicial_detalhes( $dados, $where ){
            return $this->update( $dados, 'cdinicio_detalhe='.$where );
        }

        public function insereinicial_detalhes( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiinicial_detalhes( $id ){
            return $this->delete( $id );
        }

        public function pesquisainicial_detalhes( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdinicio_detalhe DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'inicial_detalhes', $op, $perfil );
        }

    }   