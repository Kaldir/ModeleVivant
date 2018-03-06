<?php $pageTitle = 'Validation des annonces';
ob_start(); ?>

<?php
foreach ($ads as $ad) {
?>
	<div class="formStyle adStyle">
		<div class="container-fluid adContainer">
			<div class="row adRow">
				<div class="adBlocks col-md">
					<strong><?php echo htmlspecialchars($ad['title']); ?></strong>
					<p class="smallInfosText">publié le <?php echo htmlspecialchars($ad['creation_date_fr']); ?></p>
					<p><strong><?php echo htmlspecialchars($ad['town']); ?></strong>
					 - (<?php echo htmlspecialchars($ad['county']); ?>)</p>
					<p class="smallInfosText"><?php echo htmlspecialchars($ad['location']); ?></p>
					<strong><?php echo htmlspecialchars($ad['date_event']); ?></strong>
					<p><?php  echo htmlspecialchars($ad['content']); ?></p>
				</div>

				<div class="adBlocks col-md-1">
					<div class="adButtons">
						<form action="index.php?action=publishAdvertisement" method="post">
					    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
					    	<input name="id_ad" type="hidden" value="<?php echo $ad['id']; ?>"/ >
					    	<button type="submit" name="submit" class="buttonStyle" value="Publier l'annonce"><i class="fas fa-check" title="Publier l'annonce" aria-hidden="true"></i></button>
						</form>

					    <form action="index.php?action=modifyFormAdvertisement" method="post">
					    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
					    	<input name="id_ad" type="hidden" value="<?php echo $ad['id']; ?>"/ >
					    	<button type="submit" name="submit" class="buttonStyle" value="Modifier"><i class="fas fa-pencil-alt" title="Modifier" aria-hidden="true"></i></button>
						</form>

					    <form action="index.php?action=deleteAdvertisement" method="post">
					    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
					    	<input name="id_ad" type="hidden" value="<?php echo $ad['id']; ?>"/ >
					    	<button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette annonce ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
$content = ob_get_clean(); ?>