<?php $title = 'Ajouter un commentaire'; ?>

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
                <h3 class="font-weight-light">Ajoutez votre commentaire</h3>
                <hr class="border border-info"><br/>
                
                <form action="index.php?action=addComment&amp;id=<?= $_GET['id']?>" method="post">
                    <div class="form-group">
                        <label for="author">Auteur</label><br/>
                        <input class="form-control border border-info" type="text" id="author" name="author">
                    </div>
                    <div class="form-group">
                        <label for="comment">Commentaire</label><br/>
                        <textarea class="form-control border border-info" id="comment" name="comment"></textarea>
                    </div>
                    <button type="submit" class="text-white btn-info btn-sm shadow">Valider</button>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>