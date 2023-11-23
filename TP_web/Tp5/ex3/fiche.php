<?php
include('../connection.php');
if (!empty($_POST['id_prod'])) {
    $product_id = $_POST['id_prod'];

    $cmd = "SELECT * FROM PRODUIT WHERE id_prod = :id_prod";
    $query = $conn->prepare($cmd);
    $query->bindParam(':id_prod', $product_id, PDO::PARAM_INT);
    $query->execute();
    $productDetails = $query->fetch(PDO::FETCH_ASSOC);
    echo '<p><strong> ID : </strong>' . $productDetails['id_prod'] . '</p>';
    echo '<p><strong> Designation : </strong> '. $productDetails['designation'] . '</p>';
    echo '<p><strong> Marque : </strong>' . $productDetails['marque'] . '</p>';
    echo '<p> <strong>Prix UHT :</strong> ' . $productDetails['prix_uht'] . '</p>';
    echo '<p> <strong>Quantité en stock : </strong>' . $productDetails['qstock'] . '</p>';
}
?>
