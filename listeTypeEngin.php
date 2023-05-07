<?php
    $page = "camions";
    $title = "Gérer les engins";
    require_once("./includes/connection.inc.php");
    include_once("./includes/header.inc.php");
?>
<main role="main">
    <?php
        echo generationEntete("Les véhicules de pompier", "Voici la liste des types de véhicules que l'on peut trouver dans une caserne de pompiers.");
    ?>

    <div class="album py-5">
        <div class="container">
            <?php
            if(isset($_GET['status'])) {
                $err = htmlspecialchars($_GET['status']);

                switch($err) {
                    case 'success':
            ?>
            <div class="alert alert-success">
                <strong><i class="fa-solid fa-check"></i> Succès :</strong> Insertion de l'engin
                <strong><?= $_GET['nomEngin']; ?></strong> éffectuée avec succès !
            </div>
            <?php
                    break;
                
                case 'error':
                    ?>
            <div class="alert alert-danger">
                <strong><i class="fa-solid fa-x"></i> Erreur :</strong> une erreur s'est produite.
            </div>
            <?php
                    break;

                case 'deleted':
            ?>
            <div class="alert alert-danger">
                <strong><i class="fa-solid fa-circle-exclamation"></i> Attention :</strong> l'engin
                <strong><?= $_GET['id']; ?></strong> viens d'être supprimé !
            </div>
            <?php
                    break;

                case 'updated':
            ?>
            <div class="alert alert-warning">
                <strong><i class="fa-solid fa-triangle-exclamation"></i> Alerte :</strong> l'engin
                <strong><?= $_GET['ancienNom']; ?></strong> viens d'être modifié.
            </div>
            <?php
                        break;
                    }
                }
            ?>
            <div class="row">
                <?php
                    $listeVeh = "SELECT idTypeEngin, LblEngin, img FROM TypeEngin;";
                    foreach ($db->query($listeVeh) as $row) 
                    {?>
                <div class="col-md-4 fw-bolder grow">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="images/engins/<?php echo $row["img"]?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"> <?php echo $row["LblEngin"].' ('.$row["idTypeEngin"].')'?> </p>

                            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="ModifTypeEngin.php?id=<?php echo ($row["idTypeEngin"])?>" type="button" class="btn btn-sm btn-warning">Modifier</a>
                                <a href="suppTypeEngin.php?id=<?php echo ($row["idTypeEngin"])?>" type="button" class="btn btn-sm btn-danger">Supprimer</a>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</main>
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <a href="AjoutTypeEngin.php" type="button" class="btn btn-primary btn-lg">Ajouter</a>
            </div>
        </div>
    </div>
<?php } ?>
<br>

<?php
    include_once("./includes/footer.inc.php");
?>