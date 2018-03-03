<?php
namespace Kldr\ModeleVivant\Model;

class AdManager extends Manager
{
// RESEARCH
	public function researchAd($keywords) {
		$db = $this->dbConnect();
        $ad = $db->query('SELECT content, title FROM mv_ad WHERE content RLIKE "'.$keywords.'" OR title RLIKE "'.$keywords.'" ORDER BY creation_date');
        return $ad;
    }

// ADVERTISEMENTS
    public function addAdvertisement($id_category, $title, $town, $county, $location, $date_event, $content) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('INSERT INTO mv_ad(id_category, title, town, county, location, date_event, content, creation_date) VALUES(?, ?, ?, ?, ?, ?, ?, NOW())');
        $req->execute(array($id_category, $title, $town, $county, $location, $date_event, $content));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

        public function getAdvertisement($id_category, $id_user) {
		$db = $this->dbConnect();
	    $req = $db->prepare('SELECT id, id_category, id_user, title, content, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_ad WHERE id_category = ? AND id_user = ? ORDER BY comment_date DESC');
	    $req->execute(array($id_category, $id_user));
	    if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

    public function editAdvertisement($title, $town, $county, $location, $date_event, $content, $adId) {
	    $db = $this->dbConnect();
	    $req = $db->prepare('UPDATE mv_ad SET title = ?, town = ?, county = ?, location = ?, date_event = ?,content = ?, signalised = 0 WHERE id = ?');
	    $req->execute(array($title, $town, $county, $location, $date_event, $content, $adId));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }

	public function deleteAdvertisement($adId) {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM mv_ad WHERE id = ?');
        $req->execute(array($adId));
        if ($req->rowCount() < 1) {
            return false;
        }
        return true;
    }	

    	public function signalAd($adId) {
	    $db = $this->dbConnect();
		$req = $db->prepare('UPDATE mv_ad SET signalised = 1 WHERE id = ?');
		$req->execute(array($adId));
		if ($req->rowCount() < 1) {
            return false;
        }
        return true;
	}

	    public function getAdsSignalised() { 
		$db = $this->dbConnect();
	    $signalised = $db->query('SELECT id, title, town, county, location, date_event, content, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM mv_ad WHERE signalised = 1 ORDER BY creation_date DESC');
    	return $signalised;
	}
}