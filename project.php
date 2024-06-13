<?php
require 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$projectId = new MongoDB\BSON\ObjectId($_GET['id']);
$project = $db->projects->findOne(['_id' => $projectId, 'user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);

if (!$project) {
    echo "Project not found!";
    exit();
}

$tasks = $db->tasks->find(['project_id' => $projectId]);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($project['name'], ENT_QUOTES); ?> - CodeTracker</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($project['name'], ENT_QUOTES); ?></h1>
    <form method="post" action="">
        <input type="text" name="task_name" placeholder="New Task Name" required>
        <button type="submit">Add Task</button>
    </form>
    <h2>Tasks</h2>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?php echo htmlspecialchars($task['name'], ENT_QUOTES); ?>
                (<?php echo $task['status']; ?>)
                <form method="post" action="task.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $task['_id']; ?>">
                    <input type="hidden" name="action" value="update">
                    <select name="status">
                        <option value="incomplete" <?php echo $task['status'] == 'incomplete' ? 'selected' : ''; ?>>Incomplete</option>
                        <option value="complete" <?php echo $task['status'] == 'complete' ? 'selected' : ''; ?>>Complete</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
                <form method="post" action="task.php" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $task['_id']; ?>">
                    <input type="hidden" name="action" value="delete">
                    <button type="submit">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
