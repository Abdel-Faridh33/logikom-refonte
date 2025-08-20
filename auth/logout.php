<?php
session_start();
require_once '../includes/functions.php';

logout();
header('Location: ../index.php');
exit;
?>