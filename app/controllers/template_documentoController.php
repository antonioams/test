
<?php
session_start();
    class template_documento extends Controller{

        public function Index_action(){
            $template_documento = new template_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $template_documento_lista = $template_documento->listatemplate_documento("{$par}");

            $datas['template_documento'] = $template_documento_lista;

            if ($template_documento->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/template_documento/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $template_documento = new template_documentoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));

           $projetos = new projetosModel();
		   $consultas = new consultasModel();
		   	
           /*$tabelas = $projetos->rsql("SELECT
                                                c.relname as tabela

                                                FROM pg_catalog.pg_attribute a
                                                INNER JOIN pg_stat_user_tables c ON a.attrelid = c.relid
                                                WHERE
                                                a.attnum > 0 AND
                                                NOT a.attisdropped
                                                GROUP by c.relname
                                                ORDER BY tabela");*/
	       
	       $tabelas = $consultas->rsql("SELECT 
									   		e.entidade AS tabela
									        ,e.legendaentidade
									    FROM 
									    	modulo e
									    WHERE
									    	e.entidade IS NOT NULL
									   	GROUP BY e.entidade,e.legendaentidade
									    ORDER BY e.legendaentidade");											
           $datas['tabelas'] = $tabelas;
           $datas['tabelas_json'] = json_encode($tabelas);

           /*$tabelas_ref = $projetos->rsql("SELECT
                                          cl.relname as tabela,
                                          a.attname AS atributo,
                                          clf.relname AS tabela_ref,
                                          af.attname AS atributo_ref
                                        FROM pg_catalog.pg_attribute a
                                          JOIN pg_catalog.pg_class cl ON (a.attrelid = cl.oid AND cl.relkind = 'r')
                                          JOIN pg_catalog.pg_namespace n ON (n.oid = cl.relnamespace)
                                          JOIN pg_catalog.pg_constraint ct ON (a.attrelid = ct.conrelid AND
                                               ct.confrelid != 0 AND ct.conkey[1] = a.attnum)
                                          JOIN pg_catalog.pg_class clf ON (ct.confrelid = clf.oid AND clf.relkind = 'r')
                                          JOIN pg_catalog.pg_namespace nf ON (nf.oid = clf.relnamespace)
                                          JOIN pg_catalog.pg_attribute af ON (af.attrelid = ct.confrelid AND
                                               af.attnum = ct.confkey[1])
                                          ORDER BY tabela     ");*/
		   $tabelas_ref = $consultas->rsql("select 
		   										m.cdmodulo
												, m.entidade as tabela
												, m.legendaentidade as legenda_tabela
												, mc.campo as atributo
												, mc.legenda as legenda_atributo
												, mr.entidade as tabela_ref
												, mr.legendaentidade as legenda_tabela_ref
												, mrc.campo as atributo_ref 
											from 
												modulo m
												, modulo_campo mc
											left outer join modulo mr on mc.cdmodulo_referencia=mr.cdmodulo
											left outer join modulo_campo mrc on
											mr.cdmodulo=mrc.cdmodulo and mrc.cchave=1
											where 
											m.cdmodulo=mc.cdmodulo and 
											m.entidade is not null");								 
           $datas['tabelas_ref'] = json_encode($tabelas_ref);

           /*$colunas = $projetos->rsql("SELECT
                                                c.relname,
                                                a.attname AS Column,
                                                pg_catalog.format_type(a.atttypid, a.atttypmod) AS Datatype

                                                FROM pg_catalog.pg_attribute a
                                                INNER JOIN pg_stat_user_tables c ON a.attrelid = c.relid
                                                WHERE
                                                a.attnum > 0 AND
                                                NOT a.attisdropped
                                                ORDER BY c.relname, a.attname");*/
		   $colunas = $consultas->rsql("select 
											   e.cdmodulo
											   ,e.entidade as relname
											   ,e.legendaentidade
											   ,c.cdcampo
											   ,c.campo AS Column
											   ,c.legenda as legendacampo
                                            from 
												modulo e
												,modulo_campo c 
                                            where
                                            	e.cdmodulo=c.cdmodulo and e.entidade is not null
                                                order by e.legendaentidade, c.legenda");										
           $datas['colunas'] = $colunas;


            if ($template_documento->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/template_documento/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $template_documento = new template_documentoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            if ($template_documento->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/template_documento/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){
            $template_documento = new template_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $id = $this->getParam('id');
            $detalhes_template_documento = $template_documento->listatemplate_documento('cdtemplate='.$id);
            $datas['template_documento'] = $detalhes_template_documento;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['template_documento'][0]['template'] );
            if ($template_documento->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/template_documento/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }


         public function ver(){
            $template_documento = new template_documentoModel();
                       $projetos = new projetosModel();
            $id = $this->getParam('id');
            $par = $this->getParam('par');
            $template = $projetos->rsql("SELECT * FROM template_documento WHERE cdtemplate =". $id);
            $variavel = $projetos->rsql("SELECT ". $template[0][variavel]." FROM ".$template[0][tabela]." where cd".$template[0][tabela]." ='".$par."'");

            $datas['template'] = $template;
            $datas['variavel'] = $variavel;

            $this->view('/template_documento/ver', $datas);
        

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $template_documento = new template_documentoModel();
            $dados=$_POST;
            $atualiza = $template_documento->atualizatemplate_documento($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/template_documento/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/template_documento/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $template_documento = new template_documentoModel();
            $atualiza = $template_documento->excluitemplate_documento( 'cdtemplate='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($template_documento->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/template_documento/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $template_documento = new template_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            if ($template_documento->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/template_documento/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $template_documento = new template_documentoModel();
            $_POST['tabela'] = implode( ',' , $_POST['tabela']);
            $_POST['variavel'] = implode( ',' , $_POST['variavel']);
            $_POST['parametro'] = implode( ',' , $_POST['parametro']);
            $insere = $template_documento->inseretemplate_documento($_POST, 'cdtemplate');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/template_documento/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/template_documento/" );
            }

        }

        
        public function inserem( Array $dados = null ){
            $template_documento = new template_documentoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['template'][0])) {
                $i=0;
                foreach ($dados['template'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_template_documento[$key]=$dados[$key][$i];
                    }
                    $insere = $template_documento->inseretemplate_documento($dados_template_documento,'cdtemplate');
                    $i++;
                }

            }

           if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso. Registros inseridos.';
            }

            header( "Location: /".PROJETO."/template_documento/" );


        }



        public function inserew(){
            $template_documento = new template_documentoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='template_documento') {
                    $dados['template_documento'][$p[1]]=$value;
                }
            }

            $inserep = $template_documento->inseretemplate_documento($dados['template_documento'], 'cdtemplate');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/template_documento/" );
            

        }

        public function pesquisa(){
            $template_documento = new template_documentoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));$filtro='';
            foreach ($_POST as $key => $value) {
                    if ( ($key!="submit") and ($value!="")) {
                              $vop='';
                              if (is_array($value)) { $value=implode( ',' , $value); }
                         if (substr($key, 1, 1)=="1") { $op=" >= "; } elseif (substr($key, 1, 1)=="2") { $op=" <= "; } elseif (substr($key, 1, 1)=="3") { $op=" in "; $vop=" Esteja em "; } else { $op=" = "; }
                        if (substr($key, 0, 1)=="s"){
                            $vop=' Contenha ';
                            $w .= ($w=="") ? "upper(".substr($key, 2).") like upper("."'%".$value."%')" : " and upper(".substr($key, 2).") like upper("."'%".$value."%')" ;
                        } else if (substr($key, 0, 1)=="d") {
                            $w .= ($w=="") ? substr($key, 2).$op."'".$value."'" : " and ".substr($key, 2).$op."'".$value."'" ;
                        } else if (substr($key, 0, 1)=="i") {
                            $w .= ($w=="") ? substr($key, 2).$op.$value : " and ".substr($key, 2).$op.$value ;
                        } else if (substr($key, 0, 1)=="m") {
                            $val = str_replace(",", "','", $value);
                            $w .= ($w=="") ? substr($key, 2).$op."('".$val."')" : " and ".substr($key, 2).$op."('".$val."')" ;
                        }
                          if ($vop!='') {$op=$vop;}
                          $filtro .= '<br>'.substr($key, 2).$op.$value;

                    }
                }
            if ($w!='') { if ($par!='') { $w.=' and '.$par; } }
            else { if ($par!='') {$w=$par;} }

            $pesquisa = $template_documento->pesquisatemplate_documento($w);
            $datas['template_documento'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/template_documento/index', $datas);

    }


}