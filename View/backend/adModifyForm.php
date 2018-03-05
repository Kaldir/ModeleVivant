<?php $pageTitle = 'Gestion des annonces';
ob_start(); ?>

<div class="formStyle">
    <form action="index.php?action=editAdvertisement" method="post">
    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
    	<input name="id_ad" type="hidden" value="<?php echo $ad['id']; ?>"/ >
        <div>
			<label for="id_category">Catégorie *</label><br />
			<select name="id_category" id="id_category" required>
<?php
foreach ($categories as $category) {
?>
				<option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $ad['id_category']) { echo 'selected'; } ?>><?php echo $category['name']; ?></option>
<?php
}
?>
			</select><br />
        	<label for="title">Intitulé *</label><br />
            <input type="text" id="title" name="title" required value="<?php echo $ad['title']; ?>"/><br />
            <label for="town">Ville *</label><br />
            <input type="text" id="town" name="town" required value="<?php echo $ad['town']; ?>" /><br />
            <label for="location">Département *</label><br />
            <input type="number" min="01" max="99" id="county" name="county" required value="<?php echo $ad['number']; ?>"/><br />
            <label for="location">Emplacement précis</label><br />
            <input type="text" id="location" name="location" value="<?php echo $ad['location']; ?>"/><br />
			<label for="date">Date</label><br />
	        <input type="date" name="date_event" value="<?php echo $ad['date']; ?>"/><br />
            <label for="content">Contenu *</label><br />
			<textarea id="content" name="content" required><?php echo $ad['content']; ?></textarea><br />
            <button type="submit" name="submit" class="buttonStyle" value="Publier l'annonce"><i class="fas fa-check" title="Publier l'annonce" aria-hidden="true"></i></button>
		
	    	<button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cette annonce ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>