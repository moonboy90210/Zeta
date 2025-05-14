<?php
require '../connect.php';

$username = 'admin';
$plainPassword = 'admin123';
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO zeta_admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);
$stmt->execute();

echo "Admin user created!";
?>
