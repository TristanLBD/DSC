    <?php
        // if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: listeTypeEngin.php'); }
        $title = "Ajouter un engin";
        $page = "camions";
        require_once('./includes/connection.inc.php');
        if(!isset($_SESSION['role']) || $_SESSION["role"] != "Admin") header('Location: ./listeTypeEngin.php');
        
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_POST["valider"])) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // On récupère les valeurs qu'il y avait dans le formulaire
                $idTypeEngin =  htmlspecialchars($_POST['idTypeEngin']);
                $LblEngin = htmlspecialchars($_POST['LblEngin']);

                // On va maintenant effectuer les tests
                $erreur = False; // on est optimiste
                
                // Traitement de la photo
                //! gerer la photo de profil
                if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
                    $urlPhoto = $_FILES['image'];
                    $nom_photo = $urlPhoto['name'];

                    $Photoextension = explode(".", $nom_photo);
                    $Photoext = $Photoextension[count($Photoextension) - 1];
                    $nom_complet = $LblEngin.".".$Photoext;
                } else {
                    $erreur = True;
                }

                // tests sur l'id'
                if (!isset($idTypeEngin) || strlen($idTypeEngin)>4)  {
                    $erreur = True;
                }

                // tests sur le libelle
                if (!isset($LblEngin) || strlen($LblEngin)<3 || strlen($LblEngin)>45 || !is_string($LblEngin)) {
                    $erreur = True;
                }
                
                // Ajout si pas d'erreur
                if( ! $erreur ) {

                    // Préparation de la requête principale
                    $req = $db->prepare('INSERT INTO TypeEngin (idTypeEngin, LblEngin, img) VALUES (:midTypeEngin, :mLblEngin, :mimage )');

                    // On va utiliser bind pour lier les variables PHP au paramètre :m de prépare
                    $req->bindParam(':midTypeEngin', $idTypeEngin, PDO::PARAM_STR);
                    $req->bindParam(':mLblEngin', $LblEngin, PDO::PARAM_STR);
                    $req->bindParam(':mimage',  $nom_complet, PDO::PARAM_STR);

                    // On tente avec un try d'executer la requête
                    try {
                        $req->execute();
                        // On déplace l'image dans le répertoire
                        move_uploaded_file($urlPhoto['tmp_name'],'images/engins/'.$nom_complet);
                        header('Location: listeTypeEngin.php?status=success&nomEngin='.$idTypeEngin);
                    } catch(PDOException $e) {
                        if ($e->getCode()==23000) {
                            header('Location: ajoutTypeEngin.php?status=exist');
                        } else {
                            echo $e->getMessage();
                        }
                    }	
                } else {
                    // echo "On a trouvé des erreurs dans le filtrage des informations";
                    header('Location: ajoutTypeEngin.php?status=error');
                }
            }
        }
        require_once("./includes/header.inc.php");
    ?>
    <div class="container">
        <?= generationEntete("Ajout d'un type d'engin", "Formulaire pour ajouter une type engin."); ?>
        <center><img src="./images/placeholder.png" onclick="triggerClick('#image')" id="photo"  width=20% class="img-responsive float-right border border-primary" ></center>
        <?php
            if(isset($_GET['status'])) {
                $err = htmlspecialchars($_GET['status']);
    
                switch($err) {
                    case 'error': ?>
                        <div class="alert alert-danger">
                            <strong><i class="fa-solid fa-check"></i> Erreur :</strong> Une erreur est survenue lors de l'ajout d'un engin !
                        </div>
                    <?php break;

                    case 'exist': ?>
                        <div class="alert alert-danger">
                            <strong><i class="fa-solid fa-check"></i> Erreur :</strong> L'engin renseigné existe déja !
                        </div>
                    <?php break;
                }
            }
        ?>
        <form method="post" action="AjoutTypeEngin.php" id="form" enctype="multipart/form-data" novalidate>
            <div class="row">
                <div class="form-control-group col-md-3 mt-3 fw-bolder">
                    <label class="text-decoration-underline" for="idTypeEngin">ID de l'engin</label>
                    <input type="text" onkeyup='transformToUpperCaseOnInput(this)' pattern="[A-Z]{2,4}" class="form-control" maxlength="4" name="idTypeEngin" id="idTypeEngin" placeholder="Ex : EPA" required>
                    <div class="invalid-feedback">L'id du type Véhicule est obligatoire ( Il est constitué de 3 à 4 caractère en majuscule )</div>
                </div>

                <div class="form-control-group col-md-6 mt-3 fw-bolder">
                    <label class="text-decoration-underline" for="LblEngin">Libellé de l'engin</label>
                    <input class="form-control" name="LblEngin" id="LblEngin" required>
                    <div class="invalid-feedback">Le libellé de l'engin est obligatoire</div>
                </div>

                <div class="form-group col-md-3 mt-3 fw-bolder">
                    <label class="text-decoration-underline" for="image">Photo</label>
                    <input type="file" onchange="actualiserPhoto(this, 'photo')" id="image" name="image" accept="image/jpeg, image/png, image/gif">
                    <div class="invalid-feedback">La date de naissance est obligatoire</div>
                </div>
            </div>
            
            <div class="form-row text-center mt-3">
            <input type="submit" value="Ajouter" class="btn btn-primary" name="valider" />
            </div>
        </form>
    </div>
        
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <?php include_once("./includes/footer.inc.php") ?>