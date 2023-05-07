<?php
    session_start();
    $_SESSION['active'] = 'active';

    require_once("./includes/connection.inc.php");

    if(isset($_POST["valider"])) {
        if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);

            $check = $db->prepare('SELECT id, email, pwd, role FROM utilisateurs WHERE email = ?');
            try {
                $check->execute(array($email));
                $data = $check->fetch(PDO::FETCH_ASSOC);
                $row = $check->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
                header('Location: ./login.php?reg_err=invalidlogin'); die();
            }
            

            //! Si > à 0 alors l'utilisateur existe
            if($row > 0) {
                // Si le mail est bon niveau format
                if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // Si le mot de passe est le bon
                    if(password_verify($password, $data['pwd'])) {
                        // On créer la session et on redirige sur landing.php
                        $_SESSION['id'] = $data['id'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['role'] = $data['role'];
                        header('Location: ./index.php');
                        die();
                    }else{ header('Location: ./login.php?login_err=password'); die(); }
                }else{ header('Location: ./login.php?login_err=email'); die(); }
            }else{ header('Location: ./login.php?login_err=already'); die(); }
        }else{ header('Location: ./login.php'); die();} // si le formulaire est envoyé sans aucune données
    }

    include_once("./includes/header.inc.php");
    echo generationEntete("DSC", "Connexion");
?>
    <div class="container d-flex align-items-center justify-content-center my-auto">
        <form method="POST" action="./login.php">
            <div class="mb-3">
                <label for="email" class="form-label text-decoration-underline fw-bolder ">Adresse Electronique :</label>

                <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label text-decoration-underline fw-bolder ">Mot de passe :</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <center>
                <button type="submit" class="btn btn-primary" name="valider">Envoyer</button>
                <button type="reset" class="btn btn-danger" name="valider">Annuler</button>
            </center>
        </form>
    </div>
<?php
    include_once("./includes/footer.inc.php");
?>