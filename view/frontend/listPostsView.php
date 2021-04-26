<?php $title = 'Jean Forteroche'; ?>

<?php ob_start(); ?>

    <div class="jumbotron bg-white">
        <div class="row text-center text-danger">
            <div class="col">
                <h1 class="font-weight-light">Un billet simple pour l'Alaska</h1>
                <h2 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h2>
            </div>
        </div>
    </div>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="container"> 
        <div class="row text-center text-danger bg-info pt-4 pb-4">
            <div class="col-12 col-lg-4">
                <div class="card border-danger shadow">
                    <div class="card-body">
                        <h3 class="card-title font-weight-light"><?= htmlspecialchars($data['title']) ?><br/></h3>
                        <em>par <?= strtoupper($data['author']) ?></em>
                        <em>le <?= $data['creation_date_fr'] ?></em>
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['content'])) ?></br></p>
                        <a class="btn btn-outline-danger btn-sm shadow" href="#" role="button">Lire la suite</a><br/>
                        <em><strong><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></strong></em>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
