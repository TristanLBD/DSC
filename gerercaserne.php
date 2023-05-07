<?php
    require_once("./includes/connection.inc.php");
    if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: listecasernes.php'); }

    $idCaserne = htmlspecialchars($_GET["id"]);

    $req = $db->prepare("SELECT * FROM caserne where idCaserne = :mid");
    try {
        $req->bindParam(':mid', $idCaserne, PDO::PARAM_STR);
        $req->execute();
        $resultCaserne = $req->fetch(PDO::FETCH_ASSOC);
        if(!$req->rowCount()) {
            header('Location: listecasernes.php');
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $req = $db->prepare("SELECT * FROM garage, villes_france where garage.villeGarage = villes_france.ville_id");
    try {
        $req->execute();
        $resultGarage = $req->fetchAll(PDO::FETCH_ASSOC);
        if(!$req->rowCount()) {
            header('Location: listecasernes.php');
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    
    $page = "caserne";
    $title = "Caserne ".ucfirst($resultCaserne["NomCaserne"]);

    //! Gestion Form AJout Zngin CAserne
    if(isset($_POST['valider'])) {
        $typeEngin = htmlspecialchars($_POST['typeengin']);
        $idGarage = htmlspecialchars($_POST['garage']);

        //! Récuperer le plus grand numéro de ce type d'engin dans la caserne en question 
        $req = $db->prepare("SELECT MAX(Numéro) as numero FROM engin WHERE IdTypeEngin = :midTypeEngin AND IdCaserne = :midCaserne");
        
        try {
            $req->execute(array(
                ':midTypeEngin' => $typeEngin,
                ':midCaserne' => $idCaserne
            ));
            $maxNumero = $req->fetch();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        $numMAx = $maxNumero["numero"] + 1;
        
        $req = $db->prepare('INSERT INTO engin(Numéro, IdCaserne,IdTypeEngin) VALUES (:mnumero, :midCaserne, :midTypeEngin)');
        
        try {
            $req->execute(array(
                ':mnumero' => $maxNumero["numero"] + 1,
                ':midCaserne' => $idCaserne,
                ':midTypeEngin' => $typeEngin
            ));
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        //!Dates ajd et date lendemain
        $aujourdhui = date('Y-m-d', strtotime('now'));
        $lendemain = date('Y-m-d', strtotime('tomorrow'));
        $raison = 'Mise en service.';

        //! Ajout dans la table maintenance pour check du véhicule
        $req = $db->prepare("INSERT INTO `maintenance` (`idCaserne`, `Numéro`, `IdTypeEngin`, `idGarage`, `raison`, `dateDebutMaintenance`, `dateFinMaintenance`) VALUES (:idCaserne, :Numero, :IdTypeEngin, :idGarage, :raison, :dateDebut, :dateFin);");
        try {
            $req->execute(array(
                ':idCaserne' => $idCaserne,
                ':Numero' => $numMAx,
                ':IdTypeEngin' => $typeEngin,
                ':idGarage' => $idGarage,
                ':raison' => $raison,
                ':dateDebut' => $aujourdhui,
                ':dateFin' => $lendemain
            ));
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }




    require_once("./includes/header.inc.php");
    
    $req = $db->prepare("
        SELECT Max(dateDebutMaintenance) as dateDebut, MAX(dateFinMaintenance) as dateFin, maintenance.Numéro, maintenance.IdTypeEngin, maintenance.IdCaserne, img, LblEngin, raison
        FROM maintenance, engin, typeengin
        WHERE maintenance.IdTypeEngin = engin.IdTypeEngin AND maintenance.Numéro = engin.Numéro AND maintenance.IdCaserne = engin.IdCaserne AND typeengin.IdTypeEngin = engin.IdTypeEngin  and maintenance.IdCaserne = :midCaserne 
        GROUP BY maintenance.Numéro, maintenance.IdTypeENgin, maintenance.IdCaserne;
    ");
    try {
        $req->bindParam(':midCaserne', $idCaserne, PDO::PARAM_STR);
        $req->execute();
        $resultatListeEngin = $req->fetchAll(PDO::FETCH_ASSOC);
        $countEngin = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    //! Liste des types d'engins
    $req = $db->prepare('SELECT * FROM typeengin ORDER BY idTypeEngin ASC;');
    try {
        $req->execute();
        $typeEngins = $req->fetchAll();
    } catch(PDOException $e) {
        header('Location: listecasernes.php');
    }
?>
    <div class="container mt-5">
        <?php echo generationEntete(ucfirst($resultCaserne["NomCaserne"]), "Gérer la caserne."); ?>

        <div class="album">
            <p class="lead text-muted text-decoration-underline">Liste des <?= $countEngin ?> engins de cette caserne :</p>
            <div class="container">
                <div class="row">
                <?php
                    foreach ($resultatListeEngin as $row) {?>            
                    <div class="col-md-4 fw-bolder">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="images/engins/<?php echo $row["img"]?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"> <?php echo ucfirst($row["LblEngin"])?> </p>
                                <div class="card-action">
                                    <span class="card-text"> <?php echo ucfirst($row["IdTypeEngin"])." ".$row["Numéro"]?> </span>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-<?php if($row["dateFin"] < date("Y-m-d")) { echo("success"); } else { echo("danger"); }?>" <?php if($row["dateFin"] > date("Y-m-d")) { echo("title=\"Raison : ".$row['raison']."\""); } ?> role="button" aria-disabled="true"><?php if($row["dateFin"] < date("Y-m-d")) { echo("Disponible"); } else { echo("Indisponible"); }?></a>
                                        <a href="gerervehicule.php?caserne=<?=$idCaserne?>&type=<?=$row["IdTypeEngin"]?>&num=<?=$row["Numéro"]?>" class="btn btn-warning" role="button" aria-disabled="true">Gérer</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        
                    <?php }
                ?>
                </div>
            </div>
        </div>
        <p class="lead text-muted text-decoration-underline">Ajouter un véhicule appartenant à cette caserne :</p>

        <form method="post" action="gerercaserne.php?id=<?= $idCaserne ?>" id="form" novalidate>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <label for="type" class="text-decoration-underline">Type d'engin :</label>
                        <div class="form-group">
                            <select class="form-control col-md-6" name="typeengin" id="typeengin">
                                <option style="display: none;"  selected value="none">Choisir un type d'engin</option>';
                                <?php
                                    foreach  ($typeEngins as $row) {
                                        echo '<option value="'.$row["idTypeEngin"].'">'.ucwords($row["idTypeEngin"]).'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    <div class="invalid-feedback">L'identifiant est obligatoire</div>
                </div>


                <div class="col-lg-4 col-sm-12">
                    <label for="type" class="text-decoration-underline">Garage pour mise en service :</label>
                        <div class="form-group">
                            <select class="form-control col-md-6" name="garage" id="garage">
                                <option style="display: none;"  selected value="none">Choisir un type d'engin</option>';
                                <?php
                                    foreach  ($resultGarage as $row) {
                                        echo '<option value="'.$row["idGarage"].'">'.ucwords($row["nomGarage"])." (".ucwords($row["nom"]).')</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    <div class="invalid-feedback">L'identifiant est obligatoire</div>
                </div>

                <div class="col-lg-4 col-sm-12">
                    <label for="type" class="text-decoration-underline">Caserne :</label>
                        <div class="form-group">
                            <input type="text" class="form-control" disabled value="<?= ucfirst($resultCaserne["NomCaserne"]); ?>" required>
                            <input type="text" class="form-control"  style="display: none;" disabled value="<?= ucfirst($resultCaserne["idCaserne"]); ?>" name="idCaserne" required>
                        </div>
                    <div class="invalid-feedback">L'identifiant est obligatoire</div>
                </div>
            </div>
            <div class="row text-center my-3">
                <div class="col">
                    <input type="submit" value="Ajouter" class="btn btn-primary" name="valider" />
                </div>
            </div>
        </form>

    </div>
<?php
    include_once("./includes/footer.inc.php");
?>