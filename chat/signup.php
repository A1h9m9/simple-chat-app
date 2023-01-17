<?php

if(isset($_POST['username'])){
    include 'connect.php';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password= sha1($_POST['password']);
    $stmt =$con->prepare('SELECT username FROM users WHERE username=?');
    $stmt->execute([$username]);
    if($stmt->rowCount()>0){
        header('Location:signin.php');
    }else{
        $stmt1=$con->prepare('INSERT INTO users(username, Email, password)VALUES(?,?,?)');
        $stmt1->execute([$username,$email,$password]);
        if($stmt1->rowCount()>0){
            header('Location:login.php');

        }
    }
    
}