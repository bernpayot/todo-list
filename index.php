<?php
    $PageTitle = "Home";
        require 'dbconn.php';
    require 'header.php';
?>

<main>
    <div class="date-container">
        <p class="day"><?php echo date("l"); ?></p>
        <p class="time"><?php echo date("m/d/Y"); ?></p>
    </div>
    <div class="add-task-container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="form-control">
            <input type="text" name="add-task" id="add-task" placeholder="Add a task..." required>
            <input type="submit" name="submit" id="submit-btn" value="Add">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $task = filter_input(INPUT_POST, "add-task", FILTER_SANITIZE_SPECIAL_CHARS);
                if (!empty($task)) {
                    $sql = "INSERT INTO tasks (description) VALUES ('$task')";

                    try {
                        mysqli_query($conn, $sql);
                        header("Location: " . $_SERVER["PHP_SELF"]);
                        exit();                        
                    } catch (mysqli_sql_exception) {
                        echo "Error!";
                    }
                }   
            }
        ?>
    </div>

    <div class="task-container" style="overflow-y: auto; display: flex; flex-direction: column; justify-content: flex-start; height: clamp(300px, calc(100vh - 250px), 800px); padding: 1rem; margin-bottom: 2rem;">
            <?php
                $sql = "SELECT * FROM tasks ORDER BY id DESC";
                try {
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <div class="task-card" style="display:flex; justify-content: center; background-color: #343a40; border: 1px solid rgb(33,37,41,1); 
                            border-radius: 5px; color: #f8f9fa; padding: 1.5rem; margin: 1.2rem;">
                                <h2> <?php echo $row["description"]; ?> </h2>
                            </div>
                        <?php    
                        }
                    } else {
                        ?>
                            <div class="no-tasks" style="display: flex; justify-content: center; text-align: center;">
                                <h2> There are no tasks currently. </h2>
                            </div>                            
                        <?php
                    }
                } catch (mysqli_sql_exception) {
                    echo "Error!";
                }
            ?>    
    </div>    
</main>

<?php
    require 'footer.php';
    mysqli_close($conn);
?>