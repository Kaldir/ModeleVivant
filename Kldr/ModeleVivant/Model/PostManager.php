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
}