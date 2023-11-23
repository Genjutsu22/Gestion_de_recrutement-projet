<?php

use Psy\VarDumper\Presenter;

include('personne.php');

$p1 = new personne('Oubella','Abdallah','2003-08-17');
echo $p1->Presenter();
echo $p1->age();

?>