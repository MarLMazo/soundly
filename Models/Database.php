<?php

class Database{

  private static $username = "";
  private static $password = "";
  private static $dsn = "mysql:host=localhost;dbname=";
  private static $dbconn;

  //get pdo connection
  public static function getDb()
  {
      if (!isset(self::$dbconn)) {
          try {
              self::$dbconn = new \PDO(self::$dsn, self::$username, self::$password);
          } catch (\PDOException $e) {
              $msg = $e->getMessage();
              echo $msg;
              exit();
          }
      }
      self::$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return self::$dbconn;
  }
}
