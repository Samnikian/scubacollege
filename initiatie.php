<?php
require_once('header.php');
?>
<div id="initiatie">
    <h1>Duikschool - Gratis Duikinitiatie</h1>
    <p>
        <strong>Wat gaan we allemaal doen tijdens zo'n initiatie?</strong><br />
        Eerst geven we je een korte briefing over de gebruikte apparatuur en de basisprincipes van het 
        persluchtduiken. Daarna ga je al snel onder professionele begeleiding 
        het zwembad in en neem je al snel je eerste ademteugen onder water !
    </p>
    <p>
        <strong>Waar en wanneer gaan deze initiaties door?</strong><br />
        De initiaties gaan door in het Maanhoevebad, in Sint-Katelijne-Waver bij Mechelen op zaterdagmiddag 
        of op vrijdagavond in zwembad De Nekkerpool in Mechelen. Onderaan kan u een voorkeurstijdstip selecteren. 
        U krijgt van ons nog een bevestiging per e-mail.<!--Kontich wegdoen?????-->
    </p>
    <p>
        <strong>Zijn er vereisten?</strong><br />
        De minimumleeftijd is 10 jaar. U dient zich fijn en comfortabel te voelen in het water.
    </p>
    <p>
        <strong>Wat moet ik meebrengen?</strong>
        Zwemgerief en een handdoek!
    </p>
    <p>
        <strong>Hoe kan ik me inschrijven?</strong><br />
        Vul het onderstaande inschrijvingsformulier in en druk op verzend. Wij contacteren U voor een afspraak !<!--telefoon????-->
    </p>
    <p>
        <strong>Wat kan ik doen na deze duikinitiatie?</strong><br />
        Wanneer je het programma hebt afgerond, heb je reeds de 1ste stap gezet in de richting van een 
        internationaal erkend duikbrevet : het <a href="">PADI Open Water Diver</a><!--link invullen!!!!-->
        brevet. Vraag je instructeur om meer informatie.
    </p>
    <?php
    //unset($_SESSION['initiatie']);
    require_once('includes/Mail.class.php');
    require_once('includes/Initiatie.class.php');
    $initiatie = new Initiatie();
    echo $initiatie->getOutput();
    ?>
</div>
<?php
require_once('footer.php');
?>