<?php
namespace Kldr\ModeleVivant\Model;

class UserManager extends Manager
{
    public $pseudo, $mail, $avatar, $admin, $id;

// LOGIN
    public function login($password, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo, mail, avatar, password, admin, id FROM mv_user WHERE mail = ?');
        $req->execute(array($mail));
        $user = $req->fetch();
        if (!password_verify($password, $user['password'])) { // fonction PHP qui vérifie si les mots de passe (crypté et clair) sont identiques (celui rentré et celui de la bdd)
            return false;
        }
        $this->pseudo = $user['pseudo']; // this désigne l'objet UserManager, on attribue ainsi une valeur aux variables déclarée au début de la classe afin de les réutiliser plus tard, lorsque l'on a accès à l'objet en question
        $this->mail = $user['mail'];
        $this->avatar = $user['avatar'];
        $this->admin = $user['admin'];
        $this->id = $user['id'];
        return true;
   }

	public function createAccount($pseudo, $mail, $password) {
       	$db = $this->dbConnect();
        $password = password_hash($password, PASSWORD_DEFAULT); // hash le mdp avant de le rentrer dans la bdd
        $req = $db->prepare('INSERT INTO mv_user(pseudo, mail, password, creation_date) VALUES (?, ?, ?, NOW())');
        $result = $req->execute(array($pseudo, $mail, $password));
        if (!$result || $req->rowCount() < 1) { // (rowCount permet de compter le nombre de ligne affectées par la dernière requête) Si aucune donnée n'a été insérée...
            return false;
        }
        return true;
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

    public function updatePseudo($pseudo, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE mv_user SET pseudo = ? WHERE mail = ?');
        $req->execute(array($pseudo, $mail));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

        public function updateMail($newMail, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE mv_user SET mail = ? WHERE mail = ?');
        $req->execute(array($newMail, $mail));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

    public function updateAvatar($newAvatar, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE mv_user SET avatar = ? WHERE mail = ?');
        $req->execute(array($newAvatar, $mail));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

    public function getUsersAccount() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, pseudo, mail, avatar FROM mv_user WHERE admin = 0 ORDER BY pseudo');
        $users = $req->fetchAll();
        return $users;
    }

    public function deleteUserAccount($id_user) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM mv_user WHERE id = ?');
        $req->execute(array($id_user));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }
}