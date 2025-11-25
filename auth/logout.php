<?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

logout();
header('Location: ' . url('index.php'));
exit;
?>