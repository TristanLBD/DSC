<?php
    $page = "garages";
    $title = "Garages";
    include_once("./includes/connection.inc.php");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $db->prepare("SELECT * FROM garage,villes_france WHERE garage.villeGarage = villes_france.ville_id");
    try {
        $req->execute();
        $resultGarage = $req->fetchAll(PDO::FETCH_ASSOC);
        $rowGarage = $req->rowCount();

        $req = $db->prepare("SELECT ville_id, nom FROM villes_france");
        $req->execute();
        $listeGarage = $req->fetchAll();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    if(isset($_POST["valider"])) {
        if(isset($_POST["nomGarage"],$_POST["villeGarage"],$_POST["addrGarage"]) && !empty($_POST['nomGarage']) && !empty($_POST['villeGarage']) && !empty($_POST['addrGarage']) ) {
            $nomGarage = htmlspecialchars($_POST['nomGarage']);
            $villeGarage = htmlspecialchars($_POST['villeGarage']);
            $addrGarage = htmlspecialchars($_POST['addrGarage']);
            $req = $db->prepare('INSERT INTO garage(nomGarage,villeGarage,addrGarage) VALUES (:nomGarage,:villeGarage,:addrGarage)');
            
            try {
                $req->execute(array(
                    ':nomGarage' => $nomGarage,
                    ':villeGarage' => $villeGarage,
                    ':addrGarage' => $addrGarage
                ));
                header("Location: listeGarages.php?status=added");
            } catch(PDOException $e) {
                echo $e->getMessage();
                header("Location: listeGarages.php.php?status=error");
            }
        }
    }

    if(isset($_GET["delete"])) {
        if(!empty($_GET['delete'])) {
            $id = htmlspecialchars($_GET['delete']);
            $req = $db->prepare('DELETE FROM garage WHERE idGarage = :mid');
            
            try {
                $req->execute(array(':mid' => $id));
                header("Location: listeGarages.php?status=deleted");
            } catch(PDOException $e) {
                echo $e->getMessage();
                header("Location: listeGarages.php.php?status=error");
            }
        }
    }
    include_once("./includes/header.inc.php");
    echo generationEntete("DSC", "Liste des ".$rowGarage." garages.");
?>

    <div class="container mt-5">
    <?php
        if(isset($_GET['status'])) {
            $err = htmlspecialchars($_GET['status']);

            switch($err) {
                case 'added': ?>
                    <div class="alert alert-success">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Ajout du garage éffectué avec succès !
                    </div>
                <?php break;

                case 'updated': ?>
                    <div class="alert alert-warning">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Modification du garage éffectuée avec succès !
                    </div>
                <?php break;

                case 'deleted': ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Suppression du garage éffectuée avec succès !
                    </div>
                <?php break;
            }
        }
    ?>
        <div class="input-group">
            <span class="input-group-text">Rechercher un garage</span>
            <input type="search" class="form-control" id="myInput" onkeyup="searchShortcut()" placeholder="Rechercher un garage...">
        </div>
        <table class="table table-dark table-striped text-center">
            <thead>
                <tr>
                <th scope="col" class="text-decoration-underline">Nom</th>
                <th scope="col" class="text-decoration-underline">Ville</th>
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                <th scope="col" class="text-decoration-underline">Actions</th>
                <?php } ?>
                </tr>
            </thead>
            <tbody id="racourci-container">
                <?php foreach($resultGarage as $row) { ?>

                    <tr class='racourci'>
                        <td class='racourci-title'><?=ucfirst($row["nomGarage"])?></td>
                        <td class='racourci-title'><?=ucfirst($row["nom"])?></td>
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                        <td>
                            <a class="btn btn-warning" title="Modifier ce garage" href="./modifGarage.php?id=<?=$row['idGarage'];?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn btn-danger" title="Supprimer ce garage" href="?delete=<?=$row["idGarage"]?>" role="button"><i class="fa-solid fa-trash"></i></a>
                        </td>
                        <?php } ?>
                    </tr>

                <?php } ?>
                <tr id='noresult' style="display: none;">
                    <td colspan="3" class="bg-warning fw-bolder">Aucun résultat</td>
                </tr>
            </tbody>
        </table>


        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
        <form method="post" id="form" novalidate>
            <h1 class="text-center text-decoration-underline">Ajouter un garage :</h1>
            <div class="row">
                <div class="form-control-group col-lg-4 col-sm-12">
                    <label class="text-decoration-underline fw-bolder" for="nomGarage">Nom du garage :</label>
                    <input class="form-control" name="nomGarage" id="nomGarage" required>
                    <div class="invalid-feedback">Ce champ est obligatoire !</div>
                </div>

                <div class="form-control-group col-lg-4 col-sm-12">
                    <label class="text-decoration-underline fw-bolder" for="villeGarage">Ville du garage :</label>
                    <select name="villeGarage" id="villeGarage" class="form-select" aria-label="Default select example" required>
                        <option value="Officier" style="display: none;" selected disabled>Choisir un ville...</option>
                            <?php foreach($listeGarage as $value){ ?>
                            <option value="<?=$value['ville_id']?>" ><?= ucwords($value["nom"]) ?></option>
                            <?php }; ?>
                    </select>
                    <div class="invalid-feedback">Ce champ est obligatoire !</div>
                </div>

                
                <div class="form-control-group col-lg-4 col-sm-12">
                    <label class="text-decoration-underline fw-bolder" for="addrGarage">Addresse du garage :</label>
                    <input class="form-control" name="addrGarage" id="addrGarage" required>
                    <div class="invalid-feedback">Ce champ est obligatoire !</div>
                </div>
            </div>

            <div class="form-row mt-3 text-center">
                <input type="submit" value="Ajouter" class="btn btn-primary" name="valider" />
            </div>
        </form>
        <?php } ?>
        
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>