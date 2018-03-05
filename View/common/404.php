<?php $pageTitle = 'Erreur 404 !';
ob_start(); ?>

<div class="formStyle">
	<p>Erreur 404 : cette page n'existe pas !</p>
</div>

<?php $content = ob_get_clean(); ?>