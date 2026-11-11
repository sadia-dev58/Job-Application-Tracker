<?php
// Login guard: include at the top of every protected page
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
