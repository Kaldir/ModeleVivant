<?php $pageTitle = 'Commentaires signalés';
ob_start();

foreach ($comments as $comment) {
?>
	<div class="formStyle commentStyle">
		<div class="container-fluid commentContainer">
			<div class="row commentRow">
				<div class="commentBlocks col-md">
					<strong><?php echo htmlspecialchars($comment['author']); ?></strong>
					<img class="userAvatarAdCom infosUser infoUserAvatar" src="<?php echo AVATAR_PATH . $comment['user_avatar']; ?>" alt="avatar_user" />
					<p class="smallInfosText">publié le <?php echo htmlspecialchars($comment['creation_date_fr']); ?></p>
					<p><?php  echo htmlspecialchars($comment['content']); ?></p>
				</div>
				<div class="linkComment">
			        <p>En provenance du billet "<a href="index.php?action=displayOnePost&amp;id=<?php echo htmlspecialchars($comment['id_post']); ?>" class="titleComment"><?php echo htmlspecialchars($comment['title']); ?></a>"</p>
			    </div>

				<div class="commentBlocks col-md-1">
					<div class="commentButtons">
					    <form action="index.php?action=modifyFormComment" method="post">
					    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
					    	<input name="id_comment" type="hidden" value="<?php echo htmlspecialchars($comment['id']); ?>"/ >
					    	<button type="submit" name="submit" class="buttonStyle" value="Modifier"><i class="fas fa-pencil-alt" title="Modifier" aria-hidden="true"></i></button>
						</form>

					    <form action="index.php?action=deleteComment" method="post">
					    	<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
					    	<input name="id_comment" type="hidden" value="<?php echo htmlspecialchars($comment['id']); ?>"/ >
					    	<button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
$content = ob_get_clean(); ?>