<?php
    $page = "garages";
    $title = "Garages";
    require_once("./includes/connection.inc.php");
    if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: listegarages.php'); }

    if(!isset($_GET['id']) OR empty($_GET['id'])) { header('Location: listeGarages.php'); }
    $idGarage = htmlspecialchars($_GET['id']);

    if(isset($_POST['valider'],$_POST['nomGarage'],$_POST['villeGarage'],$_POST['addrGarage']) && !empty($_POST['nomGarage']) && !empty($_POST['villeGarage']) && !empty($_POST['addrGarage'])){
        $nomGarage = htmlspecialchars($_POST['nomGarage']);
        $villeGarage = htmlspecialchars($_POST['villeGarage']);
        $addrGarage = htmlspecialchars($_POST['addrGarage']);

        $req = $db->prepare('UPDATE garage SET nomGarage = :nomGarage, villeGarage = :villeGarage, addrGarage = :addrGarage  WHERE idGarage  = :id');
        
        try {
            $req->execute(array(
                ':nomGarage' => $nomGarage,
                ':villeGarage' => $villeGarage,
                ':addrGarage' => $addrGarage,
                ':id' => $idGarage
            ));
            header("Location: listeGarages.php?status=updated");
            die();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    $req = $db->prepare('SELECT * FROM garage WHERE idGarage = :mid');
    try {
        $req->execute(array(
            ':mid' => $idGarage    
        ));
        if($req->rowCount() >= 1)
        $result = $req->fetch();
        
        $req = $db->prepare("SELECT ville_id, nom FROM villes_france");
        $req->execute();
        $listeGarage = $req->fetchAll();

    } catch(PDOException $e) {
        echo $e->getMessage();
    }


    require_once("./includes/header.inc.php");
?>
    
    <div class="container">
        <?php echo generationEntete("Habilitations :","Modifier une habilitation."); ?>
        <div class="row">
            <div class="col">
                <form method="post" id="form" action="./modifGarage.php?id=<?=$idGarage?>" novalidate>
                    <h1 class="text-center text-decoration-underline">Ajouter un garage :</h1>
                    <div class="row">
                        <div class="form-control-group col-lg-4 col-sm-12">
                            <label class="text-decoration-underline fw-bolder" for="nomGarage">Nom du garage :</label>
                            <input class="form-control" value="<?= $result['nomGarage'] ?>" name="nomGarage" id="nomGarage" required>
                            <div class="invalid-feedback">Ce champ est obligatoire !</div>
                        </div>

                        <div class="form-control-group col-lg-4 col-sm-12">
                            <label class="text-decoration-underline fw-bolder" for="villeGarage">Ville du garage :</label>
                            <select name="villeGarage" id="villeGarage" class="form-select" aria-label="Default select example" required>
                                <option value="Officier" style="display: none;" selected disabled>Choisir un ville...</option>
                                    <?php foreach($listeGarage as $value){ ?>
                                    <option value="<?=$value['ville_id']?>" <?php if($value['ville_id'] == $result['villeGarage']){echo("selected");} ?>><?= ucwords($value["nom"]) ?></option>
                                    <?php }; ?>
                            </select>
                            <div class="invalid-feedback">Ce champ est obligatoire !</div>
                        </div>

                        
                        <div class="form-control-group col-lg-4 col-sm-12">
                            <label class="text-decoration-underline fw-bolder" for="addrGarage">Addresse du garage :</label>
                            <input class="form-control" value="<?= $result['addrGarage'] ?>" name="addrGarage" id="addrGarage" required>
                            <div class="invalid-feedback">Ce champ est obligatoire !</div>
                        </div>
                    </div>

                    <div class="form-row mt-3 text-center">
                        <input type="submit" value="Modifier" class="btn btn-primary" name="valider" />
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php
    include_once("./includes/footer.inc.php");
?>