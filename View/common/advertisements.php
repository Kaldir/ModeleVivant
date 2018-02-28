<?php $title = 'MV - Petites annonces';
ob_start(); ?>

<h3 class="contentTitle">Petites annonces</h3>

<div class="formStyle">
    <form action="index.php?action=addAdvertisment" method="post">
        <div>
        	<label for="title">Intitulé</label><br />
            <input type="text" id="title" name="title" /><br />
            <label for="location">Lieu</label><br />
            <input type="text" id="location" name="location" /><br />
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" /></textarea><br />
            <button type="submit" name="submit" class="buttonStyle" value="Ajouter"><i class='fas fa-check'></i></button>
        </div>
    </form>
</div>

<!--  PAGINATION A GERER -->

<h4 class="contentSubTitle">Annonces en ligne</h4>

<div class="container-fluid advertisementsContainer">
	<div class="row advertisementsRow">
		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle">Cherche artiste</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle">Cherche modèle</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle">Matériel à vendre</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle">Oeuvres à vendre</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle">Evénement</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle">Autre</a>
		</div>
	</div>
</div>

<!--
<?php
// while ($data = $ads->fetch()) {
?>
	<div class="formStyle">
		<h4><?php echo htmlspecialchars($data['title']); ?></h4>
		<i class="smallInfosText">publié le <?php echo htmlspecialchars($data['creation_date_fr']); ?></i>
		<strong><?php echo htmlspecialchars($data['location']); ?></strong>
-->
<!-- EDIT & DELETE AD IF ADMIN-->
<!--
	<?php
//	if ($_SESSION['admin'] == 1) {
	?>
		<a href="index.php?action=editAdvertisement&amp;id=<?php echo htmlspecialchars($data['id']); ?>"><i class="fa fa-pencil" title="Modifier" aria-hidden="true"></i></a>

		<a href="index.php?action=deleteAdvertisement&amp;id=<?php echo htmlspecialchars($data['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette annonce ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></a>
	</div>
	<?php
?>
-->
<?php $content = ob_get_clean(); ?>