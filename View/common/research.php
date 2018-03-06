<?php $pageTitle = 'Votre recherche';
ob_start(); ?>

<?php
if (!empty($posts)) {
?>
<div class="subButtonsStyle sbsToggler">
	<h4>Section tutos et partage d'expériences</h4>
    <i class="fas fa-bars"></i>
</div>
<?php
}
foreach ($posts as $post) {
?>

<div class="fsContent">
	<div class="formStyle searchStyle">
		<strong><?php echo $post['title']; ?></strong>
		<i class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?></i>
<!--
	<p><?php // echo $this->getExcerpt($post['content']); ?></p>
	    <a class="buttonStyle" href="index.php?action=displayOnePost&amp;id=<?php // echo htmlspecialchars($post['id']); ?>">Lire la suite...</a>
-->
	</div>
</div>

<?php
}
if (!empty($ads)) {
?>
<div class="subButtonsStyle sbsToggler">
	<h4>Section annonces</h4>
    <i class="fas fa-bars"></i>
</div>
<?php
}
foreach ($ads as $ad) {
?>

<div class="fsContent">
	<div class="formStyle searchStyle">
		<strong><?php echo $ad['title']; ?></strong>
		<i class="smallInfosText">publié le <?php echo htmlspecialchars($ad['creation_date']); ?></i>
		<strong><?php echo htmlspecialchars($ad['location']); ?></strong>
<!--
	<p><?php // echo $this->getExcerpt($ad['content']); ?></p>
	    <a class="buttonStyle" href="index.php?action=displayOneAd&amp;id=<?php // echo htmlspecialchars($ad['id']); ?>">Lire la suite...</a>
-->
	</div>
</div>
<?php
}
?>

<?php $content = ob_get_clean(); ?>