<?php

include 'connect.php';


if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $message=$_POST['message'];
    $stmt=$con->prepare('INSERT INTO chat(usename, message) VALUES(?, ?)');
    $stmt->execute([$username,$message]);
}

$stmt1=$con->prepare('SELECT * FROM chat ORDER BY chat_id DESC');
$stmt1->execute();


while($row = $stmt1->fetch()){
    echo "<p>" . $row['usename'] . ":" . $row['message'] . "</p>";
}

?>
<form method="POST">
    <label>username</label>
    <input type="txet" name="username">
    <label>message</label>
    <input type="txet"  name="message">
    <input type="submit" name="submit" value="send">

</form>