<?php

namespace Model;

class site
{
    private $URL;
    private $code;
    private $codeUser;
    private $reference;
    private $httpCode;
    private $register;
    private $updated;
    private $message;
    private $result;

    public function __construct(){
    }

    public static function request($URL, $codeUser,$reference){
        $site = new self();
        $site->setURL($URL);
        $site->setCodeUser($codeUser);
        $site->setReference($reference);
        return $site;
    }
    public static function search( $codeUser,$reference){
        $site = new self();
        $site->setCodeUser($codeUser);
        $site->setReference($reference);
        return $site;
    }

    public static function response($URL,$code,$codeUser,$httpCode,$register,$updated,$message,$result){
        $site = new self();
        $site->setURL($URL);
        $site->setCode($code);
        $site->setCodeUser($codeUser);
        $site->setHttpCode($httpCode);
        $site->setRegister($register);
        $site->setUpdated($updated);
        $site->setMessage($message);
        $site->setResult($result);
        return $site;
    }

    public function toJson(){
        $json = array(
            'URL' => $this->getURL(),
            'code' => $this->getCode(),
            'codeUser' => $this->getCodeUser(),
            'reference' => $this->getReference(),
            'httpCode' => $this->getHttpCode(),
            'register' => $this->getRegister(),
            'updated' => $this->getUpdated(),
            'message' => $this->getMessage(),
            'result' => $this->getResult()
        );

        return json_encode($json);
    }

    public function setURL($URL){ $this->URL = $URL;}
    public function setCode($code){ $this->code = $code;}
    public function setCodeUser($codeUser){ $this->codeUser = $codeUser;}
    public function setReference($reference){ $this->reference = $reference;}
    public function setHttpCode($httpCode){ $this->httpCode = $httpCode;}
    public function setRegister($register){ $this->register = $register;}
    public function setUpdated($updated){ $this->updated = $updated;}
    public function setMessage($message){ $this->message = $message;}
    public function setResult($result){ $this->result = $result;}

    public function getURL(){return $this->URL;}
    public function getCodeUser(){return $this->codeUser;}
    public function getCode(){return $this->code;}
    public function getReference(){return $this->reference;}
    public function getHttpCode(){return $this->httpCode;}
    public function getRegister(){return $this->register;}
    public function getUpdated(){return $this->updated;}
    public function getMessage(){return $this->message;}
    public function getResult(){return $this->result;}
}
