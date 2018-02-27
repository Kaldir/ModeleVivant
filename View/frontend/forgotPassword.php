<?php $title = 'MV - Récupération de mot de passe';
ob_start(); ?>

<h3 class="contentTitle">Récupération de mot de passe</h3>

<p>Entrez votre email, vous recevrez un nouveau mot de passe que vous pourrez changer dans les paramètres de votre compte par la suite.</p>

<div class="formStyle">
    <form action="index.php?action=updatePassword" method="post" class="connexionUser">
        <label for="mail">Email</label><br />
        <input type="mail" class="mail" name="mail" required /><br />
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

        if (isset($success)) { ?>
        <div class="alert alert-success" role="alert">
        	<strong>Succès ! </strong><?php echo $success; ?>
        </div>
        <?php } ?>
        </form>
</div>

<?php $content = ob_get_clean(); ?>