<?php

session_start();
if(isset($_SESSION['user'])){
    header('Location:chat.php');
}
include 'connect.php';
include 'header.php';
if(isset($_POST['username'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password= sha1($_POST['password']);
    $stmt=$con->prepare('SELECT user_id, username, Email, password FROM users WHERE username=? AND Email=? AND password=?');
    $stmt->execute([$username,$email,$password]);
    $row=$stmt->fetch();
    if($stmt->rowCount()>0){
        $_SESSION['user']=$username;
        $_SESSION['user_id']=$row['user_id'];
        header('Location:chat.php');
    }
}
?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
<div class="mb-3">
        <input type="hidden" name="user_id">
    <label for="exampleInputEmail1" class="form-label">username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>