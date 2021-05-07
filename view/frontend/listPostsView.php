<?php $title = 'Jean Forteroche'; ?>

<?php ob_start(); ?>

<div class="embed-responsive embed-responsive-16by9">
        <video autoplay muted loop>
            <source src="public/images/slider.mp4" type="video/mp4" alt="Vidéo livre">
        </video>
        <div class="card-img-overlay d-flex flex-column my-auto align-items-center justify-content-center text-center text-white">
            <h1 class="display-4 font-weight-light">Jean Forteroche</h1>
            <h2 class="display-7 font-weight-light font-italic">Auteur et écrivain</h2>
        </div>
    </div>

    <div class="jumbotron bg-info">
        <div class="row text-center font-weight-light font-italic text-light">
            <div class="col">
                <h5>Billet simple pour l'Alaska, un "web roman" dramatique et épique,<br/>
                Composé de 6 chapitres avec un résumé que vous pouvez commenter en vous connectant.<br/>
                Ce "web roman" est uniquement disponible sur mon blog, vous trouverez ci-dessous un lien pour le télécharger <br/>
                Bonne lecture !<br/><br/>
                <a class="link text-danger" href="#">Billet simple pour l'Alaska</a> 
                </h5>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-5 mb-4 px-5 border border-danger text-danger">
            <div class="col-12 col-md-6 col-lg-5 my-4 pt-5">
                <img class="d-block w-50 border border-danger" src="public/images/portrait.jpg" class="img-fluid" alt="Potrait">
            </div>
            <div class="col-12 col-md-6 col-lg-7 my-4">
                <h2 class="font-weight-light">Jean Forteroche</h2>
                <hr class="border border-danger">
                <p> Né à Genève en Suisse, j'ai suivi des études dans une école de commerce qui m'ennuyais terriblement, je préferais errer dans les librairies.<br/>
                    Fils unique et très introverti je ne me mélangeais pas au autres une feuille et du papier me suffisait.
                    J'écrivais des poêmes, inventais des proverbes puis sur des ressentis, des expériences vécues et des voyages.</p>
                <p>Je suis parti à Paris ai cumulé des petits jobs jusqu'à cette rencontre avec un rédacteur en chef d'un journal d'actualité. Il a adoré ma plume et m'a engagé en tant que journaliste.<br/>
                    À 42 ans après ce voyage innoubliable en Alaska, j'ai décidé d'écrire mon premier roman.</p> 
            </div>
        </div>
    </div>

    <div class="jumbotron bg-white">
        <div class="row text-center text-danger">
            <div class="col">
                <h1 class="font-weight-light">Billet simple pour l'Alaska</h1>
                <h2 class="font-weight-light font-italic">découvrez les chapitres et laissez-moi un commentaire</h2>
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
                        <em>par <?= strtoupper($data['author']) ?></em>
                        <em>le <?= $data['creation_date_fr'] ?></em>
                        <p class="card-text"><?= nl2br(htmlspecialchars($data['content'])) ?></br></p>
                        <a class="btn btn-info border-danger btn-sm shadow" href="index.php?action=post&amp;id=<?= $data['id'] ?>" role="button">Lire la suite</a><br/>
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