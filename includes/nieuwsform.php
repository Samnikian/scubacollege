<form id="nieuws" action="<?php if(isset($action)){echo $action;}?>" enctype="multipart/form-data" method="post" class="standaardform"> 
<table>
	<tr>
		<td colspan="2"><h1>Een nieuws item toevoegen/aanpassen!</h1></td>
	</tr>
	<tr>
		<td class="left">Titel</td>
		<td><input type="text" name="titel" id="titel" <?php if(isset($titel)){echo 'value="'.$titel.'"';}?> /></td>
	</tr>
	<tr>
		<td class="left">Tekst/Inhoud</td>
		<td><textarea id="tekst" name="tekst"><?php if(isset($tekst)){echo $tekst;}?></textarea></td>
	</tr>
	<?php
	if(isset($foto)){
		echo '<tr><td colspan="2"><b>Huidige foto: '.$foto.'</b><br /></td></tr>';
		if($foto != 'geen'){
			echo '<tr><td><img height="100px" width="150px;" src="'.$foto.'" /></td><td><input type="checkbox" name="delete" id="delete" /><label for="delete">Huidige foto verwijderen.</label><input type="hidden" name="path" value="'.$foto.'" /></td></tr>';
		}
	}
	?>
	<tr>
		<td class="left">Foto</td>
		<td><input id="foto" name="foto" type="file" /></td>
	</tr>
	<tr>
		<td class="left">Prioriteit</td>
		<td>
			<?php
			if(!isset($prioriteit)){
				echo "<select name=\"prioriteit\" id=\"prioriteit\"><option value=\"1\" selected>1</option><option value=\"2\">2</option><option value=\"3\">3</option></select>";
			}
			else{
				echo "<select name=\"prioriteit\" id=\"prioriteit\"><option value=\"1\"";
				if($prioriteit==1){
					echo " selected ";
				}
				echo ">1</option><option value=\"2\"";
				if($prioriteit==2){
					echo " selected ";
				}
				echo ">2</option><option value=\"3\"";
				if($prioriteit==3){
					echo " selected ";
				}
				echo ">3</option></select>";
			}
			if(isset($id)){
				echo '<input type="hidden" name="id" value="'.$id.'" />';
			}
			?>
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="Opslaan" /></td>
	</tr>
</table>
</form>