<?php
    class ModulosCamposModel extends Model{
        public $_tabela = "modulo_campo";

        public function listaModuloscampos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmodulo DESC' );
        }

		public function atualizaModuloscampos( $dados, $where ){
            return $this->update( $dados, 'cdcampo='.$where );
        }

		public function insereModuloscampos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

		public function excluiModuloscampos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaModuloscampos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdcampo' );
        }

    }