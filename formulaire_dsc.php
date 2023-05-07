<?php
    $page = "pompiers";
    $title = "Ajouter un pompier";
    require_once("includes/connection.inc.php");

    if(isset($_POST["valider"])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // On récupère les valeurs qu'il y avait dans le formulaire
            $matricule =  htmlspecialchars($_POST['matricule']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $dateNaissance = htmlspecialchars($_POST['dateNaissance']);
            $tel = htmlspecialchars($_POST['tel']);
            $sexe = htmlspecialchars($_POST['sexe']);
            $grade = htmlspecialchars($_POST['grade']);
            $type = htmlspecialchars($_POST['type']);
            $bip = substr($_POST['bip'], 0, 3);
            $idEmployeur = htmlspecialchars($_POST['employeur']);
            $dateEmbauche = htmlspecialchars($_POST['dateEmbauche']);
            $indice = htmlspecialchars($_POST['indice']);
            $idCaserne = htmlspecialchars($_POST['caserne']);

            $erreur = False; // on est optimiste
            if (!isset($matricule) || strlen($matricule)!=6)  {
                $erreur = True;
            }
            if (!isset($nom) || strlen($nom)<3 || strlen($nom)>45 || !is_string($nom)) {
                $erreur = True;
            }
            if (!isset($prenom) || strlen($prenom)<3 || strlen($prenom)>45 || !is_string($prenom)) {
                $erreur = True;
            }

            // Ajout si pas d'erreur
            if( ! $erreur ) {
                $req = $db->prepare('INSERT INTO Pompier (Matricule, NomPompier, PrenomPompier, DateNaissPompier, TelPompier, SexePompier, idGrade) VALUES (:mMatricule, :mNomPompier, :mPrenomPompier, :mDateNaissPompier, :mTelPompier, :mSexePompier, :midGrade )');
                try {
                    $req->execute(array(
                        ':mMatricule' => $matricule,           
                        ':mNomPompier' => $nom,
                        ':mPrenomPompier' => $prenom,
                        ':mDateNaissPompier' => $dateNaissance,
                        ':mTelPompier' => $tel,
                        ':mSexePompier' => $sexe,
                        ':midGrade' => $grade
                    ));
                } catch(PDOException $e) {
                    if ($e->getCode()==23000) {
                        echo "Ce matricule existe déjà";
                    } else {
                        echo $e->getMessage();
                    }
                }

                //! Préparation de la requête pour le Professionel
                $pro = $db->prepare('INSERT INTO Professionnel (MatPro, DateEmbauche, Indice) VALUES (:mMatricule, :mDateEmbauche, :mIndice)');

                //! Préparation de la requête pour le pompier Volontaire
                $vol = $db->prepare('INSERT INTO Volontaire (MatVolontaire, Bip, IdEmployeur) VALUES (:mMatricule, :mBip, :mIdEmployeur)');

                if ($type == "volontaire")  {
                    $req = $vol;
                    $req->execute(array(
                        ':mMatricule' => $matricule,           
                        ':mBip' => $bip,
                        ':mIdEmployeur' => $idEmployeur
                    ));

                    try {
                        $req->execute();
                    } catch(PDOException $e) {
                        echo "Une erreur est survenue dans la table vol !";
                        echo $e->getMessage();
                    }

                } elseif ($type == "professionnel") {
                    $req = $pro;
                    $req->execute(array(
                        ':mMatricule' => $matricule,           
                        ':mDateEmbauche' => $dateEmbauche,
                        ':mIndice' => $indice
                    ));

                    try {
                        $req->execute();
                    } catch(PDOException $e) {
                        echo "Une erreur est survenue dans la table pro !";
                        echo $e->getMessage();
                    }

                } else {
                    echo "Houston on a un problème !";
                }


                //! Ajout dans affectation
                $req = $db->prepare('INSERT INTO Affectation (Matricule, Date, IdCaserne) VALUES (:mMatricule, :mDateAffectation, :mIdCaserne)');
                $dateJour = date("Y-m-d");

                try {
                    $req->execute(array(
                        ':mMatricule' => $matricule,
                        ':mDateAffectation' => $dateJour,
                        ':mIdCaserne' => $idCaserne
                    ));
                header('Location: index.php?status=success');
                } catch(PDOException $e) {
                    echo "prb dans l'ajout d'une valeur dans la table Affectation !";
                    echo $e->getMessage();
                }

            } else {
                echo "On a trouvé des erreurs dans le filtrage des informations";
            }
        }
    }


    $sql = "SELECT * FROM `grade`";
    $req = $db->prepare($sql);
    $req->execute();
    $result = $req->fetchAll();
    include_once("./includes/header.inc.php");
?>
    <div class="container mt-5">
        <?php echo generationEntete("DSC", "Ajouter un pompier."); ?>
        <form class="row needs-validation" action="formulaire_dsc.php" method="POST" novalidate>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="matricule" class="form-label text-decoration-underline fw-bolder">Matricule :</label>
                    <input pattern="[0-9]{6}" class="form-control" id="matricule" name="matricule" placeholder="Ex : 876524" required>
                    <div class="valid-feedback">Matricule valide. <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Matricule invalide. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
                
                <div class="col-6">
                    <label for="dateNaissance" class="form-label text-decoration-underline fw-bolder">Date de naissance :</label>
                    <input type="date" name="dateNaissance" id="dateNaissance" class="form-control" required>
                    <div class="valid-feedback">Date valide. <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Veillez renseigner votredate de naissance. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-6">
                    <label for="nom" class="form-label text-decoration-underline fw-bolder">Nom  :</label>
                    <input type="text" class="form-control" id="nom" name="nom" pattern="[A-Za-zéèà-]{3,45}" required>
                    <div class="valid-feedback">Nom valide. <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Nom invalide. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
                
                <div class="col-6">
                    <label for="prenom" class="form-label text-decoration-underline fw-bolder">Prénom :</label>
                    <input type="text" class="form-control" id="prenom"  name="prenom" pattern="[A-Za-zéèà-]{3,45}" required>
                    <div class="valid-feedback">Prénom valide. <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Prénom invalide. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-6">
                    <span class="text-decoration-underline fw-bolder">Sexe :</span><br>
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <label class="form-check-label text-decoration-underline" for="femme">Féminin</label>
                            <input class="form-check-input" type="radio" name="sexe" id="femme" value="féminin" required>
                        </div>
                        <div class="col-4">
                            <label class="form-check-label text-decoration-underline" for="homme">Masculin</label>
                            <input class="form-check-input" type="radio" name="sexe" id="homme" value="masculin" required>
                        </div>
                    </div>
                </div>
                
                <div class="col-6">
                    <label for="grade" class="form-label text-decoration-underline fw-bolder">Grade :</label>
                    <select name="grade" id="grade" class="form-select" aria-label="Default select example" required>
                        <option value="Officier" style="display: none;" selected disabled>Choisir un grade...</option>
                        <?php
                            foreach($result as $value){
                                echo('<option value="'.$value["idGrade"].'">'.ucwords($value["LblGrade"]).'</option>');
                            };
                        ?>
                    </select>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-6">
                    <label for="tel" class="form-label text-decoration-underline fw-bolder">Télléphonne  :</label>
                    <input type="tel" class="form-control" name="tel" id="tel" pattern="^[0-9]{10}$" required>
                    <div class="valid-feedback">Télléphonne renseigné. <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Veillez renseigner un numéro de télléphonne valide. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
                
                <div class="col-6">
                    <label for="caserne" class="form-label text-decoration-underline fw-bolder">Caserne :</label>
                    <select name="caserne" id="caserne" class="form-select" aria-label="Default select example" required>
                        <option value="Officier" style="display: none;" selected disabled>Choisir une caserne...</option>
                        <?php
                            $listeCaserne = "SELECT idCaserne, NomCaserne FROM Caserne ORDER BY NomCaserne ASC;";
                            foreach  ($db->query($listeCaserne) as $row) {
                                echo '<option value="'.$row["idCaserne"].'">'.ucwords($row["NomCaserne"]).'</option>';
                            }
                        ?>
                    </select>
                    <div class="valid-feedback">Caserne selectionnée. <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Veillez selectionner une caserne. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
            </div>


            <div class="row mb-3">
                <div class="col-12">
                    <span class="text-decoration-underline fw-bolder">Type pompier :</span><br>
                    <input class="form-check-input text-decoration-underline" type="radio" name="type" id="pro" value="professionnel" onchange="aff_cach_input('pro')" checked required>
                    <label class="form-check-label" for="pro">Professionnel</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="form-check-input text-decoration-underline" type="radio" name="type" id="vol" value="volontaire" onchange="aff_cach_input('volontaire')" required>
                    <label class="form-check-label" for="vol">Volontaire</label>

                    <div class="valid-feedback">Catégorie sélectionnée <i class="fa-regular fa-circle-check"></i></div>
                    <div class="invalid-feedback">Veillez selectionnez une catégorie. <i class="fa-solid fa-circle-xmark"></i></div>
                </div>
            </div>




            <!-- Partie volontaire -->
            <!-- <div id="blockVolontaire">
                <div class="form">
                <label for="employeur" >Employeur</label>
                <div class="form-group">
                    <select class="form-control col-md-6" name="employeur" id="employeur">
                    <?php
                        $listeGrade = "SELECT idEmployeur, NomEmployeur FROM Employeur;";
                        foreach  ($db->query($listeGrade) as $row) {
                        echo '<option value="'.$row["idEmployeur"].'">'.ucwords($row["NomEmployeur"]).'</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="invalid-feedback">
                    L'employeur est obligatoire
                </div>
                </div>
                <div class="form">
                    <label for="bip" id="titreBip">Bip</label>
                    <input type="number" class="form-control" name="bip" id="bip" placeholder="Ex : 123" >
                    <div class="invalid-feedback">Le Bip obligatoire</div>
                </div>
            </div>  -->

            <div class="row mb-3" id="blockVolontaire">
                <div class="col-6">
                    <label for="employeur" class="text-decoration-underline fw-bolder">Employeur</label>
                        <div class="form-group">
                            <select class="form-control col-md-6" name="employeur" id="employeur">
                                <?php
                                    $listeGrade = "SELECT idEmployeur, NomEmployeur FROM Employeur;";
                                    foreach  ($db->query($listeGrade) as $row) {
                                    echo '<option value="'.$row["idEmployeur"].'">'.ucwords($row["NomEmployeur"]).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    <div class="invalid-feedback">L'employeur est obligatoire</div>
                </div>
                
                <div class="col-6">
                    <label for="bip" id="titreBip" class="text-decoration-underline fw-bolder">Bip</label>
                    <input type="number" class="form-control" name="bip" id="bip" placeholder="Ex : 123" >
                    <div class="invalid-feedback">Le Bip obligatoire</div>
                </div>
            </div>

            <div class="row mb-3" id="blockPro">
                <div class="col-6">
                    <label for="indice" class="text-decoration-underline fw-bolder">Indice</label>
                    <input type="number" class="form-control" name="indice" id="indice" placeholder="Ex : 840" >
                    <div class="invalid-feedback">L'indice est obligatoire</div>
                </div>
                
                <div class="col-6">
                    <label for="dateEmbauche" class="text-decoration-underline fw-bolder">Date d'embauche</label>
                    <input type="date" class="form-control" name="dateEmbauche" id="dateEmbauche" >
                    <div class="invalid-feedback">La date d'embauche est obligatoire'</div>
                </div>
            </div>
            
            
            
            <div class="container"> 
                <div class="row"> 
                    <div class="col text-center">
                        <br><button class="btn btn-primary" type="submit" name="valider">Envoyer</button>
                    </div> 
                </div> 
            </div>
        </form>
    </div>


    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach((form) => {
                form.addEventListener('submit', (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        function aff_cach_input(action) { 
            if (action == "volontaire")  {
                document.getElementById('blockVolontaire').style.display="flex"; 
                document.getElementById('blockPro').style.display="none"; 
            } else if (action == "pro") {
                document.getElementById('blockVolontaire').style.display="none"; 
                document.getElementById('blockPro').style.display="flex"; 
            }
            return true;
        }

        aff_cach_input('pro');
    </script>
    <?php  include_once("./includes/footer.inc.php"); ?>