<?php
error_reporting(E_ALL);
session_start();

define('MYSQL_HOST', 'robb0283.publiccloud.com.br');
define('MYSQL_USER', 'frank_dev');
define('MYSQL_PASSWORD', 'Frank2019@');
define('MYSQL_DB_NAME', 'frankfkl1_ssentregas_dev');

class ControllerBd
{
	public $conn;

	function __construct()
	{
		try {
			$this->conn = new PDO('mysql:host='.MYSQL_HOST.';dbname='.MYSQL_DB_NAME.';charset=utf8',MYSQL_USER,MYSQL_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
		}
		catch ( PDOException $e ) {
    		///echo 'Erro ao conectar com o MySQL: ' . ;
    		die($e->getMessage());
		}

	}
}