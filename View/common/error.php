<?php $title = 'MV - erreur';
ob_start(); ?>

<h3 class="contentTitle">Erreur !</h3>

<div class="errorContent">
	<?php
	if (isset($errors)) {
	    foreach ($errors as $error) {
	    ?>
	    <div class="alert alert-danger" role="alert">
	        <strong><?php echo $error; ?></strong>
	    </div>
	    <?php
	    }
	}
	?>

	<button title="Retour" class="buttonStyle" onclick="window.history.back();" type="button" value="Retour"><i class="fas fa-arrow-left"></i></button> <!-- javascript qui permet le retour à la page précédente -->
</div>
<?php $content = ob_get_clean(); ?>