
  <?php
    class parametroModel extends Model{
        public $_tabela = "parametro";
        public $_conexao = "1";

        public function listaparametro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdparametro DESC' );
        }

        public function atualizaparametro( $dados, $where ){
            return $this->update( $dados, 'cdparametro='.$where );
        }

        public function insereparametro( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiparametro( $id ){
            return $this->delete( $id );
        }

        public function pesquisaparametro( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdparametro DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'parametro', $op, $perfil );
        }

    }   