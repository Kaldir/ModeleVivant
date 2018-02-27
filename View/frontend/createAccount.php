<?php $title = 'MV - Création d\'un compte utilisateur';
ob_start(); ?>

<h3 class="contentTitle">Création de compte utilisateur</h3>

<div class="formStyle">
    <form action="index.php?action=createAccount" method="post" class="connexionUser">
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" required /><br />
        <label for="mail">Email</label><br />
        <input type="mail" id="mail" name="mail" required /><br />
        <label for="password">Mot de passe</label><br />
		<input type="password" class="password" name="password" required /><br />
		<label for="checkPassword">Confirmation du mot de passe</label><br />
		<input type="password" class="checkPassword" name="checkPassword" required /><br />
        <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>

        <?php
        if (isset($errors)) {
            foreach ($errors as $error) {
            ?>
            <div class="alert alert-danger" role="alert">
            	<strong>Erreur ! </strong><?php echo $error; ?>
            </div>
            <?php
            }
        }
        ?>
    </form>
</div>

<?php $content = ob_get_clean(); ?>