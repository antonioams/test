<?php
    class ModulosvinculadosModel extends Model{
        public $_tabela = "modulo_vinculado";

        public function listaModulosvinculados( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmodulo DESC' );
        }

		public function atualizaModulosvinculados( $dados, $where ){
            return $this->update( $dados, 'cdmodulo='.$where );
        }

		public function insereModulosvinculados( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

		public function excluiModulosvinculados( $id ){
            return $this->delete( $id );
        }

        public function pesquisaModulosvinculados( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdvinculado DESC' );
        }

    }