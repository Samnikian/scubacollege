<?php
require_once('header.php');

$query = 'SELECT * FROM `nieuws` ORDER BY `aangemaakt` DESC,`prioriteit` ASC;';
if($result = $db->query($query)){
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "<p class=\"nieuwsitem\">";
			echo "<strong class=\"titel\"><span class=\"links\">&nbsp;".$row['titel'];
			if($ingelogd && $_SESSION['user_level'] > INSTRUCTOR){
				echo "&nbsp;<a href=\"nieuws_bewerken.php?i=".$row['id']."\">[bewerken]</a>";
				echo "&nbsp;<a href=\"nieuws_verwijderen.php?i=".$row['id']."\">[verwijderen]</a>";
			}
                        echo "</span>";
			echo "<span class=\"rechts\">".date('d/m/Y',$row['aangemaakt'])."&nbsp;</span></strong>";
			$parser = new JBBCode\Parser();
			$parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
			$parser->parse($row['tekst']);
			echo "<span class=\"nieuwsitemtekst\">".$parser->getAsHtml()."</span>";
			if($row['foto'] !== 'geen'){
				echo "<br /><img src=\"".$row['foto']."\" />";
			}
			echo "</p>";
		}
	}
}
$result->close();
?>
<?php
require_once('footer.php');
?>


 
