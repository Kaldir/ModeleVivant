<?php $pageTitle = 'Erreur 404 !';
ob_start(); ?>

<div class="alert alert-danger" role="alert">
	<strong>Erreur 404 : cette page n'existe pas !</strong>
</div>

<?php $content = ob_get_clean(); ?>