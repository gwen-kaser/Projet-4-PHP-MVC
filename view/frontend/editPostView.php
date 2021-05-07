<?php $title = 'Jean Forteroche'; ?>

<?php ob_start(); ?>

<div class="container pb-4">
        <div class="row mt-5 justify-content-center text-danger border border-danger">
            <div class="col-12 col-md-6 col-lg-4 py-5">
                <h3 class="font-weight-light">Ajoutez votre chapitre !</h3>
                <hr class="border border-danger"><br/>
                <form action="index.php?action=addPost" method="post">
                    <div>
                        <label for="title">Titre</label><br/>
                        <input type="text" id="title" name="title"><br/><br/>
                    </div>
                    <div>
                        <label for="author">Auteur</label><br/>
                        <input type="text" id="author" name="author"><br/><br/>
                    </div>
                    <div>
                        <label for="content">Résumé</label><br/>
                        <textarea id="content" name="content"></textarea><br/><br/>
                    </div>
                    <div>
                        <input type="submit" class="btn-info btn-sm shadow">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>