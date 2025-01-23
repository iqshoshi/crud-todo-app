<!-- <form action="add_task.php" method="POST">
    <input type="text" name="title" placeholder="Task title" required>
    <textarea name="description" placeholder="Task description"></textarea>
    <button type="submit">Add Task</button>
</form> -->

<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tasks 
        (title, description, status) 
        VALUES ('$title', '$description', 'Pending')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}


?>
