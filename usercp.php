<?php
require_once('header.php');
$req = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
$action = filter_input(INPUT_POST, 'action');

if ($req === 'POST' && $action === 'changepassword') {
    
} elseif ($req === 'POST' && $action === 'changeinfo') {
    //changeinfo
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
} else {
    //SHOWFORMS
    ?>
    <fieldset>
        <legend>Wachtwoord wijzigen</legend>
        <form action="" method="POST">
            <label for="oudww">Oud wachtwoord</label><input type="password" id="OudWW" name="OudWW" /><br />
            <label for="nieuwwwa">Nieuw wachtwoord</label><input type="password" id="NieuwWWA" name="NieuwWWA" /><br />
            <label for="nieuwwwb">Bevestig nieuw wachtwoord</label><input type="password" id="NieuwWWB" name="NieuwWWB" /><br />
            <input type="submit" value="Wijzig wachtwoord" />
        </form>
    </fieldset>
    <fieldset>
        <legend>Nieuwe gebruiker toevoegen.</legend>
        <form action="" method="">
            <label for="lidnr">Lid Nummer</label><input type="text" id="lidnr" name="lidnr" placeholder="20150000" /><br />
            <label for="email">Email</label><input type="text" id="email" name="email" placeholder="lid@scubacollege.be" /><br />
            <input type="submit" value="Lid toevoegen!" />
        </form>
    </fieldset>
    <fieldset>
        <legend>Gebruiker blokkeren/deblokkeren</legend>
        <form action="" method="post">
            <script>
                $(document).ready(function ($) {
                    $('#customerAutocomplte').autocomplete({
                        source: 'suggest.php',
                        minLength: 2
                    });
                });
            </script>
            <input type="text" placeholder="Name" id="customerAutocomplte" class="ui-autocomplete-input" autocomplete="off" />
        </form>
    </fieldset>
    <fieldset>
        <legend>Gebruikers gegevens opvragen</legend>

    </fieldset>
    <?php
}
require_once('footer.php');
?>