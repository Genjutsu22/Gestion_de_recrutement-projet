<?php
include('../connection.php');
$cmd = "SELECT * FROM categorie";
$query = $conn->prepare($cmd);
$query->execute();
$tab = $query->fetchAll(PDO::FETCH_ASSOC);

echo '<form id="categoryForm" method="post" action="menu2.php">';
echo '<select id="categoryDropdown" name="category_id" onchange="submitForm2()">';
echo '<option value="">Select Category</option>';
foreach ($tab as $category) {
    echo '<option value="' . $category['id_cat'] . '">' . $category['designation'] . '</option>';
}
echo '</select>';
echo '</form>';
?>
<script>
function submitForm2() {
    document.getElementById("categoryForm").submit();
}
</script>
