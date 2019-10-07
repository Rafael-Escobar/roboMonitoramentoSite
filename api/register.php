<?php

require $_SERVER['DOCUMENT_ROOT']."/robointerwebs/vendor/autoload.php";
require $_SERVER['DOCUMENT_ROOT']."/robointerwebs/config.php";

use Controller\sites;
use Model\site;
use Library\secret;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $result = array(
        "result" => -1,
        "message" => 'Method not allowed'
    );

    echo json_encode($result);
    exit();
}

try {
    
    if(
        isset($_POST['user']) &&
        isset($_POST['url'])   &&
        isset($_POST['reference'])   &&
        isset($_POST['signature'])
        ){
            if(!empty($_POST['user']) &&
            !empty($_POST['url'])   &&
            !empty($_POST['reference'])   &&
            !empty($_POST['signature'])
            ){
            
                if(secret::verifyHash($_POST['user'].$_POST['url'],$_POST['signature'],KEY_HASH)){

                    $site = site::request($_POST['url'], $_POST['user'],$_POST['reference']);

                    $sites = new sites();

                    if($sites->findWithReference($site)){
                        $result = array(
                            "result" => -7,
                            "message" => 'Site already registered'
                        );
                    
                        echo json_encode($result);
                        exit();
                    }else{
                        $res = $sites->insert($site);
    
                        if($res){
                            $result = array(
                                "result" => 1,
                                "message" => 'SUCCESS'
                            );
                        
                            echo json_encode($result);
                            exit();
                        }else{
                            $result = array(
                                "result" => -5,
                                "message" => 'Error'
                            );
                        
                            echo json_encode($result);
                            exit();
                        }
                        
                    }


                }else{
                    $result = array(
                        "result" => -4,
                        "message" => 'Invalid signature'
                    );
                
                    echo json_encode($result);
                    exit();
                }

        }else{
            $data = empty($_POST['user'])? 'user,': '';
            $data .= empty($_POST['url'])? 'url,': '';
            $data .= empty($_POST['reference'])? 'reference,': '';
            $data .= empty($_POST['signature'])? 'signature,': '';

            $result = array(
                "result" => -2,
                "message" => "Data empty: $data"
            );
        
            echo json_encode($result);
            exit();
        }

    }else{
        $data = !isset($_POST['user'])? 'user,': '';
        $data .= !isset($_POST['url'])? 'url,': '';
        $data .= !isset($_POST['reference'])? 'reference,': '';
        $data .= !isset($_POST['signature'])? 'signature,': '';
        $result = array(
            "result" => -2,
            "message" => "Data missing: $data"
        );

        echo json_encode($result);
        exit();
    }

     //code...
} catch (Exception $e) {
    $result = array(
        "result" => -3,
        "message" => 'contact suport'.$e->__toString()
    );

    echo json_encode($result);
    exit();
}

?>