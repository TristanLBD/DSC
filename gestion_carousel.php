<?php
    $page = 'carousel';
    $title = 'Gestion Carousel';
    require_once("./includes/connection.inc.php");
    if(!isset($_SESSION['role']) || $_SESSION["role"] != "Admin") header('Location: ./index.php');

    $req = $db->prepare("SELECT * FROM carousel");
    try {
        $req->execute();
        $resultCarousel = $req->fetchAll(PDO::FETCH_ASSOC);
        $rowCarousel = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }



    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $db->prepare("SELECT MAX(id) as id FROM carousel");
    try {
        $req->execute();
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        $id = $resultat["id"] + 1;
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    if(isset($_POST["valider"])) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titreCarousel =  htmlspecialchars($_POST['titre']);
            $infoCarousel = htmlspecialchars($_POST['infos']);

            $erreur = False; // on est optimiste

            //! gerer la photo de profil
            if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
                $urlPhoto = $_FILES['image'];
                $nom_photo = $urlPhoto['name'];

                $Photoextension = explode(".", $nom_photo);
                $Photoext = $Photoextension[count($Photoextension) - 1];
            } else {
                $erreur = True;
            }

            if (!isset($titreCarousel) || strlen($titreCarousel)>255)  {
                $erreur = True;
            }

            if (!isset($infoCarousel) || strlen($infoCarousel)>255 || !is_string($infoCarousel)) {
                $erreur = True;
            }
            
            if(!$erreur) {
                $req = $db->prepare('INSERT INTO carousel (id, titre, info,img) VALUES (:id ,:mtitre, :minfo, :mimage )');

                try {
                    $req->execute(array(
                        ':id' => $id,
                        ':mtitre' => $titreCarousel,
                        ':minfo' => $infoCarousel,
                        ':mimage' => $id.'.'.$Photoext
                    ));
                    // On déplace l'image dans le répertoire
                    move_uploaded_file($urlPhoto['tmp_name'],'images/carousel/'.$id.'.'.$Photoext);
                    header('Location: gestion_carousel.php');
                } catch(PDOException $e) {
                    if ($e->getCode()==23000) {
                        echo "Cet id d'engin existe déjà";
                    } else {
                        echo $e->getMessage();
                    }
                }	
            } else {
                header('Location: gestion_carousel.php?status=error');
            }
        }
    }
    require_once("./includes/header.inc.php");
?>
<h1 class="jumbotron-heading text-decoration-underline text-center my-4"></h1>
<?php echo generationEntete("Carousel :","Liste des images présentes dans le carousel :"); ?>

<div class="container">
    <?php
        if(isset($_GET['status'])) {
            $err = htmlspecialchars($_GET['status']);

            switch($err) {
                case 'added': ?>
                    <div class="alert alert-success">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Ajout d'une image au carousel éffectué avec succès !
                    </div>
                <?php break;

                case 'updated': ?>
                    <div class="alert alert-success">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Modification d'une image du carousel éffectuée avec succès !
                    </div>
                <?php break;

                case 'error': ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa-solid fa-check"></i> Erreur :</strong> Une erreur est survenue lors de l'ajout d'une image !
                    </div>
                <?php break;
            }
        }

        if(!$rowCarousel) {
            echo("<center><h2>Aucune image actuellement présente dans le carousel !</h2></center>");
        }
        $count = 0;
        foreach($resultCarousel as $row) {
            $count = $count + 1;
    ?>
    <div class="row grow" style="border: 3px solid black;">
        <div class="col-sm-4" style="min-height: 250px; max-height: 250px; background-image: url('./images/carousel/<?= $row["img"] ?>');  background-repeat: no-repeat; background-size: contain; background-position: center;"></div>
        <div class="col-sm-6">
            <p style="font-size: 35px; text-decoration: underline; font-family: 'Poppins', sans-serif; font-weight: 900;"><?= ucfirst($row["titre"]) ?></p>
            <p><?= ucfirst($row["info"]) ?></p>
        </div>
        <div class="col-sm-2 d-flex flex-column justify-content-between my-3">
            <a class="btn btn-danger" href="./SupprCarousel.php?id=<?= $row['id'] ?>" role="button">Supprimer</a>
            <a class="btn btn-warning" href="./ModifCarousel.php?id=<?= $row['id'] ?>" role="button">Modifier</a>
        </div>
    </div>
    <?php
            if($rowCarousel > $count) { echo("<hr>"); }
        }
    ?>
</div>

    <div class="container">
        <h1 class="jumbotron-heading text-decoration-underline my-4 text-center fw-bolder">Ajout d'une image au carousel :</h1>
        <center><img src="" id="photo" onclick="triggerClick('#image')" width=20% class="img-responsive float-right" ></center>
        <form method="post" action="./gestion_carousel.php" id="form" enctype="multipart/form-data" novalidate>
            
            <div class="row">
                <div class="form-control-group col-md-6">
                    <label class="text-decoration-underline fw-bolder" for="titre">Titre</label>
                    <input  class="form-control" name="titre" id="titre" required>
                    <div class="invalid-feedback">L'id du type Véhicule est obligatoire ( Il est constitué de 3 à 4 caractère en majuscule )</div>
                </div>

                <div class="form-control-group col-md-6">
                    <label class="text-decoration-underline fw-bolder" for="infos">Informations complémentaires</label>
                    <input class="form-control" name="infos" id="infos" required>
                    <div class="invalid-feedback">Le libellé de l'engin est obligatoire</div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <label class="text-decoration-underline fw-bolder" for="image">Photo</label>
                    <input type="file" onchange="actualiserPhoto(this, 'photo')" id="image" name="image" accept="image/jpeg, image/png, image/gif">
                    <div class="invalid-feedback">La date de naissance est obligatoire</div>
                </div>
            </div>



            <div class="form-row mt-3 text-center">
                <input type="submit" value="Ajouter" class="btn btn-primary" name="valider" />
            </div>
        </form>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>