<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table th, .table td {
            vertical-align: middle;
            white-space: nowrap;
        }

        .add-admin-btn {
            font-weight: 600;
        }
    </style>
</head>

<body>

<?= view('admin/header', data: ['title' => 'Admin Dashboard']) ?>

<div class="container-fluid px-4 mt-3">

    <div class="card shadow-sm">
        <div class="card-body">

            <!-- HEADER ROW -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">📋 List of Admins</h5>

                <a href="<?= site_url('admin/create') ?>"
                   class="btn btn-primary add-admin-btn px-4">
                    ➕ Create Admin
                </a>
            </div>

            <!-- SUCCESS MESSAGE -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($admins)): ?>
                        <?php foreach ($admins as $admin): ?>
                            <tr>
                                <td><?= $admin['id'] ?></td>
                                <td><?= esc($admin['username']) ?></td>
                                <td><?= ucfirst($admin['role']) ?></td>
                                <td><?= $admin['created_at'] ?></td>
                                 <td>
                <a href="<?= site_url('admin/change_password/' . $admin['id']) ?>" 
                   class="btn btn-sm btn-warning">
                   🔑 Change Password
                </a>
            </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                No admins found
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <?php if (isset($pager)): ?>
                <div class="d-flex justify-content-center mt-3">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= view('admin/sharefooter') ?>

</body>
</html>