
<?php
session_start();
    class contratos extends Controller{
        

        public function Index_action(){
            $projetos = new projetosModel();
            $contratos = new contratosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
    
              //$contratos_lista = $contratos->listacontratos("{$par}");
            
              $contratos_lista = $projetos->rsql("
                select c.cdcontrato, c.data, c.valor, c.numero, c.objeto,  sum(ic.valor) as valor_item from contrato c
                left outer join contrato_item ic on c.cdcontrato=ic.cdcontrato
                where c.cdprojeto=".$_SESSION[PROJETO]['filtro']['cdprojeto']."
                group by c.cdcontrato, c.data, c.valor, c.numero, c.objeto ");

            $datas['contratos'] = $contratos_lista;

            if ($contratos->pacesso('visualizar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contratos/index', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function novo(){
           $contratos = new contratosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $fornecedores = new fornecedoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfornecedor') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fornecedores = $fornecedores->listafornecedores("{$par}");

            $datas['fornecedores'] = $detalhes_fornecedores;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($contratos->pacesso('inserir',$_SESSION[PROJETO]['cdperfil'])=='1') {    $this->view('/contratos/novo', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function novom(){
            $contratos = new contratosModel();
           $datas['vc'] = $this->modvinculados(get_class($this));
            $fornecedores = new fornecedoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfornecedor') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fornecedores = $fornecedores->listafornecedores("{$par}");

            $datas['fornecedores'] = $detalhes_fornecedores;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($contratos->pacesso('inserir_mtp',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contratos/novom', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }



        public function editar(){

            $contratos = new contratosModel();
            $id = $this->getParam('id');
            $detalhes_contratos = $contratos->listacontratos('cdcontrato='.$id);
            $detalhes_contratos[0]['valor']= str_replace(".", ",", $detalhes_contratos[0]['valor']);
            $datas['contratos'] = $detalhes_contratos;
            $datas['vc'] = $this->modvinculados(get_class($this),$id, $datas['contratos'][0]['objeto'] );
            $fornecedores = new fornecedoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfornecedor') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fornecedores = $fornecedores->listafornecedores("{$par}");

            $datas['fornecedores'] = $detalhes_fornecedores;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($contratos->pacesso('editar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contratos/editar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }

        }

        public function atualiza(){
            $id = $this->getParam('id');
            $contratos = new contratosModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']); 
            $dados=$_POST;
            $consultaantes = $contratos->listacontratos('cdcontrato='.$id);
            $atualiza = $contratos->atualizacontratos($dados, $id );            

            //historico

            $consulta = $contratos->listacontratos('cdcontrato='.$id);
            $texto = '';
            if($consultaantes[0]['cdlicitacao']!=$consulta[0]['cdlicitacao']){
                echo "licitacao";
                $texto = "Númedo da licitação de: ".$consultaantes[0]['cdlicitacao']." Para:".$consulta[0]['cdlicitacao']."<br/>";
            }
            if($consultaantes[0]['data']!=$consulta[0]['data']){
                echo "data";
                 $texto .= "Data de: ".$consultaantes[0]['data']." Para:".$consulta[0]['data']."<br/>";
            }
            if($consultaantes[0]['prazo']!=$consulta[0]['prazo']){
                echo "prazo";
                 $texto .= "Prazo de: ".$consultaantes[0]['prazo']." Para:".$consulta[0]['prazo']."<br/>";
            }
            if($consultaantes[0]['valor']!=$consulta[0]['valor']){
                echo "valor";
                 $texto .= "Valor de: ".$consultaantes[0]['valor']." Para:".$consulta[0]['valor']."<br/>";
            }
            if($consultaantes[0]['numero']!=$consulta[0]['numero']){
                echo "numero";
                 $texto .= "Valor de: ".$consultaantes[0]['numero']." Para:".$consulta[0]['numero']."<br/>";
            }
            if($consultaantes[0]['objeto']!=$consulta[0]['objeto']){
                echo "objeto";
                 $texto .= "Valor de: ".$consultaantes[0]['objeto']." Para:".$consulta[0]['objeto']."<br/>";
            }

            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");
            $dados_historico['tabela']='contrato';
            $dados_historico['descricao']=$consulta[0]['cdcontrato'];
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$_SESSION[filtro]['cdprojeto'];
            $dados_historico['texto']= $texto;
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='A';
            if($texto <> ''){
            $insere = $historico->inserehistorico($dados_historico, 'cdhistorico');
            }
            //fim historico

            if ($_POST['submit']=='Salvar e Continuar') {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/contratos/editar/id/{$id}" );

            } else {

            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Atualização!</strong>&nbsp;Informações Atualizadas com sucesso.';
            header( "Location: /".PROJETO."/contratos/" );

            }

        }

        public function exclui(){
            $id = $this->getParam('id');
            $contratos = new contratosModel();
            $consulta = $contratos->listacontratos('cdcontrato='.$id);
            $atualiza = $contratos->excluicontratos( 'cdcontrato='.$id );


            //historico

            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");
            $dados_historico['tabela']='contrato';
            $dados_historico['descricao']=$consulta[0]['cdcontrato'];
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$_SESSION[filtro]['cdprojeto'];
            $dados_historico['texto']='<b>Numero:</b> '.$consulta[0]['numero'];
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='E';
            $insere = $historico->inserehistorico($dados_historico, 'cdhistorico');

            //fim historico


            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Exclusão!</strong>&nbsp;Informações Excluídas com sucesso.';

            if ($contratos->pacesso('excluir',$_SESSION[PROJETO]['cdperfil'])=='1') {
                header( "Location: /".PROJETO."/contratos/" );
            } else {
                header( "Location: /".PROJETO."/erro/" );
            }
            

        }

        public function pesquisar(){
            $contratos = new contratosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $fornecedores = new fornecedoresModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfornecedor') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_fornecedores = $fornecedores->listafornecedores("{$par}");

            $datas['fornecedores'] = $detalhes_fornecedores;
            $projetos = new projetosModel();

            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdprojeto') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }

            $detalhes_projetos = $projetos->listaprojetos("{$par}");

            $datas['projetos'] = $detalhes_projetos;
            if ($contratos->pacesso('pesquisar',$_SESSION[PROJETO]['cdperfil'])=='1') {
                $this->view('/contratos/pesquisar', $datas);
            } else {
                $this->view('/erro/index', $datas);
            }
        }

        public function insere(){
            $contratos = new contratosModel();
            $_POST['valor']= str_replace(",", ".", $_POST['valor']); 
            $insere = $contratos->inserecontratos($_POST, 'cdcontrato');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {

            //historico    

            $consulta = $contratos->listacontratos('cdcontrato='.$insere);
            $historico = new historicoModel();
            $dataHora = date("d/m/Y h:i:s");
            $dados_historico['tabela']='contrato';
            $dados_historico['descricao']=$consulta[0]['cdcontrato'];
            $dados_historico['datahora']=$dataHora;
            $dados_historico['cdprojeto']=$_SESSION[filtro]['cdprojeto'];
            $dados_historico['texto']='<b>Numero:</b> '.$consulta[0]['numero'].'<br/> <b>Objeto:</b> '.$consulta[0]['objeto'].'<br/><b>Licitação: </b>'.$consulta[0]['cdlicitacao'];
            $dados_historico['cdusuario']=$_SESSION[PROJETO]['cdusuario'];
            $dados_historico['tipo']='I';
            $insereh = $historico->inserehistorico($dados_historico, 'cdhistorico');

            //fim historico
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }

            if ($_POST['submit']=='Salvar e Continuar') {
            header( "Location: /".PROJETO."/contratos/editar/id/{$insere}" );
            } else {
            header( "Location: /".PROJETO."/contratos/" );
            }
        }


        public function inserem( Array $dados = null ){
            $contratos = new contratosModel();
            if ($dados == null) {$dados=$_POST;}

            if (!empty($dados['data'][0])) {
                $i=0;
                foreach ($dados['data'] as $key => $value) {
                    foreach ($dados as $key => $value) {
                        $dados_contratos[$key]=$dados[$key][$i];
                    }
                    $dados_contratos['valor']= str_replace(",", ".", $dados_contratos['valor']); 
                    $insere = $contratos->inserecontratos($dados_contratos,'cdcontrato');
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

            header( "Location: /".PROJETO."/contratos/" );


        }



        public function inserew(){
            $contratos = new contratosModel();

            foreach ($_POST as $key => $value) {
                $p = explode('@', $key);
                if ($p[0]=='contrato') {
                    $dados['contrato'][$p[1]]=$value;
                }
            }

            $inserep = $contratos->inserecontratos($dados['contrato'], 'cdcontrato');


            if ($insere==0) {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-danger';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Erro!</strong>&nbsp;Erro ao Cadastrar Informações.';
            } else {
              $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-success';
              $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Cadastro!</strong>&nbsp;Informações Cadastradas com sucesso.';
            }


            header( "Location: /".PROJETO."/contratos/" );
            

        }

        public function pesquisa(){
            $contratos = new contratosModel();
            $datas['vc'] = $this->modvinculados(get_class($this));
            $fornecedores = new fornecedoresModel();
            $par="";
            foreach ($datas['vc'] as $vc) {
                if ( ($vc['tipo']==0) and ($vc['valor']!='') and ($vc['chave']=='cdfornecedor') ) {
                    $par=$vc['chave'].'='.$vc['valor']; 
                }
            }
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

            $pesquisa = $contratos->pesquisacontratos($w);
            $datas['contratos'] = $pesquisa;
            if ($filtro!='') {
            $_SESSION[PROJETO]['mensagem']['tipo'] = 'alert alert-warning alert-dismissable';
            $_SESSION[PROJETO]['mensagem']['texto'] = '<strong>Parâmetros:</strong>'.$filtro;
            }
            $this->view('/contratos/index', $datas);

    }


}