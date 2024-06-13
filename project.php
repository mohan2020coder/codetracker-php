<?php
require 'includes/functions.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Validate project ID
$projectId = new MongoDB\BSON\ObjectId($_GET['id']);
$project = $db->projects->findOne(['_id' => $projectId, 'user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);

// If project not found, exit
if (!$project) {
    echo "Project not found!";
    exit();
}

// Fetch tasks for the project
$tasks = $db->tasks->find(['project_id' => $projectId]);

// Handle new task form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskName = $_POST['task_name'];
    $db->tasks->insertOne([
        'project_id' => $projectId,
        'name' => $taskName,
        'status' => 'incomplete'
    ]);
    header('Location: project.php?id=' . $projectId);
    exit();
}

// Set page title
$pageTitle = htmlspecialchars($project['name'], ENT_QUOTES) . " - CodeTracker";

// Output buffering for capturing content
ob_start();
?>

<!-- HTML and CSS for the page -->
<style>
    .task-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .task-table th,
    .task-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .task-table th {
        background-color: #f0f0f0;
    }

    .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn i {
        margin-right: 5px;
    }

    .input {
        padding: 6px 8px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .select-status {
        width: 100px;
    }

    .task-item {
        margin-bottom: 10px;
    }
</style>

<h1><?php echo htmlspecialchars($project['name'], ENT_QUOTES); ?></h1>

<!-- Form to add new task -->
<form method="post" action="">
    <input type="text" name="task_name" placeholder="New Task Name" required>
    <button type="submit" class="btn"><i class="fas fa-plus"></i> Add Task</button>
</form>

<h2>Tasks</h2>

<!-- Table to display tasks -->
<table class="task-table">
    <thead>
        <tr>
            <th>Task Name (Status)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task) : ?>
            <tr>
                <td><?php echo htmlspecialchars($task['name'], ENT_QUOTES); ?> (<?php echo $task['status']; ?>)</td>
                <td>
                    <!-- Form for updating task status -->
                    <form method="post" action="task.php" class="task-form">
                        <input type="hidden" name="id" value="<?php echo $task['_id']; ?>">
                        <input type="hidden" name="action" value="update">
                        <select name="status" class="input select-status">
                            <option value="incomplete" <?php echo $task['status'] == 'incomplete' ? 'selected' : ''; ?>>Incomplete</option>
                            <option value="complete" <?php echo $task['status'] == 'complete' ? 'selected' : ''; ?>>Complete</option>
                        </select>
                        <button type="submit" class="btn btn-update"><i class="fas fa-edit"></i></button>
                    </form>

                    <!-- Form for deleting task -->
                    <form method="post" action="task.php" class="task-form">
                        <input type="hidden" name="id" value="<?php echo $task['_id']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-delete"><i class="fas fa-trash-alt"></i> </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Link back to dashboard -->
<a href="dashboard.php" class="btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>

<?php
// End of content capture
$content = ob_get_clean();

// Including base template
include 'base_template.php';

// Debugging message
if (isset($projectName)) {
    $debugbar["messages"]->addMessage("New project added: $projectName");
}

// Including footer
include 'footer.php';
?>
