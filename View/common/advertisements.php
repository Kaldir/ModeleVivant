<?php $title = 'MV - Petites annonces';
ob_start(); ?>

<h3 class="contentTitle">Petites annonces</h3>

<div class="errorContent">
	<?php
	if (isset($errors)) {
	    foreach ($errors as $error) {
	    ?>
	    <div class="alert alert-danger" role="alert">
	        <strong><?php echo $error; ?></strong>
	    </div>
	    <?php
	    }
	}
	?>
</div>

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
<?php
foreach ($categories as $category) {
?>
				<option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
<?php
}
?>
			</select><br />
        	<label for="title">Intitulé *</label><br />
            <input type="text" id="title" name="title" required value="hop"/><br />
            <label for="town">Ville *</label><br />
            <input type="text" id="town" name="town" required value="hop" /><br />
            <label for="location">Département *</label><br />
            <input type="number" min="01" max="99" id="county" name="county" required value="65"/><br />
            <label for="location">Emplacement précis</label><br />
            <input type="text" id="location" name="location" value="hop"/><br />
			<label for="date">Date</label><br />
	        <input type="date" name="date_event" /><br />
            <label for="content">Contenu *</label><br />
			<textarea id="content" name="content" required>hop</textarea><br />
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

<?php
foreach ($categories as $category) {
?>
		<div class="advertisementsBlocks col-md-6">
			<a href="index.php&?action=advertisements&id_category=<?php echo $category['id']; ?>" class="subButtonsStyle"><?php echo $category['name']; ?></a>
		</div>
<?php
}
?>
	</div>
</div>

<!--
<?php
// while ($ad = $ads->fetch()) {
?>
	<div class="formStyle">
		<strong><?php // echo htmlspecialchars($ad['title']); ?></strong>
		<i class="smallInfosText">publié le <?php // echo htmlspecialchars($ad['creation_date_fr']); ?></i>
		<strong><?php // echo htmlspecialchars($ad['location']); ?></strong>
-->
<!-- EDIT & DELETE AD IF ADMIN-->
<!--
	<?php
//	if ($_SESSION['admin'] == 1) {
	?>
		<a href="index.php?action=editAdvertisement&amp;id=<?php // echo htmlspecialchars($ad['id']); ?>"><i class="fa fa-pencil" title="Modifier" aria-hidden="true"></i></a>

		<a href="index.php?action=deleteAdvertisement&amp;id=<?php // echo htmlspecialchars($ad['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette annonce ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></a>
	</div>
	<?php
?>
-->
<?php $content = ob_get_clean(); ?>