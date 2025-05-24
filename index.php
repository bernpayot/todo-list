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
            <input type="text" name="add-task" id="add-task" placeholder="Add a task...">
            <input type="submit" name="submit" id="submit-btn" value="Add">
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $task = filter_input(INPUT_POST, "add-task", FILTER_SANITIZE_SPECIAL_CHARS);
                if (!empty($task)) {
                    $sql = "INSERT INTO tasks (description) VALUES ('$task')";

                    try {
                        mysqli_query($conn, $sql);
                        echo "Task created!";
                    } catch (mysqli_sql_exception) {
                        echo "Error!";
                    }
                }   
            }
        ?>
    </div>
</main>

<?php
    require 'footer.php';
?>