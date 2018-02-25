<?php $title = 'MV - Gestion du compte';
ob_start();

if (!empty($_GET['success'])) { // si la variable n'est pas vide (c'est à dire que la méthode passUpdate du backend est true)
    echo '<div class="msgStyle">Mot de passe mis à jour avec succès !</div>';
}
?>

<h2>Modification du pseudo</h2>

<div class="formStyle">
    <form action="index.php?action=pseudoUpdate" method="post" class="connexionUser">
        <label for="pseudo">Pseudo actuel</label>
        <div class="msgStyle"><?php echo $_SESSION['pseudo']; ?></div><br />
        <label for="newPseudo">Nouveau pseudo</label>
        <input type="text" id="newPseudo" name="newPseudo" required /><br />
        <label for="password">Mot de passe actuel</label>
        <input type="password" class="password" name="password" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Modifier" />
    </form>
</div>


<h2>Modification du mail</h2>

<div class="formStyle">
    <form action="index.php?action=mailUpdate" method="post" class="connexionUser">
        <label for="mail">Mail actuel</label>
        <div class="msgStyle"><?php echo $_SESSION['mail']; ?></div><br />
        <label for="newMail">Nouvel email</label>
        <input type="text" id="newMail" name="newMail" required /><br />
        <label for="newMail">Confirmation du nouvel email</label>
        <input type="text" id="newMail" name="newMail" required /><br />
        <label for="password">Mot de passe</label>
        <input type="password" class="password" name="password" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Modifier" />
    </form>
</div>

<h2>Modification de l'avatar</h2>

<div class="formStyle">
    <form action="index.php?action=avatarUpdate" method="post" class="connexionUser">
        <label for="avatar">Avatar actuel</label>
        <div class="msgStyle"><?php echo $_SESSION['avatar']; ?></div><br />
        <label for="newAvatar">Télécharger un avatar depuis votre ordinateur</label>
        <input type="" id="newAvatar" name="newAvatar" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Valider" />
    </form>
</div>

<h2>Modification du mot de passe</h2>

<div class="formStyle">
    <form action="index.php?action=passUpdate" method="post" class="connexionUser">
        <label for="password">Mot de passe actuel</label>
        <input type="password" class="password" name="password" required /><br />
        <label for="newPassword">Nouveau mot de passe</label>
        <input type="password" id="newPassword" name="newPassword" required /><br />
        <label for="newPassword">Confirmation du nouveau mot de passe</label>
        <input type="password" id="checkPassword" name="checkPassword" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Modifier" />
    </form>
</div>

<?php $content = ob_get_clean(); ?>