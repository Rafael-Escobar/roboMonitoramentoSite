<?
namespace Controller;

use PDO;

class connection 
{
    private $connection = null;

    public function connect(){
        try {
            
                if(empty($this->connection)){
                    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_BASE;

                    $this->connection= new PDO($dsn, DB_USER, DB_PASSWORD, array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
                }

                return $this->connection;

        } catch (\Exception $e) {

            throw new \Exception("Connection with database fail !".$e->__toString(), 500);
        
        }
    }

    public function __construct(){
        try {
            if(
                (DB_USER == null) || 
                (DB_PASSWORD == null) ||
                (DB_BASE == null) ||
                (DB_HOST == null) 
            ){
                throw new \Exception("Connection credentials are missing!", 500);
            }else{
                echo "<br> DB_USER ".DB_USER;
                echo "<br> DB_PASSWORD ".DB_PASSWORD;
                echo "<br> DB_BASE ".DB_BASE;
                echo "<br> DB_HOST ".DB_HOST;
            }

        } catch (\Exception $e) {
            throw new \Exception("Connection with database fail !".$e->__toString(), 500);
        }
    }

    public function __destructor(){
        $this->function = null;
    }

    public function get(){
        try {

            if(empty($this->connection)){
                return $this->connect();
            }

            return $this->connection;

        } catch (\Exception $e) {
            throw new \Exception("Connection with database fail !".$e->__toString(), 500);
        }
    }

}
