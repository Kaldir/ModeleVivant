<?php $title = 'MV - Affichage d\'un billet';
ob_start(); ?>

<h3 class="contentTitle"><?php echo $_POST['title']; ?></h3>

<?php $content = ob_get_clean(); ?>