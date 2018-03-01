<?php $title = 'MV - Gestion du compte';
ob_start(); ?>

<h3 class="contentTitle">Gestion du compte</h3>

<!-- ERROR OR SUCCESS MESSAGE -->
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

<!-- PSEUDO -->
<div class="container">
    <div class="row justify-content-center">
        <div id="modifyPseudo" class="modifyAccount col-md-6">
            <h4 class="subButtonsStyle sbsToggler">Modification du pseudo</h4>
            <div class="formStyle fsContent">
                <div class="infosUser"><?php echo $_SESSION['pseudo']; ?></div>
                <form action="index.php?action=updatePseudo" method="post" class="connexionUser">
                    <input name="token" type="hidden" value="<?php echo $this->token; ?>"/>
                    <label for="newPseudo">Nouveau pseudo</label><br />
                    <input type="text" id="newPseudo" name="newPseudo" required /><br />
                    <label for="password">Mot de passe</label><br />
                    <input type="password" class="password" name="password" required /><br />
                    <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
                </form>
            </div>
        </div>

<!-- MAIL -->
        <div id="modifyMail" class="modifyAccount col-md-6">
            <h4 class="subButtonsStyle sbsToggler">Modification du mail</h4>
            <div class="formStyle fsContent">
                <div class="infosUser"><?php echo $_SESSION['mail']; ?></div>
                <form action="index.php?action=updateMail" method="post" class="connexionUser">  
                    <input name="token" type="hidden" value="<?php echo $this->token; ?>"/>             
                    <label for="newMail">Nouvel email</label><br />
                    <input type="text" id="newMail" name="newMail" required /><br />
                    <label for="newMail">Confirmation du nouvel email</label><br />
                    <input type="text" id="newMail" name="newMail" required /><br />
                    <label for="password">Mot de passe</label><br />
                    <input type="password" class="password" name="password" required /><br />
                    <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
                </form>
            </div>
        </div>

<!-- AVATAR -->
        <div id="modifyAvatar" class="modifyAccount col-md-6">
            <h4 class="subButtonsStyle sbsToggler">Modification de l'avatar</h4>
            <div class="formStyle fsContent">
                <img class="infosUser infoUserAvatar" src="http://kaldir.fr/OCR/Projet_5/Acces_au_site/Public/img/feather12.png" alt="Votre_avatar" />
                <form action="index.php?action=updateAvatar" method="post" class="connexionUser" enctype="multipart/form-data">     
                    <input name="token" type="hidden" value="<?php echo $this->token; ?>"/>         
                    <label for="newAvatar">Télécharger un avatar depuis votre ordinateur</label><br />
                    <input type="hidden" name="MAX_FILE_SIZE" value="300000"> <!-- limite la taille du fichier à 300Ko -->
                    <input type="file" id="newAvatar" name="newAvatar"><br />
                    <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
                </form>
            </div>
        </div>

<!-- PASSWORD -->
        <div id="modifyPassword" class="modifyAccount col-md-6">
            <h4 class="subButtonsStyle sbsToggler">Modification du mot de passe</h4>
            <div class="formStyle fsContent">
                <form action="index.php?action=updatePassword" method="post" class="connexionUser">
                    <input name="token" type="hidden" value="<?php echo $this->token; ?>"/>
                    <label for="password">MdP actuel</label><br />
                    <input type="password" class="password" name="password" required /><br />
                    <label for="newPassword">Nouveau MdP</label><br />
                    <input type="password" id="newPassword" name="newPassword" required /><br />
                    <label for="newPassword">Confirmation du nouveau MdP</label><br />
                    <input type="password" id="checkPassword" name="checkPassword" required /><br />
                    <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>