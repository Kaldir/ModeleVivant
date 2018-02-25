<?php
namespace Kldr\ModeleVivant\Model;

class UserManager extends Manager
{
/*
    public function checkLogin($password, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo, mail, password, admin FROM mv_user WHERE email = ?');
        $req->execute(array($email));
        $user = $req->fetch();
        if (password_verify($password, $user['password'])) { // fonction PHP qui vérifie si les mots de passe (crypté et clair) sont identiques (celui rentré et celui de la bdd)
            $userInfo = array(
                'pseudo' => $user['pseudo'],
                'mail' => $user['mail'],
                'admin' => $user['admin'],
            );
            return $userInfo;
        }
        return false;
    }
*/

	public function createAccount($pseudo, $mail, $password) {
        $result = $this->checkExistingUser($pseudo, $mail); // on utilise la méthode checkExistingUser pour vérifier si les données existent déjà dans la bdd
        if ($result['success'] == false) {
            return array(
            'success' => false,
            'message' => $result['message'],
            );
        } // Si les données n'existent pas, alors, on les crée
		$db = $this->dbConnect();
        $password = password_hash($password, PASSWORD_DEFAULT); // hash le mdp avant de le rentrer dans la bdd
        $req = $db->prepare('INSERT INTO mv_user(pseudo, mail, password, creation_date) VALUES (?, ?, ?, NOW())');
        $result = $req->execute(array($pseudo, $mail, $password));
        if (!$result || !$req->rowCount() < 1) { // si aucune donnée n'a été insérée...
            return array(
            'success' => false,
            'message' => 'Le compte n\'a pas pu être créé...',
            );
        }
        return array(
        'success' => true,
        );
    }

    public function checkExistingUser($pseudo, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo FROM mv_user WHERE lower(pseudo) = lower(?)'); // lower sert à ignorer la casse en écrivant tous les caractères en minuscules
        $req->execute(array($pseudo));
        $message = '';
        if ($req->rowCount() > 0) { // permet de compter le nombre de ligne affectées par la dernière requête
            $message .= 'Ce pseudo est déjà pris ! ';
        }
        $req = $db->prepare('SELECT mail FROM mv_user WHERE lower(mail) = lower(?)');   
        $req->execute(array($mail));
        if ($req->rowCount() > 0) {
            $message .= 'Ce mail est déjà utilisé !';
        }
        if (!empty($message)) {
            return array(
            'success' => false,
            'message' => $message,
            );
        }
        return array(
        'success' => true,
        );
    }

/*
	public function recoverPassword($password, $pseudo, $mail) {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE mv_user SET password = ? WHERE pseudo = ? AND mail = ?');
        $req->execute(array($password, $pseudo, $mail));
        $recover = $req->rowCount(); // permet de compter le nombre de ligne affectées par la dernière requête
        return $recover;
    }

    public function pseudoUpdate($pseudo, $password) {
        $db = $this->dbConnect();
        $checkLogin = $this->checkLogin($password, $_SESSION['mail']);
        if (is_array($checkLogin)) {
            $req = $db->prepare('UPDATE mv_user SET pseudo = ? WHERE mail = ?');
            $req->execute(array($pseudo, $_SESSION['mail']));
            $pseudoUp = $req->rowCount(); // permet de compter le nombre de ligne affectées par la dernière requête
            return $pseudoUp;
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

	public function mailUpdate() {

	}

	public function avatarUpdate() {

	}
*/
}