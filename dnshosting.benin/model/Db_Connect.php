<?php
class Db_Connect
{
private $db;


public function connect()
{
	require_once ('Config.php');
			try
			{
	$this->db=new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME,DB_USER,DB_PASSWORD);	
			}
			catch(Exception $e)
			{
			 die('Erreur : '.$e->getMessage());
			}
	return $this->db;
}


}

?>