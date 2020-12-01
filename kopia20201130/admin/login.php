<?php
session_start();
error_reporting(-1);
?>
<?php
  include_once "api/dbhandler.php";
  
    if(isset($_SESSION["username"])){
      header("Location: ../index.php");
      exit();
    }

  $db = getDB();
  $users = $db["users"];
  $method = $_SERVER["REQUEST_METHOD"];

  if($method !== "POST"){
    // sendError(405, "Method not allowed.");
    header("Location: ../index.php");
    exit();
  }

  $username = $_POST["username"];
  $password = $_POST["password"];

  if($username === "" || $password === ""){
    // sendError(400, "Both fields must be filled");
    header("Location: ../index.php?error=1");
    exit();
  }

  foreach($db["users"] as $user){
    if($user["name"] === $username && $user["password"] === $password){
      $_SESSION["username"] = $username;
      $_SESSION["userID"] = $user["id"];
      http_response_code(200);
      header("Location: ../index.php");
      exit();
    }  
  }
  // sendError(400, "Incorrect username or password");
  header("Location: ../index.php?error=2");
?>