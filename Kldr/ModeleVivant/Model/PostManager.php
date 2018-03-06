<?php
namespace Kldr\ModeleVivant\Model;

class PostManager extends Manager
{
// RESEARCH
	public function researchPost($keywords) {
		$db = $this->dbConnect();
        $req = $db->query('SELECT content, title FROM mv_post WHERE content RLIKE "'.$keywords.'" OR title RLIKE "'.$keywords.'" ORDER BY creation_date');
        $post = $req->fetchAll();
        return $post;
    }

// POSTS
    public function addPost($id_user, $id_category, $title, $content) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO mv_post(id_user, id_category, title, content, creation_date) VALUES(?, ?, ?, ?, NOW())');
        $req->execute(array($id_user, $id_category, $title, $content));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

    public function getPost($id_post) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, id_category, id_user, title, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_post WHERE id = ? ORDER BY creation_date DESC');
        $req->execute(array($id_post));
        $post = $req->fetch();
        return $post;
    }

    public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, id_category, id_user, title, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_post ORDER BY creation_date DESC');
        $posts = $req->fetchAll();
        return $posts;
    }

    public function getPostsByCategory($id_category) {
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, id_category, id_user, title, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_post WHERE id_category = ? ORDER BY creation_date DESC');
	    $req->execute(array($id_category));
        $posts = $req->fetchAll();
        return $posts;
    }

    public function editPost($id_category, $title, $content, $id_post) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('UPDATE mv_post SET id_category = ?, title = ?, content = ? WHERE id = ?');
	    $req->execute(array($id_category, $title, $content, $id_post));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

	public function deletePost($id_post) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM mv_post WHERE id = ?');
        $req->execute(array($id_post));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }	
}