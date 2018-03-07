<?php
namespace Kldr\ModeleVivant\Model;

class CommentManager extends Manager
{
    public function addComment($id_post, $id_user, $content) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO mv_comment(id_post, id_user, content, creation_date) VALUES(?, ?, ?, NOW())');
        $req->execute(array($id_post, $id_user, $content));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

    public function getComment($id_comment) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, id_post, id_user, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_comment WHERE id = ? ORDER BY creation_date DESC');
        $req->execute(array($id_comment));
        $ad = $req->fetch();
        return $ad;
    }

    public function getSignalisedComments() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, id_post, id_user, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_comment WHERE signalised = 0 ORDER BY creation_date DESC');
        $ads = $req->fetchAll();
        return $ads;
    }

    public function getCommentsByPost($id_post) {
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, id_post, id_user, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_comment WHERE id_post = ? AND signalised = 0 ORDER BY creation_date DESC');
	    $req->execute(array($id_post));
        $ads = $req->fetchAll();
        return $ads;
    }

    public function editComment($id_post, $content, $id_comment) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('UPDATE mv_comment SET id_post = ?, content = ?, signalised = 0 WHERE id = ?');
	    $req->execute(array($id_post, $content, $id_comment));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

	public function deleteComment($id_comment) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM mv_comment WHERE id = ?');
        $req->execute(array($id_comment));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }	

    public function reportedComment($id_comment) {
	    $db = $this->dbConnect();
		$req = $db->prepare('UPDATE mv_comment SET signalised = 1 WHERE id = ?');
		$req->execute(array($id_comment));
		if ($req->rowCount() < 1) {
            return false;
        }
        return true;
	}
}