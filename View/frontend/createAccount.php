<?php $pageTitle = 'Création d\'un compte utilisateur';
ob_start(); ?>

<div class="formStyle">
    <form action="index.php?action=createAccountProcessing" method="post" class="connexionUser">
        <input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" required /><br />
        <label for="mail">Email</label><br />
        <input type="email" id="mail" name="mail" required /><br />
        <label for="password">Mot de passe</label><br />
		<input type="password" class="password" name="password" required /><br />
		<label for="checkPassword">Confirmation du mot de passe</label><br />
		<input type="password" class="checkPassword" name="checkPassword" required /><br />
        <div class="g-recaptcha" data-sitekey="6LdeQEsUAAAAAAsf73aSGDjisluKzr33_2AiufI7"></div>
        <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>