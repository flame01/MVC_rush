<?php

namespace WebFramework;

use \PDO;

class ORM {
  private $query;
  private $db;

  private static $instance = null;

  /**
   * Private constructor so nobody else can instantiate it.
   */
  private function __construct() {
    $this->query = '';
  }

  /**
   * Retrieve the static instance of the ORM.
   *
   * @return ORM - Instance of the ORM
   */
  public static function getInstance() {
      if (is_null(self::$instance)) {
          self::$instance = new ORM();
      }

      return self::$instance;
  }

  /**
   * Connect to a database.
   *
   * @param array $config - Database configuration
   * @return PDO - Instance of PDO used to interact with the connected DB.
   */
  public function connect(array $config) {
    try {
      $this->db = new PDO(
        "{$config['driver']}:host={$config['host']};dbname={$config['dbname']}",
        $config['username'],
        $config['password'],
        $config['options']
      );
      return $this->db;
    }
    catch (Exception $e) {
      echo $e->getMessage();
    }
  }

 
  public function persist($object) {
    // TODO: Implement this function
    $this->query .= $object;
  }

  /**
   * Synchronize each managed models with the database.
   */
  public function flush() {
    // TODO: Implement this function
    $query = $this->db->prepare($this->query);
    $query->execute();
    $query = '';
  }

  //select("users", "user_id, username, email", "user_id > 3", true);
  public function select($table, $values = "*", $condition = null, $multiple = true){

    $query = "SELECT $values FROM $table";
    if($condition !== NULL){
      $query .= "WHERE $condition"; 
    }
    $query .= ";";

    $query = $this->db->prepare($query);
    $query->execute();
    if($multiple){
      return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    return $query->fetch(PDO::FETCH_ASSOC);

  }
}
