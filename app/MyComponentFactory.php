<?php
class MyComponentFactory extends ComponentFactory
{
    function buildConfig()
    {
        $config = new stdClass();
        $config->db = 'mysql';
        $config->dbname = 'hoge';
        $config->host = 'localhost';
        $config->user = 'dbusername';
        $config->password = 'dbpassword';
        return $config;
    }

    function buildPDO()
    {
        $config = $this->container->get('config');
        $dsn = "{$config->db}:dbname={$config->dbname};host={$config->host}";
        $pdo = new PDO($dsn, $config->user, $config->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}

?>
