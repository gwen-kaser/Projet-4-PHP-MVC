<?php $title = 'Inscription'; ?>

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
                <h3 class="font-weight-light">Inscrivez-vous</h3>
                <hr class="border border-info"><br/>
                
                <form action="index.php?action=saveUser" method="post">
                    <div class="form-group">
                        <label for="input">Pseudo</label>
                        <input class="form-control border border-info" type="text" id="pseudo" name="pseudo">
                    </div>
                    <div class="form-group">
                        <label for="input">Mot de passe</label>
                        <input class="form-control border border-info" type="password" id="pass" name="pass">
                        <div class="font-weight-light font-italic text-info"><?php echo $errorPassword ?? "";?></div>
                    </div>
                    <div class="form-group">
                        <label for="input">Confirmation du mot de passe</label>
                        <input class="form-control border border-info" type="password" id="pass2" name="pass2">
                    </div>
                    <div class="form-group">
                        <label for="input">Email</label>
                        <input class="form-control border border-info" type="text" id="email" name="email">
                        <div class="font-weight-light font-italic text-info"><?php echo $errorEmail ?? "";?></div>
                    </div>
                    <button type="submit" class="text-white btn-info btn-sm shadow">Confirmer</button>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>