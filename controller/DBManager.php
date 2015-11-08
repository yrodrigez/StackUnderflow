<?php
/**
 * User: Yago
 * Date: 08/11/2015
 * Time: 9:58
 */

include_once("../classes/usuario.php");
include_once("../classes/respuesta.php");
include_once("../classes/post.php");
include_once("../classes/tag.php");

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
        $this->dbUser= 'root';
        $this->dbPass= '';
        $this->dbName= 'stackunderflow';
        $this->host= 'localhost';
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

    /**
     * @param $usuario
     * recibe un usuario para crear un usuario básico en la base de datos,
     * básico quiere decir que la foto y la descripción serán nulos en este
     * y además será tipoUsuario= 1 que correspondería a usuario "normal"
     */
    public function createBasicUser(
       $usuario
    ) {
        $username= $usuario->getUsername();
        $password= $usuario->getPassword();
        $tipoUsuario= '1';
        $email= $usuario->getEmail();
        $this->connection= $this->connect();
        $result= $this->connection->query("INSERT INTO `usuario`(
                                                            `username`,
                                                            `password`,
                                                            `email`,
                                                            `foto`,
                                                            `descripcion`,
                                                            `tipo`)
                                                            VALUES (
                                                            '$username',
                                                            '$password',
                                                            '$email',
                                                            'NULL',
                                                            'NULL',
                                                            '$tipoUsuario')");
        if(!$result)
        {
            die("Error de conexión al crear BasicUser".$result);
        }
        return true;
    }

    /**
     * @param $post
     * @param $usuario
     */
    public function createPost(
        $post,
        $usuario
    ) {
        $this->connection= $this->connect();
        $result= $this->connection->query("INSERT INTO `POST`(
                                                          `USERNAME`,
                                                          `CUERPO`,
                                                          `FECHA_CREACION`,
                                                          `CONTESTADA`)
                                                          VALUES(
                                                          '$usuario->getUsername()',
                                                          '$post->cuerpo;',
                                                          '$post->fechaCreacion()',
                                                          `0`)");
        if(!$result)
        {
            die("Error de conexión al crear BasicUser".$result);
        }
        return true;
    }

    /**
     * @param $usuario
     * @return Usuario
     * si el usuario es inválido retorna en el tipo de usuario -1
     */
    public function login(
        $usuario
    ){
        $this->connection = $this->connect();
        $username= $usuario->getUsername();
        $results = $this
            ->connection
            ->query(
                "SELECT * FROM USUARIO
                    WHERE USERNAME=
                    '$username'"
            );
        if (
            $results->num_rows == 0
        ) {
            return -2;
        }
        else
        {
            foreach (
                $results as $result
            ) {
                if (
                    $usuario->getPassword() == $result["PASSWORD"]
                ) {
                    $usuario->setTipo($result["TIPO"]);
                    $usuario->setDescripcion($result["DESCRIPCION"]);
                    $usuario->setEmail($result["EMAIL"]);
                    $usuario->setFotoPath($result["FOTO"]);
                    return $usuario;
                }
                else
                    $usuario->setTipo(-1);
                    return $usuario;
            }
        }
    }




}
