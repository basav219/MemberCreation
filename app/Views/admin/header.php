<!DOCTYPE html>
<html>
<head>
      <meta charset="UTF-8">
    <title><?= esc($title ?? 'CO-OP BANK') ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
     <link rel="stylesheet" href="<?= base_url('CSS/custom.css') ?>">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <!-- <span class="logo">🏦</span> -->
        <div>
            <strong>Bank System</strong>
            <!-- <small>Credit Co-operative Society</small> -->
        </div>
    </div>

    <nav class="menu">
        <div class="dropdown">
            <button class="dropbtn">Customers ▾</button>
            <div class="dropdown-content">
                <a href="<?= base_url('member/list') ?>">Customer List</a>
                <a href="<?= base_url('member/create') ?>"> Create Customer</a>
                <a href="<?= base_url('member/sharecreation') ?>"> Share Creation</a>
            </div>
        </div>
    </nav>

    <div class="user">
        <span class="username"> <?= session('username') ?></span>
        <a href="<?= base_url('admin/logout') ?>" class="logout">Logout</a>
    </div>
</header>
</body>
</html>