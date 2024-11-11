<?php
include "../classes/User.php";

$user = new User;
$id = $_POST['id'];
$user->delete($id);
?>