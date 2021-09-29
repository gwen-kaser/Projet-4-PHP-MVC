<?php $title = 'Gestion des chapitres'; ?>

<?php ob_start(); ?>

    <div class="jumbotron jumbotron-fluid" style="background: url(public/images/alaska.jpg) no-repeat center center fixed; background-size: cover;">
        <div class="container py-5 text-center text-white">
            <h2 class="display-4 font-weight-light">Billet simple pour l'Alaska</h2>
            <h3 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h3><br/>
            <h4 class="font-weight-light">Vous pouvez<span class="font-italic"> supprimer, modifier et ajouter</span> un chapitre</h4> 
        </div>
    </div>
    <div class="container">
        <p><a class="font-weight-light font-italic text-info" href= "index.php">Retour page d'accueil</a></p>
    </div>

<!-- Boucle / Affichage chapitres -->
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
                        par <?= strtoupper($data['pseudo']) ?>
                        le <?= $data['created_date_fr'] ?>
                        </p>
                        <p class="card-text"><?= nl2br($data['content']) ?></p><br/>
                        <p>
                        <!-- Bouton suppression et modification commentaire -->
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
    <!-- Bouton d'ajout d'un chapitre -->
    <div class="text-center">
        <a href="index.php?action=viewAddPost" class="btn btn-info btn-sm border-danger shadow active" role="button" aria-pressed="true">Ajouter un chapitre</a>
    </div>
   
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
