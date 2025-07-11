<?php
session_start();
if (($_SESSION['user_role'] ?? '') !== 'Admin') {
    header('Location: /church/login.php');
    exit;
}
// Conexión a la base de datos XAMPP/phpMyAdmin
$mysqli = new mysqli('localhost', 'root', '', 'test');
function get_all_users() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, username, role FROM users");
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administrar Perfiles</title>
</head>
<body>
    <h1>Administrar Perfiles de Usuario</h1>
    <form method="post" action="perfiles_update.php">
        <table>
            <tr><th>Usuario</th><th>Perfil</th></tr>
            <?php
            foreach (get_all_users() as $user) {
                echo "<tr>
                    <td>{$user['username']}</td>
                    <td>
                        <select name='roles[{$user['id']}]'>";
                foreach (array_keys(include __DIR__ . '/../config/roles.php') as $role) {
                    $selected = $user['role'] === $role ? 'selected' : '';
                    echo "<option value='$role' $selected>$role</option>";
                }
                echo "</select>
                    </td>
                </tr>";
            }
            ?>
        </table>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
