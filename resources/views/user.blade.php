<?php
//session_start();
//require "bootstrap.php";

use App\Suser;
use Illuminate\Database\Capsule\Manager as Capsule;
use Carbon\Carbon;
use Illuminate\Support\Str;


//$user = $_SESSION['user'];

if (isset($_POST["user_name"])) {


    $api_token = Str::random(10);
    $create_time = Carbon::now();

    $crete=App\Suser::Create
    ([
        'user_name' => $_POST["user_name"],
        'password' => $_POST["password"],
        'api_token' => $api_token,
        'create_time' => $create_time,
    ]);

        dd($crete);

    echo "新增 User 成功";
//
//    $_SESSION["user"]=$_POST["user"];
//    $url = "ormboard.php";
//    echo "<script language='javascript' type='text/javascript'>";
//    echo "window.location.href='$url'";
//    echo "</script>";

}
