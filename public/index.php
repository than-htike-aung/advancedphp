<?php

use App\classes\Mail;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../bootstrap/init.php";

//echo APP_ROOT;
//echo getenv("APP_NAME");
//echo "<br>" . getenv("APP_DEVELOPER");
//echo "<br>" . getenv("APP_ENV");
//echo URL_ROOT;

//$user = Capsule::table("users")->where("id",1)->get();
//echo "<pre>" .print_r($user,true). "</pre>";


$mailer = new Mail();

$content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Pellentesque commodo velit quis elit fermentum, 
         a vulputate ipsum pellentesque. Aliquam ultricies leo ante, ";
$data = [
    "to" => "zaw060700@gmail.com",
    "to_name" => "THAN HTIKE",
    "content" => $content,
    "subject" => "New mail testing for e-commerce project",
    "filename" => "welcome",
    "img_link" => URL_ROOT . '/assets/images/coder.jpg'
];

//extract($data);
//echo  $to_name;

if($mailer->send($data)){
    echo "<br><h1>Mail Send Successfully</h1>";
}else{
    echo "<br><h1>Mail Send Fail!</h1>";
}
