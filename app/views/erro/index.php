
<?php
include('app/views/topo.php');
?>
<div class="alert alert-danger">
<strong>Acesso Negado!</strong>&nbsp; Você não possue acesso a essa funcionalidade! Contate o Administrador do Sistema.
</div>
<a href="#" onclick="window.history.back();return false;" class="btn btn-default">Voltar</a>

<?php if (!empty($view_vc[1])) { ?> 
 </div>
</div>
</div>
<?php }  ?> 
<?php include('app/views/rodape.php'); ?>