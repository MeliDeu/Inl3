<?php error_reporting(-1); ?>
<?php
  session_start();
  include_once "../api/dbhandler";

  if(isset($_SESSION["username"])){
    header("Location: ../index.php");
    exit();
  }

  $database = getDB();
  $users = $database["users"];
  $method = $_SERVER["REQUEST_METHOD"];

  if(!$method === "POST"){
    http_response_code(405);
    exit();
  }
$postUsername = $_POST["username"];
$postPassword = $_POST["username"];

foreach($users as $index => $user){
  if($user["name"] === $postUsername && $user["password"] === $postPassword){
    $_SESSION["username"]
  }
}

?>