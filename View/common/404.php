<?php $title = 'MV - 404';
ob_start(); ?>

<h3 class="contentTitle">Erreur 404 !</h3>

<button class="buttonStyle" onclick="window.history.back();" type="button" value="Retour"><i class="fas fa-long-arrow-alt-left"></i></button>

<div class="formStyle">
	<p>Erreur 404 : cette page n'existe pas !</p>
</div>

<?php $content = ob_get_clean(); ?>