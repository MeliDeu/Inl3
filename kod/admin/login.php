<?php
  error_reporting(-1);
  session_start();
  include_once "../api/dbhandler.php";
  
  if(isset($_SESSION["username"])){
    header("Location: ../index.php");
    exit();
  }
  $post = file_get_contents("php://input");
  $database = getDB();
  $users = $database["users"];
  $method = $_SERVER["REQUEST_METHOD"];
  $contentType = $_SERVER["CONTENT_TYPE"];

  if($method !== "POST"){
    http_response_code(405);
    echo "fel";
    header("Location: ../index.php");
    exit();
  }

  if($contentType !== "application/json"){
    http_response_code(400);
    echo $contentType;
    echo $post;
    exit();
  }
  $loginData = json_decode($post, true);
  echo $post;
  $loginUsername = $loginData["username"];
  $loginPassword = $loginData["password"];

  foreach($users as $user){
    if($user["name"] === $loginUsername && $user["password"] === $loginPassword){
      $_SESSION["username"] = $loginUsername;
      header("Location: ../index.php");
      exit();
    } else {
      http_response_code(400);
      exit();
    }
  }

?>