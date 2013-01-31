<?php
class DB
{
	private static $instance;
	private $count = 0;
	public $dbh;

	private function __construct()
	{
	}

	public static function singleton()
	{
		if (!isset(self::$instance)) {
			//echo 'Creating new instance.';
			$className = __CLASS__;
			self::$instance = new $className;
			self::$instance->connect();
		}
		return self::$instance;
	}

	function connect() {
		$dbh = new MyPDO('mysql:host='.MYSQL_CONNECT_HOST.';dbname='.MYSQL_DB_NAME, MYSQL_CONNECT_USER, MYSQL_CONNECT_PASS);
		//$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		$query = "SET NAMES utf8";
		$dbh->query($query);
		$this->dbh = $dbh;
	}
/*
    public function increment()
    {
        return $this->count++;
    }

    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }
*/
}

/*
$_DB = mysql_connect(MYSQL_CONNECT_HOST,MYSQL_CONNECT_USER,MYSQL_CONNECT_PASS) or die("cannnot connect");
mysql_select_db(MYSQL_DB_NAME,$_DB);
$query = "SET NAMES utf8";

mysql_query($query,$_DB);
*/


?>
