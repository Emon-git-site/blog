<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "blog");

class Database {
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $dbname = DB_NAME;

  public $link;
  public $error;

  public function __construct() {
      $this->connectDB();
  }

  private function connectDB() {
      $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
      if ($this->link->connect_error) {
          $this->error = "Connection fail: " . $this->link->connect_error;
          return false;
      }
  }

  // Select or Read data
  public function select($query) {
      $result = $this->link->query($query) or die($this->link->error . __LINE__);
      return $result->num_rows > 0 ? $result : false;
  }

  // Insert data
  public function insert($query) {
      $insertRow = $this->link->query($query) or die($this->link->error . __LINE__);
      return $insertRow ? $insertRow : false;
  }

  // Update data
  public function update($query) {
      $updateRow = $this->link->query($query) or die($this->link->error . __LINE__);
      return $updateRow ? $updateRow : false;
  }

  // Delete data
  public function delete($query) {
      $deleteRow = $this->link->query($query) or die($this->link->error . __LINE__);
      return $deleteRow ? $deleteRow : false;
  }
}
?>
