<?php
// hash_test.php
$password = '12345678';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "El hash para '12345678' es: <br>";
echo "<strong>" . $hash . "</strong>";
?>