
  <?php
    class parametrosModel extends Model{
        public $_tabela = "parametro";

        public function listaparametros( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdparametro DESC' );
        }

        public function atualizaparametros( $dados, $where ){
            return $this->update( $dados, 'cdparametro='.$where );
        }

        public function insereparametros( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluiparametros( $id ){
            return $this->delete( $id );
        }

        public function pesquisaparametros( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdparametro DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'parametros', $op, $perfil );
        }

    }   