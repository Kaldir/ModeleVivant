<?php $title = 'MV - Affichage des billets';
ob_start(); ?>

<h3 class="contentTitle">Bonnes pratiques et partage d'expériences</h3>

<?php
if ($_SESSION['connected'] && $_SESSION['admin'] == 1) { // on vérifie si une session existe ET si elle est admin ou user (1 pour admin, 0 pour user)
?>

<div class="formStyle">
    <form action="index.php?action=addPost" method="post">
    		<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
        <div>
        	<label for="id_category">Catégorie *</label><br />
				<select name="id_category" id="id_category" required>
					<option value="tutos">Bonnes pratiques</option>
					<option value="xpPersonnal">Expériences vécues</option>
					<option value="xpStory">Expériences rapportées</option>
				</select><br />
        	<label for="title">Titre</label><br />
            <input type="text" id="title" name="title" required/><br />
            <label for="content">Contenu</label><br /> 
            <div class="textareaTinyMce">
            	<textarea id="message" name="message" required/></textarea>
	            <button type="submit" name="submit" class="buttonStyle" value="Ajouter"><i class='fas fa-check'></i></button>
	        </div>
        </div>
    </form>
</div>

<?php
}
?>

<!--  PAGINATION A GERER -->

<div class="container-fluid postsContainer">
	<div class="row postsRow">
		<div class="postsBlocks col-md-4">
            <div class="subButtonsStyle sbsToggler">
                <h4>Bonnes pratiques</h4>
                <i class="fas fa-bars"></i>
            </div>
            <div class="formStyle fsContent">
            </div>
        </div>

		<div class="postsBlocks col-md-4">
            <div class="subButtonsStyle sbsToggler">
                <h4>XP vécues</h4>
                <i class="fas fa-bars"></i>
            </div>
            <div class="formStyle fsContent">
        	</div>
        </div>

		<div class="postsBlocks col-md-4">
            <div class="subButtonsStyle sbsToggler">
                <h4>XP rapportées</h4>
                <i class="fas fa-bars"></i>
            </div>
            <div class="formStyle fsContent">
        	</div>
        </div>
	</div>
</div>
 
<!--
<?php
// while ($post = $posts->fetch()) {
?>

	<div class="formStyle">
		<strong><?php // echo htmlspecialchars($post['title']); ?></strong>
		<i class="smallInfosText">publié le <?php // echo htmlspecialchars($post['creation_date_fr']); ?></i>

<?php
// if ($_SESSION['connected'] && $_SESSION['admin'] == 1) {
?>
		<a class="buttonStyle" href="index.php?action=editPost&amp;id=<?php // echo htmlspecialchars($post['id']); ?>"><i class="fa fa-pencil" title="Modifier" aria-hidden="true"></i></a>

		<a class="buttonStyle" href="index.php?action=deletePost&amp;id=<?php // echo htmlspecialchars($post['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></a>
<?php
// }
?>
	    <p><?php // echo $this->getExcerpt($post['content']); ?></p>
	    <a class="buttonStyle" href="index.php?action=displayOnePost&amp;id=<?php // echo htmlspecialchars($post['id']); ?>">Lire la suite...</a>
	</div>

<?php
// }
?>
-->
<?php $content = ob_get_clean(); ?>