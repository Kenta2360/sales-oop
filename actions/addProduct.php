<?php
include "../classes/User.php";

$user = new User;

$user->addProduct($_POST);

?>