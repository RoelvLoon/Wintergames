<?php
require 'config.php';

?>

<!DOCTYPE html>
<html lang="nl">
<head>
	<title>GLR Wintergames Events</title>

	<meta charset="utf-8">
	<meta name="description" content="Wintergames Grafisch Lyceum Rotterdam">
  	<meta name="author" content="Grafisch Lyceum">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="style/main.css">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/9a6dadeaeb.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://alcdn.msauth.net/browser/2.13.1/js/msal-browser.js"></script>
    <script type="text/javascript" src="js/ui.js" defer></script>
    <script type="text/javascript" src="js/auth.js" defer></script>
    <script type="text/javascript" src="js/register.js" defer></script>
</head>
<body> 
	<!--navbar met links QRcode en rechts Reserveren-->
	<div class="nav">
		<!--Links QR als je er op drukt slide de helft met informatie en een knop-->
		<p class="navMenuLink"><a href="../">Home</a></p>
		<!--Rechts Reserveren als je er op drukt slide de helft met informatie en een knop-->
		<p id='logout' class="navMenuLink">Uitloggen</p>
		<p id='login' onclick="signIn()" class="navMenuLink">Inloggen</p>
	</div>

	<!--Achtergrond foto/video die de hele pagina mooi bedekt -->
	<div class="voorPaginaInhoud">

        <!-- Login scherm (zichtbaar wanneer je niet ingelogd bent) -->
        <div class="eventKeuze eventGekozen" id="loginscreen">
            <div class="textContainer">
                <h1>Voorkeur events</h1>
                <p class="letopText">Je moet eerst inloggen om je voorkeuren te kunnen kiezen</p>
            </div>
            <div class="buttonContainer">
                <div>
                    <a class="btnLink btnWidth" href="../">Terug</a>
                    <a class="btnLink btnWidth" onclick="signIn()">Inloggen</a>
                </div>
            </div>
        </div>

        <!-- Beginscherm (zichtbaar wanneer je ingelogd bent) -->
        <div class="eventKeuze" id="main">
            <div class="textContainer">
                <h1 id="userQuestionText">Wat wil je doen?</h1>
                <div class="voorkeurButton">
                    <a class="btnLink btnNoMargin" href="#">Geboekte tijden bekijken</a>
                </div>
                <hr>
            </div>
            <div class="buttonContainer">
                <a class="btnLink" onclick="chooseEvent('schaatsbaan')">Schaatsbaan</a>
                <a class="btnLink" onclick="chooseEvent('curlingbaan')">Curlingbaan</a>
                <a class="btnLink" onclick="chooseEvent('skibaan')">Skibaan</a>
            </div>
            <div class="aantalContainer">
                <div class="aantalText">
                    <p>vrije plaatsen:</p>
                </div>
                <div class="aantalDivContainer">
                    <div class="eventAantal"><p>
                        <?php
                        // Check wat de max personen in het tijdslot zijn
                        $maxQuery = 'SELECT `max` FROM `settings_schaatsbaan`';
                        $maxResult = mysqli_query($mysqli, $maxQuery);
                        // Check hoeveel mensen al zijn ingeschreven voor deze activiteit
                        $amountQuery = "SELECT * FROM `voorkeuren` WHERE activity = 'schaatsbaan'";
                        $amountResult = mysqli_query($mysqli, $amountQuery);
                        // Check of maxquery een geldige result heeft
                        if (!$maxResult) {
                            echo '??';
                            exit;
                        } else { // Zo ja, tel dan alle 'max' integers bij elkaar op en echo het min de amountRegistered.
                            $i = 0;
                            $amountRegistered = mysqli_num_rows($amountResult);
                            while ($item = mysqli_fetch_assoc($maxResult)) {
                                $i = $i + $item["max"];
                            }
                            echo $i - $amountRegistered;
                        }?>
                    </p></div>
                    <div class="eventAantal"><p>
                        <?php
                        // Check wat de max personen in het tijdslot zijn
                        $maxQuery = 'SELECT `max` FROM `settings_curlingbaan`';
                        $maxResult = mysqli_query($mysqli, $maxQuery);
                        // Check hoeveel mensen al zijn ingeschreven voor deze activiteit
                        $amountQuery = "SELECT * FROM `voorkeuren` WHERE activity = 'curlingbaan'";
                        $amountResult = mysqli_query($mysqli, $amountQuery);
                        // Check of maxquery een geldige result heeft
                        if (!$maxResult) {
                            echo '??';
                            exit;
                        } else { // Zo ja, tel dan alle 'max' integers bij elkaar op en echo het min de amountRegistered.
                            $i = 0;
                            $amountRegistered = mysqli_num_rows($amountResult);
                            while ($item = mysqli_fetch_assoc($maxResult)) {
                                $i = $i + $item["max"];
                            }
                            echo $i - $amountRegistered;
                        }?>
                    </p></div>
                    <div class="eventAantal"><p>
                        <?php
                        // Check wat de max personen in het tijdslot zijn
                        $maxQuery = 'SELECT `max` FROM `settings_skibaan`';
                        $maxResult = mysqli_query($mysqli, $maxQuery);
                        // Check hoeveel mensen al zijn ingeschreven voor deze activiteit
                        $amountQuery = "SELECT * FROM `voorkeuren` WHERE activity = 'skibaan'";
                        $amountResult = mysqli_query($mysqli, $amountQuery);
                        // Check of maxquery een geldige result heeft
                        if (!$maxResult) {
                            echo '??';
                            exit;
                        } else { // Zo ja, tel dan alle 'max' integers bij elkaar op en echo het min de amountRegistered.
                            $i = 0;
                            $amountRegistered = mysqli_num_rows($amountResult);
                            while ($item = mysqli_fetch_assoc($maxResult)) {
                                $i = $i + $item["max"];
                            }
                            echo $i - $amountRegistered;
                        }?>
                    </p></div>
                </div>
            </div>
        </div>

        <!-- Schaatsbaan scherm (zichtbaar wanneer je op schaatsbaan klikt vanuit het beginscherm)-->
        <div class="eventKeuze eventGekozen" id="schaatsbaan">
            <div class="textContainer">
                <h1>Schaatsbaan</h1>
                <p class="letopText">LET OP!<br>Door deze handeling te verrichten maak je geen reservering!
                    Je geeft hier alleen je voorkeur aan voor een tijd. Deze hoeft dus niet definitief te zijn.
                </p>
            </div>
            <div class="buttonContainer">
                <?php $activity = "schaatsbaan";?>
                <select id="<?php echo $activity; ?>SelectBox" class="eventTime">
                    <?php
                        $query = "SELECT * FROM settings_" . $activity;
                        $result = mysqli_query($mysqli, $query);
                        if (!$result) {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Niet beschikbaar</option>";
                            exit;
                        } if (mysqli_num_rows($result) > 0) {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Tijdslot selecteren</option>";
                            while ($item = mysqli_fetch_assoc($result)) {

                                $amountQuery = 'SELECT * FROM voorkeuren WHERE time = "' . $item["time"] . '" AND activity = "' . $activity . '"';
                                $resultAmount = mysqli_query($mysqli, $amountQuery);

                                if (!$resultAmount) {
                                    $amountOfPeople = "??";
                                } else {
                                    $amountOfPeople = mysqli_num_rows($resultAmount);
                                }

                                echo "<option value='" . $item['time'] . "'>";
                                    echo $item['time'] . " (" . $amountOfPeople . "/" . $item['max'] . ")";
                                echo "</option>";
                            }
                        } else {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Niet beschikbaar</option>";
                        }
                    ?>
                </select>
                <div>
                    <a class="btnLink btnWidth" href="#" onclick="window.location.reload(true);">Terug</a>
                    <a class="btnLink btnWidth" onclick="inschrijven('<?php echo $activity; ?>')">Inschrijven</a>
                </div>
            </div>
        </div>

        <!-- Curlingbaan scherm (zichtbaar wanneer je op curlingbaan klikt vanuit het beginscherm)-->
        <div class="eventKeuze eventGekozen" id="curlingbaan">
            <div class="textContainer">
                <h1>Curlingbaan</h1>
                <p class="letopText">LET OP!<br>Door deze handeling te verrichten maak je geen reservering!
                    Je geeft hier alleen je voorkeur aan voor een tijd. Deze hoeft dus niet definitief te zijn.
                </p>
            </div>
            <div class="buttonContainer">
            <?php $activity = "curlingbaan";?>
                <select id="<?php echo $activity; ?>SelectBox" class="eventTime">
                    <?php
                        $query = "SELECT * FROM settings_" . $activity;
                        $result = mysqli_query($mysqli, $query);
                        if (!$result) {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Niet beschikbaar</option>";
                            exit;
                        } if (mysqli_num_rows($result) > 0) {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Tijdslot selecteren</option>";
                            while ($item = mysqli_fetch_assoc($result)) {

                                $amountQuery = 'SELECT * FROM voorkeuren WHERE time = "' . $item["time"] . '" AND activity = "' . $activity . '"';
                                $resultAmount = mysqli_query($mysqli, $amountQuery);

                                if (!$resultAmount) {
                                    $amountOfPeople = "??";
                                } else {
                                    $amountOfPeople = mysqli_num_rows($resultAmount);
                                }

                                echo "<option value='" . $item['time'] . "'>";
                                    echo $item['time'] . " (" . $amountOfPeople . "/" . $item['max'] . ")";
                                echo "</option>";
                            }
                        } else {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Niet beschikbaar</option>";
                        }
                    ?>
                </select>
                <div>
                    <a class="btnLink btnWidth" href="#" onclick="window.location.reload(true);">Terug</a>
                    <a class="btnLink btnWidth" onclick="inschrijven('<?php echo $activity; ?>')">Inschrijven</a>
                </div>
            </div>
        </div>

        <!-- Skibaan scherm (zichtbaar wanneer je op skibaan klikt vanuit het beginscherm)-->
        <div class="eventKeuze eventGekozen" id="skibaan">
            <div class="textContainer">
                <h1>Skibaan</h1>
                <p class="letopText">LET OP!<br>Door deze handeling te verrichten maak je geen reservering!
                    Je geeft hier alleen je voorkeur aan voor een tijd. Deze hoeft dus niet definitief te zijn.
                </p>
            </div>
            <div class="buttonContainer">
            <?php $activity = "skibaan";?>
                <select id="<?php echo $activity; ?>SelectBox" class="eventTime">
                    <?php
                        $query = "SELECT * FROM settings_" . $activity;
                        $result = mysqli_query($mysqli, $query);
                        if (!$result) {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Niet beschikbaar</option>";
                            exit;
                        } if (mysqli_num_rows($result) > 0) {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Tijdslot selecteren</option>";
                            while ($item = mysqli_fetch_assoc($result)) {

                                $amountQuery = 'SELECT * FROM voorkeuren WHERE time = "' . $item["time"] . '" AND activity = "' . $activity . '"';
                                $resultAmount = mysqli_query($mysqli, $amountQuery);

                                if (!$resultAmount) {
                                    $amountOfPeople = "??";
                                } else {
                                    $amountOfPeople = mysqli_num_rows($resultAmount);
                                }

                                echo "<option value='" . $item['time'] . "'>";
                                    echo $item['time'] . " (" . $amountOfPeople . "/" . $item['max'] . ")";
                                echo "</option>";
                            }
                        } else {
                            echo "<option value='tijdslot' selected='true' disabled='disabled'>Niet beschikbaar</option>";
                        }
                    ?>
                </select>
                <div>
                    <a class="btnLink btnWidth" href="#" onclick="window.location.reload(true);">Terug</a>
                    <a class="btnLink btnWidth" onclick="inschrijven('<?php echo $activity; ?>')">Inschrijven</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>