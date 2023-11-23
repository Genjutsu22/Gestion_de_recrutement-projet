<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1.2.php</title>
</head>
<body>
    <?php
        $heure = date("H");

        echo "Hello PHP, nous sommes le " . date("Y-m-d") . "<br>";

        if ($heure >= 5 && $heure < 12) {
            echo "Bon matin";
        } elseif ($heure >= 12 && $heure < 18) {
            echo "Bonne après-midi";
        } else {
            echo "Bonne soirée";
        }
    ?>
     <h2>Variables d'environnement</h2>
    <table border="1">
        <tr>
            <th>Variable</th>
            <th>Valeur</th>
        </tr>
        <tr>
            <td>$SERVER_ADDR</td>
            <td><?php echo $_SERVER['SERVER_ADDR']; ?></td>
        </tr>
        <tr>
            <td>$HTTP_HOST</td>
            <td><?php echo $_SERVER['HTTP_HOST']; ?></td>
        </tr>
        <tr>
            <td>$REMOTE_ADDR</td>
            <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
        </tr>
        <tr>
            <td>gethostbyAddr($REMOTE_ADDR)</td>
            <td><?php echo gethostbyaddr($_SERVER['REMOTE_ADDR']); ?></td>
        </tr>
        <tr>
            <td>$HTTP_USER_AGENT</td>
            <td><?php echo $_SERVER['HTTP_USER_AGENT']; ?></td>
        </tr>
    </table>
    <h2>Variables d'environnement (phpInfo)</h2>
    <?php phpinfo(); ?>
</body>
</html>
