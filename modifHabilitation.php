<?php
    $page = "habilitations";
    $title = "Gérer les habilitations";
    require_once("./includes/connection.inc.php");
    if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: habilitation.php'); }


    if(!isset($_GET['id']) || empty($_GET['id'])) { header('Location : habilitation.php'); die(); }
    $idHabilitatuion = htmlspecialchars($_GET['id']);

    if(isset($_POST['valider']) && isset($_POST['libelle']) && !empty($_POST['libelle'])){
        $lblHab = htmlspecialchars($_POST['libelle']);
        $req = $db->prepare('UPDATE habilitation SET LblHabilitation = :lblHab WHERE idHabilitation  = :id');
        
        try {
            $req->execute(array(
                ':lblHab' => $lblHab,
                ':id' => $idHabilitatuion
            ));
            header("Location: habilitation.php?status=updated");
            die();
        } catch(PDOException $e) {
            echo $e->getMessage();
            // header('Location : habilitation.php');
            // die();
        }
        
    }

    $req = $db->prepare('SELECT * FROM  habilitation WHERE idHabilitation = :idHab');
    
    try {
        $req->execute(array(
            ':idHab' => $idHabilitatuion    
        ));
        if($req->rowCount() >= 1)
        $result = $req->fetch();

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    require_once("./includes/header.inc.php");
?>
    
    <div class="container">
        <?php echo generationEntete("Habilitations :","Modifier une habilitation."); ?>
        <div class="row">
            <div class="col">

                <form method="POST" action="./modifhabilitation.php?id=<?=$idHabilitatuion?>">
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bolder text-decoration-underline">ID de l'habilitation :</label>
                        <input type="number" value="<?= $result['idHabilitation'] ?>" class="form-control" id="id" aria-describedby="idhab" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="libelle" class="form-label fw-bolder text-decoration-underline">Libéllé :</label>
                        <input type="text" value="<?= $result['LblHabilitation'] ?>" class="form-control" name="libelle" id="libelle">
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" name="valider" class="btn btn-warning grow">Modifier</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<?php
    include_once("./includes/footer.inc.php");
?>