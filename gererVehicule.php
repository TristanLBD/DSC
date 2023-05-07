<?php
    include_once("./includes/connection.inc.php");
    if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: listecasernes.php'); }

    $idCaserne = htmlspecialchars($_GET["caserne"]);
    $typeEngin = htmlspecialchars($_GET["type"]);
    $numEngin = htmlspecialchars($_GET["num"]);

    if(isset($_POST['maintenanceUpdate'])) {
        $raison = htmlspecialchars($_POST["raison"]);
        $dateDebut = htmlspecialchars($_POST["dateDebut"]);
        $dateFin = htmlspecialchars($_POST["dateFin"]);

        $req = $db->prepare('UPDATE MAINTENANCE SET raison = :raison, dateFinMaintenance = :dateFin WHERE idCaserne = :idCaserne AND idTypeEngin = :idTypeEngin AND Numéro = :numero AND dateDebutMaintenance = :dateDebut');
        
        try {
            $req->execute(array(
                ':dateDebut' => $dateDebut,
                ':numero' => $numEngin,
                ':idTypeEngin' => $typeEngin,
                ':idCaserne' => $idCaserne,
                ':dateFin' => $dateFin,
                ':raison' => $raison
            ));
            header("Location: gerercaserne.php?id=".$idCaserne);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }



    $req = $db->prepare("
    SELECT Numéro,engin.idTypeEngin,img,LblEngin,NomCaserne
    FROM engin, typeengin, caserne
    where engin.idCaserne = :midCaserne 
    AND engin.idTypeEngin = :IdTypeEngin
    AND engin.Numéro = :Numero
    AND engin.idTypeEngin = typeengin.idTypeEngin
    AND engin.idCaserne = caserne.IdCaserne");

    try {
        $req->execute(array(
            ':midCaserne' => $idCaserne,
            ':IdTypeEngin' => $typeEngin,
            ':Numero' => $numEngin
        ));
        $resultEngin = $req->fetch(PDO::FETCH_ASSOC);
        if(!$req->rowCount()) {
            header('Location: listecasernes.php');
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $req = $db->prepare("
        SELECT Max(dateDebutMaintenance) as dateDebut, MAX(dateFinMaintenance) as dateFin, maintenance.Numéro, maintenance.IdTypeEngin, maintenance.IdCaserne, img, LblEngin, raison
        FROM maintenance, engin, typeengin
        WHERE maintenance.IdTypeEngin = engin.IdTypeEngin AND maintenance.Numéro = engin.Numéro AND maintenance.IdCaserne = engin.IdCaserne AND typeengin.IdTypeEngin = engin.IdTypeEngin  AND maintenance.IdCaserne = :midCaserne AND maintenance.Numéro = :mnumero AND maintenance.idTypeEngin = :midtypeengin
        GROUP BY maintenance.Numéro, maintenance.IdTypeENgin, maintenance.IdCaserne;
    ");
    try {
        $req->execute(array(
            ':midCaserne' => $idCaserne,
            ':mnumero' => $numEngin,
            ':midtypeengin' => $typeEngin
        ));
        $resultMaintenance = $req->fetch(PDO::FETCH_ASSOC);
        $countEngin = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    $page = "caserne";
    $title = "Caserne ".ucfirst($resultEngin["NomCaserne"]);
    include_once("./includes/header.inc.php");
?>
    <?php echo generationEntete($resultEngin['idTypeEngin'].$resultEngin['Numéro']. " de la caserne ".ucfirst($resultEngin['NomCaserne'])." : ", "Gérer la caserne ".ucfirst($resultEngin['NomCaserne'])); ?>
    <div class="album py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" id="photo" src="images/engins/<?php echo $resultEngin["img"]?>" onclick="triggerClick('#image')" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"> <?php echo ucwords($resultEngin["LblEngin"])?> </p>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

    <?php
        if(!$resultMaintenance["dateFin"] < date("Y-m-d")) :
    ?>

    <div class="container">
		<form method="post" action="./gerervehicule.php?caserne=<?=$idCaserne?>&num=<?=$numEngin?>&type=<?=$typeEngin?>" id="form" novalidate>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <label for="dateFin" class="form-label text-decoration-underline">Date de naissance :</label>
                    <input type="date" name="dateDebut" value="<?= $resultMaintenance["dateDebut"] ?>" id="dateDebut" style="display : none;" required>
                    <input type="date" name="dateFin" value="<?= $resultMaintenance["dateFin"] ?>" id="dateFin" class="form-control" required>
                </div>

                <div class="col-md-6 col-sm-12">
                    <label for="floatingTextarea" class="form-label text-decoration-underline">Raison de la maintenance :</label>
                    <textarea class="form-control"  name="raison" id="floatingTextarea"><?= $resultMaintenance["raison"];?></textarea>
                </div>
            </div>

			<div class="row mt-3">
                <div class="col text-center">
                    <input type="submit" value="Modifier" class="btn btn-warning" name="maintenanceUpdate" />
                </div>
			</div>
		</form>
    </div>
    
    <?php
        else :
            echo("<p class='text-center fw-bolder fs-1 text-decoration-underline'>Aucunne maintenance en cours pour ce véhicule.</p>");
        endif;
    ?>
    
<?php
    include_once("./includes/footer.inc.php");
?>