<?php
session_start();
if (($_SESSION['user_role'] ?? '') !== 'Admin') {
    header('Location: /church/login.php');
    exit;
}
$mysqli = new mysqli('localhost', 'root', '', 'test');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['roles'])) {
    foreach ($_POST['roles'] as $user_id => $role) {
        $stmt = $mysqli->prepare("UPDATE users SET role=? WHERE id=?");
        $stmt->bind_param("si", $role, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}
header('Location: perfiles.php');
exit;
