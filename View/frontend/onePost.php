<?php $pageTitle = htmlspecialchars($post["category_name"]);
ob_start();

if (!empty($post)) {
?>

<h4 class="postTitle"><?php echo $post['title']; ?></h4>

<!-- DISPLAY ONE POST -->
<div class="formStyle postStyle">
    <div class="container-fluid postContainer">
        <div class="row postRow">
            <div class="postBlocks col-md">
                <strong class="titleForm"><?php echo htmlspecialchars($post['title']); ?></strong>
                <p class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?></p>                    
                <p><?php echo ($post['content']); ?></p>
            </div>

<!-- EDIT AND DELETE POST FOR ADMIN -->
<?php
if (!empty($_SESSION['admin'])) {
?>
           <div class="postBlocks col-md-1">
                <div class="postButtons">
                    <form action="index.php?action=modifyFormPost" method="post">
                        <input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
                        <input name="id_post" type="hidden" value="<?php echo htmlspecialchars($post['id']); ?>"/ >
                        <button type="submit" name="submit" class="buttonStyle" value="Modifier"><i class="fas fa-pencil-alt" title="Modifier" aria-hidden="true"></i></button>
                    </form>

                    <form action="index.php?action=deletePost" method="post">
                        <input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
                        <input name="id_post" type="hidden" value="<?php echo htmlspecialchars($post['id']); ?>"/ >
                        <button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
                    </form>
<?php
}
?>
                    <button class="buttonStyle" onclick="window.history.back();" type="button" title="Retour" value="Retour"><i class="fas fa-long-arrow-alt-left"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php  
}
$content = ob_get_clean(); ?>