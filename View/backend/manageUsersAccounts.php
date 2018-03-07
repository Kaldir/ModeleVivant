<?php $pageTitle = 'Gestion comptes utilisateurs';
ob_start(); ?>

<div class="userStyle">
	<div class="container-fluid userContainer">
		<div class="row userRow">
<?php
foreach ($users as $user) {
?>
			<div class="col-md-4">
				<div class="formStyle userBlocks">
					<img class="infosUser infoUserAvatar" src="<?php echo AVATAR_PATH . $user['avatar']; ?>" alt="avatar_user" />
					<strong><?php echo htmlspecialchars($user['pseudo']); ?></strong><br />
					<p><?php echo htmlspecialchars($user['mail']); ?></p>

					<form action="index.php?action=deleteUserAccount" method="post">
						<input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
						<input name="id_user" type="hidden" value="<?php echo htmlspecialchars($user['id']); ?>"/ >
						<button type="submit" name="submit" class="buttonStyle" value="Supprimer" onclick="return(confirm('Etes-vous sûr de vouloir supprimer cet utilisateur ?'));"><i class="fa fa-trash" title="Supprimer" aria-hidden="true"></i></button>
					</form>
				</div>
			</div>
<?php
}
?>		</div>
	</div>
</div>

<?php $content = ob_get_clean(); ?>