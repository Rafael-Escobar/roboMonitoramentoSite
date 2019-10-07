<?php

require $_SERVER['DOCUMENT_ROOT']."/robointerwebs/vendor/autoload.php";
require $_SERVER['DOCUMENT_ROOT']."/robointerwebs/config.php";

use Controller\sites;
use Model\site;
use Library\secret;

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    $result = array(
        "result" => -1,
        "message" => 'Method not allowed'
    );

    echo json_encode($result);
    exit();
}

try {
    
    if(
        isset($_GET['user']) &&
        isset($_GET['reference'])   &&
        isset($_GET['signature'])
        ){
            if(!empty($_GET['user']) &&
            !empty($_GET['reference'])   &&
            !empty($_GET['signature'])
            ){
            
                if(secret::verifyHash($_GET['user'].$_GET['reference'],$_GET['signature'],KEY_HASH)){
                    var_dump($_GET);

                    $site = site::search($_GET['user'],$_GET['reference']);
                    $sites = new sites();
                    $res = $sites->findWithReference($site);

                    if($res){
                        $result = array(
                            "result" => 1,
                            "message" => $res->toJson()
                        );
                    
                        echo json_encode($result);
                        exit();

                    }else{
                        $result = array(
                            "result" => -5,
                            "message" => 'Not Found'
                        );
                    
                        echo json_encode($result);
                        exit();
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
            $data = empty($_GET['user'])? 'user,': '';
            $data .= empty($_GET['reference'])? 'reference,': '';
            $data .= empty($_GET['signature'])? 'signature,': '';

            $result = array(
                "result" => -2,
                "message" => "Data empty: $data"
            );
        
            echo json_encode($result);
            exit();
        }

    }else{
        $data = !isset($_GET['user'])? 'user,': '';
        $data .= !isset($_GET['reference'])? 'reference,': '';
        $data .= !isset($_GET['signature'])? 'signature,': '';
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
        "message" => 'contact suport'
    );

    echo json_encode($result);
    exit();
}

?>