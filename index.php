<!DOCTYPE html>
<html lang="ne">
<head>
	<title>GLR Wintergames</title>

	<meta charset="utf-8">
	<meta name="description" content="Wintergames Grafisch Lyceum Rotterdam">
  	<meta name="author" content="Grafisch Lyceum">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="style/style.css">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/9a6dadeaeb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://alcdn.msauth.net/browser/2.13.1/js/msal-browser.js"></script>
    <script type="text/javascript" src="js/auth.js"></script>
	<script src="js\wintergames.js" defer></script>
</head>
<body>
<div id="overlay">
    <div id="qrpopup">
    </div>
</div>  

	<!--Slidediv die naar links swipet met info en qr knop-->
	<div class="slideHouder">
		<div id="infoSlideQR" class="infoSlideQR">
			<p class='vraagQR' onclick="infoTerug()"></p>
			<a class="btnLink" onclick="inloggen()" id="inloggen">QR CODE AANVRAGEN</a>
			<p class="infoTerugQR" onclick="infoTerug()"></p>
		</div>
	
		<!--Slidediv die naar rechts swipet met info en Reserveer knop-->
		<div id="infoSlideRes" class="infoSlideRes">
			<p class='vraagQR' onclick="infoTerug()"></p>
			<a class="btnLink" href="./reserveren.php">Reserveren</a>
			<p class="infoTerugQR" onclick="infoTerug()"></p>
		</div>
	</div>

	<!--navbar met links QRcode en rechts Reserveren-->
	<div class="nav">
		<!--Links QR als je er op drukt slide de helft met informatie en een knop-->
		<p onclick="slideZijdeQR()" class="navMenuLink">QR Code</p>
		<!--Rechts Reserveren als je er op drukt slide de helft met informatie en een knop-->
		<p onclick="slideZijdeRes()" class="navMenuLink">Reserveren</p>
	</div>

	<!--Achtergrond foto/video die de hele pagina mooi bedekt (De navbar en slides moeten hiervoor blijven)-->
	<div class="voorPaginaInhoud">
        <div class='frontpageDesign'>
            <div class='frontpageLogo'>
                <img width= '330vw' src='../media/Logo_WinterGames_2021.png' />
            </div>
            <div class='frontpageSlogan'>
                <h1 class='koptekstFrontpage'>Wintergames 2021</h1>
            </div>
        </div>

		<!--Informatie over de games en spellen die er gaan komen-->
		<div class="onderPagina">
			<p onclick="naarOnder()"></p>
		</div>

	</div>

	<div id="evenementInfo" class="evenementInfo">
		<div class="inhoudEvenementInfo">
            <h1>Wintergames spellen:</h1>
            <p style="color: red">CORONA-UPDATE: De Wintergames gaan helaas niet door i.v.m. de huidige lockdown</p>
            <br>
            <h2>-Curling</h2>
            <h2>-Schaatsen</h2>
            <h2>-Skiën</h2>

			<!--<p>verdere info</p>-->

		</div>

	</div>

</body>
</html>