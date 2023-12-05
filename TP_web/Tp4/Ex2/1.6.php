<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire 1.6</title>
</head>
<body>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET" && !isset($_POST["formulaire_envoye"])) {
            afficherFormulaire();
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formulaire_envoye"])) {
            traiterDonnees();
            
        }
        
        function afficherFormulaire() {
            echo '<h2>Formulaire 1.6</h2>';
            echo '<form action="1.6.php" method="POST">';
            echo '<label for="nom">Nom:</label>';
            echo '<input type="text" id="nom" name="nom" required><br>';

            echo '<label for="prenom">Prénom:</label>';
            echo '<input type="text" id="prenom" name="prenom" required><br>';

            echo '<label for="sexe">Sexe:</label>';
            echo '<select id="sexe" name="sexe">';
            echo '<option value="M">Masculin</option>';
            echo '<option value="F">Féminin</option>';
            echo '</select><br>';

            echo '<label for="vins">Vins:</label>';
            echo '<select id="vins" name="vins[]" multiple>';
            echo '<option value="bordeaux">Bordeaux</option>';
            echo '<option value="beaujolais">Beaujolais</option>';
            echo '<option value="loire">Loire</option>';
            echo '</select><br>';

            echo '<input type="hidden" name="formulaire_envoye" value="1">';
            echo '<input type="submit" value="Envoyer">';
            echo '</form>';
        }

        function traiterDonnees() {
            $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
            $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
            $sexe = isset($_POST["sexe"]) ? $_POST["sexe"] : "";
            $vins = isset($_POST["vins"]) ? $_POST["vins"] : [];

            echo '<h2>Récapitulatif des données</h2>';
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
