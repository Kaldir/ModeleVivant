<?php $pageTitle = 'Gestion des commentaires';
ob_start(); ?>

<div class="formStyle">
    <form action="index.php?action=editComment" method="post">
    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
    	<input name="id_comment" type="hidden" value="<?php echo $comment['id']; ?>"/ >
        <div>
            <label for="content">Commentaire *</label><br />
			<textarea id="content" name="content" required><?php echo $comment['content']; ?></textarea><br />
            <button type="submit" name="submit" class="buttonStyle" value="Valider"><i class="fas fa-check" title="Valider" aria-hidden="true"></i></button>
		
	    	<button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>