<?php $pageTitle = 'Gestion des billets';
ob_start(); ?>

<div class="formStyle">
    <form action="index.php?action=editPost" method="post">
    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
    	<input name="id_post" type="hidden" value="<?php echo $post['id']; ?>"/ >
        <div>
			<label for="id_category">Catégorie *</label><br />
			<select name="id_category" id="id_category" required>
<?php
foreach ($categories as $category) {
?>
				<option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $post['id_category']) { echo 'selected'; } ?>><?php echo $category['name']; ?></option>
<?php
}
?>
            </select><br />
            <label for="title">Titre *</label><br />
            <input type="text" id="title" name="title" required value="<?php echo $post['title']; ?>"/><br />
            <label for="content">Contenu *</label><br />
            <textarea class="textareaTinyMce" id="content" name="content"><?php echo $post['content']; ?></textarea><br />
            <button type="submit" name="submit" class="buttonStyle" value="Valider"><i class="fas fa-check" title="Valider" aria-hidden="true"></i></button>
		
	    	<button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>