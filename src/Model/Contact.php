<?php

namespace App\Model;

use Symfony\Component\HttpFoundation\Response;

class Contact
{
    private $pathFiles = '../public/files/feedback.txt';

    public function feedBack($request)
    {
        $name = $request['name'];
        $address = $request['address'];
        $subject = $request['subject'];
        $message = $request['message'];

        $message = "От " . $name . ", " . $address . " на тему " . $subject . ":\r\n " . $message . "\r\n\r\n";
        $message = htmlspecialchars($message, ENT_QUOTES);
        $file = fopen($this->pathFiles, "a");
        fwrite($file, $message);
        fclose($file);
        $response = new Response();
        $response->headers->set('Location:', '/');
    }
}