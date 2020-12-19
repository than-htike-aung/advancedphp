<?php

use App\classes\Mail;
use App\classes\Session;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../bootstrap/init.php";

//Session::add("name", "Tester");

//Session::remove("token");

//echo $_SESSION["name"];

// var_dump(Session::get("name"));

//Session::replace("name", "tester3");
//echo Session::get("name");

//Session::flash("create_success", "category created successfully");

//Session::flash("create_success");
/*
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
*/

//$mailer->send();

//extract($data);
//echo  $to_name;

//if($mailer->send($data)){
//    echo "<br><h1>Mail Send Successfully</h1>";
//}else{
//    echo "<br><h1>Mail Send Fail!</h1>";
//}
