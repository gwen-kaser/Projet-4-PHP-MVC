<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

    <div class="jumbotron bg-white">
        <div class="row text-center text-danger">
            <div class="col">
                <h1 class="font-weight-light">Billet simple pour l'Alaska</h1>
                <h2 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h2>
            </div>
        </div>
    </div>
    
    <div class="container">
    <p><a class="font-italic text-info" href="index.php">Retour à la liste des billets</a></p>
        <div class="row text-center text-danger bg-info mb-3">
            <div class="col-12">
                <div class="card border-danger shadow">
                    <div class="card-body">
                        <h3 class="card-title font-weight-light"><?= htmlspecialchars($post['title']) ?><h3>
                        <em>le <?= $post['creation_date_fr'] ?></em>
                        <p class="card-text font-weight-light"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container"> 
        <div class="row text-center text-danger">
            <div class="col-12 mt-5">
<?php
while ($comment = $comments->fetch())
{
?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> <em>le <?= $comment['comment_date_fr'] ?></em></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <em><strong><a href="index.php?action=viewComment&amp;id=<?= $comment['id'] ?>&postId=<?= $post['id']?>">Modifier</a></strong></em><br/>
                <em><strong><a href= "index.php?action=deleteComment&amp;id=<?= $comment['id']?>&postId=<?= $post['id']?>">Supprimer</a></strong></em><br/><br/>
<?php
}
?>
            </div>
        </div>
    </div>

    <div class="container pb-4">
        <div class="row mt-5 justify-content-center text-danger border border-danger">
            <div class="col-12 col-md-6 col-lg-4 py-5">
                <h3 class="font-weight-light">Ajoutez votre commentaire !</h3>
                <hr class="border border-danger"><br/>
                <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                    <div>
                        <label for="author">Auteur</label><br/>
                        <input type="text" id="author" name="author"><br/><br/>
                    </div>
                    <div>
                        <label for="comment">Commentaire</label><br/>
                        <textarea id="comment" name="comment"></textarea><br/><br/>
                    </div>
                    <div>
                        <input type="submit"class="btn-info btn-sm shadow">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>