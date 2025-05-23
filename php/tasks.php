<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Louis Tran, Alex Ala-Kantti Ayman Nasir">
    <meta charset="UTF-8">
    <title>Task Manager - Home</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>



<!--
JavaScript :
    Open/close modals
    Handle form submissions with fetch/DOM
    Hook up filter & sort functions
PHP :
Handle form data in add-task.php, edit-task.php, and delete-task.php
CSS teammate: style the modals, table, and filters-->



<body>
    <?php 
        require_once('credentials.php');
        require_once('database.php');
        $db = db_connect();
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('Location: login.html');
            exit;
        }
    ?>

    <header>
        <nav>
            <ul>
                <li> <a href="index.html"> Home</a></li>
                <li> <a href="tasks.php">Task List</a></li>
                <li> <a href="about.html">About</a></li>
                <li> <a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Task List</h1>
        <!-- Filters for tasks -->

        <div class="filter-section">
            <label for="filterStatus">Status:</label>
            <select id="filterStatus">
                <option value="all">All</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>

            <label for="filterPriority">Priority:</label>
            <select id="filterPriority">
                <option value="all">All</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>

            <label for="filterDueDate">Due Date:</label>
            <input type="date" id="filterDueDate">

            <button id="applyFilters">Apply Filters</button>
        </div>



        <div class="sort-section">
            <label for="sortBy">Sort By:</label>
            <select id="sortBy">
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="urgent">Urgent</option>
            </select>
            <button id="sortTasks">Sort</button>
        </div>


        <!-- Task Table -->
        <?php 
            $sql = "SELECT * FROM tasks ";
            $results = mysqli_query($db, $sql);
        ?>

        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="taskList">
                <!-- Tasks will be dynamically inserted here -->
                <?php while($output = mysqli_fetch_assoc($results)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($output['name']); ?></td>
                        <td><?php echo htmlspecialchars($output['date']); ?></td>
                        <td><?php echo htmlspecialchars($output['priority']); ?></td>
                        <td><?php echo htmlspecialchars($output['status']); ?></td>
                        <td>
                            <button class="edit-btn">Edit</button>
                            <a href="delete.php?deleteid=<?php echo $output['id'] ?>" class="delete-btn">Delete</a>
                            <a href="update_status.php?updateid=<?php echo $output['id'] ?>" class="mark-done-btn">Mark Done</a>
                        </td>
                    </tr>
                <?php } ?>
                
            </tbody>
        </table>

        <!-- Button to open the Add Task modal -->

        <button id="openAddTask">+ Add Task</button>


        <!--Php  controls the Add Task modal.-->
        <div id="addTaskModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span> <!--Close Button-->
                <h2>Add New Task</h2>
                <form id="addTaskForm" action='insert.php' method="POST">
                    
                    <label for="taskTitle">Task Title:</label>
                    <input type="text" name="name" id="taskTitle" required>

                    <label for="taskDescription">Description:</label>
                    <textarea id="taskDescription" required></textarea>

                    <label for="taskDueDate">Due Date:</label>
                    <input type="date" name="date" id="taskDueDate" required>

                    <label for="taskPriority">Priority:</label>
                    <select name="priority" id="taskPriority">
                        <option value="!!! (High)">!!! (High)</option>
                        <option value="!! (Medium)">!! (Medium)</option>
                        <option value="! (Low)">! (Low)</option>
                    </select>

                    <label for="taskStatus">Status:</label>
                    <select name="status" id="taskStatus">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>

                    <input type="submit">Add Task</input>
                </form>
            </div>
        </div>

        <div id="editTaskModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Edit Task</h2>
                <form id="editTaskForm" action="alter.php"  method="POST">
                    <input type="hidden" name="editid" id="editTaskId">

                    <label for="editTaskTitle">Task Title:</label>
                    <input type="text" name="newname" id="editTaskTitle" required>

                    <label for="editTaskDescription">Description:</label>
                    <textarea id="editTaskDescription" required></textarea>

                    <label for="editTaskDueDate">Due Date:</label>
                    <input type="date" name="newdate" id="editTaskDueDate" required>

                    <label for="editTaskPriority">Priority:</label>
                    <select name="newpriority" id="editTaskPriority">
                        <option value="!!! (High)">!!! (High)</option>
                        <option value="!! (Medium)">!! (Medium)</option>
                        <option value="! (Low)">! (Low)</option>
                    </select>

                    <label for="editTaskStatus">Status:</label>
                    <select name="newstatus" id="editTaskStatus">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>

                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Task Manager. All Rights Reserved.</p>
    </footer>
   
    <script src="js/task.js"></script>
</body>
</html>