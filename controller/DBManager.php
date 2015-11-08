<?php
/**
 * User: Yago
 * Date: 08/11/2015
 * Time: 9:58
 */

require_once(__DIR__."../classes/usuario.php");
require_once(__DIR__."../classes/respuesta.php");
require_once(__DIR__."../classes/post.php");
require_once(__DIR__."../classes/tag.php");

class DBManager
{
    private $dbUser;
    private $dbPass;
    private $dbName;
    private $host;
    private $connection;

    /**
     * DBManager constructor.
     */
    public function __construct()
    {
        $this->dbUser='';
        $this->dbPass= '';
        $this->dbName= 'stackunderflow';
        $this->host='localhost';
        $this->connection= $this->connect();
    }

    /**
     * @return mysqli
     * Crea una conexion y la devuelve para hacer consultas del estilo
     * $connection->query('DROP DATABASE');
     */
    private function connect()
    {
        $connection= new mysqli($this->host,$this->dbUser,$this->dbPass,$this->dbName);
        if($connection->connect_error)
        {
            die('Error en conexion('.$connection->connect_errno.') '.$connection->connect_error);
        }
        return $connection;
    }


}
