    <?php
        $page = "carousel";
        $title = "Supprimer une image";
		require_once("./includes/connection.inc.php");
        if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: index.php'); }
        $id = htmlspecialchars($_GET["id"]);


        $req = $db->prepare('SELECT * FROM carousel where id = :mid');
        
        try {
            $req->execute(array(':mid' => $id));
            $resultCarousel = $req->fetch(PDO::FETCH_ASSOC);
            if(!$req->rowCount()) {
				header('Location: gestion_carousel.php');
            }
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        
		if(isset($_GET['delete'])) {
			$req = $db->prepare('DELETE FROM carousel WHERE id = :mid ');
			$req->bindParam(':mid', $id);

			try {
				$req->execute();
				/* Deleting the image from the server. */
                unlink("images/carousel/".$resultCarousel['img']);
				header('Location: gestion_carousel.php');
			} catch(PDOException $e) {  
				echo $e->getMessage();
				header('Location: gestion_carousel.php');
			}
		}
		require_once("./includes/header.inc.php");
	?>
    <div class="container mt-5">
        <main role="main">
            <?php echo generationEntete("Suppression d'une image du carousel.", "Attention la suppression est définitive !"); ?>


            <div class="row" style="border: 3px solid black;">
                <div class="col-sm-5" style="min-height: 250px; max-height: 250px; background-image: url('./images/carousel/<?= $resultCarousel["img"] ?>');  background-repeat: no-repeat; background-size: contain; background-position: center;"></div>
                <div class="col-sm-7">
                    <p style="font-size: 35px; text-decoration: underline; font-family: 'Poppins', sans-serif; font-weight: 900;"><?= ucfirst($resultCarousel["titre"]) ?></p>
                    <p><?= ucfirst($resultCarousel["info"]) ?></p>
                </div>
            </div>
        </main>
    </div>

    <div class="container mt-3"> 
		<div class="row"> 
			<div class="col text-center"> 
				<a href="./SupprCarousel.php?id=<?php echo($resultCarousel['id'])?>&delete=true" type="button" name="delete" class="btn btn-danger btn-lg">Confirmer la suppression</a>
			</div> 
		</div> 
    </div>

	<?php
		include_once("./includes/footer.inc.php");
	?>
	</body>
</html>