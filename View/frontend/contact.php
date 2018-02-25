<?php $title = 'MV - Contact';
ob_start(); ?>

<h3>Formulaire de contact</h3>

<p>Vous souhaitez partager une expérience et peut être la voir publiée sur ce site ou simplement m'écrire pour quoi que ce soit ? Utilisez le formulaire ci-dessous, je vous répondrais au plus vite !</p>

<div class="formStyle">
    <form action="index.php?action=sendMailContact" method="post" class="connexionUser">
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" required /><br />
        <label for="email">Email</label><br />
        <input type="email" id="email" name="<?php $_POST['mail'] ?>" required /><br />
        <label for="message">Message</label><br />
        <textarea id="message" name="message" required ></textarea><br />
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