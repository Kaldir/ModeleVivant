<?php $title = 'MV - Affichage d\'un billet';
ob_start(); ?>

<h3 class="contentTitle"><?php echo $_POST['title']; ?></h3>

<button class="buttonStyle" onclick="window.history.back();" type="button" value="Retour"><i class="fas fa-long-arrow-alt-left"></i></button>

<!-- DISPLAY POST -->
<div class="formStyle">
    <h3><?php echo htmlspecialchars($post['title']); ?></h3> 
    <i class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?> </i>
<?php
if (!empty($_SESSION['admin'])) {
?>
    <a href="index.php?action=editPost&amp;id=<?php echo htmlspecialchars($post['id']); ?>"><i class="fa fa-pencil" title="Modifier" aria-hidden="true"></i></a>

    <a href="index.php?action=deletePost&amp;id=<?php echo htmlspecialchars($post['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></a>
<?php
}
?>
    <?php echo nl2br($post['content']); ?>
</div>

<!-- DISPLAY COMMENTS -->
<h4 class="contentSubTitle">Commentaires</h4>

<div id="commentDisplay">
    <form action="index.php?action=addComment&amp;id=<?php echo htmlspecialchars($post['id']); ?>" method="post" id="formComment">
        <input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
        <label for="content">Commentaire</label><br />
        <input id="content" name="content" />
        <input type="submit" class="buttonStyle" />
    </form>

<?php
while ($comment = $comments->fetch()) {
?>
    <div class="commentStyle">
<!-- SIGNALISED FOR ADMIN -->

        <?php
        if ($comment['signalised'] && !empty($_SESSION['admin'])) {
        ?>
        <div class="adminSignalised">
            <i class="fa fa-exclamation-triangle"></i> Commentaire signalé <i class="fa fa-exclamation-triangle"></i>
        </div>
        <?php    
        }
// SIGNALISED FOR USERS
        if (empty($_SESSION['admin'])) {
        ?>
        <a href="index.php?action=signalComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>&amp;postId=<?php echo htmlspecialchars($_GET['id']); ?>"><i class="fa fa-exclamation-circle"  title='Signaler' aria-hidden="true"></i></a>
        <?php
        }
        ?>
<!-- DISPLAY AUTHOR & DATE OF THE COMMENT -->
        <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
        <i class="smallInfosText">- <?php echo htmlspecialchars($comment['comment_date_fr']); ?></i>
<!-- EDIT & DELETE COMMENT FOR ADMIN -->
        <?php
        if (!empty($_SESSION['admin'])) {
        ?>
        <a href="index.php?action=editComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>"><i class="fa fa-pencil" title='Modifier' aria-hidden="true"></i></a>

        <a href="index.php?action=deleteComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>&amp;id_post=<?php echo htmlspecialchars($comment['id_post']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));"><i class="fa fa-trash" title='Supprimer' aria-hidden="true"></i></a>
        <?php
        }
        ?>
<!-- DISPLAY CONTENT OF THE COMMENT -->
        <p><?php echo htmlspecialchars($comment['content']); ?></p>
    </div>
<?php
}
?>
</div>

<!-- MODAL BOOTSTRAP WHICH APPEAR WHEN COMMENT SIGNALISED BY USER -->
<?php
if ($signalised) {
?>
<div id="modalSignal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <p>Vous venez de signaler un commentaire : l'administrateur prendra cette information en compte dès que possible, merci !</p>
        <button type="button" class="btn btn-secondary buttonStyle" data-dismiss="modal">Ok !</button>
      </div>
    </div>
</div>
<?php
}
?>


<?php $content = ob_get_clean(); ?>