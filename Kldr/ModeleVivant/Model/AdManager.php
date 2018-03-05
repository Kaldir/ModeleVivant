<?php
namespace Kldr\ModeleVivant\Model;

class AdManager extends Manager
{
// RESEARCH
	public function researchAd($keywords) {
		$db = $this->dbConnect();
        $req = $db->query('SELECT content, title FROM mv_ad WHERE content RLIKE "'.$keywords.'" OR title RLIKE "'.$keywords.'" ORDER BY creation_date');
        $ad = $req->fetchAll();
        return $ad;
    }

// ADVERTISEMENTS
    public function addAdvertisement($id_user, $id_category, $title, $town, $county, $location, $date_event, $content) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO mv_ad(id_user, id_category, title, town, county, location, date_event, content, creation_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, NOW())');
        $req->execute(array($id_user, $id_category, $title, $town, $county, $location, $date_event, $content));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

    public function getAdvertisement($id_ad) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, id_category, id_user, title, town, county, location, date_event, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_ad WHERE id = ? ORDER BY creation_date DESC');
        $req->execute(array($id_ad));
        $ad = $req->fetch();
        return $ad;
    }

    public function getAdvertisements() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, id_category, id_user, title, town, county, location, date_event, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_ad ORDER BY creation_date DESC');
        $ads = $req->fetchAll();
        return $ads;
    }

    public function getAdvertisementsByCategory($id_category) {
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, id_category, id_user, title, town, county, location, date_event, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_ad WHERE id_category = ? ORDER BY creation_date DESC');
	    $req->execute(array($id_category));
        $ads = $req->fetchAll();
        return $ads;
    }

    public function editAdvertisement($id_category, $title, $town, $county, $location, $date_event, $content, $id_ad) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('UPDATE mv_ad SET $id_category = ?, title = ?, town = ?, county = ?, location = ?, date_event = ?, content = ? WHERE id_ad = ?');
	    $req->execute(array($id_category, $title, $town, $county, $location, $date_event, $content, $id_ad));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

	public function deleteAdvertisement($id_ad) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM mv_ad WHERE id = ?');
        $req->execute(array($id_ad));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }	

    public function publishedAd($id_ad) {
	    $db = $this->dbConnect();
		$req = $db->prepare('UPDATE mv_ad SET published = 1 WHERE id = ?');
		$req->execute(array($id_ad));
		if ($req->rowCount() < 1) {
            return false;
        }
        return true;
	}
}