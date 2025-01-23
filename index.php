
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>To-Do List</title>
</head>
<body>

    <h1>TODO LIST</h1>
            <?php

            include 'db_connect.php';


            $sql = "SELECT * FROM tasks";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                echo "<table border='1'>"; // Start the table and add a border for visibility
                
                echo "<tr>
                        <th>Task ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                     </tr>"; // Table headers
                
                while($row = $result->fetch_assoc()) {
                    // echo "Task ID ". $row["id"] . " : " . $row["title"] . " : " .
                    // $row["description"].
                    // " - Status: " . $row["status"] . "<br>";

                    // echo    "ID : ". $row["id"] . " ----- ".   
                    //         "Title : " . $row["title"] . " ---- ".    
                    //         "Description : " . $row["description"] . " ---- ".     
                    //         "Status : ". $row["status"] . "<br>";
                            
                            echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>"; // Task ID
                                echo "<td>" . $row["title"] . "</td>"; // Title
                                echo "<td>" . $row["description"] . "</td>"; // Description
                                echo "<td>" . $row["status"] . "</td>"; // Status


                                echo "<td>";

                                    echo "<form action='delete_task.php' method='POST' style='display:inline;'>";
                                          echo "<input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button class='button-delete' type='submit'>Delete</button>";
                                    echo "</form>";

                                    echo "<form action='update_task.php' method='POST' style='display:inline;'>";
                                          echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                                                if ($row["status"] == "Pending") {
                                                    echo "<input type='hidden' name='new_status' value='Completed'>
                                                          <button class='button-update-cmpltd' type='submit'>Mark as Completed</button>";
                                                } else {
                                                    echo "<input type='hidden' name='new_status' value='Pending'>
                                                          <button class='button-update-incmplt' type='submit'>Mark as Incomplete</button>";
                                                }

                                   echo "</form>";
                                
                                echo "</td>";



                            echo "</tr>"; // End the row   
                }
                
                echo "</table>"; // End the table

            } else {
                echo "<p class='no-task-found'>Hoorrrray...!! No tasks found :) </p>";
            }
            $conn->close();

            ?>
<div class=add-task-form>
    <h2>Add a new task</h2>
    <form action="add_task.php" method="POST">
        <input type="text" name="title" placeholder="Task title" required>
        <textarea name="description" placeholder="Task description"></textarea>
        <button class="add-task-button" type="submit">Add Task</button>
    </form>            
</div>

</body>
</html>
