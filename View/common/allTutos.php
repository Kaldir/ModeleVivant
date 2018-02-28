<?php $title = 'MV - Affichage des billets';
ob_start(); ?>

<h3 class="contentTitle">Bonnes pratiques et partage d'expériences</h3>

<?php
if ($_SESSION['connected'] && $_SESSION['admin'] == 1) { // on vérifie si une session existe ET si elle est admin ou user (1 pour admin, 0 pour user)
?>

<div class="formStyle">
    <form action="index.php?action=addPost" method="post">
        <div>
        	<label for="title">Titre</label><br />
            <input type="text" id="title" name="title" /><br />
            <label for="content">Contenu</label><br /> <!-- mettre TyniMCE -->
            <textarea id="content" name="content" /></textarea><br />

<!-- CHAMP POUR UPLOADER UNE IMAGE DU PC -->

            <button type="submit" name="submit" class="buttonStyle" value="Ajouter"><i class='fas fa-check'></i></button>
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