<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLR Wintergames Tijdslot toevoegen</title>
    <script type="text/javascript" src="js/script.js" defer></script>
</head>
<body>
	<h1>Vul de gegevens van het tijdslot in:</h1>
    <form method="post" action="addProcess.php">
        <table>
            <tr>
                <td>Tijdslot:</td>
                <td><input type="text" name="time" required placeholder="bijv: 15:15 - 15:30"/></td>
            </tr>
            <tr>
                <td>Aantal mensen:</td>
                <td><input type="number" name="max" min="1" required placeholder="bijv: 30"/></td>
            </tr>
            <tr>
                <td><input id="event" name="event" type="hidden"></td>
            <tr>
                <td> </td>
                <td><input type="submit" name="send" value="Tijdslot toevoegen"></td>
            </tr>
        </table>
    </form>
</body>
</html>