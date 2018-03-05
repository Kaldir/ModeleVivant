<?php $pageTitle = 'Récupération de mot de passe';

ob_start(); ?>

<p>Entrez votre email, vous recevrez un nouveau mot de passe que vous pourrez changer dans les paramètres de votre compte par la suite.</p>

<div class="formStyle">
    <form action="index.php?action=generatePassword" method="post" class="connexionUser">
        <input name="token" type="hidden" value="<?php echo $this->token; ?>"/ >
        <label for="mail">Email</label><br />
        <input type="email" class="mail" name="mail" required /><br />
        <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>