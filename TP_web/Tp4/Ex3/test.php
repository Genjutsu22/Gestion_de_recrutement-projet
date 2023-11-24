<?php

include('personne.php');

$p1 = new personne('Oubella','Abdallah','2003-08-17');
echo $p1->Presenter();
echo "<br>Votre age est : " . $p1->age();

?>