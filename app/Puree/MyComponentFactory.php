<?php
namespace Puree;

class MyComponentFactory extends \Pure\ComponentFactory
{
/*
    function buildRequest()
    {
        //$request = new \Pure\Request();
        $request = Request::getInstance();
        return $request;
    }

    function buildDB()
    {
        //$request = new \Pure\Request();
        $db = DB::getInstance($this->container->get('MyPDO'));
        return $db;
    }
*/
    function buildConfig()
    {
        //new MyPDO('mysql:host='.MYSQL_CONNECT_HOST.';dbname='.MYSQL_DB_NAME, MYSQL_CONNECT_USER, MYSQL_CONNECT_PASS);
        $config = new \stdClass();
        $config->db = 'mysql';
        $config->dbname = MYSQL_DB_NAME;
        $config->host = MYSQL_CONNECT_HOST;
        $config->user = MYSQL_CONNECT_USER;
        $config->password = MYSQL_CONNECT_PASS;
        return $config;
    }

    function buildMyPDO()
    {
        //$request = new \Pure\Request();
        //$mypdo = new MyPDO();
        //return $mypdo;
        $config = $this->container->get('config');
        $dsn = "{$config->db}:dbname={$config->dbname};host={$config->host}";
        $pdo = new \Pure\MyPDO($dsn, $config->user, $config->password);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $query = "SET NAMES utf8";
        $pdo->query($query);

        return $pdo;

    }
}

?>
