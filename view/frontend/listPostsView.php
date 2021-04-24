<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon blog !</h1>
<h2>Les derniers billets du blog :</h2>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?><br/>
            <em>par <?= strtoupper($data['author']) ?></em>
            <em>le <?= $data['creation_date_fr'] ?></em>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br />
            <em><strong><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></strong></em>
        </p>
    </div>
<?php
} // Fin de la boucle des billets
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
