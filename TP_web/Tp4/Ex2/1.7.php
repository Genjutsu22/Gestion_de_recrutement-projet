<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement Formulaire 1.7</title>
</head>
<body>
    <h2>Texte saisi avec les caractères de nouvelle ligne convertis en balises &lt;br&gt;</h2>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $zoneTexte = isset($_POST["zoneTexte"]) ? $_POST["zoneTexte"] : "";
            $texteAvecBr = nl2br($zoneTexte);

            echo $texteAvecBr;
        }
    ?>
</body>
</html>
