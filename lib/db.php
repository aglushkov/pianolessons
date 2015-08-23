<?php
require_once DOCROOT . '/config/secrets.php';
require_once DOCROOT . '/lib/piano_error.php';

# Singleton class
class DB {
  static private $instance;

  private function __construct(){
    if (!($this->db = mysqli_connect(DB_HOST, DB_USER, DB_PASS))) {
      throw new PianoError("DATABASE CONNECTION ERROR");
    }

    if(!$this->db->select_db(DB_NAME)) {
      throw new PianoError("DATABASE NOT EXISTS");
    }
  }

  static public function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new DB();
    }
    return self::$instance;
  }

  public function query($query) {
    $query = trim($query);
    $mysqli_result = $this->db->query($query);
    if(!$mysqli_result) {
       throw new PianoError(mysqli_error($link)."\n".$query);
    }

    if (is_object($mysqli_result)) {
      $res = array();
      while ($row = $mysqli_result->fetch_assoc()) {
        $res[] = $row;
      }
    } elseif($mysqli_result===true) {
      $query = strtolower($query);
      if (strpos($query, "insert")===0) {
        $res = $this->db->insert_id;
      } elseif(strpos($query, "update")===0 || strpos($query, "delete")===0) {
        $res = $this->db->affected_rows;
      } else {
        $res = $mysqli_result;
      }
    }
    return $res;
  }

}


?>
