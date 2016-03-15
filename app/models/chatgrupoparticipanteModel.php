
  <?php
    class chatgrupoparticipanteModel extends Model{
        public $_tabela = "chatgrupoparticipante";
        public $_conexao = "2";

        public function listachatgrupoparticipante( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function atualizachatgrupoparticipante( $dados, $where ){
            return $this->update( $dados, '='.$where );
        }

        public function inserechatgrupoparticipante( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluichatgrupoparticipante( $id ){
            return $this->delete( $id );
        }

        public function pesquisachatgrupoparticipante( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, ' DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'chatgrupoparticipante', $op, $perfil );
        }

    }   