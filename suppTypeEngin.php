    <?php
        $page = "camions";
        $title = "Supprimer un camion";
		require_once("./includes/connection.inc.php");
        if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: listeTypeEngin.php'); }
		$id = htmlspecialchars($_GET["id"]);

		if(isset($_GET['delete'])) {

			$nomFichier = $_GET["image"];
			$req = $db->prepare('DELETE FROM TypeEngin WHERE idTypeEngin = :mid ');
			$req->bindParam(':mid', $_GET["id"]);

			try {
				$req->execute();
				// On efface la photo du répertoire
				unlink("images/engins/".$nomFichier);
				header('Location: listeTypeEngin.php?status=deleted&id='.$_GET["id"]);
			} catch(PDOException $e) {
				echo $e->getMessage();
				header('Location: listeTypeEngin.php?status=error');
			}
		}
		require_once("./includes/header.inc.php");
	?>
	<main role="main">
		<?php echo generationEntete("Suppression d'un type Engin", "Attention la suppression est définitive !"); ?>

		<div class="album py-5">
			<div class="container">
				<div class="row justify-content-center">
				<?php
					$req = $db->prepare("SELECT idTypeEngin, LblEngin, img FROM TypeEngin WHERE idTypeEngin = :mid;");
					try {
						$req->execute(array(':mid' => $id));
						$result = $req->fetch();
					} catch(PDOException $e) {
						echo $e->getMessage();
					}
				?>            
					<div class="col-md-4">
						<div class="card mb-4 box-shadow">
							<img class="card-img-top" src="images/engins/<?php echo $result["img"]?>" alt="Card image cap">
							<div class="card-body">
								<p class="card-text"> <?php echo ucwords($result["LblEngin"])?> </p>
							</div>
						</div>
					</div>        
				</div>
			</div>
		</div>
    </main>

    <!-- Bouton Suppression -->
    <div class="container"> 
		<div class="row"> 
			<div class="col text-center"> 
				<a href="suppTypeEngin.php?id=<?php echo($result['idTypeEngin'])?>&image=<?php echo($result['img'])?>&delete=true" type="button" name="delete" class="btn btn-danger btn-lg">Supprimer</a>
			</div> 
		</div> 
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
	<?php
		include_once("./includes/footer.inc.php");
	?>
	</body>
</html>