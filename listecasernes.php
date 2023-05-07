<?php
    $page = "caserne";
    $title = "Liste des casernes";
    require_once("./includes/connection.inc.php");
    require_once("./includes/header.inc.php");

    $req = $db->prepare("SELECT * FROM caserne ORDER BY NomCaserne ASC");
    try {
        $req->execute();
        $resultCaserne = $req->fetchAll(PDO::FETCH_ASSOC);
        $countPompier = $req->rowCount();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

?>

    <div class="container mt-5">
        <center><h1 class="text-decoration-underline"></h1></center>
        <?php echo generationEntete("DSC", "Voici la liste des ".$countPompier." casernes"); ?>

        <div class="input-group">
            <span class="input-group-text">Rechercher une caserne</span>
            <input type="search" class="form-control" id="myInput" onkeyup="searchShortcut()" placeholder="Rechercher une caserne...">
        </div>
        <table class="table table-dark table-striped text-center">
            <thead>
                <tr>
                    <th scope="col" class="text-decoration-underline">Nom</th>
                    <th scope="col" class="text-decoration-underline">Actions</th>
                </tr>
            </thead>
            <tbody id="racourci-container">
                <?php foreach($resultCaserne as $row) { ?>
                        <tr class='racourci'>
                            <td class='racourci-title'><?= ucfirst($row["NomCaserne"]) ?></td>
                            <td>
                                <a class='btn btn-primary' href='./infocaserne.php?id=<?= $row["idCaserne"] ?>' role='button'>Infos</a>
                                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                                <a class='btn btn-success' href='./gerercaserne.php?id=<?= $row["idCaserne"] ?>' role='button'>Gérer</a>
                                <?php } ?>
                            </td>
                        </tr>
                <?php } ?>
                
                <tr id='noresult' style="display: none;">
                    <td colspan="2" class="bg-warning fw-bolder">Aucun résultat</td>
                </tr>
            </tbody>
        </table>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>