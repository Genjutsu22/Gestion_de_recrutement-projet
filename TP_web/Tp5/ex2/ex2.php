<?php
include('../connection.php');

if(isset($_POST['search'])){
    if(!empty($_POST['search-value'])){
        $cmd = "SELECT * FROM Annuaire WHERE nom LIKE :search OR prenom LIKE :search";
        $query = $conn->prepare($cmd);
        $searchValue = '%' . $_POST['search-value'] . '%';
        $query->bindParam(':search', $searchValue, PDO::PARAM_STR);
        $query->execute();
        $val = $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

if(isset($_POST['ajouter'])){
    try {
        $cmd = "INSERT INTO Annuaire VALUES (:nom, :prenom, :num_post)";
        $query = $conn->prepare($cmd);
        $query->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $query->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $query->bindParam(':num_post', $_POST['num_post'], PDO::PARAM_STR);
        $query->execute();
    } catch (PDOException $e) {
        echo "Erreur d'ajout : " . $e->getMessage();
    }
}
if(isset($_POST['modifier'])){
    try {
        $cmd = "UPDATE Annuaire SET num_post = :num_post WHERE nom = :nom AND prenom = :prenom";
        $query = $conn->prepare($cmd);
        $query->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $query->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $query->bindParam(':num_post', $_POST['num_post'], PDO::PARAM_STR);
        $query->execute();
    } catch (PDOException $e) {
        echo "Erreur de modification : " . $e->getMessage();
    }
}
if(isset($_POST['supprimer'])){
    try {
        $cmd = "delete from Annuaire WHERE nom = :nom AND prenom = :prenom";
        $query = $conn->prepare($cmd);
        $query->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $query->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $query->execute();
    } catch (PDOException $e) {
        echo "Erreur de supression : " . $e->getMessage();
    }
}
$cmd = "select * from Annuaire";
$query = $conn->prepare($cmd);
$query->execute();
$tab = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP5 - Ex2</title>
</head>
<body>
    <div>
        <form action="" method="post">
            <input type="search" name="search-value">
            <input type="submit" name="search"value="Rechercher">
        </form>
    </div>
    <div>
        <br>
        <?php  
        echo '<table border="1">';
        echo '<tr><th>Nom</th><th>Prenom</th><th>numero de poste</th></tr>';     
        if (!empty($val) ) {
            foreach ($val as $row) {
                echo '<tr>';
                echo '<td>' . $row['nom'] . '</td>';
                echo '<td>' . $row['prenom']. '</td>';
                echo '<td>' . $row['num_post']. '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No results found.</td></tr>';
        }
        
        echo '</table>';
        ?>
    </div>
    <br>
    <strong>Ajout</strong>
    <div>
        <br>
        <form action="" method="post">
           <span for="nom">Nom : </span>
           <input type="text" name="nom" id="nom" required >
           <span for="prenom">Prenom : </span>
           <input type="text" name="prenom" id="prenom" required >
           <span for="num_post">Numero de poste : </span>
           <input type="text" name="num_post" id="num_post" required>
           <input type="submit" name="ajouter" value="ajouter">
        </form>
    </div>
    <div>
        <br>
        <?php  
        echo '<table border="1">';
        echo '<tr><th>Nom</th><th>Prenom</th><th>numero de poste</th></tr>';     
        if (!empty($tab) ) {
            foreach ($tab as $row) {
                echo '<tr>';
                echo '<td>' . $row['nom'] . '</td>';
                echo '<td>' . $row['prenom']. '</td>';
                echo '<td>' . $row['num_post']. '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="3">No results found.</td></tr>';
        }
        
        echo '</table>';
        ?>
    </div>
    <br>
    <strong>Modification</strong>
    <div>
        <br>
        <form action="" method="post">
           <span for="nom">Nom : </span>
           <input type="text" name="nom" id="nom" required >
           <span for="prenom">Prenom : </span>
           <input type="text" name="prenom" id="prenom" required >
           <span for="num_post">Numero de poste : </span>
           <input type="text" name="num_post" id="num_post" required>
           <input type="submit" name="modifier" value="modifier">
        </form>
    </div>
    <br>
    <strong>Supression</strong>
    <div>
        <br>
        <form action="" method="post">
           <span for="nom">Nom : </span>
           <input type="text" name="nom" id="nom" required >
           <span for="prenom">Prenom : </span>
           <input type="text" name="prenom" id="prenom" required >
           <input type="submit" name="supprimer" value="supprimer">
        </form>
    </div>
</body>
</html>