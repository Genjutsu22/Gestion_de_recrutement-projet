<?php
class personne{
     var $nom;
     var $prenom;
     var $date_naissance;
     function __construct($nom,$prenom,$date){
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->date_naissance = $date;
     }
     function age(){
      $date = new DateTime($this->date_naissance);
      $date->format('Y-m-d');
      $currentDate = new DateTime();
      $age = $currentDate->diff($date)->y; 
      $ageAsInt = intval($age);
 
      return $ageAsInt;
     }
     function presenter(){
        return " <strong>Nom :</strong> " . $this->nom ." <strong>Prenom :</strong> ". $this->prenom. "<strong> Date de naissance :</strong> " . $this->date_naissance; 
     }

     
}
?>