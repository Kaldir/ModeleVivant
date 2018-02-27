<?php
namespace Kldr\ModeleVivant\Model;

class UserManager extends Manager
{
// SETTERS & GETTERS (permet de s'assurer qu'on ne donne pas n'importe quelle valeur à l'objet depuis l'extérieur de celui-ci. Le setter va vérifier qu'on donne la valeur attendue à son attribut).
    private $pseudo, $mail, $admin;

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setAdmin($admin) {
        $this->admin = $admin;
    }

    public function getAdmin() {
        return $this->admin;
    }

// LOGIN
/*
    public function login($password, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo, mail, password, admin FROM mv_user WHERE email = ?');
        $req->execute(array($email));
        $user = $req->fetch();
        if (password_verify($password, $user['password'])) { // fonction PHP qui vérifie si les mots de passe (crypté et clair) sont identiques (celui rentré et celui de la bdd)
            $userInfos = array(
                'pseudo' => $user['pseudo'],
                'mail' => $user['mail'],
                'admin' => $user['admin'],
            );
             return array(
            'success' => false,
            'data' => $userInfos
            );
        }
        return false;
    }
*/
	public function createAccount($pseudo, $mail, $password) {
       	$db = $this->dbConnect();
        $password = password_hash($password, PASSWORD_DEFAULT); // hash le mdp avant de le rentrer dans la bdd
        $req = $db->prepare('INSERT INTO mv_user(pseudo, mail, password, creation_date) VALUES (?, ?, ?, NOW())');
        $result = $req->execute(array($pseudo, $mail, $password));
        if (!$result || !$req->rowCount() < 1) { // (rowCount permet de compter le nombre de ligne affectées par la dernière requête) Si aucune donnée n'a été insérée...
            return array(
            'success' => false,
            'message' => 'Le compte n\'a pas pu être créé...',
            );
        }
        return array(
        'success' => true,
        );
    }

    public function checkUserByMail($mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT mail FROM mv_user WHERE lower(mail) = lower(?)'); // lower sert à ignorer la casse en écrivant tous les caractères en minuscules
        $req->execute(array($mail));
        if ($req->rowCount() < 1) { // si le mail n'existe pas
            return false;
        }
        return true;
    }

    public function checkUserByPseudo($pseudo) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo FROM mv_user WHERE lower(pseudo) = lower(?)');
        $req->execute(array($pseudo));
        if ($req->rowCount() < 1) { // si le pseudo n'existe pas
            return false;
        }
        return true;
    }

	public function updatePassword($password, $mail) {
        $db = $this->dbConnect();
        $password = password_hash($password, PASSWORD_DEFAULT); // hash le mdp avant de le rentrer dans la bdd
        $req = $db->prepare('UPDATE mv_user SET password = ? WHERE mail = ?');
        $req->execute(array($password, $mail));
        if ($req->rowCount() < 1) { // permet de compter le nombre de ligne affectées par la dernière requête
            return false;
        }
        return true;
    }

/*
    public function updatePseudo($pseudo, $password) {
        $db = $this->dbConnect();
        $checkLogin = $this->checkLogin($password, $_SESSION['mail']);
        if (is_array($checkLogin)) {
            $req = $db->prepare('UPDATE mv_user SET pseudo = ? WHERE mail = ?');
            $req->execute(array($pseudo, $_SESSION['mail']));
            $upPseudo = $req->rowCount(); // permet de compter le nombre de ligne affectées par la dernière requête
            return $upPseudo;
        } else {
            return false;
        }
    }

        public function passUpdate($password, $newPassword) {
        $db = $this->dbConnect();
        $checkLogin = $this->checkLogin($password, $_SESSION['mail']);
        if (is_array($checkLogin)) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hachage du mot de passe
            $req = $db->prepare('UPDATE mv_user SET password = ? WHERE mail = ?');
            $req->execute(array($newPassword, $_SESSION['mail']));
            $passUp = $req->rowCount(); // permet de compter le nombre de ligne affectées par la dernière requête
            return $passUp;
        } else {
            return false;
        }
    }

	public function updateMail() {

	}

	public function updateAvatar() {

	}
*/
}