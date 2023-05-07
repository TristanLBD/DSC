<?php
    $title = "Modifier le carousel";
    $page = "carousel";
    require_once("./includes/connection.inc.php");
    if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: index.php'); }

    $id = htmlspecialchars($_GET["id"]);

    $req = $db->prepare("SELECT * FROM carousel where id = :mid");
    try {
        $req->bindParam(':mid', $id, PDO::PARAM_STR);
        $req->execute();
        $resultCarousel = $req->fetch(PDO::FETCH_ASSOC);
        if(!$req->rowCount()) {
            header('Location: gestion_carousel.php');
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }


    
    if(isset($_POST["valider"])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // On récupère les valeurs qu'il y avait dans le formulaire
            $titreCarousel =  htmlspecialchars($_POST['titre']);
            $infoCarousel = htmlspecialchars($_POST['infos']);

            // On va maintenant effectuer les tests
            $erreur = False; // on est optimiste
            if(isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
                $urlPhoto = $_FILES['image'];
                $nom_fichier = $urlPhoto['name'];
                $extension = explode(".", $nom_fichier);
                $ext = $id.'.'.$extension[count($extension) - 1];

                $req = $db->prepare("UPDATE carousel SET img = :mimg WHERE id = :mid");
                try {
                    $req->bindParam(':mimg', $ext, PDO::PARAM_STR);
                    $req->bindParam(':mid', $id, PDO::PARAM_STR);
                    $req->execute();
                    if($ext != $resultCarousel['img']) {
                        unlink("./images/carousel/".$resultCarousel['img']);
                    }
                    move_uploaded_file($urlPhoto['tmp_name'],'images/carousel/'.$ext);
                } catch(PDOException $e) {
                    echo $e->getMessage();
                }

                if (strlen($nom_fichier)==0) {
                    $nom_fichier="user.png";
                }
            }

            // tests sur l'id'
            if (!isset($titreCarousel) || strlen($titreCarousel)>255)  {
                $erreur = True;
            }

            // tests sur le libelle
            if (!isset($infoCarousel) || strlen($infoCarousel)>255 || !is_string($infoCarousel)) {
                $erreur = True;
            }
            
            // Ajout si pas d'erreur
            if( ! $erreur ) {

                // Préparation de la requête principale
                $req = $db->prepare('UPDATE carousel SET `titre` = :mtitre, `info` = :minfo where id = :id');
                // $req = $db->prepare('UPDATE carousel SET `titre` = :mtitre, `info` = :minfo, `img` = :mimage where id = :id');

                // On va utiliser bind pour lier les variables PHP au paramètre :m de prépare
                $req->bindParam(':mtitre', $titreCarousel, PDO::PARAM_STR);
                $req->bindParam(':minfo', $infoCarousel, PDO::PARAM_STR);
                // $req->bindParam(':mimage',  $ext, PDO::PARAM_STR);
                $req->bindParam(':id', $id, PDO::PARAM_STR);

                // On tente avec un try d'executer la requête
                try {
                    $req->execute();
                    // On déplace l'image dans le répertoire
                    header('Location: gestion_carousel.php');
                } catch(PDOException $e) {
                    if ($e->getCode()==23000) {
                        echo "Cet id d'engin existe déjà";
                    } else {
                        echo $e->getMessage();
                    }
                }	
            } else {
                echo "On a trouvé des erreurs dans le filtrage des informations";
            }
        }
    }
    require_once("./includes/header.inc.php");
?>

    <div class="container mt-5">
        <?php echo generationEntete("Modification du carousel.", "Modification d'une image au carousel."); ?>

        <center><img src="./images/carousel/<?= $resultCarousel['img'] ?>" id="photo" onclick="triggerClick('#image')" width=20% class="img-responsive float-right my-3" ></center>
        <form method="post" action="./ModifCarousel.php?id=<?=$id?>" id="form" enctype="multipart/form-data" novalidate>
            
            <div class="row">
                <div class="form-control-group col-md-6">
                    <label class="text-decoration-underline" for="titre">Titre</label>
                    <input  class="form-control" value="<?= $resultCarousel['titre'] ?>" name="titre" id="titre" required>
                    <div class="invalid-feedback">L'id du type Véhicule est obligatoire ( Il est constitué de 3 à 4 caractère en majuscule )</div>
                </div>

                <div class="form-control-group col-md-6">
                    <label class="text-decoration-underline" for="infos">Informations complémentaires</label>
                    <input class="form-control" value="<?= $resultCarousel['info'] ?>" name="infos" id="infos" required>
                    <div class="invalid-feedback">Le libellé de l'engin est obligatoire</div>
                </div>
            </div>

            <div class="form-group col-md-3">
                <label class="text-decoration-underline" for="image">Photo</label>
                <input type="file" onchange="actualiserPhoto(this, 'photo')" id="image" name="image" accept="image/jpeg, image/png, image/gif">
                <div class="invalid-feedback">La date de naissance est obligatoire</div>
            </div>



            <div class="form-row mt-3 text-center">
                <input type="submit" value="Modifier" class="btn btn-warning" name="valider" />
            </div>
        </form>
    </div>

<?php
    include_once("./includes/footer.inc.php");
?>