<?php
    header("Content-type: text/css; charset: UTF-8");
    header('Cache-control: must-revalidate');
?>
body{
	height:100%;
	background-image		: url('images/bg.gif');
	font-size				: 11px;
	font-family				: verdana, arial, helvetica, sans-serif;
	font-weight				: normal;
}
a,a:active,a:visited{
	color					: #333;
	font-weight				: normal;
	text-decoration			: none 
}
a:hover {
	color					: #666;
	font-weight				: bold;
	text-decoration			: none
}
#frame {
	height:100%;
	padding					: 0px;
	margin					: 1px auto 1px auto;
	width					: 1200px; /*1200*/
	text-align				: left;
	background				: #fff;
	border					: 1px solid #9999cc;
	height:100%;
}
#contentheadermenu{
	color					: #fff;
}
.headermenusub{
	width					:1194px;/*994*/
	height					:25px;
}
.headermenusub{
	font-size				: 1.1em;
	font-weight				: bold;
	padding					: 8px 3px 2px 3px;
	background-image		: url('images/contentheadermenu.jpg');
	vertical-align			: middle;
	height					: 23px;
	text-align				: left;
}
.headermenusub a , .headermenusub a:active,.headermenusub a:visited{
	padding					: 4px 15px 4px 15px;
	font-weight				: bold;
	color					: #ffffff;
	text-decoration			: none;
}
.headermenusub a:hover,.headermenusubsel,.headermenusubsel:visited,.headermenusubsel:hover,.headermenusubsel:active {
	color					: #333333;
	background-color		: #f4f5f6;
	text-decoration			: none;
}
#contentleft{
	background				: #fff;
	float					: left;
	width					: 200px;
	min-height				: 100%;
	padding					: 0;

}
#contentcenter{
	background				: #fff;
	float					: left;
	width					: 813px;/*613*/
	padding					: 0;
	min-height				: 500px;
	border-left				: 1px solid #9999cc;
	border-right			: 1px solid #9999cc;
}
#contentright{
	text-align				: center;
	background				: #fff;
	float					: right;
	width					: 185px;
	min-height				: 100%;
	padding					: 0;
	
}

#contentheader {
	height					: 130px;
	background				: url('images/header.jpg') no-repeat 0px 0px;
}
.boxkop {
	border					: #999 1px solid;
	padding-left			: 4px;
	font-weight				: bold;
	font-size				: 11px;
	background-image		: url('images/boxkop.jpg');
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
	margin-top				: 15px;
	padding-left			: 8px;
	font-weight				: bold;
	background-image		: url('images/leftbox.jpg');
	margin-bottom			: 5px;
	height					: 18px;
	color					: #fff;
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
}
.titel{
	height					: 18px;
	color					: #fff;
	display:block;
	background-image	: url('images/leftbox.jpg');
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
    width: 90%;
}
#eventHeader{
    font-weight:bold;
}
.eventTitel{
    font-weight:bold;
}