<?php
session_start();

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
    
    if ($id !== null && isset($_SESSION['contacts'][$id])) {
        unset($_SESSION['contacts'][$id]);
        
        $_SESSION['contacts'] = array_values($_SESSION['contacts']);
    }
}

header("Location: index.php");
exit;