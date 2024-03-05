<?php
session_start();
$user = $_SESSION['user'];
if ($user == null) {
	header('Location: ../index.html');
	exit;
}
if (isset($_GET['logHout'])) {
    unset($_SESSION['user']);
    header('Location: ../index.html');
	exit;
}

?>