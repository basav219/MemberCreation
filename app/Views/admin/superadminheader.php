<!DOCTYPE html>
<html>
<head>
    <title>SuperAdmin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">CO-OP BANK | SuperAdmin</span>

    <div class="text-white">
        <?= session()->get('username') ?>
        <a href="<?= site_url('admin/logout') ?>" class="btn btn-sm btn-danger ms-3">Logout</a>
    </div>
</nav>

<div class="container mt-4"></div>