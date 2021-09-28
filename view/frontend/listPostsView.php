<?php $title = 'Jean Forteroche/accueil'; ?>

<?php ob_start(); ?>

<!-- Accueil -->
<div class="embed-responsive embed-responsive-16by9">
        <video autoplay muted loop>
            <source src="public/images/home.mp4" type="video/mp4">
        </video>
        <div class="card-img-overlay d-flex flex-column my-auto align-items-center justify-content-center text-center text-white">
            <h1 class="display-3 font-weight-light">Jean Forteroche</h1>
            <h2 class="font-weight-light font-italic">Auteur et écrivain</h2>
        </div>
    </div>

    <div class="jumbotron jumbotron-fluid bg-danger py-4">
        <div class="container text-white">
                <h4 class="font-weight-light">Billet simple pour l'Alaska</h4><br/>
                <h5 class="font-weight-light font-italic">Un "web roman" dramatique et épique,<br/>
                composé de 10 chapitres que vous pouvez commenter en vous connectant.<br/>
                Ce "web roman" est uniquement disponible sur mon blog.<br/>
                Bonne lecture !
                </h5> 
        </div>
    </div>
    
    <!-- Biographie -->
    <div class="container py-4">
        <div class="row my-5 px-5 border border-danger text-danger shadow">
            <div class="col-12 col-md-6 col-lg-5 my-4 pt-5">
                <img class="img-fluid d-block w-50 border border-danger" src="public/images/portrait.jpg" alt="Potrait">
            </div>
            <div class="col-12 col-md-6 col-lg-7 my-4">
                <h3 class="font-weight-light">Jean Forteroche</h3>
                <hr class="border border-info">
                <p> Né à Genève en Suisse, j'ai suivi des études dans une école de commerce qui m'ennuyait terriblement, je préferais errer dans les librairies.<br/>
                    Fils unique et très introverti je ne me mélangeais pas au autres une feuille et un stylo me suffisaient.
                    J'écrivais des poêmes, inventais des proverbes puis sur des ressentis, des expériences vécues et des voyages.<br><br/>
                    Je suis parti à Paris, ai cumulé des petits jobs jusqu'à cette rencontre avec le rédacteur en chef d'un journal d'actualités. Il a adoré ma plume et m'a engagé en tant que journaliste.<br/><br/>
                    À 42 ans après ce voyage innoubliable en Alaska, j'ai décidé d'écrire mon premier "web roman" : <span class="font-weight-light font-italic text-info"> Billet simple pour l'Alaska.</span>
                </p> 
            </div>
        </div>
    </div>
    
    <div class="jumbotron jumbotron-fluid my-5" style="background: url(public/images/alaska.jpg) no-repeat center center fixed; background-size: cover;">
        <div class="container text-center text-white py-5 my-5">
                <h2 class="display-4 font-weight-light">Billet simple pour l'Alaska</h2>
                <h3 class=" font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h3>
        </div>
    </div>

<!-- Boucle / Affichage résumés chapitres -->
<?php
while ($data = $posts->fetch())
{
?>
    <div class="container pb-5"> 
        <div class="row text-center text-danger bg-danger mb-3">
            <div class="col-12">
                <div class="card border-danger shadow">
                    <div class="card-body">
                        <h3 class="card-title font-weight-light"><?= htmlspecialchars($data['title']) ?><br/></h3>
                        <p class="font-weight-light font-italic text-info">
                        par <?= strtoupper($data['pseudo']) ?>
                        le <?= $data['created_date_fr'] ?>
                        </p>
                    <?php if(strlen($data['content']) > 200) { 
                        $data['content'] = substr($data['content'], 0, 200).'...'; } ?>
                        <p class="card-text"><?=  nl2br($data['content']) ?></p><br/>
                        <p><a class="font-weight-light font-italic text-info" href="index.php?action=post&amp;id=<?= $data['id'] ?>">Lire la suite</a></p>
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
