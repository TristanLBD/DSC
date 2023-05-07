<?php
    function generationEntete(string $titre,string $sous_titre): string {
        $titre = htmlspecialchars($titre);
        $sous_titre = htmlspecialchars($sous_titre);
        return '<div class="text-center mt-5 text-decoration-underline">
                    <img class="d-block mx-auto mb-2" src="images/sapeur-pompier.png" alt="logo Sapeurs Pompiers" height="115">
                    <h1 class="display-5 fw-bolder">'.$titre.'</h1>
                    <p class="lead fw-bolder">'.$sous_titre.'</p>
                </div>';
    }

    function passwordCheck($pass) :bool {
        $nb_points = 10;
        $nb_caractere = strlen($pass);
        $points_nbcarac = 0;
        $points_complexite = 0;
        //! Vérification de la longueur du mot de passe
        if($nb_caractere >= 12) { $points_nbcarac = 1; };        
        //! Vérification des lettres minuscules
        if(preg_match("/[a-z]/", $pass)) {  $points_complexite = $points_complexite + 1; }
        //! Vérification des lettres majuscules
        if(preg_match("/[A-Z]/", $pass)) {  $points_complexite = $points_complexite + 2; } 
        //! Vérification des chiffres
        if(preg_match("/[0-9]/", $pass)) {  $points_complexite = $points_complexite + 3; }
        //! Vérification des caractères spéciaux
        if(preg_match("/\W/", $pass)) {  $points_complexite = $points_complexite + 4; }

        $resultat = $points_nbcarac * $points_complexite;
        return($nb_points == $resultat);
    }

    function validateDate($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    function vd($array) {
        echo "<pre>";
        var_dump($array);
        echo "</pre>";
    }
?>