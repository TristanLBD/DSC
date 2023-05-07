<?php
    $page = "accueil";
    $title = "Accueil";
    include_once("./includes/connection.inc.php");
    include_once("./includes/header.inc.php");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $req = $db->prepare("SELECT * FROM carousel");
    try {
        $req->execute();
        $resultCarousel = $req->fetchAll(PDO::FETCH_ASSOC);
        $rowCarousel = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo generationEntete("DSC", "Direction de la Sécurité Civile.");
?>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <?php
            $count = 0;
            foreach($resultCarousel as $row) {
                $count = $count + 1;
                if($rowCarousel > $count) {
        ?>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?=$count?>"
            aria-label="Slide <?=$count+1?>"></button>
        <?php
                }
            }
        ?>
    </div>
    <div class="carousel-inner">
        <?php 
            $count = 0;
            foreach($resultCarousel as $row) {
            $count = $count + 1;
        ?>
        <div style="background-color: black;" class="carousel-item <?php if($count == 1){ echo("active"); } ?>">
            <center><img src="./images/carousel/<?= $row['img']?>" style="height: 500px; width: auto;"></center>
            <div class="carousel-caption d-none d-md-block">
                <h5 class="text-decoration-underline"><?= $row['titre'] ?></h5>
                <p><?= $row['info'] ?></p>
            </div>
        </div>
        <?php
            }

            
            if(!$rowCarousel) {
        ?>
        <div style="background-color: black;" class="carousel-item active">
            <center><img src="./images/carousel/placeholder.png" style="height: 500px; width: auto;"></center>
            <div class="carousel-caption d-none d-md-block">
                <h5>Aucunne nouvelle a signaler</h5>
                <p>Aucunne nouvelle a signaler</p>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<?php
    //! Nombre de pompiers
    $req = $db->prepare("SELECT DISTINCT COUNT(*) as total FROM pompier");
    try {
        $req->execute();
        $resultPompier = $req->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    //! Nombre de casernes 
    $req = $db->prepare("SELECT COUNT(*) as total FROM caserne");
    try {
        $req->execute();
        $resultCaserne = $req->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    
    //! Nombre de vehicules
    $req = $db->prepare("SELECT COUNT(*) as total FROM engin");
    try {
        $req->execute();
        $resultEngin = $req->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo("<center><h1>Il y a un total de <strong class='text-decoration-underline'>".$resultPompier['total']." pompiers</strong> et de <strong class='text-decoration-underline'>".$resultEngin['total']." engins</strong> répartis dans <strong class='text-decoration-underline'>".$resultCaserne['total']." casernes</strong> !</h1></center>");
    include_once("./includes/footer.inc.php");
?>