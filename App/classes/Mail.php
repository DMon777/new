<?php

namespace App\classes;

class Mail{

    protected static $message;
    protected static $subject;
    protected static $from;
    protected static $headers;
    protected static $to;


    public static function send_mail($to,$subject,$message,$from){

        self:: $to = $to;
        self:: $message = $message;
        self:: $subject = "=?utf-8?B?".base64_encode($subject)."?=";
        self:: $headers = "From: $from\r\nReply-to:$from\r\nContent-type:text/plain;charset = utf-8\r\n";

        mail(self::$to,self::$subject,self::$message,self::$headers);
    }


}