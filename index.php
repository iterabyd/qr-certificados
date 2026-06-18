<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['usuario']))
{
    header('Location: views/dashboard/index.php');
    exit;
}

require_once 'views/auth/login.php';