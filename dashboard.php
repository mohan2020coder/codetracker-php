
<?php
require 'includes/functions.php';


if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

try {
    $projectsCursor = $db->projects->find(['user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id'])]);
    $projects = iterator_to_array($projectsCursor);
} catch (Exception $e) {
    $debugbar["messages"]->addMessage("Error fetching projects: " . $e->getMessage());
    die("Error fetching projects: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectName = $_POST['project_name'];
    try {
        $db->projects->insertOne([
            'user_id' => new MongoDB\BSON\ObjectId($_SESSION['user_id']),
            'name' => $projectName
        ]);
        header('Location: dashboard.php');
        exit();
    } catch (Exception $e) {
        $debugbar["messages"]->addMessage("Error inserting project: " . $e->getMessage());
        die("Error inserting project: " . $e->getMessage());
    }
}

$pageTitle = 'Dashboard - CodeTracker';

ob_start();
?>

<style>
    ul {
        list-style: none;
        padding: 0;
    }
</style>
<h1>Dashboard</h1>
<form method="post" action="">
    <input type="text" name="project_name" placeholder="New Project Name" class="input" required>
    <button type="submit" class="btn">Add Project</button>
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
<a href="logout.php" class="input">Logout</a>

<?php
$content = ob_get_clean();

include 'base_template.php';

if (isset($projectName)) {
    $debugbar["messages"]->addMessage("New project added: $projectName");
}
?>


<?php
include 'footer.php';
?>
