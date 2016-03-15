
  <?php
    class municipiosmapaModel extends Modelmapa{
        public $_tabela = "municipio";
        public $_conexao = "2";

        public function listamunicipios( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmunicipio DESC' );
        }

        public function atualizamunicipios( $dados, $where ){
            return $this->update( $dados, 'cdmunicipio='.$where );
        }

        public function inseremunicipios( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

        public function excluimunicipios( $id ){
            return $this->delete( $id );
        }

        public function pesquisamunicipios( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmunicipio DESC' );
        }

        public function pacesso( $op, $perfil ){
            return $this->acesso( 'municipios', $op, $perfil );
        }

    }   