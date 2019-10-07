<?php

namespace Library;

class secret
{
    public static function verifyHash($content,$signatura,$key){
        $hash=hash_hmac('sha256', $content, $key);
        return strcmp($signatura,$hash)==0? true:false;
    }
}
