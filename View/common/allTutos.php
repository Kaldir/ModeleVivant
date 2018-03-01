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
        	<label for="title">Titre</label><br />
            <input type="text" id="title" name="title" /><br />
            <label for="content">Contenu</label><br /> 
            <div class="textareaTinyMce">
            	<textarea id="message" name="message" /></textarea>
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
			<a href="" class="subButtonsStyle">Bonnes pratiques</a>
		</div>

		<div class="postsBlocks col-md-4">
			<a href="" class="subButtonsStyle">Expériences vécues</a>
		</div>

		<div class="postsBlocks col-md-4">
			<a href="" class="subButtonsStyle">Expériences rapportées</a>
		</div>
	</div>
</div>

<?php $content = ob_get_clean(); ?>