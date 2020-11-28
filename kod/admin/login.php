<?php
session_start();
error_reporting(-1);
?>
<?php
  include_once "../api/dbhandler.php";

  if(isset($_SESSION["username"])){
    header("Location: ../index.php");
    exit();
  }

  $database = getDB();
  $users = $database["users"];
  $method = $_SERVER["REQUEST_METHOD"];

  if(!$method === "POST"){
    http_response_code(405);
    header("Location: ../index.php");
    exit();
  }
  $postUsername = $_POST["username"];
  $postPassword = $_POST["password"];

  foreach($users as $user){
    if($user["name"] === $postUsername && $user["password"] === $postPassword){
      $_SESSION["username"] = $postUsername;
      header("Location: ../index.php");
      exit();
    }
  }

?>