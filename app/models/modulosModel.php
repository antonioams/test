<?php
    class ModulosModel extends Model{
        public $_tabela = "modulo";

        public function listaModulos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmodulo DESC' );
        }

		public function atualizaModulos( $dados, $where ){
            return $this->update( $dados, 'cdmodulo='.$where );
        }

		public function insereModulos( $dados, $chave ){
            return $this->insert( $dados, $chave );
        }

		public function excluiModulos( $id ){
            return $this->delete( $id );
        }

        public function pesquisaModulos( $where = null, $qtd = null, $offset = null ){
            return $this->read( $where, $qtd, $offset, 'cdmodulo DESC' );
        }

        public function listarcolunas($tab, $conexao){
            return $this->listcol($tab, $conexao);
        }

        public function adicionartabela( $tab, $conexao ){
            return $this->adtab($tab, $conexao);
        }

        public function adicionarcoluna( $tab, $coluna, $tipo, $ref = '', $conexao ){
            if ($tipo=='') {



            } elseif ( ($tipo=='inteiro') or ($tipo=='check') ) {
              $tp='integer';
            } elseif ($tipo=='numero') {
              $tp='double precision';
            } elseif ($tipo=='data') {
              $tp='date';
            } elseif ( ($tipo=='telefone') or ($tipo=='texto curto') ) {
              $tp='varchar(100)';
            } elseif ($tipo=='lista') {
              if ($ref=='') { $tp='varchar(100)'; } else { $tp='integer'; }
            } else {
              $tp='varchar(255)';
            }
            return $this->adcol($tab, $coluna, $tp, $conexao);
        }

    }