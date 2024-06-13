<?php
require 'includes/functions.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskId = new MongoDB\BSON\ObjectId($_POST['id']);
    $task = $db->tasks->findOne(['_id' => $taskId]);
    if ($task) {
        if ($_POST['action'] == 'update') {
            $db->tasks->updateOne(
                ['_id' => $taskId],
                ['$set' => ['status' => $_POST['status']]]
           
            );
            header('Location: project.php?id=' . $task['project_id']);
            exit();
        } elseif ($_POST['action'] == 'delete') {
            $db->tasks->deleteOne(['_id' => $taskId]);
            header('Location: project.php?id=' . $task['project_id']);
            exit();
        }
    }
}

// If the script reaches here, it means there was an invalid request
echo "Invalid request!";
?>