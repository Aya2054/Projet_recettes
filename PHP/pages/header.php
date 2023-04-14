<?php
$logged = isset($_SESSION['nickname']) ;
?>

<header>
    <nav>
        <div id="menu">
            <div><a href=""><h1 id="logo" class="elm-menu"><span id="isa">ISA</span>-Recettes</h1></a>

            </div>
            <div>
                <ul>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acceuil
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>




                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Nos recettes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>

                    <?php if($logged):?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Opérations
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>


                </ul>
            </div>

            <?php if($logged):?>//a ajouter
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
