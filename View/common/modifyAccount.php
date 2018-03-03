<?php $title = 'MV - Gestion du compte';
ob_start(); ?>

<h3 class="contentTitle">Gestion du compte</h3>

<!-- ERROR OR SUCCESS MESSAGE -->
<?php
if (isset($errors)) {
    foreach ($errors as $error) {
    ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $error; ?></strong>
    </div>
    <?php
    }
}

if (isset($success)) { ?>
<div class="alert alert-success" role="alert">
    <strong><?php echo $success; ?></strong>
</div>
<?php } ?>

<!-- PSEUDO -->
<div class="container">
    <div class="row justify-content-center">
        <div id="modifyPseudo" class="modifyAccount col-md-6">
            <div class="subButtonsStyle sbsToggler">
                <h4>Modification du pseudo</h4>
                <i class="fas fa-bars"></i>
            </div>
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
            <div class="subButtonsStyle sbsToggler">
                <h4>Modification du mail</h4>
                <i class="fas fa-bars"></i>
            </div>
            <div class="formStyle fsContent">
                <div class="infosUser"><?php echo $_SESSION['mail']; ?></div>
                <form action="index.php?action=updateMail" method="post" class="connexionUser">  
                    <input name="token" type="hidden" value="<?php echo $this->token; ?>"/>             
                    <label for="newMail">Nouvel email</label><br />
                    <input type="email" id="newMail" name="newMail" required /><br />
                    <label for="checkMail">Confirmation du nouvel email</label><br />
                    <input type="email" id="checkMail" name="checkMail" required /><br />
                    <label for="password">Mot de passe</label><br />
                    <input type="password" class="password" name="password" required /><br />
                    <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
                </form>
            </div>
        </div>

<!-- AVATAR -->
        <div id="modifyAvatar" class="modifyAccount col-md-6">
            <div class="subButtonsStyle sbsToggler">
                <h4>Modification de l'avatar</h4>
                <i class="fas fa-bars"></i>
            </div>            
            <div class="formStyle fsContent">
               <img class="infosUser infoUserAvatar" src="<?php echo AVATAR_PATH . $_SESSION['avatar']; ?>" alt="Votre_avatar" />
                <form action="index.php?action=updateAvatar" method="post" class="connexionUser" enctype="multipart/form-data">
                    <input name="token" type="hidden" value="<?php echo $this->token; ?>"/>         
                    <label for="newAvatar">Télécharger un avatar depuis votre ordinateur</label><br />
                    <input type="hidden" name="MAX_FILE_SIZE" value="200000"> <!-- limite la taille du fichier à 200Ko -->
                    <input type="file" accept=".png, .jpeg, .jpg" id="newAvatar" name="newAvatar" required><br />
                    <span>(200Ko max, format jpeg, jpg, png)</span><br />
                    <button type="submit" name="submit" class="buttonStyle" value="Connexion"><i class='fas fa-check'></i></button>
                </form>
            </div>
        </div>

<!-- PASSWORD -->
        <div id="modifyPassword" class="modifyAccount col-md-6">
            <div class="subButtonsStyle sbsToggler">
                <h4>Modification du mot de passe</h4>
                <i class="fas fa-bars"></i>
            </div>            
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