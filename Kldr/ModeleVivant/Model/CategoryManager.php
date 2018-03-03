<?php
namespace Kldr\ModeleVivant\Model;

class CategoryManager extends Manager
{
	public function getCategory($id, $name) {
		$db = $this->dbConnect();
	    $req = $db->query('SELECT id, name FROM mv_category WHERE id = ? AND name = ?');
	    $req->execute(array($id));
        $category = $req->fetch();
		$this->id = $category['id'];
		$this->id = $category['name'];
		return true;
	}
}