			<br clear="all">
		</div>
                <div id="contentleft">
                <!--<div class="boxkopl">Leren duiken</div>-->
                <div class="boxkoplboven">Startpagina</div>
                <a href="index.php">Home</a><br />


                <div class="boxkopl">Duikschool</div>
                <a href="initiatie.php">Duikinitiatie</a><br />
                <a href=""> Leer nu duiken</a><br />
                <a href="">Locatie & planning</a><br />
                <a href="opleidingen.php">Padi duikopleidingen</a><br />

                <div class="boxkopl">Club</div>
                <a href="">Informatie</a><br />
                <a href=""> Activiteiten</a><br />
                <a target="_blank" href="http://www.facebook.com/scubacollege#!/scubacollege?sk=photos" > Foto album</a><br />

                <div class="boxkopl">Contact</div>
                <a href="">Wie zijn wij ?</a><br />

                <div class="boxkopl">Informatief</div>
                <a href="links.php">Interessante links</a>
                <div class="boxkopl">Social Media</div>
                <div class="menucenter"><?php require_once('includes/socialmedia.html'); ?></div>
                <?php
                if ($ingelogd) {
                    switch ($_SESSION['user_level']) {
                        case ADMIN:
                            echo "<div class=\"boxkopl\">Admin</div>";
                            echo "<a href=\"nieuws_toevoegen.php\">Nieuws Item Toevoegen</a><br />";
                            echo "<a href=\"event_toevoegen.php\">Kalender Item Toevoegen</a><br />";
                            echo "<a href=\"opleidingen.php?action=add\">Opleiding Toevoegen</a><br />";
                            break;
                        case STAFF:
                            echo "<div class=\"boxkopl\">Staff</div>";
                            echo "<a href=\"nieuws_toevoegen.php\">Nieuws Item Toevoegen</a><br />";
                            echo "<a href=\"event.php\">Kalender Item Toevoegen</a><br />";
                            echo "<a href=\"opleidingen.php?action=add\">Opleiding Toevoegen</a><br />";
                            break;
                        case INSTRUCTOR:
                            echo "<div class=\"boxkopl\">Instructeur</div>";
                            break;
                        case USER:
                            echo "<div class=\"boxkopl\">Leden</div>";
                            break;
                    }
                    echo "<a href=\"logout.php\">Uitloggen</a><br />";
                } else {
                    require_once('includes/loginform.html');
                }
                ?>
                    
                    <div class="boxkopl">Onze partners</div>
                    <div class="menucenter">
                        <a class="padi" href="http://www.padi.com/scuba/?LangType=1043" target="_blank"><img src="images/padi.gif">
                        <br />RF S-799086</a>
                        <hr>
                        <a href="https://www.daneurope.org/home" target="_blank"><img class="dan" src="images/dan.jpg"></a>
                        <hr>
                        <!--<br clear="all">-->
                    </div>
		</div>
		<br clear="all">
	</div>
	<script type="text/javascript">
		var gajshost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write("\<script src='" + gajshost + "google-analytics.com/ga.js' type='text/javascript'>\<\/script>" );
		</script>
		<script type="text/javascript">
		var pagetracker = _gat._gettracker("ua-1612255-7");
		pagetracker._initdata();
		pagetracker._trackpageview();
	</script>
	</body>
</html>
<?php
    ob_end_flush();
?>