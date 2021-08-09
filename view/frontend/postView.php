<?php $title = 'Chapitre et commentaires'; ?>

<?php ob_start(); ?>

    <div class="jumbotron" style="background: url(public/images/slider-2.jpg) no-repeat center center fixed; background-size: cover;" alt="Paysage Alaska">
        <div class="row py-5 text-center text-white">
            <div class="col">
                <h2 class="display-4 font-weight-light">Billet simple pour l'Alaska</h2>
                <h3 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h3>
            </div>
        </div>
    </div>
    
    <div class="container">
    <p><a class="font-weight-light font-italic text-info" href="index.php">Retour page d'accueil</a></p>
        <div class="row text-center text-danger bg-danger mb-3">
            <div class="col-12">
                <div class="card border-danger shadow">
                    <div class="card-body">
                        <h3 class="card-title font-weight-light"><?= htmlspecialchars($post['title']) ?></h3>
                        <p class="font-weight-light font-italic text-info">
                        par <?= $post['author'] ?>
                        le <?= $post['created_date_fr'] ?>
                        </p>
                        <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container"> 
        <div class="row text-center text-danger pb-5">
            <div class="col-12 mt-5">
                <h4 class="font-weight-light">Commentaires</h4><br/>
    <?php while ($comment = $comments->fetch()) { ?>
                <p class="font-weight-light font-italic text-danger pt-3"><?= htmlspecialchars($comment['pseudo']) ?> le <?= $comment['comment_date_fr']?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <?php if (isset($_SESSION['id'])) { ?>
            <?php if (($_SESSION['id']) == ($comment['user_id']) || $_SESSION['admin'] == true) { ?>
                <a class="font-weight-light font-italic text-info" href="index.php?action=viewEditComment&amp;id=<?= $comment['id'] ?>&postId=<?= $post['id']?>">Modifier</a> |
                <a class="font-weight-light font-italic text-info" href="index.php?action=deleteComment&amp;id=<?= $comment['id']?>&postId=<?= $post['id']?>">Supprimer</a><br/><br/>
            <?php } ?>
        <?php } ?>
        <?php if ($comment['reported'] == 1) { ?>
            <a href="index.php?action=postReport&amp;id=<?=$comment['id']?>&postId=<?= $post['id']?>"><i class="fas fa-flag text-danger"></i></a></p>
        <?php } else { ?>
            <a href="index.php?action=postReport&amp;id=<?=$comment['id']?>&postId=<?= $post['id']?>"><i class="fas fa-flag text-info"></i></a></p>
        <?php } ?>
    <?php } ?> 
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['id'])) { ?>
        <div class="text-center pb-4">
            <a href="index.php?action=viewAddComment&amp;id=<?= $post['id']?>"><input class="text-white btn-info btn-sm shadow" type="button" value="Ajoutez votre commentaire !"></a>
        </div>
    <?php } else { ?>
        <div class="text-center pb-5">
            <a href="index.php?action=connexion"><input class="text-white btn-info btn-sm shadow" type="button" value="Connectez-vous si vous souhaitez ajouter un commentaire"></a>
        </div>
    <?php } ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>