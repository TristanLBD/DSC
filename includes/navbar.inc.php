<header>
    <?php $style = "style=\"background-image: url('./images/flames.gif');background-size: cover;background-position: 0 15px;background-repeat: no-repeat;\"" ?>
    <div class="px-3 py-2 text-bg-danger">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="./index.php"
                    class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none nav-titre">
                    <i class="fa-solid fa-fire"></i>&nbsp; <span class="text-decoration-underline">Direction de la
                        Sécurité Civile</span>
                </a>
                <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                    <li class="text-center <?php if(isset($page)){if($page == "accueil"){ echo("navbar-active-link overflow"); }} ?>"
                        style="">
                        <a href="./index.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "accueil"){ echo($style); }} ?>>
                            <i class="fa-solid fa-house"></i> <br> Accueil
                        </a>
                    </li>
                    <li
                        class="text-center <?php if(isset($page)){if($page == "habilitations"){ echo("navbar-active-link overflow"); }} ?>">
                        <a href="./habilitation.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "habilitations"){ echo($style); }} ?>>
                            <i class="fa-solid fa-id-card-clip"></i> <br> Habilitations
                        </a>
                    </li>
                    <li
                        class="text-center <?php if(isset($page)){if($page == "camions"){ echo("navbar-active-link overflow"); }} ?>">
                        <a href="./listeTypeEngin.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "camions"){ echo($style); }} ?>>
                            <i class="fa-solid fa-truck"></i> <br> Camions
                        </a>
                    </li>
                    <li
                        class="text-center <?php if(isset($page)){if($page == "pompiers"){ echo("navbar-active-link overflow"); }} ?>">
                        <a href="./formulaire_dsc.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "pompiers"){ echo($style); }} ?>>
                            <i class="fa-solid fa-user-plus"></i> <br> Ajout Pompier
                        </a>
                    </li>
                    <li
                        class="text-center <?php if(isset($page)){if($page == "caserne"){ echo("navbar-active-link overflow"); }} ?>">
                        <a href="./listecasernes.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "caserne"){ echo($style); }} ?>>
                            <i class="fa-solid fa-house"></i> <br> Casernes
                        </a>
                    </li>
                    <li
                        class="text-center <?php if(isset($page)){if($page == "garages"){ echo("navbar-active-link overflow"); }} ?>">
                        <a href="./listeGarages.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "garages"){ echo($style); }} ?>>
                            <i class="fa-solid fa-wrench"></i> <br> Garages
                        </a>
                    </li>

                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "Admin") { ?>
                    <li
                        class="text-center <?php if(isset($page)){if($page == "carousel"){ echo("navbar-active-link overflow"); }} ?>">
                        <a href="./gestion_carousel.php" class="nav-link text-white"
                            <?php if(isset($page)){if($page == "carousel"){ echo($style); }} ?>>
                            <i class="fa-solid fa-images"></i> <br> Carousel
                        </a>
                    </li>

                        <li
                        class="text-center">
                        <a href="./logout.php" class="nav-link text-white">
                            <i class="fa-solid fa-power-off"></i> <br> Déconnexion
                        </a>
                    </li>
                    <?php } ?>
                    

                </ul>
            </div>
        </div>
    </div>
</header>