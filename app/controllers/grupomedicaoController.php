
<?php
session_start();
    class grupomedicao extends Controller{

        public function Index_action(){
            $projetos = new projetosModel();
            $grupomedicao = new grupomedicaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $grupomedicao_lista =  $projetos->rsql("
                select g.cdgrupomedicao, g.numero, g.data, g.cdprojeto, c.objeto, c.numero as numero_contrato, sum(m.valor) as medicao, sum(ic.valor) as item_contrato from grupomedicao g
                left outer join contrato c on g.cdcontrato=c.cdcontrato
                left outer join medicao m on g.cdgrupomedicao=m.cdgrupomedicao
                left outer join contrato_item ic on m.cdcontrato_item=ic.cdcontrato_item
                where g.cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']."
                group by g.cdgrupomedicao, g.numero, g.data, g.cdprojeto, c.objeto, c.numero
                order by g.data, g.numero ");

            $datas['grupomedicao'] = $grupomedicao_lista;

            if ($grupomedicao->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupomedicao/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $grupomedicao = new grupomedicaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']);

            $datas['contratos'] = $detalhes_contratos;
                        
            if ($grupomedicao->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/grupomedicao/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $grupomedicao = new grupomedicaoModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;

            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']);

            $datas['contratos'] = $detalhes_contratos;
                        
            if ($grupomedicao->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupomedicao/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $grupomedicao = new grupomedicaoModel();
            $id = $this->getParam('id');
            $detalhes_grupomedicao = $grupomedicao->listagrupomedicao('cdgrupomedicao='.$id);
            $datas['grupomedicao'] = $detalhes_grupomedicao;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['grupomedicao'][0]['numero'] );
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("cdcontrato=".$_SESSION[PROJETO]['filtro']['cdcontrato']);

            $datas['contratos'] = $detalhes_contratos;
                        
            if ($grupomedicao->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupomedicao/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $grupomedicao = new grupomedicaoModel();
            $dados=$_POST;
            $dados['cdcontrato']=$_SESSION[PROJETO]['filtro']['cdcontrato'];
            $atualiza = $grupomedicao->atualizagrupomedicao($dados, $id );

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupomedicao/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/grupomedicao/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $grupomedicao = new grupomedicaoModel();
            $atualiza = $grupomedicao->excluigrupomedicao( 'cdgrupomedicao='.$id );
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($grupomedicao->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/grupomedicao/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $grupomedicao = new grupomedicaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();
            
            $contratos = new contratosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdcontrato') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_contratos = $contratos->listacontratos("{$par}");

            $datas['contratos'] = $detalhes_contratos;            

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($grupomedicao->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/grupomedicao/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){

            $grupomedicao = new grupomedicaoModel();			
			      $_POST['cdcontrato']=$_SESSION[PROJETO]['filtro']['cdcontrato'];
            $insere = $grupomedicao->inseregrupomedicao($_POST, 'cdgrupomedicao');

            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
            //historico    

            $consulta = $grupomedicao->listagrupomedicao('cdgrupomedicao='.$insere);

            $texto = '<b>Numero:</b> '.$consulta[0]['numero'].'<br/> <b>Data da Medição:</b> '.$consulta[0]['data'];
            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");
            $dados_historico['tabela']='medicao';
            $dados_historico['descricao']=$consulta[0]['cdgrupomedicao'];
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$_SESSION[filtro]['cdprojeto'];
            $dados_historico['texto']=$texto;
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='I';
            $insereh = $historico->inserehistorico($dados_historico, 'cdhistorico');

            //fim historico

              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/grupomedicao/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/grupomedicao/" );
            }

        }


        public function inserem( Array $dados = null ){
            $grupomedicao = new grupomedicaoModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['numero'][0])) {
                $i=0;
                foreach ($dados['numero'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_grupomedicao[$key]=$dados[$key][$i];
                    }
                    $insere = $grupomedicao->inseregrupomedicao($dados_grupomedicao,'cdgrupomedicao');
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

            header( "Location: /".PROJETO."/grupomedicao/" );


        }



        public function inserew(){
            $grupomedicao = new grupomedicaoModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='grupomedicao') {
                    $dados['grupomedicao'][$p[1]]=$value;
                }
            }

            $inserep = $grupomedicao->inseregrupomedicao($dados['grupomedicao'], 'cdgrupomedicao');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/grupomedicao/" );
            

        }

        public function pesquisa(){
            $grupomedicao = new grupomedicaoModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $projetos = new projetosModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }$filtro='';
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

            $pesquisa = $grupomedicao->pesquisagrupomedicao($w);
            $datas['grupomedicao'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/grupomedicao/index', $datas);

    }


}
