<?php
session_start();
if($_SESSION["name"]) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLR Wintergames Adminpaneel</title>
    <link rel="stylesheet" href="style/main.css">
	<script src="https://kit.fontawesome.com/9a6dadeaeb.js" crossorigin="anonymous"></script>
</head>
<body>


<div class="nav">
    <p class="navMenuLink"><a href="../">Home</a></p>
    <p class="navMenuLink"><a href="logout.php">Uitloggen</a></p>
</div>
    

<?php
require '../config.php';
?>
<div class="container">
    <!-- Schaatsbaan tijdsloten -->
    <table>
        <tr>
            <th colspan=3>Schaatsbaan tijdsloten</th>
        </tr>
        <tr>
            <th>Tijdslot</th>
            <th>Max personen</th>
            <th></th>
        </tr>
        <?php
            $query = "SELECT * FROM settings_schaatsbaan";
            $result = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($item = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>" . $item['time'] . "</td>";
                        echo "<td>" . $item['max'] . "</td>";
                        echo "<td><a href='remove.php?id=" . $item['id'] . "&event=schaatsbaan'><i class='far fa-trash-alt buttons' aria-hidden='true'></i></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=3>Geen tijdsloten gevonden!</td></tr>";
            }
        ?>
        <tr>
            <th colspan="3">
                <a href="add.php?event=schaatsbaan">
                    <i class="far fa-plus-square" aria-hidden="true"></i> Tijdslot toevoegen
                </a>
            </th>
        </tr>
    </table>


    <!-- Curlingbaan tijdsloten -->
    <table>
        <tr>
            <th colspan=3>Curlingbaan tijdsloten</th>
        </tr>
        <tr>
            <th>Tijdslot</th>
            <th>Max personen</th>
            <th></th>
        </tr>
        <?php
            $query = "SELECT * FROM settings_curlingbaan";
            $result = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($item = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>" . $item['time'] . "</td>";
                        echo "<td>" . $item['max'] . "</td>";
                        echo "<td><a href='remove.php?id=" . $item['id'] . "&event=curlingbaan'><i class='far fa-trash-alt buttons' aria-hidden='true'></i></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=3>Geen tijdsloten gevonden!</td></tr>";
            }
        ?>
        <tr>
            <th colspan="3">
                <a href="add.php?event=curlingbaan">
                    <i class="far fa-plus-square" aria-hidden="true"></i> Tijdslot toevoegen
                </a>
            </th>
        </tr>
    </table>


    <!-- Skibaan tijdsloten -->
    <table>
        <tr>
            <th colspan=3>Skibaan tijdsloten</th>
        </tr>
        <tr>
            <th>Tijdslot</th>
            <th>Max personen</th>
            <th></th>
        </tr>
        <?php
            $query = "SELECT * FROM settings_skibaan";
            $result = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($item = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>" . $item['time'] . "</td>";
                        echo "<td>" . $item['max'] . "</td>";
                        echo "<td><a href='remove.php?id=" . $item['id'] . "&event=skibaan'><i class='far fa-trash-alt buttons' aria-hidden='true'></i></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan=3>Geen tijdsloten gevonden!</td></tr>";
            }
        ?>
        <tr>
            <th colspan="3">
                <a href="add.php?event=skibaan">
                    <i class="far fa-plus-square" aria-hidden="true"></i> Tijdslot toevoegen
                </a>
            </th>
        </tr>
    </table>
</div>
</body>
</html>

<?php
}else 
    header("Location:login.php");
?>