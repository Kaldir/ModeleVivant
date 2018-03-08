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
	foreach ($posts as $post) {
?>

<div class="fsContent">
	<div class="formStyle searchStyle">
		<strong class="titleForm"><?php echo htmlspecialchars($post['title']); ?></strong>
		<i class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?></i>
		<p><?php echo $this->getExcerpt($post['content']); ?></p>
	    <a href="index.php?action=displayOnePost&amp;id_post=<?php echo htmlspecialchars($post['id']); ?>"><div class="buttonStyle Arrow" title="Lire la suite..."><i class="fas fa-arrow-right"  aria-hidden="true"></i></div></a>
	</div>
</div>

<?php
	}
}
if (!empty($ads)) {
?>
<div class="subButtonsStyle sbsToggler">
	<h4>Section annonces</h4>
    <i class="fas fa-bars"></i>
</div>
<?php
	foreach ($ads as $ad) {
?>

<div class="fsContent">
	<div class="formStyle searchStyle">
		<strong class="titleForm"><?php echo htmlspecialchars($ad['title']); ?></strong>
		<p class="smallInfosText">publié le <?php echo htmlspecialchars($ad['creation_date_fr']); ?> par <a class="mailto" href="mailto:<?php echo htmlspecialchars($ad['user_mail']); ?>"><?php echo htmlspecialchars($ad['user_pseudo']); ?> <img class="userAvatarAdCom infosUser infoUserAvatar" src="<?php echo AVATAR_PATH . $ad['user_avatar']; ?>" alt="avatar_user" /></a></p>
		<p><strong><?php echo htmlspecialchars($ad['town']); ?></strong>
		 - (<?php echo htmlspecialchars($ad['county']); ?>)</p>
		<p class="smallInfosText">Lieu : <?php echo htmlspecialchars($ad['location']); ?> - Date : <?php echo htmlspecialchars($ad['date_event_fr']); ?></strong></p>
		<p><?php echo htmlspecialchars($ad['content']); ?></p>
	</div>
</div>
<?php
	}
}
?>

<?php $content = ob_get_clean(); ?>