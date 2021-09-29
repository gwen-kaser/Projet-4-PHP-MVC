<?php $title = 'Commentaires signalés'; ?>

<?php ob_start(); ?>

    <div class="jumbotron jumbotron-fluid" style="background: url(public/images/alaska.jpg) no-repeat center center fixed; background-size: cover;">
        <div class="container py-5 text-center text-white">
            <h2 class="display-4 font-weight-light">Billet simple pour l'Alaska</h2>
            <h3 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h3><br/>
            <h4 class="font-weight-light">Vous pouvez supprimer un commentaires ainsi que son signalement</h4>
        </div>
    </div>
    
    <!-- Affichage commentaires signalés -->
    <div class="container">
    <p><a class="font-weight-light font-italic text-info" href= "index.php">Retour page d'accueil</a></p>
         <div class="row text-center text-danger pb-5">
            <div class="col-12 mt-5">
                <h3 class="font-weight-light">Commentaires signalés</h3><br/>
                <hr class="border border-info"><br/>
    <?php while ($comment = $reportedComments->fetch()) { ?>
                <p class="font-weight-light font-italic text-danger pt-3"><?= htmlspecialchars($comment['pseudo']) ?> le <?= $comment['comment_date_fr']?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <!-- Suppression commentaire et signalement -->
                <a class="font-weight-light font-italic text-info" href="index.php?action=deleteComment&amp;id=<?= $comment['id']?>">Supprimer le commentaire</a> |
                <a class="font-weight-light font-italic text-info" href="index.php?action=deleteReport&amp;id=<?= $comment['id']?>">Supprimer le signalement</a>
                <hr class="border border-info mt-5"><br/>
    <?php } ?> 
            </div>
        </div>
    </div>
    







<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>