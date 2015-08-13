<?php
    header("Content-type: text/css; charset: UTF-8");
    header('Cache-control: must-revalidate');
    
?>
body{
	height:100%;
	background-image                        : url('../images/bg.gif');
	font-size				: 0.75em;
	font-family				: verdana, arial, helvetica, sans-serif;
	font-weight				: normal;
}
a,a:active,a:visited{
	color					: #333;
	font-weight				: normal;
	text-decoration                         : none 
}
a:hover {
	color					: #666;
	font-weight				: bold;
	text-decoration			: none
}
#frame {
	height:100%;
	padding					: 0px;
	margin					: 25px auto 25px auto;
	width					: 74.999%; /*1200*/
        max-width:1200px;
	text-align				: left;
	background				: #fff;
	border					: 1px solid #9999cc;
	min-height:100%;
        /*height:100%;*/
        
    box-shadow: 0 0 25px black;
}
#contentleft{
	background				: #fff;
	float					: left;
	width					: 16.66666667%;/*200px*/
	min-height				: 100%;
	padding					: 0;

}
.menucenter{
	text-align				: center;
}
#contentcenter{
	background				: #fff;
	float					: right;
	width					: 83.1%;/*813   67.75%*//*613*/185+813=998 989/1200*100=83%
	padding					: 0;
	min-height				: 500px;
	border-left				: 1px solid #9999cc;
	border-right			: 1px solid #9999cc;
}
#contentright{
	text-align				: center;
	background				: #fff;
	float					: right;
	width					: 15.4%;/*185px*/
	min-height				: 100%;
	padding					: 0;
	
}
#contentheadermenu{
	color					: #fff;
}
#contentheader {
	height					: 130px;
	background				: url('../images/header.jpg') no-repeat 0px 0px;
}
.boxkop {
	border					: #999 1px solid;
	padding-left			: 4px;
	font-weight				: bold;
	font-size				: 11px;
	color					: #fff;
	height					: 18px
}
.boxc {
	border					: #ccc 1px solid;
	padding					: 4px 4px 4px 4px;
	font-size				: 11px;
	background-color		: #f2f3f4;
}
.boxkopl{
	text-align				: left;
	margin-top				: 7.5px;
	padding-left			: 8px;
	font-weight				: bold;
	background-image		: url('../images/leftbox.jpg');
	margin-bottom			: 5px;
	height					: 18px;
	color					: #fff;
}
.boxkoplboven{
	text-align				: left;
	margin-top				: 0px;
	padding-left			: 8px;
	font-weight				: bold;
	background-image		: url('../images/leftbox.jpg');
	margin-bottom			: 5px;
	height					: 18px;
	color                                   : white;
}
#contentheadermenu {
	background				: #fff;
}
#footer {
	background				: #fff;
	border-top				: 1px solid #9999cc;
}
.dan{
	border					: 0px solid black;
	width					: 100px;
	height					: 190px;
}
.padi,.padi:hover{
	color					: #333;
	text-decoration			: none;
	font-weight				: normal;
	border					: 0px solid black;
	width					: 150px;
	height					: 206px;
	display					: inline-block;
}
hr{
	width					: 90%;
}
#contentleft div{
	padding-left			: 6px;
}
#contentleft a{
	padding-left			: 12px;
}
p{
	padding: 15px;
}
#initiatie h1{
	margin-left: 15px;
	margin-top:15px;
	margin-bottom:0;
	color: #000080;
}
#initiatie p{
	text-align:left;
	margin-bottom:0px;
	margin-top:0px;
}
#initiatie a{
	text-align:left;
	margin-bottom:0px;
	margin-top:0px;
	font-weight:bold;
	text-decoration:underline;
}
#initiatie fieldset{
	padding-top:25px;
	text-align : center;
	border: 1px solid #9999cc;
	margin: 10px;
}
#initiatie fieldset form label{
	display:inline-block;
	width: 180px;
	margin-bottom:10px;
	text-align:left;
}
#initiatie fieldset form input{
	display:inline-block;
	width: 200px;
	margin-bottom:10px;
}
#voorkeur{
	position:relative;
	display:inline-block;
	width: 202px;
	margin-bottom:10px;
	left:-2px;
}
.mededeling{
	height: 75px;
	width: 360px;
	display:inline-block;
}
.nieuwsitem{
	margin:0px;
	margin-left:-15px;
	width:100%;
	padding:15px;
        padding-right:0px;
        padding-top:0px;/*nodig om bovenste menu weg te doen*/
}
.titel{
	height					: 18px;
	color					: #fff;
	display:block;
	background-image	: url('../images/leftbox.jpg');
}
.nieuwsitem img{
	max-width:100%;
	display: block;
	margin-left: auto;
	margin-right: auto;
}
.rechts{
	display:inline-block;
	width:25%;
	text-align:right;
}
.links{
	display:inline-block;
	width:75%;
	text-align:left;
}
.nieuwsitemtekst{
	display:inline-block;
	padding:7px;
}
#content{
	height:100%;
	width:100%;
	padding:15px;
	text-align: center;
}
#loginform{
	margin: 0 auto;
}
#loginform input{
	margin: 2.5px;
}


#contact{
	text-align:center;
}
#contact fieldset{
	width:75%;
	margin-left: auto;
	margin-right: auto;
}
#contact fieldset form label{
	display:inline-block;
	width: 180px;
	margin-bottom:10px;
	text-align:left;
}
#contact fieldset form input{
	display:inline-block;
	width: 180px;
	margin-bottom:10px;
}
#contact fieldset form input{
	display:inline-block;
	width: 180px;
	margin-bottom:10px;
}
#contact fieldset form div{
	margin-left: auto;
	margin-right: auto;
}
#initiatie fieldset form div{
	margin-left: auto;
	margin-right: auto;
}
fieldset form .bericht{
		display:inline-block;
	margin-left: auto;
	margin-right: auto;
	width:366px;
	text-align:left;
}
fieldset form .bericht textarea{
	width:100%;
	height:150px;
}

.errorr li{
	color:red;
	width: 100%;
}
.errorr ul{
	width:100%;
}
#nieuws{
	text-align:center;
	display: block;
	width:65%;
	margin-left: auto;
	margin-right: auto;
}
#nieuws table{
	width:100%;
}
#nieuws table td.left{
	text-align:left;
	width:120px;
}
#nieuws table td input{
	width:100%;
}
#nieuws table td textarea{
	width:100%;
	height:160px;
}
.melding{
        font-weight:bold;
	width:100%;
	text-align:center;
	display:block;
}
/*
#loginform{
	text-align: center;
}
.standaardform{
	margin:15px;
	display: block;
	margin-top				: 15px;
	width					: 250px;
	width:80%;
	padding					: 20px;
	border					: 1px solid #005FA2;/*DONKER:#005FA2 LICHT:#0B9BD8* HOVER:#0077B9
	-moz-border-radius		: 20px;
	border-radius			: 20px;
	-webkit-border-radius	: 20px;
	background				:  -moz-linear-gradient(19% 75% 90deg,#005FA2, #0B9BD8);
	background				:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#005FA2), to(#0B9BD8));
}
.standaardform input{
	-moz-border-radius		: 5px;
	border-radius			: 5px;
	-webkit-border-radius	: 5px;
	width					: 230px;
	background				: #F14628;
	padding					: 3px;
	margin-bottom			: 10px;
	border-top				: 1px solid #005FA2;
	border-left				: 0px;
	border-right			: 0px;
	border-bottom			: 0px;
-webkit-transition-property	: -webkit-box-shadow, background;
-webkit-transition-duration	: 0.25s;
	-moz-box-shadow			: 0px 0px 2px #000;
	-webkit-box-shadow		: 0px 0px 2px #000;
}
.standaardform textarea{
	-moz-border-radius		: 5px;
	border-radius			: 5px;
	-webkit-border-radius	: 5px;
	/*width					: 230px;
	padding					: 3px;
	margin-bottom			: 10px;
	border-top				: 1px solid #005FA2;
	border-left				: 0px;
	border-right			: 0px;
	border-bottom			: 0px;
-webkit-transition-property	: -webkit-box-shadow, background;
-webkit-transition-duration	: 0.25s;
	-moz-box-shadow			: 0px 0px 2px #000;
	-webkit-box-shadow		: 0px 0px 2px #000;
}
.standaardform input:hover {
	-webkit-box-shadow		: 0px 0px 4px #000;
	background				: #0077B9;
}
.standaardform textarea:hover {
	-webkit-box-shadow		: 0px 0px 4px #000;
	background				: #0077B9;
}
.standaardform input#submit{
	-moz-border-radius		: 5px;
	border-radius			: 5px;
	-webkit-border-radius	: 5px;
	padding					: 3px;
	color					: #009;
	/*width					: 236px;
	text-align				: center;
}
*/
#table_kalender{
	width:95%;
	margin-left: auto;
	margin-right: auto;
	margin-top: 2.5%;
}
.titelMaand{
	text-align:center;
	font-size: 48px;
	font-family: Comic Sans MS;
	color: #000000;
	font-weight: bold;
	font-style: normal;
	font-variant: normal;
	vertical-align: baseline;
	white-space: pre-wrap;
	background-color: transparent;
}
.debug{
    display: inline-block;
    background-color:red;
    margin:1.5px;
    padding:1.5px;
}
#eventTable{
    margin: 0 auto;
    margin-top:15px;
    width: 95%;
}
#eventTable td{
    border-bottom: 1px solid black;
}
#eventHeader{
    font-weight:bold;
}
.eventTitel{
    font-weight:bold;
}
.maandHeader{
    width:100%;
    text-align:center;
}
.maandHeader a{
    font-weight:bold;
    color: black;
}
.maandHeader a:hover{
    font-weight:bold;
    color: black;
}
.eventWanneer{
    width:17,5%;
}
.eventOmschijving{
    width:45%;
}
.eventLocatie{
    width:17,5%;
}
.eventMinNiveau{
    width:17,5%;
}
.eventAddToCalendar img{
    width:32px;
    height:32px;
}
.adminButton{
    width:24px;
    height:24px;
}
#DiveEventForm{
    margin: 15px auto 15px auto;
    width:650px;
}
#DiveEventForm form{
    width:100%;
    margin: 10px auto 10px auto;
}
#DiveEventForm input{
float:right;
    display:inline-block;
    width: 70%;
    margin-bottom:10px;
}
#DiveEventForm textarea{
float:right;
    margin-left: 50px;
    height:250px;
    display:inline-block;
    width: 70.5%;
    margin-bottom:10px;
}
#DiveEventForm select{
    display:inline-block;
    width: 70.5%;
    margin-bottom:10px;
    -ms-box-sizing:content-box;
    -moz-box-sizing:content-box;
    -webkit-box-sizing:content-box; 
    box-sizing:content-box;
}
#DiveEventForm label{
float:left;
    margin-left:25px;
    display:inline-block;
    width: 25%;
    margin-bottom:10px;
    text-align:left;
}
#DiveEventForm #submit{
    margin-left:25px;
    float:left;
    width: 90.5%;
}
@media screen and (max-width: 960px) {
.boxkopl,.boxkoplboven{
    padding:15px;
}
.nieuwsitem img{
	width:100%;
	display: block;
	margin-left: auto;
	margin-right: auto;
}
body{
	height:100%;
	background-image                        : url('../images/bg.gif');
	font-size				: 1em;
	font-family				: verdana, arial, helvetica, sans-serif;
	font-weight				: normal;
}
#contentheader {
	height					: 130px;
	background				: url('../images/header.jpg') no-repeat 0px 0px;
}
#frame {
        display:flex;
        flex-direction: row;
        flex-wrap:wrap;
	height:100%;
	padding					: 0px;
	margin					: 25px auto 25px auto;
	width					: 100%; /*1200*/
        max-width:1200px;
	text-align				: left;
	background				: #fff;
	border					: 1px solid #9999cc;
	min-height:100%;
        /*height:100%;*/
        box-shadow: 0 0 25px black;
}
#contentleft{
	background				: #fff;
	width					: 100%;/*200px*/
	padding					: 0;
}
#contentcenter{
	background				: #fff;
	float					: top;
	width					: 100%;/*813*//*613*/
	padding					: 0;
}
#contentright{
	text-align				: center;
	background				: #fff;
	width					: 100%;/*185px*/
	padding					: 0;
}
}