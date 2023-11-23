<?php
include('../connection.php');
if (!empty($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    $cmd = "select * from produit where id_cat = :id_cat";
    $query = $conn->prepare($cmd);
    $query->bindParam(':id_cat', $category_id, PDO::PARAM_STR);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<form id="articleForm" action="fiche.php" method="post">';
    echo '<select id="categoryDropdown" name="id_prod" onchange="submitForm()">';
    echo '<option value="">Select Product</option>';
    foreach ($products as $product) {
        echo '<option value="' . $product['id_prod'] . '">' . $product['designation'] . '</option>';
    }
    echo '</select>';
}
echo '</form>';
?>
<script>
function submitForm() {
    document.getElementById("articleForm").submit();
}
</script>
