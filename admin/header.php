<?php require_once 'session.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Admin Panel'; ?> - Anastasya Vocal Arts</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="admin-wrapper">
        <div class="sidebar">
            <div class="sidebar-header">
                <h2>AVA<span>Panel</span></h2>
            </div>
            <ul class="sidebar-menu">
                <li class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                    <a href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
                </li>
                <li class="<?php echo ($active_page == 'students') ? 'active' : ''; ?>">
                    <a href="students.php"><i class="fas fa-user-graduate"></i><span>Data Murid</span></a>
                </li>
                <li class="<?php echo ($active_page == 'admins') ? 'active' : ''; ?>">
                    <a href="admins.php"><i class="fas fa-user-shield"></i><span>Data Admin</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
        <div class="main-content">
            <header class="header">
                <h1><?php echo $page_title ?? 'Dashboard'; ?></h1>
                <div class="user-info">
                    Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['admin_nama']); ?></strong> | <a href="logout.php">Logout</a>
                </div>
            </header>
            <main>
