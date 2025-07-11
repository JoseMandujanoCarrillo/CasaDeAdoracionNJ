<?php
session_start();

function can_modify($section) {
    $roles = include __DIR__ . '/../config/roles.php';
    $user_role = $_SESSION['user_role'] ?? null;
    if (!$user_role || !isset($roles[$user_role])) return false;
    $can = $roles[$user_role]['can_modify'];
    return in_array('all', $can) || in_array($section, $can);
}