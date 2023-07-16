<?php
require_once('../classes/User.php');
require_once('../includes/config.php');

$user = new User('','', '', '', '', '','');
$user->disconnect();
header("Location:connexion.php");