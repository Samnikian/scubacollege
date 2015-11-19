<?php
define('DEBUG' , false);

define('INITIATIE_MAIL','info@mortelmans.org');
define('CONTACT_MAIL' , 'info@mortelmans.org');

define('SMTP_HOST','send.one.com');
define('SMTP_PORT','465');
define('SMTP_USER','info@mortelmans.org');
define('SMTP_PASSWORD','cef979c87dde47307934e1860dd4d301');
define('MAIL_FROM_ADDRESS', 'info@mortelmans.org');//website@scubacollege.be
define('MAIL_FROM_NAME','Scubacollege');
define('MAIL_CONTACT_SUBJECT','Bericht via scubacollege.be contactformulier.');
define('MAIL_INITIATIE_SUBJECT','Initiatieaanvraag via scubacollege.be');
define('MAIL_ALTBODY','Om dit bericht te kunnen lezen heb je een email client nodig die HTML ondersteund!');

define('CAPTCHA_SECRET','6LeuJgETAAAAAG91qXfn5H2g-tohJ5PEWjiicCUj');
define('CAPTCHA_SITEKEY','6LeuJgETAAAAABbDWzNMWgjZNvrFxzVdjg_bUNOz');

define('HOST','localhost');
define('USERNAME','scubacollege');
define('PASSWORD','scubacollege');
define('DATABASE','scubacollege');

define('GUEST',0);
define('USER',1);
define('INSTRUCTOR',2);//staff
define('STAFF',3);//planning
define('ADMIN',4);

define('EVENT_ORGANISATOR','Scubacollege');
define('EVENT_ORGANISATOR_EMAIL','info@scubacollege.be');
define('EVENT_DATUMFORMAAT','DD/MM/YYYY');
define('EVENT_TIMEZONE','40'); //40=Brussel
define('EVENT_CALENDAR_URL','http://scubacollege.be/kalender.php#');
        
define('FILE_CONTACT_TEMPLATE','includes/contacttemplate.html');
define('FILE_CONTACT_FORM','contact.php');
define('FILE_INITIATIE_TEMPLATE','includes/initiatietemplate.html');
define('FILE_INITIATIE_FORM','initiatie.php');

define('WEBMASTER_MAIL','webmaster@scubacollege.be');
define('WEBMASTER_NAME','Webmaster');
define('FILE_REGISTRATION_TEMPLATE','includes/registrationtemplate.html');
define('MAIL_REGISTRATION_SUBJECT','Registratie scubacollege.be account');