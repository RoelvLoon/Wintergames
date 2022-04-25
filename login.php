<?php
    session_start();
    $message="";
    if(count($_POST)>0) {
        include_once 'configQR.php';
        $result = mysqli_query($mysqli,"SELECT * FROM login_user WHERE username='" . mysqli_real_escape_string($mysqli, $_POST["username"]) . "' and password = '". mysqli_real_escape_string($mysqli, $_POST["password"])."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        } else {
         $message = "<p>Onjuiste inlog gegevens.</p>";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:scanQR.php");
    }
?>
<html>
    <head>
        <title>Inloggen</title>
        <link rel="stylesheet" href="style/inlog.css">
        <script src="https://kit.fontawesome.com/9a6dadeaeb.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <div id="page">
        <div class="popup">
            <form name="frmUser" method="post" action="" align="center">
            <h1 id="inlogText">Inloggen</h1>
                <input class="inlog" placeholder="Gebruikersnaam" type="text" name="username">
                <br><br>
                <!-- ' OR '1'='1 -->
                <input class="inlog" placeholder="Wachtwoord" type="password" name="password">
                <div class="message">
                    <br>
                    <?php if($message!="") { 
                        echo $message; }
                    ?>
                </div>
                <div id="inlogButton">
                    <input class="btnLink" type="submit" name="submit" value="Inloggen">
                </div>
            </form>
        </div>
    </div>
    </body>
</html>