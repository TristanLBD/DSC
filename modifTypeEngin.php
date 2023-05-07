    <?php
		$title = "Modifier un véhicule";
		$page = "camions";
        require_once("./includes/connection.inc.php");
		if(!isset($_SESSION) || $_SESSION['role'] != "Admin") { header('Location: listeTypeEngin.php'); }

		if(isset($_POST['valider'])) {

			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$ancienNom = $_GET['nom'];

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				var_dump($_POST);

				$erreur = False; // on est optimiste
				$LblEngin = $_POST['lblengin'];
				$idTypeEngin =  $_GET['id'];

				if(isset($_FILES["image"]) && $_FILES["image"]["name"] != "") {
					
					$file_name = $_FILES['image']['name'];
					$file_name_to_save = $idTypeEngin;
					$file_size = $_FILES['image']['size'];
					$file_tmp = $_FILES['image']['tmp_name'];
					$file_type = $_FILES['image']['type'];
					
					$file_extension = explode('.', $_FILES['image']['name']);
					$file_ext = strtolower(end($file_extension));
					
					$extensions= array("jpeg","jpg","png","webp","gif","jfif");
					
					if(in_array($file_ext,$extensions)=== false){
						$errors[]="Extension not allowed, please choose a JPEG or PNG file.";
					}
					
					if($file_size > 2097152) {
						$errors[]='File size must be excately 2 MB';
					}
					
					if(empty($errors)==true) {
						unlink("./images/engins/".$ancienNom);
						sleep(1);
						move_uploaded_file($file_tmp,"./images/engins/".$file_name_to_save.'.'.$file_ext);
						$img_to_insert = $file_name_to_save.'.'.$file_ext;
						
					} else {
						return $errors;
					};

					$sql4 = "UPDATE typeengin SET `img` = :img_to_insert where `idTypeEngin` = :id";

					$req4 = $db->prepare($sql4);
					$req4->execute(array(
						':img_to_insert' => $img_to_insert,
						':id' => $idTypeEngin
					));
				}


				if (!isset($idTypeEngin) || strlen($idTypeEngin)>4)  {
					$erreur = True;
				}

				// tests sur le libelle
				if (!isset($LblEngin) || strlen($LblEngin)<3 || strlen($LblEngin)>45 || !is_string($LblEngin)) {
					$erreur = True;
				}
				
				// Ajout si pas d'erreur
				if( ! $erreur ) {
					// Préparation de la requête principale
					$req = $db->prepare('UPDATE TypeEngin SET LblEngin=:mLblEngin WHERE idTypeEngin=:midTypeEngin');

					// On va utiliser bind pour lier les variables PHP au paramètre :m de prépare
					$req->bindParam(':mLblEngin', $LblEngin, PDO::PARAM_STR);
					$req->bindParam(':midTypeEngin', $idTypeEngin, PDO::PARAM_STR);

					// On tente avec un try d'executer la requête
					try {
						$req->execute();
						header('Location: listeTypeEngin.php?ancienNom='.$idTypeEngin.'&status=updated');
					} catch(PDOException $e) {
						if ($e->getCode()==23000) {
							echo "Cet id d'engin existe déjà";
						} else {
							echo $e->getMessage();
						}
					}	
				} else {
					echo("On a trouvé des erreurs dans le filtrage des informations");
				};
			};
		};
        require_once("./includes/header.inc.php");
    ?>
    <main role="main" class="mt-5">
		<section class="jumbotron text-center">
			<div class="container">
			<h1 class="jumbotron-heading text-decoration-underline"></h1>
			<p class="lead text-muted"></p>
			</div>
		</section>
		<?php echo generationEntete("Modification d'un type Engin", "Modifier les champs qui vous semble utile !"); ?>

		<div class="album py-5">
			<div class="container">
			<div class="row justify-content-center">
			<?php
				$id = htmlspecialchars($_GET["id"]);
                $req = $db->prepare('SELECT idTypeEngin, LblEngin, img FROM TypeEngin WHERE idTypeEngin = :mid;');
				$req->execute(array(':mid' => $id));
				$result = $req->fetchAll();

				foreach ($result as $row) 
				{?>            
				<div class="col-md-4">
					<div class="card mb-4 box-shadow">
					<img class="card-img-top" id="photo" src="images/engins/<?php echo $row["img"]?>" onclick="triggerClick('#image')" alt="Card image cap">
					<div class="card-body">
						<p class="card-text"> <?php echo ucwords($row["LblEngin"])?> </p>
					</div>
					</div>
				</div>        
				<?php }
			?>
			</div>
			</div>
		</div>
		</main>
		<div class="container">
			<form method="post" action="ModifTypeEngin.php?nom=<?php echo ($row["img"])?>&id=<?php echo($row["idTypeEngin"])?>" id="form" enctype="multipart/form-data" novalidate>
				<div class="row">
					<div class="col-lg-4 col-sm-12">
						<label for="idTypeEngin" class="text-decoration-underline fw-bolder">Identifiant  (champ non modifiable)</label>
						<input pattern="[A-Z]{2,4}" disabled="disabled" class="form-control" value="<?php echo ($row["idTypeEngin"])?>" name="idTypeEngin" id="idTypeEngin" placeholder="Ex : EPA" required>
						<div class="invalid-feedback">L'id du type Véhicule est obligatoire ( Il est constitué de 3 à 4 caractère en majuscule )</div>
					</div>

					<div class="col-lg-4 col-sm-12">
						<label for="image" class="text-decoration-underline fw-bolder">Photo</label><br>
						<input type="file" accept="image/*" onchange="actualiserPhoto(this, 'photo')" id="image" name="image">
						<div class="invalid-feedback">La photo est obligatoire</div>
					</div>

					<div class="col-lg-4 col-sm-12">
						<label for="LblEngin" class="text-decoration-underline fw-bolder">Libellé de l'engin</label>
						<input class="form-control" name="lblengin" value="<?php echo ucwords($row["LblEngin"])?>" id="LblEngin" required>
						<div class="invalid-feedback">Le libellé de l'engin est obligatoire</div>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col text-center">
						<input type="submit" value="Modifier" class="btn btn-primary" name="valider" />
					</div>
				</div>

			</form>
		</div>

	<?php
		include_once("./includes/footer.inc.php");
	?>