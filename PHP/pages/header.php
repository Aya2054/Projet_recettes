<?php

$logged = isset($_SESSION['nickname']) ;
?>

<header>
    <nav>
        <div id="menu">
            <div><a href="page_principale.php"><h1 id="logo" class="elm-menu"><span id="isa">ISA</span>-Recettes</h1></a>

            </div>
            <div>
                <ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Contact
                        </a>
                        <ul class="dropdown-menu" id="contacter">
                            <li><a href="mail:isa-office@gmail.com" id="m"><i class="bi bi-envelope"></i> isa-office@gmail.com</a></li>
                            <li><a href="tel:(07)668888339" id="t"><i class="bi bi-telephone"></i> (07) 66 88 33 99</a></li>
                        </ul>
                    </li>




                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opérations
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="recettes.php">Afficher toutes</a></li>
                            <?php if($logged):?>
                            <li><a class="dropdown-item" href="ajouter.php">Ajouter une recette</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>


                </ul>
            </div>

            <?php if($logged):?>
                <a class="btn " role="button" href="logout.php">
                    <div>
                        <input type="button" value="déconnexion" id="btn">
                    </div>
                </a>
            <?php else: ?>
                <a class="btn " role="button" href="login.php">
                    <div>
                        <input type="button" value="Connexion" id="btn">
                    </div>
                </a>
            <?php endif; ?>

        </div>
    </nav>
</header>
