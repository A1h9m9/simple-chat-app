<?php
include 'connect.php';

if (isset($_POST['comment'])) {
    // Sanitize and validate the input
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
    if (empty($comment)) {
        $error = "Please enter a valid comment.";
    } else {
        // Insert the comment into the database
        $sql = "INSERT INTO comments (comment) VALUES (:comment)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }
}

// Retrieve the comments from the database
$sql = "SELECT * FROM comments ORDER BY created_at DESC";
$stmt = $con->prepare($sql);
$stmt->execute();
$comments = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Comment Bar</title>
</head>
<body>
    <!-- Display any errors -->
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Display the comment form -->
    <form method="post">
        <textarea name="comment" placeholder="Leave a comment"></textarea>
        <button type="submit">Submit</button>
    </form>

    <!-- Display the comments -->
    <?php foreach ($comments as $comment): ?>
        <p><?php echo $comment['comment']; ?></p>
        <p><?php echo $comment['created_at']; ?></p>
    <?php endforeach; ?>
</body>
</html>