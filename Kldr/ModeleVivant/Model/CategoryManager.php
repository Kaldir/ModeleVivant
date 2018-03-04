<?php
namespace Kldr\ModeleVivant\Model;

class CategoryManager extends Manager
{
	public function getAdsCategories() {
		$db = $this->dbConnect();
	    $req = $db->query('SELECT id, name FROM mv_category_ads');
        $categories = $req->fetchAll();
		return $categories;

	}

	public function getAdCategory($id) {
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, name FROM mv_category_ads WHERE id = ?');
        $req->execute(array($id));
        $category = $req->fetch();
        return $category;
	}

	public function getPostsCategories() {
		$db = $this->dbConnect();
	    $req = $db->query('SELECT id, name FROM mv_category_posts');
        $categories = $req->fetchAll();
		return $categories;
	}

		public function getPostCategory($id) {
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, name FROM mv_category_posts WHERE id = ?');
        $req->execute(array($id));
        $category = $req->fetch();
        return $category;
	}
}