<?

namespace Controller;

use Controller\connection;
use Model\site;
use PDO;

class sites extends connection{
    
    private $pdo;

    public function __construct(){
        try {
            // var_dump(self::get());
            $this->pdo = self::get();
        } catch (\Exception $e) {
            throw new Exception("Erro constructor users ".$e->__toString(),0);
        }
    }

    function insert($site){
        try{
            $stmte =$this->pdo->prepare("INSERT INTO `user_site`(`user_code`, `url`, reference) VALUES (:user_code, :url, :reference)");
            $user_code=$site->getCodeUser();
            $url=$site->getURL();
            $reference=$site->getReference();

            $stmte->bindParam(":user_code",$user_code , PDO::PARAM_INT);
            $stmte->bindParam(":reference", $reference , PDO::PARAM_INT);
            $stmte->bindParam(":url", $url , PDO::PARAM_STR);
            $executa = $stmte->execute();
            if($executa){
                return $this->pdo->lastInsertId();
            }
            else{
                return 0;
            }
        }
        catch(PDOException $e){
            // $log= new controlLog($this->pdo);
            // $log->insertLogErro('insert',$alteracao.'-->'.$e->getMessage());
            return 0;
        }
    }

    function findWithReference($site){
        try{
            $user_code=$site->getCodeUser();
            $reference=$site->getReference();
            $stmte = $this->pdo->prepare("SELECT * FROM user_site WHERE reference = :reference  AND user_code = :user_code LIMIT 1");
            $stmte->bindParam(":reference", $reference , PDO::PARAM_INT);
            $stmte->bindParam(":user_code", $user_code , PDO::PARAM_INT);
            if($stmte->execute()){
                if($stmte->rowcount()>0){
                    $result = $stmte->fetch(PDO::FETCH_OBJ);
                    $site->setURL($result->url);
                    $site->setCode($result->code);
                    $site->setCodeUser($result->user_code);
                    $site->setHttpCode($result->http_code);
                    $site->setRegister($result->register);
                    $site->setUpdated($result->updated);
                    $site->setMessage($result->message);
                    $site->setResult($result->result);
                    return $site;
                }
                return 0;
            }
            else{
                return 0;
            }
        }
        catch(PDOException $e){
            return 0;
            // return $e->getMessage();
        }
    }

    function findWithCode($site){
        try{
            $code = $site->getCode();
            $stmte = $this->pdo->prepare("SELECT * FROM user_site WHERE code = :code LIMIT 1");
            $stmte->bindParam(":code", $code , PDO::PARAM_INT);
            if($stmte->execute()){
                if($stmte->rowcount()>0){
                    $result = $stmte->fetch(PDO::FETCH_OBJ);
                    $site->setURL($result->url);
                    $site->setCode($result->code);
                    $site->setCodeUser($result->user_code);
                    $site->setHttpCode($result->http_code);
                    $site->setRegister($result->register);
                    $site->setUpdated($result->updated);
                    $site->setMessage($result->message);
                    $site->setResult($result->result);
                    return $site;
                }
                return 0;
            }
            else{
                return 0;
            }
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function siteExistWithCodeUser($site){
        try{

            $stmte = $this->pdo->prepare("SELECT * FROM user_site WHERE user_code = :user_code AND url = :url");
            $user_code=$site->getCodeUser();
            $url=$site->getURL();

            $stmte->bindParam(":user_code",$user_code , PDO::PARAM_INT);
            $stmte->bindParam(":url", $url , PDO::PARAM_STR);
            if($stmte->execute()){
                if($stmte->rowcount()>0){
                    return 1;
                }
                return 0;
            }
            else{
                return 0;
            }
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }
    
    function findWithCodeUser(int $user_code){
        try{
            $stmte = $this->pdo->prepare("SELECT * FROM user_site WHERE user_code = :user_code");
            $stmte->bindParam(":user_code", $user_code , PDO::PARAM_INT);
            if($stmte->execute()){
                if($stmte->rowcount()>0){
                    $sites = array();
                    while($result = $stmte->fetch(PDO::FETCH_OBJ)){
                        $site = site::full(
                            $result->url,
                            $result->code,
                            $result->user_code,
                            $result->http_code,
                            $result->register,
                            $result->updated,
                            $result->message,
                            $result->result
                        );
                        $sites[]=$site;
                    }
                    return $sites;
                }
                return 0;
            }
            else{
                return 0;
            }
        }
        catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function update($site){
        try{  
            $Code= $site->getCode();
            $HttpCode= $site->getHttpCode();
            $Message= $site->getMessage();
            $Result= $site->getResult();
            $stmte =$this->pdo->prepare("UPDATE `user_site` SET `http_code`=:http_code,`message`=:message,`result`=:result WHERE code = :code");
            $stmte->bindParam(":code", $Code , PDO::PARAM_INT);
            $stmte->bindParam(":http_code", $HttpCode , PDO::PARAM_STR);
            $stmte->bindParam(":message", $Message , PDO::PARAM_STR);
            $stmte->bindParam(":result", $Result , PDO::PARAM_STR);

            if($stmte->execute()){
                return 1;
            }
            else{
                return 0;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return 0;
        }
    }
}