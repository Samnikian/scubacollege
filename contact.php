<?php
require_once('header.php');
?>
<div id="contact">
	<p>
		U kan ons contacteren via info@scubacollege.be of op 049999895. U kan ook gebruik maken van onderstaand formulier om ons een bericht te sturen.
	</p>
	<?php
        //unset($_SESSION['contact']);
        require_once('includes/Contact.class.php');
        $contact = new Contact();
        echo $contact->getOutput();
        ?>
</div>
<?php
require_once('footer.php');
?>