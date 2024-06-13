<?php
require 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$projects = $db->projects->find(['user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectName = $_POST['project_name'];
    $db->projects->insertOne([
        'user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id']),
        'name' => $projectName
    ]);
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - CodeTracker</title>
</head>
<body>
    <h1>Dashboard</h1>
    <form method="post" action="">
        <input type="text" name="project_name" placeholder="New Project Name" required>
        <button type="submit">Add Project</button>
    </form>
    <h2>Your Projects</h2>
    <ul>
        <?php foreach ($projects as $project): ?>
            <li>
                <a href="project.php?id=<?php echo $project['_id']; ?>">
                    <?php echo htmlspecialchars($project['name'], ENT_QUOTES); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="logout.php">Logout</a>
</body>
</html>
