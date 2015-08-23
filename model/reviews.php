<?php
require_once DOCROOT . '/lib/db.php';

class Reviews{
	public function __construct(){
		$this->DB = DB::getInstance();
		$this->createTable();
	}

	private function createTable() {
		$query =
		"CREATE TABLE IF NOT EXISTS `reviews`
		(
			`id` int(11) NOT NULL auto_increment,
			`name` varchar(100) default NULL,
			`message` TEXT default NULL,
			`approve` bool default '0',
			`date` TIMESTAMP,
			PRIMARY KEY  (`id`)
		)
		ENGINE = InnoDB
		CHARACTER SET utf8
		COLLATE utf8_swedish_ci";

		$this->DB->query($query);
	}

	public function addReview($name,$mes) {
		$name = $this->DB->db->escape_string(htmlspecialchars($name));
		$mes = $this->DB->db->escape_string(htmlspecialchars($mes));
		return $this->DB->query("INSERT INTO reviews SET name='$name', message='$mes'");
	}

	public function getAllReviews() {
		return $this->DB->query("SELECT *,UNIX_TIMESTAMP(date) as 'date' FROM reviews ORDER BY id DESC");
	}
	public function getNotApprovedReviews() {
		return $this->DB->query("SELECT name,message,UNIX_TIMESTAMP(date) as 'date' FROM reviews WHERE approve=false ORDER BY id DESC");
	}

	public function getApprovedReviews() {
		return $this->DB->query("SELECT name,message,UNIX_TIMESTAMP(date) as 'date' FROM reviews WHERE approve=true ORDER BY id DESC");
	}
	public function deleteReview($id) {
		$id = $this->DB->db->escape_string($id);
		return $this->DB->query("DELETE from reviews WHERE id='$id'");
	}

	public function updateAndApproveReview($id,$name,$mes) {
		$id = $this->DB->db->escape_string($id);
		$name = $this->DB->db->escape_string(htmlspecialchars($name));
		$mes = $this->DB->db->escape_string(htmlspecialchars($mes));
		return $this->DB->query("UPDATE reviews SET name='$name', message='$mes', approve='1', date=date WHERE id='$id'");
	}

	public function disApproveReview($id) {
		return $this->DB->query("UPDATE reviews SET approve='0', date=date WHERE id='$id'");
	}
}

?>
