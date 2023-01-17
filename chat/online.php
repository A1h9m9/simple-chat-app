<?php

if(isset($_POST['submit'])){
    include 'connect.php';
    include 'header.php';
    $status='online';
    $stmt=$con->prepare('INSERT INTO online_button(status) VALUE(?)');
    $stmt->execute([$status]);
    if($stmt->rowCount()>0){?>
        <button type="button" class="btn btn-success">online</button>
<?php
    }
}