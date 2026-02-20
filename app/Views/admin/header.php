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
       
      
            <strong>Bank System</strong>
        
       
    </div>

    <nav class="menu">
        <div class="dropdown">
            <button class="px-3 py-1.5 rounded flex items-center gap-0.5 hover:bg-gray-800">CUSTOMERS ▾</button>
            <div class="dropdown-content">
                <a href="<?= base_url('member/list') ?>">Customer List</a>
                <a href="<?= base_url('member/create') ?>"> Create Customer</a>
                
            </div>
        </div>
    </nav>
    <nav class="menu">
        <div class="dropdown">
            <button class="px-3 py-1.5 rounded flex items-center gap-0.5 hover:bg-gray-800">MEMBERS ▾</button>
            <div class="dropdown-content">
                <a href="<?= base_url('share/sharecreationlist') ?>">Member List</a>
                <a href="<?= base_url('share/sharecreation') ?>"> Member\Share Creation</a>
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