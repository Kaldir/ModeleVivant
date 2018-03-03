<?php $title = 'MV - Recherche';
ob_start(); ?>

<h3 class="contentTitle">Votre recherche</h3>

<?php
while ($post = $posts->fetch()) { // fetch permet de récupérer le résultat d'une requête
?>

<div class="subButtonsStyle sbsToggler">
	<h4>Section tutos et partage d'expériences</h4>
    <i class="fas fa-bars"></i>
</div>
<div class="fsContent">
	<div class="formStyle adStyle">
		<?php echo $post['title']; ?>
	</div>
	<div class="formStyle adStyle">
		<?php echo $post['content']; ?>
	</div>
</div>

<?php
}
while ($ad = $ads->fetch()) {
?>
<div class="subButtonsStyle sbsToggler">
	<h4>Section annonces</h4>
    <i class="fas fa-bars"></i>
</div>
<div class="fsContent">
	<div class="formStyle adStyle">
		<?php echo $ad['title']; ?>
	</div>
	<div class="formStyle adStyle">
		<?php echo $ad['content']; ?>
	</div>
</div>
<?php
}
?>

<?php $content = ob_get_clean(); ?>