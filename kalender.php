<?php
require_once('header.php');
require_once "includes/JBBCode/Parser.php";
if(true){
	?>
	<table id="table_kalender" border="1">
		<tr><td colspan="5" class="titelMaand">Januari</td></tr>
		<tr>
			<td>DATUM</td>
			<td>OMSCHRIJVING - HOE DEELNEMEN</td>
			<td>OM HOE LAAT - WAAR</td>
			<td>MIN NIVEAU</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<?php
}
else{
	echo '<p class="melding">Er staat momenteel niets op de planning!</p>';
}
require_once('footer.php');
?>