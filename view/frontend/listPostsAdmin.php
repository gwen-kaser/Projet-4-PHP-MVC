<?php $title = 'Jean Forteroche'; ?>

<?php ob_start(); ?>

    <div class="jumbotron" style="background: url(public/images/slider-2.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        <div class="row py-5 text-center text-white">
            <div class="col">
                <h1 class="font-weight-light">Billet simple pour l'Alaska</h1>
                <h2 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h2></br>
                <h3 class="font-weight-light">Vous pouvez supprimer, modifier et ajouter un chapitre</h3>
            </div>
        </div>
    </div>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="container pb-5"> 
        <div class="row text-center text-danger bg-info mb-3">
            <div class="col-12">
                <div class="card border-danger shadow">
                    <div class="card-body">
                        <h3 class="card-title font-weight-light"><?= htmlspecialchars($data['title']) ?><br/></h3>
                        <p class="font-weight-light font-italic text-info">
                        par <?= strtoupper($data['author']) ?>
                        le <?= $data['creation_date_fr'] ?>
                        </p>
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['content'])) ?></p><br/>
                        <p>
                        <a class="font-italic text-info" href="index.php?action=postViewEdit&amp;id=<?= $data['id'] ?>">Modifier</a> |
                        <a class="font-italic text-info" href= "index.php?action=deletePost&amp;id=<?= $data['id']?>">Supprimer</a>
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
        <a class="btn btn-info border-danger btn-sm shadow" href="index.php?action=viewPost">Ajouter un chapitre</a>
    </div>
   

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
