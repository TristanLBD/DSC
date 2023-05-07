<?php
    require_once("./includes/connection.inc.php");
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
    
    $page = "caserne";
    $title = "Caserne ".ucfirst($resultCaserne["NomCaserne"]);

    require_once("./includes/header.inc.php");

    $req = $db->prepare("
        SELECT A.Matricule, Max(Date) as DateAffectation, idCaserne, NomPompier,PrenomPompier,DateNaissPompier,TelPompier,SexePompier,pompier.idGrade, LblGrade
        FROM Affectation A, Pompier, Grade
        WHERE Date = (select Max(Date) From Affectation Aff where A.Matricule=Aff.matricule)AND pompier.idGrade = grade.idGrade and A.Matricule = Pompier.Matricule and idCaserne = :mid group by  Matricule, Date Desc, idCaserne;");
    try {
        $req->bindParam(':mid', $idCaserne, PDO::PARAM_STR);
        $req->execute();
        $resultPompier = $req->fetchAll(PDO::FETCH_ASSOC);
        $countPompier = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    //! pas bon si l'engin a pas eu de maintenance avant (il ne sera pas selected , donc a chaque nouvel engin, prevoir 1j de prepa)
    $req = $db->prepare("
        SELECT Max(dateDebutMaintenance) as dateDebut, MAX(dateFinMaintenance) as dateFin, maintenance.Numéro, maintenance.IdTypeEngin, maintenance.IdCaserne, img, LblEngin, raison
        FROM maintenance, engin, typeengin
        WHERE maintenance.IdTypeEngin = engin.IdTypeEngin AND maintenance.Numéro = engin.Numéro AND maintenance.IdCaserne = engin.IdCaserne AND typeengin.IdTypeEngin = engin.IdTypeEngin  and maintenance.IdCaserne = :midCaserne 
        GROUP BY maintenance.Numéro, maintenance.IdTypeENgin, maintenance.IdCaserne
    ");
    try {
        $req->bindParam(':midCaserne', $idCaserne, PDO::PARAM_STR);
        $req->execute();
        $test = $req->fetchAll(PDO::FETCH_ASSOC);
        $countEngin = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    $nomCaserne = ucfirst($resultCaserne["NomCaserne"]);
    
?>
    <div class="container mt-5">
        <?php echo generationEntete("Caserne : ".$nomCaserne, "Liste des ".$countPompier." pompiers de cette caserne :"); ?>
        
        <div class="input-group">
            <span class="input-group-text">Rechercher un pompier</span>
            <input type="search" class="form-control" id="myInput" onkeyup="searchShortcut()" placeholder="Rechercher un pompier...">
        </div>
        <table class="table table-dark table-striped text-center">
            <thead>
                <tr>
                <th scope="col" class="text-decoration-underline">Nom</th>
                <th scope="col" class="text-decoration-underline">Sexe</th>
                <th scope="col" class="text-decoration-underline">Grade</th>
                <th scope="col" class="text-decoration-underline">Pro / Vol</th>
                </tr>
            </thead>
            <tbody id="racourci-container">
                <?php
                    foreach($resultPompier as $row) {
                        $req = $db->prepare("SELECT * FROM professionnel WHERE MatPro = :mid");
                        try {
                            $req->bindParam(':mid', $row["Matricule"], PDO::PARAM_STR);
                            $req->execute();
                            $resultType = $req->fetch(PDO::FETCH_ASSOC);
                            $rowCout = $req->rowCount();
                        } catch(PDOException $e) {
                            echo $e->getMessage();
                        }

                        if($rowCout) {
                            $typePompier = "Professionnel";
                        } else {
                            $typePompier = "Volontaire";
                        }

                        echo("
                        <tr class='racourci'>
                            <td class='racourci-title'>".ucfirst($row['NomPompier']).' '.ucfirst($row['PrenomPompier'])."</td>
                            <td class='racourci-title'>".ucfirst($row['SexePompier'])."</td>
                            <td class='racourci-title'>".ucfirst($row['LblGrade'])."</td>
                            <td class='racourci-title'>".$typePompier."</td>
                        </tr>");
                    }
                ?>
                <tr id='noresult' style="display: none;">
                    <td colspan="4" class="bg-warning fw-bolder">Aucun résultat</td>
                </tr>
            </tbody>
        </table>

        <div class="container py-5">
            <hr>
        </div>

        <div class="album">
            <p class="lead text-muted text-decoration-underline">Liste des <?= $countEngin ?> engins de cette caserne :</p>
            <div class="container">
                <div class="row">
                <?php
                    foreach ($test as $row) {?>            
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="images/engins/<?php echo $row["img"]?>" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text"> <?php echo ucfirst($row["LblEngin"])?> </p>
                                <div class="card-action">
                                    <span class="card-text"> <?php echo ucfirst($row["IdTypeEngin"])." ".$row["Numéro"]?> </span>
                                    <a class="btn btn-<?php if($row["dateFin"] < date("Y-m-d")) { echo("success"); } else { echo("danger"); }?>" <?php if($row["dateFin"] > date("Y-m-d")) { echo("title=\"Raison : ".$row['raison']."\""); } ?> role="button" aria-disabled="true"><?php if($row["dateFin"] < date("Y-m-d")) { echo("Disponible"); } else { echo("Indisponible"); }?></a>
                                </div>
                            </div>
                        </div>
                    </div>        
                    <?php }
                ?>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>