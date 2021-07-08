<?php $title = 'Connexion'; ?>

<?php ob_start(); ?>

    <div class="jumbotron" style="background: url(public/images/slider-2.jpg) no-repeat center center fixed; background-size: cover;" alt="Paysage Alaska">
        <div class="row py-5 text-center text-white">
            <div class="col">
                <h2 class="display-4 font-weight-light">Billet simple pour l'Alaska</h2>
                <h3 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h3>
            </div>
        </div>
    </div>

    <div class="container pb-4">
    <p><a class="font-weight-light font-italic text-info" href= "index.php">Retour page d'accueil</a></p>
        <div class="row mt-5 justify-content-center text-danger font-weight-light border border-danger">
            <div class="col-12 col-md-6 col-lg-4 py-5">
                <h3 class="font-weight-light">Connectez-vous</h3>
                <hr class="border border-info"><br/>
                
                <form action="index.php?action=connexionUser" method="post">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label><br/>
                        <input class="form-control border border-info" type="text" id="pseudo" name="pseudo">
                        <div class="font-weight-light font-italic text-info"><?php echo $errorPseudo ?? "";?></div>
                    </div>
                    <div class="form-group">
                        <label for="input">Mot de passe</label>
                        <input class="form-control border border-info" type="password" id="pass" name="pass">
                        <div class="font-weight-light font-italic text-info"><?php echo $errorPassword ?? "";?></div>
                    </div>
                    <button type="submit" class="text-white btn-info btn-sm shadow">Se connecter</button><br/><br/>
                    <a class="font-italic text-info" href="index.php?action=registration">Vous souhaitez vous inscrire ?</a>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>