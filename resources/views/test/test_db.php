<?php
require_once 'C:/wamp64/www/Employee-Bee/app/config/database.php';
$db = new Database();
$conn = $db->getConnection();
echo "Database connected successfully!";
?>