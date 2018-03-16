<?php $pageTitle = 'Bonnes pratiques et partage d\'expériences';
ob_start(); ?>

<?php
if (!empty($_SESSION['admin'])) {
?>

<div class="subButtonsStyle sbsToggler">
    <h4>Publier un billet</h4>
    <i class="fas fa-bars"></i>
</div>
<div class="formStyle fsContent">
    <form action="index.php?action=addPost" method="post">
    		<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
        <div>
            <label for="id_category">Catégorie *</label><br />
            <select name="id_category" id="id_category" required>
<?php
foreach ($categories as $category) {
?>
                <option value="<?php echo htmlspecialchars($category['id']); ?>"><?php echo htmlspecialchars($category['name']); ?></option>
<?php
}
?>
            </select><br />
        	<label for="title">Titre *</label><br />
            <input type="text" id="title" name="title" required/><br />
            <label for="content">Contenu *</label><br />
            <textarea class="textareaTinyMce" id="content" name="content"></textarea><br />
            <button type="submit" name="submit" class="buttonStyle" value="Ajouter"><i class='fas fa-check'></i></button>
        </div>
    </form>
</div>
<?php
}
?>

<div class="container-fluid postsContainer">
    <div class="row postsRow">
<?php
foreach ($categories as $category) {
?>
        <div class="postsBlocks col-md-4">
            <a href="index.php?action=posts&id_category=<?php echo htmlspecialchars($category['id']); ?>" class="subButtonsStyle sbsTogglerCategories"><?php echo htmlspecialchars($category['name']); ?><i class="fas fa-caret-square-down"></i></a>
        </div>
<?php
}
?>
    </div>
</div>

<?php
if (isset($nbPosts)) {
$this->pagination($nbPosts);
}

if (!empty($posts)) {
    foreach ($posts as $post) {
?>
    <div class="formStyle postStyle">
        <div class="container-fluid postContainer">
            <div class="row postRow">
                <div class="postBlocks col-md">
                    <strong class="titleForm"><?php echo htmlspecialchars($post['title']); ?></strong>
                    <p class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?></p>                    
                    <p><?php echo $this->getExcerpt($post['content']); ?></p>

                    <a class="buttonStyle arrow" title="Lire la suite..." href="index.php?action=displayOnePost&amp;id_post=<?php echo htmlspecialchars($post['id']); ?>"><i class="fas fa-arrow-right"  aria-hidden="true"></i></a>
                </div>

<!-- EDIT & DELETE IF ADMIN-->
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
                    </div>
                </div>
        <?php
        }
        ?>
            </div>
        </div>
    </div>
<?php
    }
}
$content = ob_get_clean(); ?>