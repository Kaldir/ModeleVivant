<?php $title = 'MV - Petites annonces';
ob_start(); ?>

<h3 class="contentTitle">Petites annonces</h3>

<?php
if ($_SESSION['connected'] == true) {
?>

<div class="subButtonsStyle sbsToggler">
	<h4>Déposer une annonce</h4>
	<i class="fas fa-bars"></i>
</div>
<div class="formStyle fsContent">
    <form action="index.php?action=addAdvertisement" method="post">
    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
        <div>
			<label for="id_category">Catégorie *</label><br />
				<select name="id_category" id="id_category" required>
				<option value="artist">Cherche artiste</option>
				<option value="model">Cherche modèle</option>
				<option value="event">Evénement</option>
				<option value="other">Autre</option>
			</select><br />
        	<label for="title">Intitulé *</label><br />
            <input type="text" id="title" name="title" required/><br />
            <label for="town">Ville *</label><br />
            <input type="text" id="town" name="town" required/><br />
            <label for="location">Département *</label><br />
            <input type="number" min="01" max="99" id="county" name="county" required/><br />
            <label for="location">Emplacement précis</label><br />
            <input type="text" id="location" name="location"/><br />
			<label for="date">Date</label><br />
	        <input type="date" name="date_event" /><br />
            <label for="content">Contenu *</label><br />
			<textarea id="content" name="content" required></textarea><br />
            <button type="submit" name="submit" class="buttonStyle" value="Ajouter"><i class='fas fa-check'></i></button>
        </div>
    </form>
</div>
<?php
}
?>
<!--  PAGINATION A GERER -->

<div class="container-fluid advertisementsContainer">
	<div class="row advertisementsRow">
		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle"><?php echo $_POST['name']; ?>Cherche artiste</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle"><?php echo $_POST['name']; ?>Cherche modèle</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle"><?php echo $_POST['name']; ?>Evénement</a>
		</div>

		<div class="advertisementsBlocks col-md-6">
			<a href="" class="subButtonsStyle"><?php echo $_POST['name']; ?>Autre</a>
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