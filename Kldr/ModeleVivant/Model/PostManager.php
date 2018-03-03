<?php
namespace Kldr\ModeleVivant\Model;

class PostManager extends Manager
{
// RESEARCH
	public function researchPost($keywords) {
		$db = $this->dbConnect();
        $post = $db->query('SELECT content, title FROM mv_post WHERE content RLIKE "'.$keywords.'" OR title RLIKE "'.$keywords.'" ORDER BY creation_date');
        return $post;
    }
}