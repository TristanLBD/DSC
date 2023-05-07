<?php
    $page = "habilitations";
    $title = "Gérer les habilitations";
    require_once("./includes/connection.inc.php");
    $message = '';

    if(isset($_POST["valider"]) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
        if(isset($_POST["libelleHabilitation"]) && !empty($_POST['libelleHabilitation'])) {
            $libelle = htmlspecialchars($_POST['libelleHabilitation']);
            $req = $db->prepare('INSERT INTO habilitation(LblHabilitation) VALUES (:libelle)');
            
            try {
                $req->execute(array(':libelle' => $libelle));
                header("Location: habilitation.php?status=added");
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    if(isset($_GET["delete"]) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') {
        if(!empty($_GET['delete'])) {
            $id = htmlspecialchars($_GET['delete']);
            $req = $db->prepare('DELETE FROM habilitation WHERE idHabilitation  = :mid');
            
            try {
                $req->execute(array(':mid' => $id));
                header("Location: habilitation.php?status=deleted");
                } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

    $req = $db->prepare('SELECT * FROM habilitation');
    
    try {
        $req->execute();
        $result = $req->fetchAll();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    require_once("./includes/header.inc.php");

?>

<div class="container">
    <?php echo(generationEntete("DSC","Gestion des habilitations.")); ?>
    <div class="row">
        <?php
        if(isset($_GET['status'])) {
            $err = htmlspecialchars($_GET['status']);

            switch($err) {
                case 'added': ?>
                    <div class="alert alert-success">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Ajout de l'habilitation éffectuée avec succès !
                    </div>
                <?php break;

                case 'updated': ?>
                    <div class="alert alert-success">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Modification de l'habilitation éffectuée avec succès !
                    </div>
                <?php break;

                case 'deleted': ?>
                    <div class="alert alert-danger">
                        <strong><i class="fa-solid fa-check"></i> Succès :</strong> Suppression de l'habilitation éffectuée avec succès !
                    </div>
                <?php break;
            }
        }
        ?>
        <div class="col">
            <h1 class="text-center text-decoration-underline">Gestion des habilitations</h1>

            <div class="input-group">
                <span class="input-group-text">Rechercher une habilitation</span>
                <input type="search" class="form-control" id="myInput" onkeyup="searchShortcut()"
                    placeholder="Rechercher une habilitation...">
            </div>
            <table class="table table-dark table-striped text-center">
                <thead>
                    <tr>
                        <th scope="col" class="text-decoration-underline">ID</th>
                        <th scope="col" class="text-decoration-underline">Libéllé</th>
                        
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                        <th scope="col" class="text-decoration-underline">Action</th>
                        <?php } ?>

                    </tr>
                </thead>
                <tbody id="racourci-container">
                    <?php
                            foreach($result as $row) {
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
                                }?>
                    <tr class='racourci'>
                        <td class=''><?=ucfirst($row['idHabilitation'])?></td>
                        <td class='racourci-title'><?=ucfirst($row['LblHabilitation'])?></td>


                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                        <td class=''>
                            <a class="btn btn-warning" href="modifhabilitation.php?id=<?=$row['idHabilitation']?>" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn btn-danger" href="habilitation.php?delete=<?=$row['idHabilitation']?>" role="button"><i class="fa-solid fa-trash"></i></a>
                        </td>
                        <?php } ?>


                    </tr>
                    <?php } ?>
                    <tr id='noresult' style="display: none;">
                        <td colspan="3" class="bg-warning fw-bolder">Aucun résultat</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php
        if(isset($_SESSION) && !empty($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>

        <form method="post" id="form" novalidate>
            <h1 class="text-center text-decoration-underline">Ajouter une habilitation :</h1>
            <div class="row">
                <div class="form-control-group col">
                    <label class="text-decoration-underline fw-bolder" for="libelleHabilitation">Libéllé de l'habilitation</label>
                    <input class="form-control" name="libelleHabilitation" id="libelleHabilitation" required>
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