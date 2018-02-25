<?php $title = 'MV - Récupération de mot de passe';
ob_start(); ?>

<h3>Récupération de mot de passe</h3>

<p>Entrez votre email, vous recevrez un nouveau mot de passe que vous pourrez changer dans les paramètres de votre compte par la suite.</p>

<div class="formStyle">
    <form action="index.php?action=sendMailAccount" method="post" class="connexionUser">
        <label for="email">Email</label><br />
        <input type="email" id="email" name="email" required /><br />
        <input type="submit" name="submit" class="buttonStyle" value="Envoyer !" />

        <?php if (!empty($error)) { ?>
        <div class="alert alert-danger" role="alert">
        	<strong>Erreur ! </strong><?php echo $error; ?>
        </div>
        <?php }
        if (!empty($success)) { ?>
        <div class="alert alert-success" role="alert">
        	<strong>Succès ! </strong><?php echo $success; ?>
        </div>
        <?php } ?>
        </form>
</div>

<?php $content = ob_get_clean(); ?>