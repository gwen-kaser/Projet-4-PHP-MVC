<?php $title = 'Jean Forteroche'; ?>

<?php ob_start(); ?>

<div class="jumbotron" style="background: url(public/images/slider-2.jpg) no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
        <div class="row py-5 text-center text-white">
            <div class="col">
                <h1 class="font-weight-light">Billet simple pour l'Alaska</h1>
                <h2 class="font-weight-light font-italic">de Jean Forteroche, auteur et écrivain</h2>
            </div>
        </div>
    </div>

    <div class="container pb-4">
    <p><a class="font-italic text-info" href= "index.php">Retour page d'accueil</a></p>
        <div class="row mt-5 justify-content-center text-danger border border-danger">
            <div class="col-12 col-md-6 col-lg-4 py-5">
                <h3 class="font-weight-light">Modifiez votre chapitre !</h3>
                <hr class="border border-danger"><br/>
                
                <form action="index.php?action=editPost&amp;id=<?= $post['id']?>" method="post">
                    <div class="form-group">
                        <label for="title">Titre</label><br/>
                        <input class="form-control" type="text" name="title" value="<?php echo $post['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="author">Auteur</label><br/>
                        <input class="form-control" type="text" name="author" value="<?php echo $post['author']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="content">Résumé</label><br/> 
                        <textarea class="form-control" type="text" name="content"><?php echo $post['content']; ?></textarea>
                    </div>
                    <button type="submit" class="btn-info btn-sm shadow">Valider</button>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>