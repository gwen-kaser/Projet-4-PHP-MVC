<?php $title = 'Admin'; ?>

<?php ob_start(); ?>

    <div class="jumbotron" style="background: url(public/images/slider-2.jpg) no-repeat center center fixed; background-size: cover;" alt="Paysage Alaska">
        <div class="row py-5 text-center text-white">
            <div class="col">
                <h2 class="display-4 font-weight-light">Billet simple pour l'Alaska</h2>
                <h3 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h3></br>
                <h4 class="font-weight-light">Vous pouvez<span class="font-italic"> supprimer, modifier et ajouter</span> un chapitre</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <p><a class="font-weight-light font-italic text-info" href= "index.php">Retour page d'accueil</a></p>
    </div>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="container pb-5"> 
        <div class="row text-center text-danger bg-danger mb-3">
            <div class="col-12">
                <div class="card border-danger shadow">
                    <div class="card-body">
                        <h3 class="card-title font-weight-light"><?= htmlspecialchars($data['title']) ?></h3><br/>
                        <p class="font-weight-light font-italic text-info">
                        par <?= strtoupper($data['author']) ?>
                        le <?= $data['creation_date_fr'] ?>
                        </p>
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['content'])) ?></p><br/>
                        <p>
                        <a class="font-weight-light font-italic text-info" href="index.php?action=viewEditPost&amp;id=<?= $data['id'] ?>">Modifier</a> |
                        <a class="font-weight-light font-italic text-info" href= "index.php?action=deletePost&amp;id=<?= $data['id']?>">Supprimer</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
    <div class="text-center">
        <a href="index.php?action=viewAddPost"><input class="text-white btn-info btn-sm shadow" type="button" value="Ajouter un chapitre"></a>
    </div>
   
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
