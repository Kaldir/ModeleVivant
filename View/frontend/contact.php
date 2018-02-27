<?php $title = 'MV - Contact';
ob_start(); ?>

<h3 class="contentTitle">Formulaire de contact</h3>

<p>Vous souhaitez partager une expérience et peut être la voir publiée sur ce site ou simplement m'écrire pour quoi que ce soit ? Utilisez le formulaire ci-dessous, je vous répondrais au plus vite !</p>

<div class="formStyle">
    <form action="index.php?action=sendMailContact" method="post" class="connexionUser">
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" required /><br />
        <label for="email">Email</label><br />
        <input type="email" class="email" name="<?php $_POST['mail'] ?>" required /><br />

        <div id="checkBoxContact">
            <p>Vous êtes...</p>
            <label for="modelContact">Modèle</label><input type="radio" name="radioContact" id="modelContact" checked />
            <label for="artistContact">Artiste</label><input type="radio" name="radioContact" id="artistContact" /><br />
            <label for="bothContact">Les deux</label><input type="radio" name="radioContact" id="bothContact" />
            <label for="otherContact">Autre</label><input type="radio" name="radioContact" id="otherContact" />
        </div>

        <div id="listContact">
           <label for="subject">Votre message concerne :</label><br />
           <select name="subject" id="subject">
               <option value="story">Une histoire à raconter</option>
               <option value="market">Une question sur du matériel</option>
               <option value="question">Une question sur les modèles</option>
               <option value="suggestion">Une suggestion</option>
               <option value="account">Un problème avec votre compte</option>
               <option value="other">Autre chose...</option>
           </select>
        </div>

        <label for="message">Message</label><br />
        <textarea id="message" name="message" required ></textarea><br />
        <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>

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