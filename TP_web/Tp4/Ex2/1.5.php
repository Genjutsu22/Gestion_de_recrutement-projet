<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Traitement Formulaire 1.5</title>
</head>
<body>
    <h2>Récuperation des données</h2>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $nom = isset($_GET["nom"]) ? $_GET["nom"] : "";
            $prenom = isset($_GET["prenom"]) ? $_GET["prenom"] : "";
            $sexe = isset($_GET["sexe"]) ? $_GET["sexe"] : "";
            $vins = isset($_GET["vins"]) ? $_GET["vins"] : [];

            echo "<p>Nom: $nom</p>";
            echo "<p>Prénom: $prenom</p>";
            echo "<p>Sexe: $sexe</p>";

            if (!empty($vins)) {
                echo "<p>Vins préférés:</p>";
                echo "<ul>";
                foreach ($vins as $vin) {
                    echo "<li>$vin</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Aucun vin sélectionné</p>";
            }
        }
    ?>
</body>
</html>
