</DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset = "utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous"
        >
        <link href="public/css/style.css" rel="stylesheet" />
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
            <div class="bg-danger">
                <div class="container">
                    <div class="row">
                        <nav class="col navbar navbar-expend-lg navbar-dark">
                            <a class="navbar-brand font-weight-light" href="index.php">Jean Forteroche</a>
                            <ul class="navbar-nav">
                                <div class="text-white font-weight-light">
                                    <?php if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']))
                                    {?>
                                        Bonjour <?= $_SESSION['pseudo'];?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="index.php?action=deconnexion">Se deconnecter</a>
                                            </li>
                                    <?php  } else { ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="index.php?action=connexion">Se connecter</a>
                                            </li>
                                    <?php }?>
                                </div>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <?= $content ?>
        <footer>
            <div class="bg-danger mt-5">
                <div class="container">
                    <div class="row py-4 text-white text-center">
                        <div class="col">
                            <a class="fb-ic">
                                <i class="fab fa-facebook-f fa-lg text-white mr-md-5 mr-3 fa-2x"></i>
                            </a>
                            <a class="tw-ic">
                                <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
                            </a>
                            <a class="ins-ic">
                                <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"></i><br/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="link bg-info text-white text-center py-3">
                <a class="text-white" href="#">Paramètres des cookies</a> | <a class="text-white" href="#">Politique de confidentialité et utilisation des cookies</a> | <a class="text-white" href="#">Mention légale</a>
            </div>
        </footer>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
</html>
