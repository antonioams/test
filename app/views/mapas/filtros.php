<h4>Filtros</h4><select class="chosen" id="cdtipo" name="m3cdtipo[]" multiple><option value=""></option><?php foreach ($view_tipos as $tipos) {echo '<option value="'.$tipos['cdtipo'].'">'.$tipos['nome'].'</option>';}?></select>